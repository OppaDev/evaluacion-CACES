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
        $users = $usuarios = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
        $evaluacion = Evaluacion::find($id);
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
        $criterioId = $request->cri_id;
        $evaluacionId = $request->eva_id;
        $rolName = 'CriteriaR';
        $user = User::find($userId);
        $user->assignRole(2);
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

        $criterios = Criterio::all();
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
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
