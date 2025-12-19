<?php

namespace App\Http\Controllers;

use App\Models\Criterio;
use App\Models\Subcriterio;
use Illuminate\Http\Request;

class PorcentajeSubcriterioController extends Controller
{
    public function index()
    {
        $criterios = Criterio::all();
        return view('acreditacion_caces.porcentajes.subcriterios', compact('criterios'));
    }

    public function store(Request $request)
    {
        try {
            $datos = $request->except('_token');
            $criterios = Criterio::all();
            $bool = true;
            $aux="";
            foreach ($criterios as $criterio) {
                $totalSubcriterio = 0;
                $subcriterios = $criterio->subcriterios;
                if (count($subcriterios) != 0) {
                    foreach ($subcriterios as $subcriterio) {
                        $totalSubcriterio += $datos[$subcriterio->id]['porcentaje'];
                    }
                    if (abs($totalSubcriterio - $criterio->porcentaje) <= 1) {
                        foreach ($subcriterios as $subcriterio) {
                            $prevporcentaje=$subcriterio->porcentaje;
                            $subcriterio->update($datos[$subcriterio->id]);
                            if($prevporcentaje!=$subcriterio->porcentaje){
                                $subcriterio->indicadors()->update(['porcentaje'=>null]);
                            }
                        }
                    } else {
                        $bool = false;
                        $aux=$aux.$criterio->criterio." ";
                    }
                }
            }
            if ($bool) {
                return redirect()->route('porcentaje.subcriterios.index')->with('success', "Registro exitoso.");
            }
            else{
                return redirect()->route('porcentaje.subcriterios.index')->with('error', "Revise los valores de $aux");
            }
        } catch (\Exception $e) {
            return redirect()->route('porcentaje.subcriterios.index')->with('error', "Error al crear el registro.");
        }
    }
}
