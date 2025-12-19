<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criterio;
use App\Models\Evaluacion;
use App\Models\Indicador;
use App\Models\ModelHasPermission;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class IndicadorAssignmentsController extends Controller
{
    public function index() {}

    public function show($id)
    {
        $permisos = [];
        $criterios = Criterio::all();
        $indicadors = Indicador::all();
        $users = $usuarios = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
        $evaluacion = Evaluacion::find($id);
        $responsable = User::where('id',);


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
        $users = User::all();
        $evaluacion = Evaluacion::find($evaluacionId);
        $rolName = 'IndicatorR';
        $user = User::find($userId);
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

        foreach ($indicadors as $key => $indicador) {
            $indId = $indicador->id;
            $permissionName = "$evaluacionId-$indId";
            try {
                $permissionId = Permission::where("name", $permissionName)->first()->id;
                $userId = ModelHasPermission::where('permission_id', $permissionId)->first()->model_id;
                $permisos[$indId] = User::where('id', $userId)->first()->name;
            } catch (\Throwable $th) {
                $permisos[$indId]  = 'No asignado';
            }
        }
        return redirect()->route('indicador.assignments.show', $evaluacionId);
    }
}
