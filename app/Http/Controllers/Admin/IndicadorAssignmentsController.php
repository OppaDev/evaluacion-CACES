<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criterio;
use App\Models\Evaluacion;
use App\Models\Indicador;
use App\Models\ModelHasPermission;
use App\Models\Permission;
use App\Models\User;
use App\Models\Universidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndicadorAssignmentsController extends Controller
{
    public function index() {}

    public function show($id)
    {
        $permisos = [];
        $criterios = Criterio::all();
        $indicadors = Indicador::all();
        $evaluacion = Evaluacion::find($id);
        $universidad = $evaluacion->universidad;

        // Verificar si el usuario actual es responsable de sede o CriteriaR
        $currentUser = Auth::user();
        if ($currentUser->hasRole('SedeR') && !$currentUser->hasRole('Admin')) {
            // Verificar que sea responsable de esta sede
            if (!$currentUser->esResponsableDeSede($universidad->id)) {
                abort(403, 'No tienes permiso para asignar en esta sede.');
            }
            // Filtrar usuarios de esta sede, excluyendo Admin y SedeR
            $users = User::whereHas('universidades', function ($query) use ($universidad) {
                $query->where('uni_id', $universidad->id);
            })->whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['Admin', 'SedeR']);
            })->get();
        } elseif ($currentUser->hasRole('CriteriaR') && !$currentUser->hasRole('Admin')) {
            // CriteriaR puede asignar usuarios de la sede de la evaluación
            $users = User::whereHas('universidades', function ($query) use ($universidad) {
                $query->where('uni_id', $universidad->id);
            })->whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['Admin', 'SedeR']);
            })->get();
        } else {
            // Admin puede ver todos los usuarios excepto Admin y SedeR
            $users = User::whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['Admin', 'SedeR']);
            })->get();
        }

        foreach ($indicadors as $key => $indicador) {
            $indId = $indicador->id;
            try {
                $permissionId = Permission::where("name", "$id-$indId")->first()->id;
                $userId = ModelHasPermission::where('permission_id', $permissionId)->first()->model_id;
                $permisos[$indId] = User::where('id', $userId)->first()->name;
            } catch (\Throwable $th) {
                $permisos[$indId]  = 'No asignado';
            }
        }
        return view('acreditacion_caces.indicador-assignments.index', compact('permisos', 'criterios', 'users', 'evaluacion'));
    }

    public function store(Request $request)
    {
        $permisos = [];
        $criterios = Criterio::all();
        $userId = $request->user_id;
        $indicadorId = $request->ind_id;
        $evaluacionId = $request->eva_id;
        $indicador = Indicador::where('id', $indicadorId)->first();
        try {
            $cri_id = $indicador->subcriterio->criterio->id;
        } catch (\Throwable $th) {
            $cri_id = $indicador->criterio->id;
        }
        $indicadors = Indicador::all();
        $evaluacion = Evaluacion::find($evaluacionId);
        $universidad = $evaluacion->universidad;
        $rolName = 'IndicatorR';
        $user = User::find($userId);

        // Verificar que el usuario a asignar no sea responsable de sede
        if ($user->hasRole('SedeR')) {
            session()->flash('error', 'No se puede asignar un responsable de sede a un indicador.');
            return redirect()->route('indicador.assignments.show', $evaluacionId);
        }

        // Verificar permisos del usuario actual
        $currentUser = Auth::user();
        if (($currentUser->hasRole('SedeR') || $currentUser->hasRole('CriteriaR')) && !$currentUser->hasRole('Admin')) {
            // SedeR: Verificar que sea responsable de esta sede
            if ($currentUser->hasRole('SedeR') && !$currentUser->esResponsableDeSede($universidad->id)) {
                session()->flash('error', 'No tienes permiso para asignar en esta sede.');
                return redirect()->route('indicador.assignments.show', $evaluacionId);
            }
            // Verificar que el usuario a asignar pertenezca a esta sede
            if (!$user->universidades()->where('uni_id', $universidad->id)->exists()) {
                session()->flash('error', 'Solo puedes asignar usuarios de tu sede.');
                return redirect()->route('indicador.assignments.show', $evaluacionId);
            }
        }

        $user->assignRole($rolName);
        try {
            $user->removeRole('Viewer');
        } catch (\Throwable $th) {
            //throw $th;
        }
        $permissionName = "$evaluacionId-$indicadorId";

        try {
            Permission::create(['name' => $permissionName, "guard_name" => 'web']);
            app()['cache']->forget('spatie.permission.cache');
            $user->givePermissionTo($permissionName);
            $user->givePermissionTo("$evaluacionId/$cri_id");
        } catch (\Throwable $th) {
            $oldUser = User::permission($permissionName)->get()->first();
            $oldUser->removeRole($rolName);
            $oldUser->revokePermissionTo($permissionName);
            if($oldUser->roles->isEmpty()&&$oldUser->permissions->isEmpty()){
                $oldUser->assignRole('Viewer');
            }
            $user->givePermissionTo($permissionName);
        }

        return redirect()->route('indicador.assignments.show', $evaluacionId);
    }
}
