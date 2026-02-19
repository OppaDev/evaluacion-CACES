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
        // CriteriaR / IndicatorR: solo ven la sede de las evaluaciones donde tienen asignaciones
        else {
            $evaluacionIds = $user->getAllPermissions()
                ->pluck('name')
                ->map(function ($name) {
                    // Permisos dinámicos: "evaluacionId/criterioId" o "evaluacionId-indicadorId"
                    if (preg_match('/^(\d+)[\/\-]/', $name, $matches)) {
                        return (int) $matches[1];
                    }
                    return null;
                })
                ->filter()
                ->unique();

            $uniIds = \App\Models\Evaluacion::whereIn('id', $evaluacionIds)->pluck('uni_id')->unique();
            $universidades = Universidad::whereIn('id', $uniIds)->get();
        }

        return view('dashboard.welcome', compact('universidades'));
    }
}
