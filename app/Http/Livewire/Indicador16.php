<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Indicador;
use App\Models\Evaluacion;
use App\Models\ResIndicador;
use App\Models\ResIndicador16;

class Indicador16 extends Component
{
    public $indicador, $criterio, $evaluacion, $uni_id;
    public $ind_id, $cri_id, $eva_id;
    public $ind_res,$ind_deb,$ind_for,$ind_nud,$ind_jus;

    public $tphd, $tp, $tpafd, $tpafd_porcentaje, $valoracion_16;

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

        $res_indicador_16 = ResIndicador16::where('eva_id', $this->eva_id)->where('ind_id', $this->ind_id)->first();
        $this->tphd = isset($res_indicador_16->tphd) ? $res_indicador_16->tphd : '1';
        $this->tp = isset($res_indicador_16->tp) ? $res_indicador_16->tp : '1';
        $this->tpafd = isset($res_indicador_16->tpafd) ? $res_indicador_16->tpafd : '100';
        $this->tpafd_porcentaje = isset($res_indicador_16->tpafd_porcentaje) ? $res_indicador_16->tpafd_porcentaje : round($this->indicador->porcentaje * 1, 3);
        $this->valoracion_16 = isset($res_indicador_16->valoracion) ? $res_indicador_16->valoracion : 'SATISFACTORIO';
    }

    public function updatedTphd()
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
            $this->tpafd = round((floatval($this->tphd) / floatval($this->tp)) * 100, 3);
            if ($this->tpafd >= 20) {
                $this->valoracion_16 = 'SATISFACTORIO';
                $this->tpafd_porcentaje = round($this->indicador->porcentaje * 1, 3);
            } elseif ($this->tpafd >= 13 && $this->tpafd < 20) {
                $this->valoracion_16 = 'CUASI SATISFACTORIO';
                $this->tpafd_porcentaje = round($this->indicador->porcentaje * 0.70, 3);
            } elseif ($this->tpafd >= 7 && $this->tpafd < 13) {
                $this->valoracion_16 = 'POCO SATISFACTORIO';
                $this->tpafd_porcentaje = round($this->indicador->porcentaje * 0.35, 3);
            } elseif ($this->tpafd < 7) {
                $this->valoracion_16 = 'DEFICIENTE';
                $this->tpafd_porcentaje = round($this->indicador->porcentaje * 0, 3);
            }
        } catch (\Throwable $th) {
            $this->tpafd = 0;
        }
    }

    public function render()
    {
        return view('livewire.indicador16.view');
    }

    public function guardarIndicador16()
    {
        $indRes=['eva_id'=>$this->eva_id,'ind_id'=>$this->ind_id,'debilidades'=>$this->ind_deb,'fortalezas'=>$this->ind_for,'nudo'=>$this->ind_nud,'justificacion'=>$this->ind_jus,'resultado'=>$this->ind_res];
        $conditions=['eva_id'=>$this->eva_id,'ind_id'=>$this->ind_id];
        ResIndicador::updateOrCreate($conditions,$indRes);
        $res_indicador_16 = ResIndicador16::where('eva_id', $this->eva_id)->where('ind_id', $this->ind_id)->first();
        if ($res_indicador_16) {
            $res_indicador_16->update([
                'tphd' => $this->tphd,
                'tp' => $this->tp,
                'tpafd' => $this->tpafd,
                'tpafd_porcentaje' => $this->tpafd_porcentaje,
                'valoracion_16' => $this->valoracion_16,
            ]);
        } else {
            ResIndicador16::create([
                'uni_id' => $this->uni_id,
                'eva_id' => $this->eva_id,
                'cri_id' => $this->cri_id,
                'ind_id' => $this->ind_id,
                'tphd' => $this->tphd,
                'tp' => $this->tp,
                'tpafd' => $this->tpafd,
                'tpafd_porcentaje' => $this->tpafd_porcentaje,
                'valoracion_16' => $this->valoracion_16,
                'user_id' => auth()->user()->id,
            ]);
        }
        session()->flash('success', 'Registro agregado con éxito.');
    }
}
