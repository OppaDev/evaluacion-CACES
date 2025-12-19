<?php

namespace App\Http\Controllers;

use App\Models\Criterio;
use App\Models\Resultado;
use App\Models\Evaluacion;
use App\Models\ResIndicador16;
use App\Models\ResIndicador17;
use App\Models\ResIndicador19;
use App\Models\ResIndicador21;
use App\Models\ResIndicador22;
use App\Models\ResIndicador25;
use App\Models\ResIndicador26;
use App\Models\ResIndicador29;

class IndicadorController extends Controller
{
    public function index($id)
    {
        $evaluacion = Evaluacion::find($id);
        $criterios = Criterio::all();
        $total_criterios=[];
        $suma_criterios=0;
        try {
            foreach ($criterios as $criterio) {
                $total_criterios[$criterio->id]=$this->calcularPorcentajeCriterio($id, $criterio->id);
                $suma_criterios+=$total_criterios[$criterio->id];
            }
        } catch (\Throwable $th) {
            return redirect()->route('porcentaje.criterios.index');
        }
        $total_evaluacion=$suma_criterios/$criterios->count();
        return view('acreditacion_caces.indicador.index', compact('total_evaluacion','evaluacion', 'total_criterios', 'criterios'));
    }


    public function calcularPorcentajeCriterio($idEvaluacion, $idCriterio)
    {
        $suma_elementos_criterio = 0;
        if (!Criterio::where('id', $idCriterio)->get()->first()->subcriterios->isEmpty()) {
            $suma_elementos_criterio = Resultado::whereHas('elemento_fundamental.indicador.subcriterio.criterio', function ($query) use ($idCriterio) {
                $query->where('id', $idCriterio);
            })->where('eva_id', $idEvaluacion)->sum('resultado');
            switch ($idCriterio) {
                case 3:
                    $suma_elementos_criterio+=ResIndicador16::where('eva_id',$idEvaluacion)->first()?->tpafd_porcentaje??0;
                    $suma_elementos_criterio+=ResIndicador17::where('eva_id',$idEvaluacion)->first()?->tptc_porcentaje??0;
                    $suma_elementos_criterio+=ResIndicador19::where('eva_id',$idEvaluacion)->first()?->tdg2_porcentaje??0;
                    $suma_elementos_criterio+=ResIndicador21::where('eva_id',$idEvaluacion)->first()?->ttg_porcentaje??0;
                    $suma_elementos_criterio+=ResIndicador22::where('eva_id',$idEvaluacion)->first()?->ttp_porcentaje??0;
                    break;
                case 4:
                    $suma_elementos_criterio+=ResIndicador25::where('eva_id',$idEvaluacion)->first()?->ip_porcentaje??0;
                    $suma_elementos_criterio+=ResIndicador26::where('eva_id',$idEvaluacion)->first()?->ip_porcentaje??0;
                    break;
                case 5:
                    $suma_elementos_criterio+=ResIndicador29::where('eva_id',$idEvaluacion)->first()?->ipv_porcentaje??0;
                    break;
                default:
                    break;
            }
            $criterioPorcentaje = Criterio::where('id', $idCriterio)->get()->first()->porcentaje;
            $suma_elementos_criterio = round($suma_elementos_criterio * 100 / $criterioPorcentaje, 2);
        } else {
            $suma_elementos_criterio = Resultado::whereHas('elemento_fundamental.indicador.criterio', function ($query) use ($idCriterio) {
                $query->where('id', $idCriterio);
            })->where('eva_id', $idEvaluacion)->sum('resultado');
            switch ($idCriterio) {
                case 3:
                    $suma_elementos_criterio+=ResIndicador16::where('eva_id',$idEvaluacion)->first()?->tpafd_porcentaje??0;
                    $suma_elementos_criterio+=ResIndicador17::where('eva_id',$idEvaluacion)->first()?->tptc_porcentaje??0;
                    $suma_elementos_criterio+=ResIndicador19::where('eva_id',$idEvaluacion)->first()?->tdg2_porcentaje??0;
                    $suma_elementos_criterio+=ResIndicador21::where('eva_id',$idEvaluacion)->first()?->ttg_porcentaje??0;
                    $suma_elementos_criterio+=ResIndicador22::where('eva_id',$idEvaluacion)->first()?->ttp_porcentaje??0;
                    break;
                case 4:
                    $suma_elementos_criterio+=ResIndicador25::where('eva_id',$idEvaluacion)->first()?->ip_porcentaje??0;
                    $suma_elementos_criterio+=ResIndicador26::where('eva_id',$idEvaluacion)->first()?->ip_porcentaje??0;
                    break;
                case 5:
                    $suma_elementos_criterio+=ResIndicador29::where('eva_id',$idEvaluacion)->first()?->ipv_porcentaje??0;
                    break;
                default:
                    break;
            }
            $criterioPorcentaje = Criterio::where('id', $idCriterio)->get()->first()->porcentaje;
            $suma_elementos_criterio = round($suma_elementos_criterio * 100 / $criterioPorcentaje, 2);
        }
        return $suma_elementos_criterio;
    }

    public function resultadoCriterio($idEvaluacion, $idCriterio)
    {
        $criterios=Criterio ::all();
        $criterio = Criterio::find($idCriterio);
        $evaluacion = Evaluacion::find($idEvaluacion);
        try {
            $resultados_criterio = Criterio::where('id', $idCriterio)->whereHas('indicadorsSub.elemento_fundamentals.resultados', function ($query) use ($idEvaluacion) {
                $query->where('eva_id', $idEvaluacion);
            })->get();
        } catch (\Throwable $th) {
            $resultados_criterio=Criterio::where('id',$idCriterio)->whereHas('indicadors.elemento_fundamentals.resultados', function($query) use($idEvaluacion){
                $query->where('eva_id',$idEvaluacion);
            })->get();
        }
        $total_criterio = $this->calcularPorcentajeCriterio($idEvaluacion, $idCriterio);

        return view('acreditacion_caces.resultados.index', compact('criterios','criterio', 'evaluacion', 'total_criterio', 'resultados_criterio'));
    }
}
