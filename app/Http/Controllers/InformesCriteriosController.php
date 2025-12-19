<?php

namespace App\Http\Controllers;

use App\Models\Formula;
use App\Models\Criterio;
use App\Models\Indicador;
use App\Models\Resultado;
use App\Models\Evaluacion;
use App\Models\ResDocente;
use App\Models\Universidad;
use App\Models\ResIndicador;
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
use App\Http\Livewire\Indicador16;
use App\Http\Livewire\Indicador17;
use App\Http\Livewire\Indicador19;
use App\Http\Livewire\Indicador21;
use App\Http\Livewire\Indicador22;
use App\Http\Livewire\Indicador25;
use App\Http\Livewire\Indicador26;
use App\Http\Livewire\Indicador29;

class InformesCriteriosController extends Controller
{
    public function index($id)
    {
        $evaluacion = Evaluacion::find($id);
        $criterios = Criterio::all();
        return view('acreditacion_caces.informes.index', compact('evaluacion', 'criterios'));
    }

    public function mejora($id)
    {
        $evaluacion = Evaluacion::find($id);
        return view('acreditacion_caces.informes.oportunidad_mejora.index', compact('evaluacion'));
    }

    public function informeGeneralPdf($id)
    {
        $criterios = Criterio::all();
        $evaluacion = Evaluacion::find($id);
        $total[1] = $this->calcularPorcentajeCriterio1($id);
        $total[2] = $this->calcularPorcentajeCriterio2($id);
        $total[3] = $this->calcularPorcentajeCriterio3($id);
        $total[4] = $this->calcularPorcentajeCriterio4($id);
        $total[5] = $this->calcularPorcentajeCriterio5($id);
        $total[6] = $this->calcularPorcentajeCriterio6($id);
        $pdf = app()->make('dompdf.wrapper');

        $pdf->loadView('acreditacion_caces.informes.pdfGeneral', compact('evaluacion', 'total', 'criterios'));

        $filename = 'informe_general' . '.pdf';

        return $pdf->stream($filename);
    }

    public function informeEspecificoPdf($id)
    {
        $evaluacion = Evaluacion::find($id);
        $resPorIndicador = [];
        $criterios = Criterio::all();
        $resultados = Resultado::where('eva_id', $id)->get();
        $res_indicadors = ResIndicador::all();
        $formulas = Formula::all();
        $total_criterio_1 = $this->calcularPorcentajeCriterio1($id);
        $total_criterio_2 = $this->calcularPorcentajeCriterio2($id);
        $total_criterio_5 = $this->calcularPorcentajeCriterio5($id);
        $total_criterio_6 = $this->calcularPorcentajeCriterio6($id);
        $res_16 = ResIndicador16::where('eva_id', $id)->get()->first();
        $res_17 = ResIndicador17::where('eva_id', $id)->get()->first();
        $res_19 = ResIndicador19::where('eva_id', $id)->get()->first();
        $res_21 = ResIndicador21::where('eva_id', $id)->get()->first();
        $res_22 = ResIndicador22::where('eva_id', $id)->get()->first();
        $res_25 = ResIndicador25::where('eva_id', $id)->get()->first();
        $res_26 = ResIndicador26::where('eva_id', $id)->get()->first();
        $res_29 = ResIndicador29::where('eva_id', $id)->get()->first();
        for ($i = 1; $i < 33; $i++) {
            
            $indicador = Indicador::find($i);
            $res_ind = Resultado::resultadosPorIndicador($i, $id)->sum('resultado');
            $aux = $res_ind * 100 / $indicador->porcentaje;
            $aux = round($aux, 0);
            if ($aux >= 0 && $aux <= 35) {
                $ind_val = 'DEFICIENTE';
            }
            if ($aux > 35 && $aux <= 70) {
                $ind_val = 'POCO SATISFACTORIO';
            }
            if ($aux > 70 && $aux < 100) {
                $ind_val = 'CUASI SATISFACTORIO';
            }
            if ($aux == 100) {
                $ind_val = 'SATISFACTORIO';
            }
            $resPorIndicador[$i] = ['val'=>$ind_val,'cal'=>$res_ind];
            switch ($i) {
                case 16:
                    if ($res_16!=null) {
                        $resPorIndicador[$i] = ['val'=>$res_16->valoracion_16,'cal'=>$res_16->tpafd_porcentaje];
                    }
                    break;
                case 17:
                    if ($res_17!=null) {
                        $resPorIndicador[$i] = ['val'=>$res_17->valoracion_17,'cal'=>$res_17->tptc_porcentaje];
                    }
                    break;
                case 19:
                    if ($res_19!=null) {
                        $resPorIndicador[$i] = ['val'=>$res_19->valoracion_19,'cal'=>$res_19->tdg2_porcentaje];
                    }
                    break;
                case 21:
                    if ($res_21!=null) {
                        $resPorIndicador[$i] = ['val'=>$res_21->valoracion_21,'cal'=>$res_21->ttg_porcentaje];
                    }
                    break;
                case 22:
                    if ($res_22!=null) {
                        $resPorIndicador[$i] = ['val'=>$res_22->valoracion_22,'cal'=>$res_22->ttp_porcentaje];
                    }
                    break;
                case 25:
                    if ($res_25!=null) {
                        $resPorIndicador[$i] = ['val'=>$res_25->valoracion_25,'cal'=>$res_25->ip_porcentaje];
                    }
                    break;
                case 26:
                    if ($res_26!=null) {
                        $resPorIndicador[$i] = ['val'=>$res_26->valoracion_26,'cal'=>$res_26->ip_porcentaje];
                    }
                    break;
                case 29:
                    if ($res_29!=null) {
                        $resPorIndicador[$i] = ['val'=>$res_29->valoracion_29,'cal'=>$res_29->ipv_porcentaje];
                    }
                    break;
            }
        }
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('acreditacion_caces.informes.pdfEspecifico', compact('resPorIndicador', 'res_16', 'res_17', 'res_19', 'res_21', 'res_22', 'res_25', 'res_26', 'res_29', 'formulas', 'resultados', 'evaluacion', 'criterios', 'total_criterio_1', 'total_criterio_2', 'total_criterio_5', 'total_criterio_6'));
        $filename = 'informe_especifico' . '.pdf';

        return $pdf->stream($filename);
    }

    // CALCULOS DE LOS PORCENTAJES DE LOS CRITERIOS
    public function calcularPorcentajeCriterio1($id)
    {
        $evaluacion = Evaluacion::find($id);
        $criterio_1 = Criterio::where('id', 1)->first();
        $suma_elementos_criterio_1 = Resultado::totalResultadosPorCriterio(1, $id);
        $total = round(($suma_elementos_criterio_1 * 100) / ($criterio_1->porcentaje), 2);
        if ($total > 100) {
            $total = 100;
        } else {
            $total = $total;
        }
        return $total;
    }

    public function resPorIndicador($ind_id, $eva_id)
    {
        return $res_ind = Resultado::resultadosPorIndicador($ind_id, $eva_id)->sum('resultado');
    }

    public function calcularPorcentajeCriterio2($id)
    {
        $evaluacion = Evaluacion::find($id);
        $criterio_2 = Criterio::where('id', 2)->first();
        $suma_elementos_criterio_2 = Resultado::totalResultadosPorCriterio(2, $id);
        $total = round(($suma_elementos_criterio_2 * 100) / ($criterio_2->porcentaje), 2);
        if ($total > 100) {
            $total = 100;
        } else {
            $total = $total;
        }
        return $total;
    }

    public function calcularPorcentajeCriterio3($id)
    {
        $evaluacion = Evaluacion::find($id);
        $criterio_3 = Criterio::where('id', 3)->first();
        $suma_elementos_criterio_3 = Resultado::totalResultadosPorCriterio(3, $id);
        $suma_formula_indicador_16 = ResIndicador16::where('cri_id', 3)->where('eva_id', $id)->where('uni_id', $evaluacion->universidad->id)->value('tpafd_porcentaje');
        $suma_formula_indicador_17 = ResIndicador17::where('cri_id', 3)->where('eva_id', $id)->where('uni_id', $evaluacion->universidad->id)->value('tptc_porcentaje');
        $suma_formula_indicador_19 = ResIndicador19::where('cri_id', 3)->where('eva_id', $id)->where('uni_id', $evaluacion->universidad->id)->value('tdg2_porcentaje');
        $suma_formula_indicador_21 = ResIndicador21::where('cri_id', 3)->where('eva_id', $id)->where('uni_id', $evaluacion->universidad->id)->value('ttg_porcentaje');
        $suma_formula_indicador_22 = ResIndicador22::where('cri_id', 3)->where('eva_id', $id)->where('uni_id', $evaluacion->universidad->id)->value('ttp_porcentaje');
        $total = round((($suma_elementos_criterio_3 + $suma_formula_indicador_16 + $suma_formula_indicador_17 + $suma_formula_indicador_19 + $suma_formula_indicador_21 + $suma_formula_indicador_22) * 100) / ($criterio_3->porcentaje), 2);
        if ($total > 100) {
            $total = 100;
        } else {
            $total = $total;
        }
        return $total;
    }

    public function calcularPorcentajeCriterio4($id)
    {
        $evaluacion = Evaluacion::find($id);
        $criterio_4 = Criterio::where('id', 4)->first();
        $suma_elementos_criterio_4 = Resultado::totalResultadosPorCriterio(4, $id);
        $suma_formula_indicador_25 = ResIndicador25::where('cri_id', 4)->where('eva_id', $id)->where('uni_id', $evaluacion->universidad->id)->value('ip_porcentaje');
        $suma_formula_indicador_26 = ResIndicador26::where('cri_id', 4)->where('eva_id', $id)->where('uni_id', $evaluacion->universidad->id)->value('ip_porcentaje');
        $total = round((($suma_elementos_criterio_4 + $suma_formula_indicador_25 + $suma_formula_indicador_26) * 100) / ($criterio_4->porcentaje), 2);
        if ($total > 100) {
            $total = 100;
        } else {
            $total = $total;
        }
        return $total;
    }

    public function calcularPorcentajeCriterio5($id)
    {
        $evaluacion = Evaluacion::find($id);
        $criterio_5 = Criterio::where('id', 5)->first();
        $suma_elementos_criterio_5 = Resultado::totalResultadosPorCriterio(5, $id);
        $suma_formulas_criterio_5 = ResIndicador29::where('cri_id', 5)->where('eva_id', $id)->where('uni_id', $evaluacion->universidad->id)->value('ipv_porcentaje');

        $total = round((($suma_elementos_criterio_5 + $suma_formulas_criterio_5) * 100) / ($criterio_5->porcentaje), 2);
        if ($total > 100) {
            $total = 100;
        } else {
            $total = $total;
        }
        return $total;
    }

    public function calcularPorcentajeCriterio6($id)
    {
        $evaluacion = Evaluacion::find($id);
        $criterio_6 = Criterio::where('id', 6)->first();
        $suma_elementos_criterio_6 = Resultado::totalResultadosPorCriterio(6, $id);
        $total = round(($suma_elementos_criterio_6 * 100) / ($criterio_6->porcentaje), 2);
        if ($total > 100) {
            $total = 100;
        } else {
            $total = $total;
        }
        return $total;
    }
}
