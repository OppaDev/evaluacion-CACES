<?php

namespace App\Http\Controllers;

use App\Models\Criterio;
use App\Models\ElementoFundamental;
use Illuminate\Http\Request;

class PorcentajeElementoController extends Controller
{
    public function index()
    {
        $criterios = Criterio::all();
        return view('acreditacion_caces.porcentajes.elementos', compact('criterios'));
    }

    public function store(Request $request)
    {
        try {
            $datos = $request->except('_token');
            $criterios = Criterio::all();
            $bool = true;
            $aux="";
            foreach ($criterios as $criterio) {
                $subcriterios = $criterio->subcriterios;
                if (count($subcriterios) != 0) {
                    foreach ($subcriterios as $subcriterio) {
                        $indicadors=$subcriterio->indicadors;
                        foreach ($indicadors as $indicador) {
                            $elementos=$indicador->elemento_fundamentals;
                            if(count($elementos)!=0){
                                $totalElemento=0;
                                foreach ($elementos as $elemento) {
                                    $totalElemento += $datos[$elemento->id]['porcentaje'];
                                }
                                if (abs($totalElemento - $indicador->porcentaje) <= 1) {
                                    foreach ($elementos as $elemento) {
                                        $elemento->update($datos[$elemento->id]);
                                    }
                                } else {
                                    $bool = false;
                                    $aux=$aux.$indicador->indicador." ";
                                }
                            }
                        }
                    }
                }else{
                    $indicadors=$criterio->indicadors;
                    foreach ($indicadors as $indicador) {
                        $totalElemento=0;
                        $elementos=$indicador->elemento_fundamentals;
                        if(count($elementos)!=0){
                            foreach ($elementos as $elemento) {
                                $totalElemento += $datos[$elemento->id]['porcentaje'];
                            }
                            if (abs($totalElemento - $indicador->porcentaje) <= 1) {
                                foreach ($elementos as $elemento) {
                                    $elemento->update($datos[$elemento->id]);
                                }
                            } else {
                                $bool = false;
                                $aux=$aux.$indicador->indicador." ";
                            }
                        }
                    }
                }
            }
            if ($bool) {
                return redirect()->route('porcentaje.elementos.index')->with('success', "Registro exitoso.");
            }
            else{
                return redirect()->route('porcentaje.elementos.index')->with('error', "Revise los valores de $aux");
            }
        } catch (\Exception $e) {
            return redirect()->route('porcentaje.elementos.index')->with('error', "Error al crear el registro$e");
        }
    }
}
