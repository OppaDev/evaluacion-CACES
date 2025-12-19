<?php

namespace App\Http\Controllers;

use App\Models\Criterio;
use App\Models\Evaluacion;

class CriterioController extends Controller
{
    public function criterio($eva_id,$cri_id)
    {
        $evaluacion = Evaluacion::find($eva_id);
        $criterio = Criterio::find($cri_id);
        $sub_criterios =$criterio->subcriterios;
        $indicadors=$criterio->indicadors;
        $criterios=Criterio::all();
        if(!$criterio->subcriterios->isEmpty()){
            return view('livewire.indicador-layout', compact('evaluacion', 'sub_criterios', 'criterio','indicadors','criterios'));
        }
        else{
            return view('livewire.indicador-layout', compact('evaluacion', 'indicadors', 'criterio','sub_criterios','criterios'));
        }
    }
}
