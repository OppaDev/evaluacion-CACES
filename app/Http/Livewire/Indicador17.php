<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Indicador;
use App\Models\Evaluacion;
use App\Models\ResIndicador;
use App\Models\ResIndicador17;

class Indicador17 extends Component
{
    public $indicador, $criterio, $evaluacion, $uni_id;
    public $ind_id, $cri_id, $eva_id;
    public $ind_res,$ind_deb,$ind_for,$ind_nud,$ind_jus;

    public $ptc, $tp, $tptc, $tptc_porcentaje, $valoracion_17;

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

        $res_indicador_17 = ResIndicador17::where('eva_id', $this->eva_id)->where('ind_id', $this->ind_id)->first();
        $this->ptc = isset($res_indicador_17->ptc) ? $res_indicador_17->ptc : '1';
        $this->tp = isset($res_indicador_17->tp) ? $res_indicador_17->tp : '1';
        $this->tptc = isset($res_indicador_17->tptc) ? $res_indicador_17->tptc : '100';
        $this->tptc_porcentaje = isset($res_indicador_17->tptc_porcentaje) ? $res_indicador_17->tptc_porcentaje : round($this->indicador->porcentaje * 1, 3);
        $this->valoracion_17 = isset($res_indicador_17->valoracion) ? $res_indicador_17->valoracion : 'SATISFACTORIO';
    }

    public function updatedPtc()
    {
        $this->calculo();
    }

    public function updatedTp()
    {
        $this->calculo();
    }

    public function calculo()
    {
        try {
            $this->tptc = round((floatval($this->ptc) / floatval($this->tp)) * 100, 3);
            if ($this->tptc >= 50) {
                $this->valoracion_17 = 'SATISFACTORIO';
                $this->tptc_porcentaje = round($this->indicador->porcentaje * 1, 3);
            } elseif ($this->tptc < 50) {
                $this->valoracion_17 = 'DEFICIENTE';
                $this->tptc_porcentaje = round($this->indicador->porcentaje * 0, 3);
            }
        } catch (\Throwable $th) {
            $this->tptc = 0;
        }
    }

    public function render()
    {
        return view('livewire.indicador17.view');
    }

    public function guardarIndicador17()
    {
        $indRes=['eva_id'=>$this->eva_id,'ind_id'=>$this->ind_id,'debilidades'=>$this->ind_deb,'fortalezas'=>$this->ind_for,'nudo'=>$this->ind_nud,'justificacion'=>$this->ind_jus,'resultado'=>$this->ind_res];
        $conditions=['eva_id'=>$this->eva_id,'ind_id'=>$this->ind_id];
        ResIndicador::updateOrCreate($conditions,$indRes);
        $res_indicador_17 = ResIndicador17::where('eva_id', $this->eva_id)->where('ind_id', $this->ind_id)->first();
        if ($res_indicador_17) {
            $res_indicador_17->update([
                'ptc' => $this->ptc,
                'tp' => $this->tp,
                'tptc' => $this->tptc,
                'tptc_porcentaje' => $this->tptc_porcentaje,
                'valoracion_17' => $this->valoracion_17,
            ]);
        } else {
            ResIndicador17::create([
                'uni_id' => $this->uni_id,
                'eva_id' => $this->eva_id,
                'cri_id' => $this->cri_id,
                'ind_id' => $this->ind_id,
                'ptc' => $this->ptc,
                'tp' => $this->tp,
                'tptc' => $this->tptc,
                'tptc_porcentaje' => $this->tptc_porcentaje,
                'valoracion_17' => $this->valoracion_17,
                'user_id' => auth()->user()->id,
            ]);
        }
        session()->flash('success', 'Registro agregado con éxito.');
    }
}
