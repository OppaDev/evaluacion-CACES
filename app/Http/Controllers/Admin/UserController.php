<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Universidad;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::with(['universidades', 'sedesResponsable', 'roles'])->get();
        $universidades = Universidad::all();
        return view('auth.users', compact(['users', 'universidades']));
    }
    public function destroy(User $user){
        $user->delete();
        session()->flash('success', 'Usuario eliminado correctamente.');
        return redirect()->route('users');
    }
}
