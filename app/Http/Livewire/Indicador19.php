<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Indicador;
use App\Models\Evaluacion;
use App\Models\ResIndicador;
use App\Models\ResIndicador19;

class Indicador19 extends Component
{
    public $indicador, $criterio, $evaluacion, $uni_id;
    public $ind_id, $cri_id, $eva_id;
    public $ind_res,$ind_deb,$ind_for,$ind_nud,$ind_jus;

    public $n, $neg_a1_2, $neg_a1, $neg_a2_2, $neg_a2, $neg_a3_2, $neg_a3, $neg_a4_2, $neg_a4, $neg_a5_2, $neg_a5, $neg_a6_2, $neg_a6,
        $tdg2, $tdg2_porcentaje, $valoracion_19;

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

        $res_indicador_19 = ResIndicador19::where('eva_id', $this->eva_id)->where('ind_id', $this->ind_id)->first();
        $this->n = isset($res_indicador_19->n) ? $res_indicador_19->n : '1';
        $this->neg_a1_2 = isset($res_indicador_19->neg_a1_2) ? $res_indicador_19->neg_a1_2 : '0';
        $this->neg_a1 = isset($res_indicador_19->neg_a1) ? $res_indicador_19->neg_a1 : '1';
        $this->neg_a2_2 = isset($res_indicador_19->neg_a2_2) ? $res_indicador_19->neg_a2_2 : '0';
        $this->neg_a2 = isset($res_indicador_19->neg_a2) ? $res_indicador_19->neg_a2 : '1';
        $this->neg_a3_2 = isset($res_indicador_19->neg_a3_2) ? $res_indicador_19->neg_a3_2 : '0';
        $this->neg_a3 = isset($res_indicador_19->neg_a3) ? $res_indicador_19->neg_a3 : '1';
        $this->neg_a4_2 = isset($res_indicador_19->neg_a4_2) ? $res_indicador_19->neg_a4_2 : '0';
        $this->neg_a4 = isset($res_indicador_19->neg_a4) ? $res_indicador_19->neg_a4 : '1';
        $this->neg_a5_2 = isset($res_indicador_19->neg_a5_2) ? $res_indicador_19->neg_a5_2 : '0';
        $this->neg_a5 = isset($res_indicador_19->neg_a5) ? $res_indicador_19->neg_a5 : '1';
        $this->neg_a6_2 = isset($res_indicador_19->neg_a6_2) ? $res_indicador_19->neg_a6_2 : '0';
        $this->neg_a6 = isset($res_indicador_19->neg_a6) ? $res_indicador_19->neg_a6 : '1';
        $this->tdg2 = isset($res_indicador_19->tdg2) ? $res_indicador_19->tdg2 : '0';
        $this->tdg2_porcentaje = isset($res_indicador_19->tdg2_porcentaje) ? $res_indicador_19->tdg2_porcentaje : round($this->indicador->porcentaje * 1, 3);
        $this->valoracion_19 = isset($res_indicador_19->valoracion_19) ? $res_indicador_19->valoracion_19 : 'SATISFACTORIO';
    }

    public function updatedN()
    {
        $this->calculo();
    }

    public function updatedNegA12()
    {
        $this->calculo();
    }

    public function updatedNegA1()
    {
        $this->calculo();
    }

    public function updatedNegA22()
    {
        $this->calculo();
    }

    public function updatedNegA2()
    {
        $this->calculo();
    }

    public function updatedNegA32()
    {
        $this->calculo();
    }

    public function updatedNegA3()
    {
        $this->calculo();
    }

    public function updatedNegA42()
    {
        $this->calculo();
    }

    public function updatedNegA4()
    {
        $this->calculo();
    }

    public function updatedNegA52()
    {
        $this->calculo();
    }

    public function updatedNegA5()
    {
        $this->calculo();
    }

    public function updatedNegA62()
    {
        $this->calculo();
    }

    public function updatedNegA6()
    {
        $this->calculo();
    }


    public function calculo()
    {
        
        try {
            if ($this->n == 1) {
                $this->tdg2 = round((1 / floatval($this->n)) * (floatval($this->neg_a1_2) / floatval($this->neg_a1)) * 100, 3);
            } elseif ($this->n == 2) {
                $this->tdg2 = round((1 / floatval($this->n)) * ((floatval($this->neg_a1_2) / floatval($this->neg_a1)) + (floatval($this->neg_a2_2) / floatval($this->neg_a2))) * 100, 3);
            } elseif ($this->n == 3) {
                $this->tdg2 = round((1 / floatval($this->n)) * ((floatval($this->neg_a1_2) / floatval($this->neg_a1)) + (floatval($this->neg_a2_2) / floatval($this->neg_a2)) + (floatval($this->neg_a3_2) / floatval($this->neg_a3))) * 100, 3);
            } elseif ($this->n == 4) {
                $this->tdg2 = round((1 / floatval($this->n)) * ((floatval($this->neg_a1_2) / floatval($this->neg_a1)) + (floatval($this->neg_a2_2) / floatval($this->neg_a2)) + (floatval($this->neg_a3_2) / floatval($this->neg_a3)) + (floatval($this->neg_a4_2) / floatval($this->neg_a4))) * 100, 3);
            } elseif ($this->n == 5) {
                $this->tdg2 = round((1 / floatval($this->n)) * ((floatval($this->neg_a1_2) / floatval($this->neg_a1)) + (floatval($this->neg_a2_2) / floatval($this->neg_a2)) + (floatval($this->neg_a3_2) / floatval($this->neg_a3)) + (floatval($this->neg_a4_2) / floatval($this->neg_a4)) + (floatval($this->neg_a5_2) / floatval($this->neg_a5))) * 100, 3);
            } elseif ($this->n == 6) {
                $this->tdg2 = round((1 / floatval($this->n)) * ((floatval($this->neg_a1_2) / floatval($this->neg_a1)) + (floatval($this->neg_a2_2) / floatval($this->neg_a2)) + (floatval($this->neg_a3_2) / floatval($this->neg_a3)) + (floatval($this->neg_a4_2) / floatval($this->neg_a4)) + (floatval($this->neg_a5_2) / floatval($this->neg_a5)) + (floatval($this->neg_a6_2) / floatval($this->neg_a6))) * 100, 3);
            }

            if ($this->tdg2 <= 14) {
                $this->valoracion_19 = 'SATISFACTORIO';
                $this->tdg2_porcentaje = round($this->indicador->porcentaje * 1, 3);
            } elseif ($this->tdg2 > 14 && $this->tdg2 <= 18) {
                $this->valoracion_19 = 'CUASI SATISFACTORIO';
                $this->tdg2_porcentaje = round($this->indicador->porcentaje * 0.70, 3);
            } elseif ($this->tdg2 > 18 && $this->tdg2 <= 23) {
                $this->valoracion_19 = 'POCO SATISFACTORIO';
                $this->tdg2_porcentaje = round($this->indicador->porcentaje * 0.35, 3);
            } elseif ($this->tdg2 > 23) {
                $this->valoracion_19 = 'DEFICIENTE';
                $this->tdg2_porcentaje = round($this->indicador->porcentaje * 0, 3);
            }
        } catch (\Throwable $th) {
            $this->tdg2 = 0;
        }
    }

    public function render()
    {
        return view('livewire.indicador19.view');
    }

    public function guardarIndicador19()
    {
        $indRes=['eva_id'=>$this->eva_id,'ind_id'=>$this->ind_id,'debilidades'=>$this->ind_deb,'fortalezas'=>$this->ind_for,'nudo'=>$this->ind_nud,'justificacion'=>$this->ind_jus,'resultado'=>$this->ind_res];
        $conditions=['eva_id'=>$this->eva_id,'ind_id'=>$this->ind_id];
        ResIndicador::updateOrCreate($conditions,$indRes);
        $res_indicador_19 = ResIndicador19::where('eva_id', $this->eva_id)->where('ind_id', $this->ind_id)->first();
        if ($res_indicador_19) {
            $res_indicador_19->update([
                'n' => $this->n,
                'neg_a1_2' => $this->neg_a1_2,
                'neg_a1' => $this->neg_a1,
                'neg_a2_2' => $this->neg_a2_2,
                'neg_a2' => $this->neg_a2,
                'neg_a3_2' => $this->neg_a3_2,
                'neg_a3' => $this->neg_a3,
                'neg_a4_2' => $this->neg_a4_2,
                'neg_a4' => $this->neg_a4,
                'neg_a5_2' => $this->neg_a5_2,
                'neg_a5' => $this->neg_a5,
                'neg_a6_2' => $this->neg_a6_2,
                'neg_a6' => $this->neg_a6,
                'tdg2' => $this->tdg2,
                'tdg2_porcentaje' => $this->tdg2_porcentaje,
                'valoracion_19' => $this->valoracion_19,
            ]);
        } else {
            ResIndicador19::create([
                'uni_id' => $this->uni_id,
                'eva_id' => $this->eva_id,
                'cri_id' => $this->cri_id,
                'ind_id' => $this->ind_id,
                'n' => $this->n,
                'neg_a1_2' => $this->neg_a1_2,
                'neg_a1' => $this->neg_a1,
                'neg_a2_2' => $this->neg_a2_2,
                'neg_a2' => $this->neg_a2,
                'neg_a3_2' => $this->neg_a3_2,
                'neg_a3' => $this->neg_a3,
                'neg_a4_2' => $this->neg_a4_2,
                'neg_a4' => $this->neg_a4,
                'neg_a5_2' => $this->neg_a5_2,
                'neg_a5' => $this->neg_a5,
                'neg_a6_2' => $this->neg_a6_2,
                'neg_a6' => $this->neg_a6,
                'tdg2' => $this->tdg2,
                'tdg2_porcentaje' => $this->tdg2_porcentaje,
                'valoracion_19' => $this->valoracion_19,
                'user_id' => auth()->user()->id,
            ]);
        }
        session()->flash('success', 'Registro agregado con éxito.');
    }
}
