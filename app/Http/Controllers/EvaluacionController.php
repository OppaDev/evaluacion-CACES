<?php

namespace App\Http\Controllers;


use App\Models\Evaluacion;
use App\Models\Universidad;
use App\Models\Criterio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluacionController extends Controller
{
    private $uni_id=1;

    public function show($id)
    {
        
        $this->uni_id=$id;
        $universidad = Universidad::find($this->uni_id);
      

        $evaluaciones = Evaluacion::where('uni_id', $id)->get();
        return view('acreditacion_caces.evaluaciones.index', compact( 'universidad', 'evaluaciones'));
    }

    public function store(Request $request){
        $evaluacion = $request->except('_token');
        $id = $request->uni_id;
        $evaluacion['fecha_creacion'] = date('Y-m-d');
        $evaluacion['use_id'] = Auth::user()->id;
        Evaluacion::insert($evaluacion);
        return redirect()->route('evaluaciones.show', $id);
    } 
    public function edit($id)
    {
        $evaluacion=Evaluacion::where('id',$id)->first();
        $universidad=Universidad::where('id',$evaluacion->uni_id)->first();
        $evaluacion = Evaluacion::find($id);
        return view('acreditacion_caces.evaluaciones.edit', compact('evaluacion','universidad'));
    }
    public function destroy($id)
    {
        $evaluacion=Evaluacion::where('id',$id)->first();
        $uni_id = $evaluacion->uni_id;
        $evaluacion->delete();
        return redirect()->route('evaluaciones.show',$uni_id);
    }

    public function update(Request $request, $id){
        $eva=Evaluacion::where('id',$id);
        $evaluacion = $request->except('_token', '_method');
        Evaluacion::where('id', $id)->update($evaluacion);
        return redirect()->route('evaluaciones.show',$this->uni_id);
    } 
}
