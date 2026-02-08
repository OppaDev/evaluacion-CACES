<?php

namespace App\Http\Controllers;

use App\Models\Universidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard (Welcome Screen).
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        // Admin y Viewer ven todas las sedes
        if ($user->hasRole('Admin') || $user->hasRole('Viewer')) {
            $universidades = Universidad::all();
        } 
        // SedeR ve solo sus sedes asignadas
        elseif ($user->hasRole('SedeR')) {
            $universidades = $user->sedeResponsable;
        } 
        // Otros roles (CriteriaR, IndicatorR) ven donde tienen asignaciones (simplificado: ven todas por ahora o vacio?)
        // Por seguridad y simplicidad inicial, si tienen asignaciones deberían ver la universidad padre.
        // Asumiendo que pueden ver todas por ahora para entrar a evaluaciones donde tienen permiso
        else {
            // Ajustar según necesidad real, por defecto ven todas pero luego se filtra en EvaluationController
            $universidades = Universidad::all();
        }

        return view('dashboard.welcome', compact('universidades'));
    }
}
