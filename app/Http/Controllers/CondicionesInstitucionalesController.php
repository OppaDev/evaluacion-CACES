<?php

namespace App\Http\Controllers;

use App\Models\Criterio;
use App\Models\Escala;
use App\Models\Evaluacion;
use App\Models\Indicador;
use App\Models\Resultado;
use App\Models\Subcriterio;
use App\Models\Universidad;
use Illuminate\Http\Request;

class CondicionesInstitucionalesController extends Controller
{
    public function index($id)
    {
        $evaluacion = Evaluacion::find($id);
        $criterio = Criterio::find(1);
        $sub_criterios = Subcriterio::where('cri_id', 1)->get();
        $escalas = Escala::all();

        return view('acreditacion_caces.condiciones_institucionales.index', compact('evaluacion', 'sub_criterios', 'criterio', 'escalas'));
    }

    public function store(Request $request)
    {

        try {
            $uni_id = $request->uni_id;
            $eva_id = $request->eva_id;
            $cri_id = $request->cri_id;            
            $datos = $request->except('_token', 'uni_id', 'eva_id', 'cri_id');                     
            foreach ($datos as $key => $item) {
                // dd($item);
                $item['ele_id'] = $key;
                $item['uni_id'] = $uni_id;
                $item['eva_id'] = $eva_id;
                $item['cri_id'] = $cri_id;
                $item['user_id'] = auth()->user()->id;
                // dd($item);
                $id = Resultado::where('ele_id', $key)->get()->first();
                if ($id != null) {
                    //update
                    Resultado::where('ele_id', $key)->update($item);
                } else {
                    //insert

                    Resultado::insert($item);
                }
            }
            return redirect()->route('condiciones.institucionales.index', $eva_id)->with('success', 'Registro exitoso.');
        } catch (\Exception $e) {
            return redirect()->route('condiciones.institucionales.index', $eva_id)->with('error', 'Error al crear el registro');
        }
    }
}
