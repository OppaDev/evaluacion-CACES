<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criterio;
use App\Models\ModelHasPermission;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserHasCriterio;
use App\Models\Evaluacion;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;

class CriteriaAssignmentsController extends Controller
{
    public function index() {}

    public function show($id)
    {
        $aux = [];
        $criterios = Criterio::all();
        $evaluacion = Evaluacion::find($id);

        // Verificar que la evaluación existe
        if (!$evaluacion) {
            abort(404, 'La evaluación no existe.');
        }

        // Si es SedeR, verificar que la evaluación pertenece a su universidad
        $user = auth()->user();
        if ($user->hasRole('SedeR')) {
            $userUniversidadIds = $user->sedeResponsable->pluck('id')->toArray();
            if (!in_array($evaluacion->uni_id, $userUniversidadIds)) {
                abort(403, 'No tienes permiso para ver esta evaluación.');
            }
        }

        // Usuarios disponibles para asignar (todos excepto Admin y que pertenezcan a la misma sede)
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['Admin', 'SedeR']);
        })->whereHas('universidades', function ($query) use ($evaluacion) {
            $query->where('id', $evaluacion->uni_id);
        })->get();

        $responsable = User::where('id',);
        foreach ($criterios as $key => $criterio) {
            $criId = $criterio->id;
            try {
                $permissionId = Permission::where("name", "$id/$criId")->first()->id;
                $userId = ModelHasPermission::where('permission_id', $permissionId)->first()->model_id;
                $criterios[$key]['responsable'] = User::where('id', $userId)->first()->name;
            } catch (\Throwable $th) {
                $criterios[$key]['responsable'] = 'No asignado';
            }
        }
        return view('acreditacion_caces.criteria-assignments.index', compact('criterios', 'users', 'evaluacion'));
    }

    public function store(Request $request)
    {
        $userId = $request->user_id;

        // Validar si SedeR intenta autoasignarse
        if (auth()->user()->hasRole('SedeR') && auth()->id() == $userId) {
            session()->flash('error', 'No tiene permisos para autoasignarse criterios.');
            return redirect()->back();
        }

        $criterioId = $request->cri_id;
        $evaluacionId = $request->eva_id;
        $rolName = 'CriteriaR';
        $user = User::find($userId);
        $user->assignRole($rolName);
        try {
            $user->removeRole('Viewer');
        } catch (\Throwable $th) {
            //throw $th;
        }
        $permissionName = "$evaluacionId/$criterioId";

        try {
            Permission::create(['name' => $permissionName, "guard_name" => 'web']);
            app()['cache']->forget('spatie.permission.cache');
            $user->givePermissionTo($permissionName);
            session()->flash('success', 'Responsable asignado.');
        } catch (\Throwable $th) {
            $oldUser = User::permission($permissionName)->get()->first();
            if ($oldUser) {
                $permissionsCount = $oldUser->permissions()->where('name', 'like', "$evaluacionId/%")->count();
                if ($permissionsCount < 2) {
                    $oldUser->removeRole($rolName);
                }
                $oldUser->revokePermissionTo($permissionName);
                if ($oldUser->roles->isEmpty() && $oldUser->permissions->isEmpty()) {
                    $oldUser->assignRole('Viewer');
                }
            }
            $user->givePermissionTo($permissionName);
            $user->assignRole($rolName);
            session()->flash('success', 'Responsable actualizado.');
        }

        $criterios = Criterio::all();
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['Admin', 'SedeR']);
        })->get();
        $evaluacion = Evaluacion::find($evaluacionId);
        foreach ($criterios as $key => $criterio) {
            $permissionName = "$evaluacionId/$criterio->id";
            try {
                $permissionId = Permission::where("name", $permissionName)->first()->id;
                $userId = ModelHasPermission::where('permission_id', $permissionId)->first()->model_id;
                $criterios[$key]['responsable'] = User::where('id', $userId)->first()->name;
            } catch (\Throwable $th) {
                $criterios[$key]['responsable'] = 'No asignado';
            }
        }
        return redirect()->route('criteria.assignments.show', $evaluacionId);
    }
}
