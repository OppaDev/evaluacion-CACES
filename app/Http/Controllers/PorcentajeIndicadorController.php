<?php

namespace App\Http\Controllers;

use App\Models\Criterio;
use App\Models\Indicador;
use Illuminate\Http\Request;

class PorcentajeIndicadorController extends Controller
{
    public function index()
    {
        $criterios = Criterio::all();
        return view('acreditacion_caces.porcentajes.indicadores', compact('criterios'));
    }

    public function store(Request $request)
    {
        try {
            $datos = $request->except('_token');
            $criterios = Criterio::all();
            $bool = true;
            $aux="";
            foreach ($criterios as $criterio) {
                $totalIndicador = 0;
                $subcriterios = $criterio->subcriterios;
                if (count($subcriterios) != 0) {
                    foreach ($subcriterios as $subcriterio) {
                        $totalIndicador = 0;
                        $indicadors=$subcriterio->indicadors;
                        foreach ($indicadors as $indicador) {
                            $totalIndicador += $datos[$indicador->id]['porcentaje'];
                        }
                        if (abs($totalIndicador - $subcriterio->porcentaje) <= 1) {
                            foreach ($indicadors as $indicador) {
                                $prevporcentaje=$indicador->porcentaje;
                                $indicador->update($datos[$indicador->id]);
                                if($prevporcentaje!=$indicador->porcentaje){
                                    $indicador->elemento_fundamentals()->update(['porcentaje'=>null]);
                                }
                                
                            }
                        } else {
                            $bool = false;
                            $aux=$aux.$subcriterio->subcriterio." ";
                        }
                    }
                }else{
                    $indicadors=$criterio->indicadors;
                    foreach ($indicadors as $indicador) {
                        $totalIndicador += $datos[$indicador->id]['porcentaje'];
                    }
                    if (abs($totalIndicador - $criterio->porcentaje) <= 1) {
                        foreach ($indicadors as $indicador) {
                            $prevporcentaje=$indicador->porcentaje;
                            $indicador->update($datos[$indicador->id]);
                            if($prevporcentaje!=$indicador->porcentaje){
                                $indicador->elemento_fundamentals()->update(['porcentaje'=>null]);
                            }
                            
                        }
                    } else {
                        $bool = false;
                        $aux=$aux.$criterio->criterio." ";
                    }
                }
            }
            if ($bool) {
                return redirect()->route('porcentaje.indicadores.index')->with('success', "Registro exitoso.");
            }
            else{
                return redirect()->route('porcentaje.indicadores.index')->with('error', "Revise los valores de $aux");
            }
        } catch (\Exception $e) {
            return redirect()->route('porcentaje.indicadores.index')->with('error', "Error al crear el registro$e");
        }
    }
}

       