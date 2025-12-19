<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Indicador;
use App\Models\Evaluacion;
use App\Models\ResIndicador;
use App\Models\ResIndicador25;

class Indicador25 extends Component
{
    public $indicador, $criterio, $evaluacion, $uni_id;
    public $ind_id, $cri_id, $eva_id;
    public $ind_res,$ind_deb,$ind_for,$ind_nud,$ind_jus;

    public $tp, $tpyrf, $tpyci, $tpycn, $ip, $ip_porcentaje, $valoracion_25;

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

        $res_indicador_25 = ResIndicador25::where('eva_id', $this->eva_id)->where('ind_id', $this->ind_id)->first();
        $this->tp = isset($res_indicador_25->tp) ? $res_indicador_25->tp : '1';
        $this->tpyrf = isset($res_indicador_25->tpyrf) ? $res_indicador_25->tpyrf : '1';
        $this->tpyci = isset($res_indicador_25->tpyci) ? $res_indicador_25->tpyci : '1';
        $this->tpycn = isset($res_indicador_25->tpycn) ? $res_indicador_25->tpycn : '1';
        $this->ip = isset($res_indicador_25->ip) ? $res_indicador_25->ip : '30';
        $this->ip_porcentaje = isset($res_indicador_25->ip_porcentaje) ? $res_indicador_25->ip_porcentaje : round($this->indicador->porcentaje * 0.70, 3);
        $this->valoracion_25 = isset($res_indicador_25->valoracion_25) ? $res_indicador_25->valoracion_25 : 'CUASI SATISFACTORIO';
    }

    public function updatedTp()
    {
        $this->calculo();
    }

    public function updatedTpyrf()
    {
        $this->calculo();
    }

    public function updatedTpyci()
    {
        $this->calculo();
    }

    public function updatedTpycn()
    {
        $this->calculo();
    }

    public function calculo()
    {
        try {
            $this->ip = round(((floatval($this->tpyrf) + floatval($this->tpyci) + floatval($this->tpycn)) / floatval($this->tp)) * 100, 2);
            if ($this->ip >= 40) {
                $this->valoracion_25 = 'SATISFACTORIO';
                $this->ip_porcentaje = round($this->indicador->porcentaje * 1, 3);
            } elseif ($this->ip >= 26 && $this->ip < 40) {
                $this->valoracion_25 = 'CUASI SATISFACTORIO';
                $this->ip_porcentaje = round($this->indicador->porcentaje * 0.70, 3);
            } elseif ($this->ip >= 13 && $this->ip < 26) {
                $this->valoracion_25 = 'POCO SATISFACTORIO';
                $this->ip_porcentaje = round($this->indicador->porcentaje * 0.35, 3);
            } elseif ($this->ip < 13) {
                $this->valoracion_25 = 'DEFICIENTE';
                $this->ip_porcentaje = round($this->indicador->porcentaje * 0, 3);
            }
        } catch (\Throwable $th) {
            $this->ip = 0;
        }
    }

    public function render()
    {
        return view('livewire.indicador25.view');
    }

    public function guardarIndicador25()
    {
        $indRes=['eva_id'=>$this->eva_id,'ind_id'=>$this->ind_id,'debilidades'=>$this->ind_deb,'fortalezas'=>$this->ind_for,'nudo'=>$this->ind_nud,'justificacion'=>$this->ind_jus,'resultado'=>$this->ind_res];
        $conditions=['eva_id'=>$this->eva_id,'ind_id'=>$this->ind_id];
        ResIndicador::updateOrCreate($conditions,$indRes);
        $res_indicador_25 = ResIndicador25::where('eva_id', $this->eva_id)->where('ind_id', $this->ind_id)->first();
        if ($res_indicador_25) {
            $res_indicador_25->update([
                'tp' => $this->tp,
                'tpyrf' => $this->tpyrf,
                'tpyci' => $this->tpyci,
                'tpycn' => $this->tpycn,
                'ip' => $this->ip,
                'ip_porcentaje' => $this->ip_porcentaje,
                'valoracion_25' => $this->valoracion_25,
            ]);
        } else {
            ResIndicador25::create([
                'uni_id' => $this->uni_id,
                'eva_id' => $this->eva_id,
                'cri_id' => $this->cri_id,
                'ind_id' => $this->ind_id,
                'tp' => $this->tp,
                'tpyrf' => $this->tpyrf,
                'tpyci' => $this->tpyci,
                'tpycn' => $this->tpycn,
                'ip' => $this->ip,
                'ip_porcentaje' => $this->ip_porcentaje,
                'valoracion_25' => $this->valoracion_25,
                'user_id' => auth()->user()->id,
            ]);
        }
        session()->flash('success', 'Registro agregado con éxito.');
    }
}
