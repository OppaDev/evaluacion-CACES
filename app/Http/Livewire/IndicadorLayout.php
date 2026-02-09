<?php

namespace App\Http\Livewire;

use App\Models\ElementoFundamental;
use App\Models\Escala;
use App\Models\Evaluacion;
use App\Models\Formula;
use App\Models\Indicador;
use App\Models\ResIndicador;
use App\Models\Resultado;
use Livewire\Component;

class IndicadorLayout extends Component
{
    public $indicador, $subcriterio, $criterio, $escalas, $evaluacion, $uni_id, $formula, $variables, $formula_res, $res_ind, $ind_val, $check;
    public $ind_id, $sub_id, $cri_id, $eva_id, $ind_res, $ind_deb, $ind_for, $ind_nud, $ind_jus;
    public $porcentaje = [];
    public $valoracion = [];
    public $observacion = [];
    public $prueba;
    public $elementosFundamentales;

    public function guardarObservacion($ele_id){
        $this->validate([
            "observacion.$ele_id" => 'nullable|string'
        ]);

        try {
            $resultado = Resultado::where('ele_id', $ele_id)
                ->where('eva_id', $this->eva_id)
                ->where('ele_ind_id', $this->ind_id)
                ->first();

            if ($resultado) {
                $resultado->update(['observacion' => $this->observacion[$ele_id]]);
                session()->flash('success', 'Observación guardada correctamente.');
            } else {
                session()->flash('info', 'La observación se guardará al guardar el indicador.');
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Error al guardar la observación.');
        }

        $this->dispatchBrowserEvent('close-modal');
    }

    public function mount($id_indicador, $id_evaluacion)
    {
        try {
            $aux = ResIndicador::where('ind_id', $id_indicador)->where('eva_id', $id_evaluacion)->get()->first();
            $this->ind_res = $aux->resultado;
            $this->ind_deb = $aux->debilidades;
            $this->ind_for = $aux->fortalezas;
            $this->ind_nud = $aux->nudo;
            $this->ind_jus = $aux->justificacion;
        } catch (\Throwable $th) {
        }
        $this->eva_id = $id_evaluacion;
        $this->evaluacion = Evaluacion::find($this->eva_id);
        $this->uni_id = $this->evaluacion->universidad->id;
        $this->ind_id = $id_indicador;
        $this->indicador = Indicador::find($this->ind_id);
        $this->res_ind = Resultado::resultadosPorIndicador($this->ind_id, $this->eva_id)->sum('resultado');
        $aux = $this->res_ind * 100 / $this->indicador->porcentaje;
        $aux=round($aux,0);
        if ($aux >= 0 && $aux <= 35) {
            $this->ind_val = 'DEFICIENTE';
            $this->check = false;
        }
        if ($aux > 35 && $aux <= 70) {
            $this->ind_val = 'POCO SATISFACTORIO';
            $this->check = false;
        }
        if ($aux > 70 && $aux < 100) {
            $this->check = true;
            $this->ind_val = 'CUASI SATISFACTORIO';
        }
        if ($aux == 100) {
            $this->check = true;
            $this->ind_val = 'SATISFACTORIO';
        }
        $this->sub_id = $this->indicador->sub_id;
        $this->cri_id = $this->indicador->cri_id;
        $this->escalas = Escala::all();

        $this->elementosFundamentales = ElementoFundamental::where('ind_id', $this->ind_id)->get();
        if ($this->elementosFundamentales->isEmpty()) {
            $this->variables = [];
            $this->formula = Formula::where('ind_id', $this->ind_id)->first();
        }

        foreach ($this->elementosFundamentales as $elemento) {
            $resultado = Resultado::where('ele_id', $elemento->id)->where('eva_id', $this->eva_id)->first();
            $this->porcentaje[$elemento->id] = isset($resultado->resultado) ? $resultado->resultado : 0;
            $this->valoracion[$elemento->id] = isset($resultado->esc_id) ? $resultado->escala->porcentaje : null;
            $this->observacion[$elemento->id] = isset($resultado->observacion) ? $resultado->observacion : null;
        }
    }

    public function updated($propertyName)
    {
        foreach ($this->valoracion as $key => $value) {
            $porcentaje_key = ElementoFundamental::where('id', $key)->where('ind_id', $this->ind_id)->pluck('porcentaje')->first();
            $this->porcentaje[$key] = round($value * $porcentaje_key / 100, 3);
        }
    }

    public function render()
    {
        return view('livewire.elementos-layout');
    }
    public function guardarIndicador()
    {
        $datos = [];
        try {
            foreach ($this->porcentaje as $key => $value) {
                if ($key != 0) {
                    $datos[$key]['resultado'] = $this->porcentaje[$key];
                    if (!isset($this->observacion[$key])) {
                        $datos[$key]['observacion'] = null;
                    } else {
                        $datos[$key]['observacion'] = $this->observacion[$key];
                    }
                    $datos[$key]['eva_use_id'] = auth()->user()->id;
                    $datos[$key]['eva_uni_id'] = $this->uni_id;
                    $datos[$key]['eva_id'] = $this->eva_id;
                    $datos[$key]['esc_id'] = Escala::where('porcentaje', $this->valoracion[$key])->first()->id;

                    $datos[$key]['ele_ind_id'] = $this->ind_id;
                    $datos[$key]['ele_id'] = $key;
                    $datos[$key]['estatus'] = 1;
                }
            }
            foreach ($datos as $key => $item) {
                $id = Resultado::where('ele_id', $key)->where('eva_id', $this->eva_id)->where('ele_ind_id', $this->ind_id)->get()->first();
                if ($id != null) {
                    //update
                    Resultado::where('ele_id', $key)->where('eva_id', $this->eva_id)->where('ele_ind_id', $this->ind_id)->update($item);
                } else {
                    //insert
                    Resultado::insert($item);
                }
            }
            $indRes = ['eva_id' => $this->eva_id, 'ind_id' => $this->ind_id, 'debilidades' => $this->ind_deb, 'fortalezas' => $this->ind_for, 'nudo' => $this->ind_nud, 'justificacion' => $this->ind_jus, 'resultado' => $this->ind_res];
            ResIndicador::updateOrCreate(['eva_id' => $this->eva_id, 'ind_id' => $this->ind_id],$indRes);
            session()->flash('success', 'Registro agregado con éxito.');
        } catch (\Throwable $th) {
            if (strpos($th->getMessage(), 'Integrity constraint violation: 1452') !== false) {
                session()->flash('error', 'No tiene permisos para modificar este indicador.');
            } else {
                session()->flash('error', 'Verifique los valores.');
            }
        }
    }

    public function formula_16()
    {
        $aux = Indicador::where('id', $this->ind_id)->first()->porcentaje;
        if ($this->valoracion['TPhd'] < 0 || $this->valoracion['TP'] <= 0) {
            session()->flash('error', 'Los valores no pueden ser 0 o menores a 0.');
        } else if ($this->valoracion['TPhd'] > $this->valoracion['TP']) {
            session()->flash('error', 'TPhd no puede ser mayor a TP.');
        } else {
            $res = $this->valoracion['TPhd'] / $this->valoracion['TP'] * $aux;
            if (Resultado::where('for_id', 1)->where('eva_id', $this->eva_id)->get()->isEmpty()) {
                Resultado::insert(['eva_uni_id' => $this->uni_id, 'eva_use_id' => auth()->user()->id, 'eva_id' => $this->eva_id, 'for_id' => 1, 'for_ind_id' => $this->ind_id, 'resultado' => $res, 'estatus' => 1]);
            } else {
                Resultado::where('for_id', 1)->where('eva_id', $this->eva_id)->update(['resultado' => $res]);
            }
            session()->flash('success', 'Calculo exitoso');
        }
    }

    public function formula_17()
    {
        $aux = Indicador::where('id', $this->ind_id)->first()->porcentaje;
        if ($this->valoracion['PTC'] < 0 || $this->valoracion['TP'] <= 0) {
            session()->flash('error', 'Los valores no pueden ser 0 o menores a 0.');
        } else if ($this->valoracion['PTC'] > $this->valoracion['TP']) {
            session()->flash('error', 'PTC no puede ser mayor a TP');
        } else {
            $res = $this->valoracion['PTC'] / $this->valoracion['TP'] * $aux;
            if (Resultado::where('for_id', 2)->where('eva_id', $this->eva_id)->get()->isEmpty()) {
                $item = ['eva_uni_id' => $this->uni_id, 'eva_use_id' => auth()->user()->id, 'eva_id' => $this->eva_id, 'for_id' => 2, 'for_ind_id' => $this->ind_id, 'resultado' => $res, 'estatus' => 1];
                Resultado::insert($item);
            } else {
                Resultado::where('for_id', 2)->where('eva_id', $this->eva_id)->update(['resultado' => $res]);
            }
            session()->flash('success', 'Calculo exitoso');
        }
    }

    public function formula_19()
    {
        $sum = 0;
        $aux = Indicador::where('id', $this->ind_id)->first()->porcentaje;
        if ($this->valoracion['n'] <= 0 || $this->valoracion['NEG_Ai'] <= 0) {
            session()->flash('error', 'Los valores no pueden ser 0 o menores a 0.');
        } else {
            for ($i = 1; $i <= $this->valoracion['n']; $i++) {
                $sum += $this->valoracion['NEG_Ai+2'] / $this->valoracion['NEG_Ai'];
            }
            $res = 1 / $this->valoracion['n'] * $sum * $aux;
            try {
                Resultado::create(['eva_uni_id' => $this->uni_id, 'eva_use_id' => auth()->user()->id, 'eva_id' => $this->eva_id, 'for_id' => 3, 'for_ind_id' => $this->ind_id, 'resultado' => $res, 'estatus' => 1]);
            } catch (\Throwable $th) {
                Resultado::where('for_id', 3)->where('eva_id', $this->eva_id)->update(['resultado' => $res]);
            }
            session()->flash('success', 'Calculo exitoso');
        }
    }
    public function formula_21()
    {
        $sum = 0;
        $aux = Indicador::where('id', $this->ind_id)->first()->porcentaje;
        if ($this->valoracion['n'] <= 0 || $this->valoracion['TEGi'] <= 0) {
            session()->flash('error', 'Los valores no pueden ser 0 o menores a 0.');
        } else {
            for ($i = 1; $i <= $this->valoracion['n']; $i++) {
                $sum += $this->valoracion['NEGTi'] / $this->valoracion['TEGi'];
            }
            $res = 1 / $this->valoracion['n'] * $sum * $aux;
            try {
                Resultado::create(['eva_uni_id' => $this->uni_id, 'eva_use_id' => auth()->user()->id, 'eva_id' => $this->eva_id, 'for_id' => 4, 'for_ind_id' => $this->ind_id, 'resultado' => $res, 'estatus' => 1]);
            } catch (\Throwable $th) {
                Resultado::where('for_id', 4)->where('eva_id', $this->eva_id)->update(['resultado' => $res]);
            }
            session()->flash('success', 'Calculo exitoso');
        }
    }

    public function formula_22()
    {
        $sum = 0;
        $aux = Indicador::where('id', $this->ind_id)->first()->porcentaje;
        if ($this->valoracion['n'] <= 0 || $this->valoracion['TECi'] <= 0) {
            session()->flash('error', 'Los valores no pueden ser 0 o menores a 0.');
        } else {
            for ($i = 1; $i <= $this->valoracion['n']; $i++) {
                $sum += $this->valoracion['NEPTi'] / $this->valoracion['TECi'];
            }
            $res = 1 / $this->valoracion['n'] * $sum * $aux;
            try {
                Resultado::create(['eva_uni_id' => $this->uni_id, 'eva_use_id' => auth()->user()->id, 'eva_id' => $this->eva_id, 'for_id' => 5, 'for_ind_id' => $this->ind_id, 'resultado' => $res, 'estatus' => 1]);
            } catch (\Throwable $th) {
                Resultado::where('for_id', 5)->where('eva_id', $this->eva_id)->update(['resultado' => $res]);
            }
            session()->flash('success', 'Calculo exitoso');
        }
    }

    public function formula_25()
    {
        $aux = Indicador::where('id', $this->ind_id)->first()->porcentaje;
        if ($this->valoracion['TP'] <= 0) {
            session()->flash('error', 'Los valores no pueden ser 0 o menores a 0.');
        } else {
            $res = ($this->valoracion['TPyRF'] + $this->valoracion['TPyCI'] + $this->valoracion['TPyCN']) / $this->valoracion['TP'] * $aux / 100;
            if (Resultado::where('for_id', 6)->where('eva_id', $this->eva_id)->get()->isEmpty()) {
                Resultado::insert(['eva_uni_id' => $this->uni_id, 'eva_use_id' => auth()->user()->id, 'eva_id' => $this->eva_id, 'for_id' => 6, 'for_ind_id' => $this->ind_id, 'resultado' => $res, 'estatus' => 1]);
            } else {
                Resultado::where('for_id', 6)->where('eva_id', $this->eva_id)->update(['resultado' => $res]);
            }
            session()->flash('success', 'Calculo exitoso');
        }
    }

    public function formula_26()
    {
        $aux = Indicador::where('id', $this->ind_id)->first()->porcentaje;
        if ($this->valoracion['PTC'] + 0.5 * $this->valoracion['PMT'] == 0) {
            session()->flash('error', 'Error division para 0.');
        } else {
            $res = ($this->valoracion['PAC'] + $this->valoracion['PA'] + $this->valoracion['LyCL'] + $this->valoracion['PIA']) / ($this->valoracion['PTC'] + 0.5 * $this->valoracion['PMT']) * $aux / 100;
            if (Resultado::where('for_id', 7)->where('eva_id', $this->eva_id)->get()->isEmpty()) {
                Resultado::insert(['eva_uni_id' => $this->uni_id, 'eva_use_id' => auth()->user()->id, 'eva_id' => $this->eva_id, 'for_id' => 7, 'for_ind_id' => $this->ind_id, 'resultado' => $res, 'estatus' => 1]);
            } else {
                Resultado::where('for_id', 7)->where('eva_id', $this->eva_id)->update(['resultado' => $res]);
            }
            session()->flash('success', 'Calculo exitoso');
        }
    }

    public function formula_29()
    {
        $aux = Indicador::where('id', $this->ind_id)->first()->porcentaje;
        if ($this->valoracion['TOA'] <= 0) {
            session()->flash('error', 'Division para 0.');
        } else {
            $res = $this->valoracion['TPV'] / $this->valoracion['TOA'] * $aux / 100;
            if (Resultado::where('for_id', 8)->where('eva_id', $this->eva_id)->get()->isEmpty()) {
                Resultado::insert(['eva_uni_id' => $this->uni_id, 'eva_use_id' => auth()->user()->id, 'eva_id' => $this->eva_id, 'for_id' => 8, 'for_ind_id' => $this->ind_id, 'resultado' => $res, 'estatus' => 1]);
            } else {
                Resultado::where('for_id', 8)->where('eva_id', $this->eva_id)->update(['resultado' => $res]);
            }
            session()->flash('success', 'Calculo exitoso');
        }
    }
}
