<?php

namespace App\Http\Livewire;

use App\Models\Archivo;
use App\Models\Evaluacion;
use App\Models\FuenteInformacion;
use App\Models\Indicador;
use Livewire\Component;
use Livewire\WithFileUploads;

class FuenteLayout extends Component
{
    use WithFileUploads;
    public $indicador, $subcriterio, $criterio, $escalas, $evaluacion, $uni_id;
    public $ind_id, $sub_id, $cri_id, $eva_id, $archivo_url = [];
    public $archivo = [];
    public $observacion = [];
    public $fuentesInformaciones;

    public function mount($id_indicador, $id_evaluacion)
    {
        $this->eva_id = $id_evaluacion;
        $this->evaluacion = Evaluacion::find($this->eva_id);
        $this->uni_id = $this->evaluacion->universidad->id;
        $this->ind_id = $id_indicador;
        $this->indicador = Indicador::find($this->ind_id);
        try {
            $this->sub_id = $this->indicador->sub_id;
            $this->cri_id = $this->indicador->subcriterio->criterio->id;
        } catch (\Throwable $th) {
            $this->cri_id= $this->indicador->criterio->id;
        }
        $this->fuentesInformaciones = FuenteInformacion::where('ind_id', $this->ind_id)->get();
        // foreach ($this->fuentesInformaciones as $fuente) {
        //     $arch_condicion_institucion = Archivo::where('eva_id', $this->eva_id)->where('ind_id', $this->ind_id)->first();
        //     $this->archivo_url[$fuente->id] = isset($arch_condicion_institucion->archivo) ? $arch_condicion_institucion->archivo : null;
        //     $this->archivo[$fuente->id] = null;
        //     $this->observacion[$fuente->id] = isset($arch_condicion_institucion->observacion) ? $arch_condicion_institucion->observacion : null;
        // }
    }

    public function render()
    {
        return view('livewire.fuente-layout');
    }

    // public function guardarArchivoIndicador1()
    // {
    //     $rutaArchivos = 'uploads/' . $this->evaluacion->universidad->universidad . '/' . $this->evaluacion->fecha_creacion .'-'.$this->evaluacion->id . '/criterio-' . $this->indicador->subcriterio->criterio->id . '/indicador-' . $this->ind_id;
    //     $datos = [];
    //     foreach ($this->archivo as $key => $archivo) {
    //         if ($key != 0) {                
    //             if ($archivo == null) {
    //                 $arch_condicion_institucion = ArchCondicionInstitucion::where('fuente_informacion_id', $key)->where('eva_id', $this->eva_id)->where('ind_id', $this->ind_id)->first();
    //                 if(isset($arch_condicion_institucion->archivo)){
    //                     $nombre_archivo = $arch_condicion_institucion->archivo;
    //                 } else{
    //                     $nombre_archivo = null;
    //                 }
    //             } else {
    //                 $nombre_archivo_1 = $archivo->getClientOriginalName();
    //                 $nombre_archivo = $archivo->storeAs($rutaArchivos, $nombre_archivo_1, 'public');
    //             }
    //             $datos[$key]['archivo'] = $nombre_archivo;
    //             if (!isset($this->observacion[$key])) {
    //                 $datos[$key]['observacion'] = null;
    //             } else {
    //                 $datos[$key]['observacion'] = $this->observacion[$key];
    //             }
    //             $datos[$key]['user_id'] = auth()->user()->id;
    //             $datos[$key]['uni_id'] = $this->uni_id;
    //             $datos[$key]['eva_id'] = $this->eva_id;
    //             $datos[$key]['cri_id'] = $this->cri_id;
    //             $datos[$key]['sub_id'] = $this->sub_id;
    //             $datos[$key]['ind_id'] = $this->ind_id;
    //             $datos[$key]['fuente_informacion_id'] = $key;
    //         }
    //     }
    //     foreach ($datos as $key => $item) {
    //         $id = ArchCondicionInstitucion::where('fuente_informacion_id', $key)->where('eva_id', $this->eva_id)->where('ind_id', $this->ind_id)->get()->first();
    //         if ($id != null) {
    //             //update
    //             ArchCondicionInstitucion::where('fuente_informacion_id', $key)->where('eva_id', $this->eva_id)->where('ind_id', $this->ind_id)->update($item);
    //         } else {
    //             //insert
    //             ArchCondicionInstitucion::insert($item);
    //         }
    //     }
    //     session()->flash('success', 'Registro agregado con éxito.');
    // }
}
