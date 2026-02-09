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
use App\Models\Universidad;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CriteriaAssignmentsController extends Controller
{
    public function index() {}

    public function show($id)
    {
        $aux = [];
        $criterios = Criterio::all();
        $evaluacion = Evaluacion::find($id);
        $universidad = $evaluacion->universidad;
        
        // Verificar si el usuario actual es responsable de sede
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
        } else {
            // Admin puede ver todos los usuarios excepto Admin y SedeR
            $users = User::whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['Admin', 'SedeR']);
            })->get();
        }

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
        $criterioId = $request->cri_id;
        $evaluacionId = $request->eva_id;
        $rolName = 'CriteriaR';
        $user = User::find($userId);
        $evaluacion = Evaluacion::find($evaluacionId);
        $universidad = $evaluacion->universidad;
        
        // Verificar que el usuario a asignar no sea responsable de sede
        if ($user->hasRole('SedeR')) {
            session()->flash('error', 'No se puede asignar un responsable de sede a un criterio.');
            return redirect()->route('criteria.assignments.show', $evaluacionId);
        }

        // Verificar si el usuario actual es responsable de sede
        $currentUser = Auth::user();
        if ($currentUser->hasRole('SedeR') && !$currentUser->hasRole('Admin')) {
            // Verificar que sea responsable de esta sede
            if (!$currentUser->esResponsableDeSede($universidad->id)) {
                session()->flash('error', 'No tienes permiso para asignar en esta sede.');
                return redirect()->route('criteria.assignments.show', $evaluacionId);
            }
            // Verificar que el usuario a asignar pertenezca a esta sede
            if (!$user->universidades()->where('uni_id', $universidad->id)->exists()) {
                session()->flash('error', 'Solo puedes asignar usuarios de tu sede.');
                return redirect()->route('criteria.assignments.show', $evaluacionId);
            }
        }

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
            $permissionsCount = $oldUser->permissions()->where('name', 'like', "$evaluacionId/%")->count();
            if($permissionsCount<2){
                $oldUser->removeRole($rolName);
            }
            $oldUser->revokePermissionTo($permissionName);
            if($oldUser->roles->isEmpty()&&$oldUser->permissions->isEmpty()){
                $oldUser->assignRole('Viewer');
            }
            $user->givePermissionTo($permissionName);
            $user->assignRole($rolName);
            session()->flash('success', 'Responsable actualizado.');
        }

        return redirect()->route('criteria.assignments.show', $evaluacionId);
    }
}
