<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Indicador;
use App\Models\Evaluacion;
use App\Models\ResIndicador;
use App\Models\ResIndicador26;

class Indicador26 extends Component
{
    public $indicador, $criterio, $evaluacion, $uni_id;
    public $ind_id, $cri_id, $eva_id;
    public $ind_res,$ind_deb,$ind_for,$ind_nud,$ind_jus;
    // PARA CALCULAR PAC
    public $q1, $q1_ci, $q2, $q2_ci, $q3, $q3_ci, $q4, $q4_ci, $aci, $aci_ci, $br, $br_ci, $la, $la_ci, $pac;
    // PARA CALCULAR PA
    public $opi, $opn, $pa;
    // PARA CALCULAR EL LyCL
    public $li, $cl, $tc, $lycl;
    // PARA CALCULAR EL IP
    public $pia, $ptc, $pmt, $ip, $ip_porcentaje, $valoracion_26;

    public function mount($id_indicador, $id_evaluacion)
    {
        try{
            $ind_res=ResIndicador::where('ind_id',$id_indicador)->where('eva_id',$id_evaluacion)->get()->first();
            $this->ind_res=$ind_res->resultado;
            $this->ind_deb=$ind_res->debilidades;
            $this->ind_for=$ind_res->fortalezas;
            $this->ind_nud=$ind_res->nudo;
            $this->ind_jus=$ind_res->justificacion;
        }
        catch(\Throwable $th){

        }
        $this->eva_id = $id_evaluacion;
        $this->evaluacion = Evaluacion::find($this->eva_id);
        $this->uni_id = $this->evaluacion->universidad->id;
        $this->ind_id = $id_indicador;
        $this->indicador = Indicador::find($this->ind_id);
        $this->cri_id = $this->indicador->subcriterio->criterio->id;

        $res_indicador_26 = ResIndicador26::where('eva_id', $this->eva_id)->where('ind_id', $this->ind_id)->first();
        // PARA CALCULAR PAC
        $this->q1 = isset($res_indicador_26->q1) ? $res_indicador_26->q1 : '0';
        $this->q1_ci = isset($res_indicador_26->q1_ci) ? $res_indicador_26->q1_ci : '0';
        $this->q2 = isset($res_indicador_26->q2) ? $res_indicador_26->q2 : '0';
        $this->q2_ci = isset($res_indicador_26->q2_ci) ? $res_indicador_26->q2_ci : '0';
        $this->q3 = isset($res_indicador_26->q3) ? $res_indicador_26->q3 : '0';
        $this->q3_ci = isset($res_indicador_26->q3_ci) ? $res_indicador_26->q3_ci : '0';
        $this->q4 = isset($res_indicador_26->q4) ? $res_indicador_26->q4 : '0';
        $this->q4_ci = isset($res_indicador_26->q4_ci) ? $res_indicador_26->q4_ci : '0';
        $this->aci = isset($res_indicador_26->aci) ? $res_indicador_26->aci : '0';
        $this->aci_ci = isset($res_indicador_26->aci_ci) ? $res_indicador_26->aci_ci : '0';
        $this->br = isset($res_indicador_26->br) ? $res_indicador_26->br : '0';
        $this->br_ci = isset($res_indicador_26->br_ci) ? $res_indicador_26->br_ci : '0';
        $this->la = isset($res_indicador_26->la) ? $res_indicador_26->la : '0';
        $this->la_ci = isset($res_indicador_26->la_ci) ? $res_indicador_26->la_ci : '0';
        $this->pac = isset($res_indicador_26->pac) ? $res_indicador_26->pac : '0';
        // PARA CALCULAR PA
        $this->opi = isset($res_indicador_26->opi) ? $res_indicador_26->opi : '1';
        $this->opn = isset($res_indicador_26->opn) ? $res_indicador_26->opn : '1';
        $this->pa = isset($res_indicador_26->pa) ? $res_indicador_26->pa : '1.9';
        // PARA CALCULAR EL LyCL
        $this->li = isset($res_indicador_26->li) ? $res_indicador_26->li : '1';
        $this->cl = isset($res_indicador_26->cl) ? $res_indicador_26->cl : '1';
        $this->tc = isset($res_indicador_26->tc) ? $res_indicador_26->tc : '1';
        $this->lycl = isset($res_indicador_26->lycl) ? $res_indicador_26->lycl : '2';
        // PARA CALCULAR EL IP
        $this->pia = isset($res_indicador_26->pia) ? $res_indicador_26->pia : '1';
        $this->ptc = isset($res_indicador_26->ptc) ? $res_indicador_26->ptc : '1';
        $this->pmt = isset($res_indicador_26->pmt) ? $res_indicador_26->pmt : '1';
        $this->ip = isset($res_indicador_26->ip) ? $res_indicador_26->ip : '3.266';
        $this->ip_porcentaje = isset($res_indicador_26->ip_porcentaje) ? $res_indicador_26->ip_porcentaje : round($this->indicador->porcentaje * 1, 3);
        $this->valoracion_26 = isset($res_indicador_26->valoracion_26) ? $res_indicador_26->valoracion_26 : 'SATISFACTORIO';
    }

    public function render()
    {
        return view('livewire.indicador26.view');
    }

    /////////////////////////////////////////////////////// CALCULOS PARA PAC ////////////////////////////////////////////////////////////////// 
    public function updatedQ1()
    {
        $this->calculoPAC();
    }

    public function updatedQ2()
    {
        $this->calculoPAC();
    }

    public function updatedQ3()
    {
        $this->calculoPAC();
    }

    public function updatedQ4()
    {
        $this->calculoPAC();
    }

    public function updatedAci()
    {
        $this->calculoPAC();
    }

    public function updatedBr()
    {
        $this->calculoPAC();
    }

    public function updatedLa()
    {
        $this->calculoPAC();
    }

    public function updatedQ1Ci()
    {
        $this->calculoPAC();
    }

    public function updatedQ2Ci()
    {
        $this->calculoPAC();
    }

    public function updatedQ3Ci()
    {
        $this->calculoPAC();
    }

    public function updatedQ4Ci()
    {
        $this->calculoPAC();
    }

    public function updatedAciCi()
    {
        $this->calculoPAC();
    }

    public function updatedBrCi()
    {
        $this->calculoPAC();
    }

    public function updatedLaCi()
    {
        $this->calculoPAC();
    }

    public function calculoPAC()
    {
        $q1_q1_ci = floatval($this->q1_ci) * 1 + floatval($this->q1_ci) * 0.21 + (floatval($this->q1) - floatval($this->q1_ci)) * 1;
        $q2_q2_ci = floatval($this->q2_ci) * 0.9 + floatval($this->q2_ci) * 0.21 + (floatval($this->q2) - floatval($this->q2_ci)) * 0.9;
        $q3_q3_ci = floatval($this->q3_ci) * 0.8 + floatval($this->q3_ci) * 0.21 + (floatval($this->q3) - floatval($this->q3_ci)) * 0.8;
        $q4_q4_ci = floatval($this->q4_ci) * 0.7 + floatval($this->q4_ci) * 0.21 + (floatval($this->q4) - floatval($this->q4_ci)) * 0.7;
        $aci_aci_ci = floatval($this->aci_ci) * 0.6 + floatval($this->aci_ci) * 0.21 + (floatval($this->aci) - floatval($this->aci_ci)) * 0.6;
        $br_br_ci = floatval($this->br_ci) * 0.5 + floatval($this->br_ci) * 0.21 + (floatval($this->br) - floatval($this->br_ci)) * 0.5;
        $la_la_ci = floatval($this->la_ci) * 0.2 + floatval($this->la_ci) * 0.21 + (floatval($this->la) - floatval($this->la_ci)) * 0.2;
        $this->pac = round(floatval($q1_q1_ci) + floatval($q2_q2_ci) + floatval($q3_q3_ci) + floatval($q4_q4_ci) + floatval($aci_aci_ci) + floatval($br_br_ci) + floatval($la_la_ci), 3);
    }

    /////////////////////////////////////////////////////// CALCULOS PARA PA //////////////////////////////////////////////////////////////////

    public function updatedOpi()
    {
        $this->calculoPA();
    }

    public function updatedOpn()
    {
        $this->calculoPA();
    }

    public function calculoPA()
    {
        $this->pa = round(floatval($this->opi) + 0.9 * floatval($this->opn), 3);
    }

    /////////////////////////////////////////////////////// CALCULOS PARA LyCL //////////////////////////////////////////////////////////////////

    public function updatedLi()
    {
        $this->calculoLyCL();
    }

    public function updatedCl()
    {
        $this->calculoLyCL();
    }

    public function updatedTc()
    {
        $this->calculoLyCL();
    }

    public function calculoLyCL()
    {
        try {
            $this->lycl = round(floatval($this->li) + (floatval($this->cl) / floatval($this->tc)), 3);
        } catch (\Throwable $th) {
            $this->lycl = 0;
        }
    }

    /////////////////////////////////////////////////////// CALCULOS PARA IP //////////////////////////////////////////////////////////////////

    public function updatedPia()
    {
        $this->calculoIP();
    }

    public function updatedPtc()
    {
        $this->calculoIP();
    }

    public function updatedPmt()
    {
        $this->calculoIP();
    }

    public function calculoIP()
    {
        $this->ip = round((floatval($this->pac) + floatval($this->pa) + floatval($this->lycl) + floatval($this->pia)) / (floatval($this->ptc) + 0.5 * floatval($this->pmt)), 3);
        if ($this->ip >= 1) {
            $this->valoracion_26 = 'SATISFACTORIO';
            $this->ip_porcentaje = round($this->indicador->porcentaje * 1, 3);
        } elseif ($this->ip >= 1 && $this->ip < 1.5) {
            $this->valoracion_26 = 'CUASI SATISFACTORIO';
            $this->ip_porcentaje = round($this->indicador->porcentaje * 0.70, 3);
        } elseif ($this->ip >= 0.5 && $this->ip < 1) {
            $this->valoracion_26 = 'POCO SATISFACTORIO';
            $this->ip_porcentaje = round($this->indicador->porcentaje * 0.35, 3);
        } elseif ($this->ip < 0.5) {
            $this->valoracion_26 = 'DEFICIENTE';
            $this->ip_porcentaje = round($this->indicador->porcentaje * 0, 3);
        }
    }

    public function guardarIndicador26()
    {
        $indRes=['eva_id'=>$this->eva_id,'ind_id'=>$this->ind_id,'debilidades'=>$this->ind_deb,'fortalezas'=>$this->ind_for,'nudo'=>$this->ind_nud,'justificacion'=>$this->ind_jus,'resultado'=>$this->ind_res];
        $conditions=['eva_id'=>$this->eva_id,'ind_id'=>$this->ind_id];
        ResIndicador::updateOrCreate($conditions,$indRes);
        $res_indicador_26 = ResIndicador26::where('eva_id', $this->eva_id)->where('ind_id', $this->ind_id)->first();
        if ($res_indicador_26) {
            $res_indicador_26->update([
                'q1' => $this->q1,
                'q1_ci' => $this->q1_ci,
                'q2' => $this->q2,
                'q2_ci' => $this->q2_ci,
                'q3' => $this->q3,
                'q3_ci' => $this->q3_ci,
                'q4' => $this->q4,
                'q4_ci' => $this->q4_ci,
                'aci' => $this->aci,
                'aci_ci' => $this->aci_ci,
                'br' => $this->br,
                'br_ci' => $this->br_ci,
                'la' => $this->la,
                'la_ci' => $this->la_ci,
                'pac' => $this->pac,
                'opi' => $this->opi,
                'opn' => $this->opn,
                'pa' => $this->pa,
                'li' => $this->li,
                'cl' => $this->cl,
                'tc' => $this->tc,
                'lycl' => $this->lycl,
                'pia' => $this->pia,
                'ptc' => $this->ptc,
                'pmt' => $this->pmt,
                'ip' => $this->ip,
                'ip_porcentaje' => $this->ip_porcentaje,
                'valoracion_26' => $this->valoracion_26,
            ]);
        } else {
            ResIndicador26::create([
                'uni_id' => $this->uni_id,
                'eva_id' => $this->eva_id,
                'cri_id' => $this->cri_id,
                'ind_id' => $this->ind_id,
                'q1' => $this->q1,
                'q1_ci' => $this->q1_ci,
                'q2' => $this->q2,
                'q2_ci' => $this->q2_ci,
                'q3' => $this->q3,
                'q3_ci' => $this->q3_ci,
                'q4' => $this->q4,
                'q4_ci' => $this->q4_ci,
                'aci' => $this->aci,
                'aci_ci' => $this->aci_ci,
                'br' => $this->br,
                'br_ci' => $this->br_ci,
                'la' => $this->la,
                'la_ci' => $this->la_ci,
                'pac' => $this->pac,
                'opi' => $this->opi,
                'opn' => $this->opn,
                'pa' => $this->pa,
                'li' => $this->li,
                'cl' => $this->cl,
                'tc' => $this->tc,
                'lycl' => $this->lycl,
                'pia' => $this->pia,
                'ptc' => $this->ptc,
                'pmt' => $this->pmt,
                'ip' => $this->ip,
                'ip_porcentaje' => $this->ip_porcentaje,
                'valoracion_26' => $this->valoracion_26,
                'user_id' => auth()->user()->id,
            ]);
        }
        session()->flash('success', 'Registro agregado con éxito.');
    }
}
