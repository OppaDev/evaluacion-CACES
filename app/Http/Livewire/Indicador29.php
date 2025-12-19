<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Indicador;
use App\Models\Evaluacion;
use App\Models\ResIndicador;
use App\Models\ResIndicador29;

class Indicador29 extends Component
{
    public $indicador, $criterio, $evaluacion, $uni_id;
    public $ind_id, $cri_id, $eva_id;
    public $ind_res,$ind_deb,$ind_for,$ind_nud,$ind_jus;

    public $tpv, $toa, $ipv, $ipv_porcentaje, $valoracion_29;

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
        $this->cri_id = $this->indicador->criterio->id;

        $res_indicador_29 = ResIndicador29::where('eva_id', $this->eva_id)->where('ind_id', $this->ind_id)->first();
        $this->tpv = isset($res_indicador_29->tpv) ? $res_indicador_29->tpv : '1';
        $this->toa = isset($res_indicador_29->toa) ? $res_indicador_29->toa : '1';
        $this->ipv = isset($res_indicador_29->ipv) ? $res_indicador_29->ipv : '1';
        $this->ipv_porcentaje = isset($res_indicador_29->ipv_porcentaje) ? $res_indicador_29->ipv_porcentaje : round($this->indicador->porcentaje*0.75, 3);
        $this->valoracion_29 = isset($res_indicador_29->valoracion) ? $res_indicador_29->valoracion : 'CUASI SATISFACTORIO';
    }

    public function updatedTpv()
    {
        $this->calculo();
    }

    public function updatedToa()
    {
        $this->calculo();
    }

    public function calculo()
    {
        try {
            $this->ipv = round(floatval($this->tpv) / floatval($this->toa), 3);
            $this->ipv = round(floatval($this->tpv) / floatval($this->toa), 3);
            if ($this->ipv >= 1.5) {
                $this->valoracion_29 = 'SATISFACTORIO';
                $this->ipv_porcentaje = round($this->indicador->porcentaje * 1, 3);
            } elseif ($this->ipv >= 1 && $this->ipv < 1.5) {
                $this->valoracion_29 = 'CUASI SATISFACTORIO';
                $this->ipv_porcentaje = round($this->indicador->porcentaje * 0.70, 3);
            } elseif ($this->ipv >= 0.5 && $this->ipv < 1) {
                $this->valoracion_29 = 'POCO SATISFACTORIO';
                $this->ipv_porcentaje = round($this->indicador->porcentaje * 0.35, 3);
            } elseif ($this->ipv < 0.5) {
                $this->valoracion_29 = 'DEFICIENTE';
                $this->ipv_porcentaje = round($this->indicador->porcentaje * 0, 3);
            }
        } catch (\Throwable $th) {
            $this->ipv = 0;
        }
    }

    public function render()
    {
        return view('livewire.indicador29.view');
    }

    public function guardarIndicador29()
    {
        $indRes=['eva_id'=>$this->eva_id,'ind_id'=>$this->ind_id,'debilidades'=>$this->ind_deb,'fortalezas'=>$this->ind_for,'nudo'=>$this->ind_nud,'justificacion'=>$this->ind_jus,'resultado'=>$this->ind_res];
        $conditions=['eva_id'=>$this->eva_id,'ind_id'=>$this->ind_id];
        ResIndicador::updateOrCreate($conditions,$indRes);
        $res_indicador_29 = ResIndicador29::where('eva_id', $this->eva_id)->where('ind_id', $this->ind_id)->first();
        if ($res_indicador_29) {
            $res_indicador_29->update([
                'tpv' => $this->tpv,
                'toa' => $this->toa,
                'ipv' => $this->ipv,
                'ipv_porcentaje' => $this->ipv_porcentaje,
                'valoracion_29' => $this->valoracion_29,
            ]);
        } else {
            ResIndicador29::create([
                'uni_id' => $this->uni_id,
                'eva_id' => $this->eva_id,
                'cri_id' => $this->cri_id,
                'ind_id' => $this->ind_id,
                'tpv' => $this->tpv,
                'toa' => $this->toa,
                'ipv' => $this->ipv,
                'ipv_porcentaje' => $this->ipv_porcentaje,
                'valoracion_29' => $this->valoracion_29,
                'user_id' => auth()->user()->id,
            ]);
        }
        session()->flash('success', 'Registro agregado con éxito.');
    }
}
