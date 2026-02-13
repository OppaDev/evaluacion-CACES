<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Universidad;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $universidades = Universidad::all();
        $roles = Role::all();
        return view('auth.users', compact(['users', 'universidades', 'roles']));
    }

    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', 'Usuario eliminado correctamente.');
        return redirect()->route('users');
    }

    /**
     * Toggle rol SedeR: si ya es SedeR lo remueve, si no lo es lo asigna
     * usando automáticamente la sede registrada del usuario.
     */
    public function toggleSedeR(User $user)
    {
        // Si ya es SedeR, remover el rol
        if ($user->hasRole('SedeR')) {
            $user->removeRole('SedeR');
            $user->sedeResponsable()->detach();
            $user->assignRole('Viewer');

            session()->flash('success', 'Rol SedeR removido correctamente. Usuario vuelve a ser Viewer.');
            return redirect()->route('users');
        }

        // Validar que el usuario tenga una sede registrada
        $universidad = $user->universidades->first();
        if (!$universidad) {
            session()->flash('error', 'El usuario no tiene una sede registrada. Debe registrarse en una sede primero.');
            return redirect()->route('users');
        }

        // Asignar rol y universidad automáticamente
        $user->removeRole('Viewer');
        $user->assignRole('SedeR');
        $user->sedeResponsable()->sync([$universidad->id]);

        session()->flash('success', "Usuario asignado como Responsable de {$universidad->sede}.");
        return redirect()->route('users');
    }
}
