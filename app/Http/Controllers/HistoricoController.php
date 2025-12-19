<?php

namespace App\Http\Controllers;

use App\Models\Criterio;
use App\Models\Resultado;
use App\Models\Evaluacion;
use App\Models\Universidad;
use Illuminate\Http\Request;
use App\Models\ResIndicador16;
use App\Models\ResIndicador17;
use App\Models\ResIndicador19;
use App\Models\ResIndicador21;
use App\Models\ResIndicador22;
use App\Models\ResIndicador25;
use App\Models\ResIndicador26;
use App\Models\ResIndicador29;
use App\Models\ResVinculacion;
use App\Models\ResInvestigacion;
use App\Models\ResGestionCalidad;

class HistoricoController extends Controller
{
    public function index($id)
    {

        $universidad = Universidad::find($id);
        $evaluaciones = Evaluacion::where('uni_id', $id)->get();
        $evaluacion = Evaluacion::find(1);
        $criterios = Criterio::all();
        return view('acreditacion_caces.historial.index', compact('universidad', 'evaluaciones', 'criterios', 'evaluacion'));
    }

    public function grafico($id)
    {
        $fecha_evaluacion = [];
        $resultados_criterio_1 = [];
        $resultados_criterio_2 = [];
        $resultados_criterio_3 = [];
        $resultados_criterio_4 = [];
        $resultados_criterio_5 = [];
        $resultados_criterio_6 = [];
        $universidad = Universidad::find($id);
        $criterios = Criterio::all();
        $evaluaciones = Evaluacion::where('uni_id', $id)->get();
        foreach ($evaluaciones as $evaluacion) {
            $fecha_i=\Carbon\Carbon::parse($evaluacion->fecha_inicial)->format('d-m-Y');
            $fecha_f=\Carbon\Carbon::parse($evaluacion->fecha_final)->format('d-m-Y');
            $fecha_evaluacion[] = "$fecha_i - $fecha_f";
            $resultados_criterio_1[] = $this->calcularPorcentajeCriterio($evaluacion->id, 1);
            $resultados_criterio_2[] = $this->calcularPorcentajeCriterio($evaluacion->id, 2);
            $resultados_criterio_3[] = $this->calcularPorcentajeCriterio($evaluacion->id, 3);
            $resultados_criterio_4[] = $this->calcularPorcentajeCriterio($evaluacion->id, 4);
            $resultados_criterio_5[] = $this->calcularPorcentajeCriterio($evaluacion->id, 5);
            $resultados_criterio_6[] = $this->calcularPorcentajeCriterio($evaluacion->id, 6);
        }

        $resultado_total = [];
        foreach ($evaluaciones as $key => $evaluacion) {
            $resultado_total[] = [
                'fecha_evaluacion' => $fecha_evaluacion[$key],
                'criterio_1' => $resultados_criterio_1[$key],
                'criterio_2' => $resultados_criterio_2[$key],
                'criterio_3' => $resultados_criterio_3[$key],
                'criterio_4' => $resultados_criterio_4[$key],
                'criterio_5' => $resultados_criterio_5[$key],
                'criterio_6' => $resultados_criterio_6[$key],
            ];
        }
        return view('acreditacion_caces.historial.grafico', compact('universidad', 'evaluaciones', 'criterios', 'resultado_total'));
    }

    public function calcularPorcentajeCriterio($id, $cri_id)
    {
        $evaluacion = Evaluacion::find($id);
        $criterio = Criterio::where('id', $cri_id)->first();
        $suma_elementos_criterio = Resultado::totalResultadosPorCriterio($cri_id, $id);
        switch ($cri_id) {
            case 3:
                $suma_elementos_criterio += ResIndicador16::where('eva_id', $id)->first()?->tpafd_porcentaje ?? 0;
                $suma_elementos_criterio += ResIndicador17::where('eva_id', $id)->first()?->tptc_porcentaje ?? 0;
                $suma_elementos_criterio += ResIndicador19::where('eva_id', $id)->first()?->tdg2_porcentaje ?? 0;
                $suma_elementos_criterio += ResIndicador21::where('eva_id', $id)->first()?->ttg_porcentaje ?? 0;
                $suma_elementos_criterio += ResIndicador22::where('eva_id', $id)->first()?->ttp_porcentaje ?? 0;
                break;
            case 4:
                $suma_elementos_criterio += ResIndicador25::where('eva_id', $id)->first()?->ip_porcentaje ?? 0;
                $suma_elementos_criterio += ResIndicador26::where('eva_id', $id)->first()?->ip_porcentaje ?? 0;
                break;
            case 5:
                $suma_elementos_criterio += ResIndicador29::where('eva_id', $id)->first()?->ipv_porcentaje ?? 0;
                break;
            default:
                break;
        }
        $total = $criterio->porcentaje != 0 ?  round(($suma_elementos_criterio * 100) / ($criterio->porcentaje), 2) : 0;
        if ($total > 100) {
            $total = 100;
        } else {
            $total = $total;
        }
        return $total;
    }
}
