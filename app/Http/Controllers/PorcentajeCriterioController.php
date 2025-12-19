<?php

namespace App\Http\Controllers;

use App\Models\Criterio;
use Illuminate\Http\Request;

class PorcentajeCriterioController extends Controller
{
    public function index()
    {
        $criterios = Criterio::all();
        return view('acreditacion_caces.porcentajes.criterios', compact('criterios'));
    }

    public function store(Request $request)
    {
        try {
            $datos = $request->except('_token');
            $total=0;
            foreach ($datos as $dato) {
                $total+=$dato['porcentaje'];
            }
            if (abs($total-100)<=1) {
                foreach ($datos as $key => $item) {
                    $criterio = Criterio::where('id', $key)->get()->first();
                    if ($criterio != null) {
                        $prevporcentaje=$criterio->porcentaje;
                        $criterio->update($item);
                        if($prevporcentaje!=$criterio->porcentaje){
                            if(!$criterio->subcriterios->isEmpty()){
                                $criterio->subcriterios()->update(['porcentaje'=>null]);
                            }
                            else{
                                $criterio->indicadors()->update(['porcentaje'=>null]);
                            }
                        }
                    } else {
                        Criterio::insert($item);
                    }
                }
                return redirect()->route('porcentaje.criterios.index')->with('success', 'Registro exitoso.');
            }
            else{
                return redirect()->route('porcentaje.criterios.index')->with('error', 'La suma total debe ser 100');
            }
        } catch (\Exception $e) {
            return redirect()->route('porcentaje.criterios.index')->with('error', "Error al crear el registro");
        }
    }
}
