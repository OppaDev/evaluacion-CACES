<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Universidad;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function showRegistrationForm(){
        $universidades = Universidad::all();
        return view('auth.register', compact('universidades'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'universidades_seleccionadas' => ['required'],  // Validar que haya universidades seleccionadas
        ]);
    }

    protected function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('Viewer');

        if (isset($request['universidades_seleccionadas'])) {
            $universidadesSeleccionadas = explode(',', $request->universidades_seleccionadas);

            foreach ($universidadesSeleccionadas as $universidadId) {
                $user->universidades()->attach($universidadId);
            }
        }

        session()->flash('success', 'Usuario registrado correctamente.');

        // return redirect()->route('universidades.index');
        return redirect()->route('users');
    }
}
