<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Universidad;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        $universidades = Universidad::all();
        $roles = Role::all();
        return view('auth.users', compact(['users', 'universidades', 'roles']));
    }
    
    public function destroy(User $user){
        $user->delete();
        session()->flash('success', 'Usuario eliminado correctamente.');
        return redirect()->route('users');
    }

    /**
     * Asignar rol SedeR a un usuario y vincular con universidad
     */
    public function assignSedeR(Request $request, User $user)
    {
        $request->validate([
            'universidad_id' => 'required|exists:universidads,id'
        ]);

        $universidad = Universidad::find($request->universidad_id);

        // Validar que el usuario no sea ya SedeR con otra universidad
        if ($user->hasRole('SedeR') && $user->universidades()->count() > 0) {
            session()->flash('error', 'Este usuario ya es SedeR de otra universidad. Primero debe removerlo.');
            return redirect()->route('users');
        }

        // Asignar rol y universidad
        $user->removeRole('Viewer');
        $user->assignRole('SedeR');
        $user->universidades()->sync([$universidad->id]);

        session()->flash('success', "Usuario asignado como SedeR de {$universidad->universidad}.");
        return redirect()->route('users');
    }

    /**
     * Remover rol SedeR de un usuario
     */
    public function removeSedeR(User $user)
    {
        if (!$user->hasRole('SedeR')) {
            session()->flash('error', 'Este usuario no es SedeR.');
            return redirect()->route('users');
        }

        $user->removeRole('SedeR');
        $user->universidades()->detach();
        $user->assignRole('Viewer');

        session()->flash('success', 'Rol SedeR removido correctamente. Usuario vuelve a ser Viewer.');
        return redirect()->route('users');
    }
}
