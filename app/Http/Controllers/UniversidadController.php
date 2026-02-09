<?php

namespace App\Http\Controllers;

use App\Models\Universidad;
use App\Models\User;
use App\Models\Evaluacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UniversidadController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Admin y Viewer ven todas las sedes
        if ($user->can('admin') || $user->hasRole('Viewer')) {
            $universidades = Universidad::with('responsable')->get();
        } 
        // Responsable de Sede solo ve su sede
        elseif ($user->hasRole('SedeR')) {
            $universidades = Universidad::with('responsable')
                ->where('responsable_id', $user->id)
                ->get();
        }
        // Otros usuarios ven las sedes donde tienen permisos
        else {
            // Obtener IDs de universidades asignadas directamente
            $sedesDirectas = $user->universidades()->pluck('universidads.id')->toArray();
            
            // Obtener IDs de universidades donde tiene permisos en evaluaciones
            $sedesEvaluaciones = [];
            foreach ($user->getAllPermissions() as $permission) {
                // Permisos tipo "eva_id/criterio_id" o "eva_id-indicador_id"
                if (preg_match('/^(\d+)[\/\-]/', $permission->name, $matches)) {
                    $evaId = $matches[1];
                    $evaluacion = Evaluacion::find($evaId);
                    if ($evaluacion) {
                        $sedesEvaluaciones[] = $evaluacion->uni_id;
                    }
                }
            }
            
            $sedesIds = array_unique(array_merge($sedesDirectas, $sedesEvaluaciones));
            
            $universidades = Universidad::with('responsable')
                ->whereIn('id', $sedesIds)
                ->get();
        }
        
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'Admin');
        })->get();
        return view('acreditacion_caces.universidades.index', compact('universidades', 'users'));
    }

    public function create()
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'Admin');
        })->get();
        return view('acreditacion_caces.universidades.create', compact('users'));
    }

    // PARA GUARDAD LA INFROMACION DEL FORMULARIO 
    public function store(Request $request)
    {
        $data = $request->except('_token', 'foto', 'informe');
        
        // Crear o actualizar la universidad primero para obtener el ID
        $universidad = Universidad::updateOrCreate(
            ['campus' => $data['campus'], 'sede' => $data['sede'], 'ciudad' => $data['ciudad']],
            $data
        );

        // Ahora subir archivos usando el ID de la universidad
        if ($request->hasFile('foto')) {
            $universidad->foto = $request->file('foto')->storeAs('uploads/' . $universidad->id, 'foto.jpg', 'public');
            $universidad->save();
        }

        if ($request->hasFile('informe')) {
            $universidad->informe = $request->file('informe')->storeAs('uploads/' . $universidad->id, $request->file('informe')->getClientOriginalName(), 'public');
            $universidad->save();
        }

        return redirect()->route('universidades.index')->with('success', 'Sede guardada correctamente.');
    }

    // PARA MOSTRAR LA INFORMACION DEL REGISTRO A EDITAR
    public function edit($id)
    {
        $universidad = Universidad::find($id);
        return view('acreditacion_caces.universidades.edit', compact('universidad'));
    }

    // PARA GUARDAR LA INFORMACION EDITADA
    public function update(Request $request, $id)
    {
        $universidad = Universidad::findOrFail($id);
        
        // Actualizar campos de texto (excluyendo archivos)
        $data = $request->except('_token', '_method', 'foto', 'informe');
        $universidad->fill($data);

        // Solo actualizar foto si se sube una nueva
        if ($request->hasFile('foto')) {
            $universidad->foto = $request->file('foto')->storeAs('uploads/' . $id, 'foto.jpg', 'public');
        }

        // Solo actualizar informe si se sube uno nuevo
        if ($request->hasFile('informe')) {
            $universidad->informe = $request->file('informe')->storeAs('uploads/' . $id, $request->file('informe')->getClientOriginalName(), 'public');
        }

        $universidad->save();
        
        return redirect()->route('universidades.index')->with('success', 'Sede actualizada correctamente.');
    }

    // PARA ELIMINAR UN REGISTRO
    public function destroy($id)
    {
        Universidad::destroy($id);
        return redirect()->route('universidades.index');
    }

    // ASIGNAR RESPONSABLE DE SEDE
    public function asignarResponsable(Request $request, $id)
    {
        $request->validate([
            'responsable_id' => 'required|exists:users,id'
        ]);

        $universidad = Universidad::findOrFail($id);
        $nuevoResponsable = User::findOrFail($request->responsable_id);

        // Verificar que el usuario no sea ya responsable de otra sede
        if ($nuevoResponsable->esResponsableSede() && !$nuevoResponsable->esResponsableDeSede($id)) {
            session()->flash('error', 'Este usuario ya es responsable de otra sede.');
            return redirect()->route('universidades.index');
        }

        // Si hay un responsable anterior, quitarle el rol SedeR si no es responsable de otra sede
        if ($universidad->responsable_id && $universidad->responsable_id != $request->responsable_id) {
            $anteriorResponsable = User::find($universidad->responsable_id);
            if ($anteriorResponsable) {
                // Verificar si es responsable de otras sedes
                $otrasSedes = Universidad::where('responsable_id', $anteriorResponsable->id)
                    ->where('id', '!=', $id)
                    ->count();
                
                if ($otrasSedes == 0) {
                    $anteriorResponsable->removeRole('SedeR');
                    // Quitar permisos de criterios e indicadores de esta sede
                    $this->quitarPermisosSedeUsuario($anteriorResponsable, $universidad);
                }
            }
        }

        // Asignar el nuevo responsable
        $universidad->responsable_id = $request->responsable_id;
        $universidad->save();

        // Asignar rol SedeR al nuevo responsable
        $nuevoResponsable->assignRole('SedeR');
        
        // Quitar roles de CriteriaR e IndicatorR si los tiene
        try {
            $nuevoResponsable->removeRole('CriteriaR');
        } catch (\Throwable $th) {}
        try {
            $nuevoResponsable->removeRole('IndicatorR');
        } catch (\Throwable $th) {}
        try {
            $nuevoResponsable->removeRole('Viewer');
        } catch (\Throwable $th) {}

        // Asociar el usuario a la sede si no está asociado
        if (!$nuevoResponsable->universidades()->where('uni_id', $id)->exists()) {
            $nuevoResponsable->universidades()->attach($id);
        }

        session()->flash('success', 'Responsable de sede asignado correctamente.');
        return redirect()->route('universidades.index');
    }

    // Quitar permisos de criterios e indicadores de una sede a un usuario
    private function quitarPermisosSedeUsuario($user, $universidad)
    {
        $evaluaciones = $universidad->evaluacions;
        foreach ($evaluaciones as $evaluacion) {
            // Quitar permisos de criterios (formato: eva_id/cri_id)
            $permisosACriterios = $user->permissions()->where('name', 'like', "$evaluacion->id/%")->get();
            foreach ($permisosACriterios as $permiso) {
                $user->revokePermissionTo($permiso->name);
            }
            // Quitar permisos de indicadores (formato: eva_id-ind_id)
            $permisosAIndicadores = $user->permissions()->where('name', 'like', "$evaluacion->id-%")->get();
            foreach ($permisosAIndicadores as $permiso) {
                $user->revokePermissionTo($permiso->name);
            }
        }
    }
}
