<?php

namespace App\Http\Livewire\ArchivoLayout;

use App\Models\ArcFueEva;
use App\Models\Archivo;
use App\Models\Evaluacion;
use App\Models\Indicador;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class ArchivoLayout extends Component
{
    use WithFileUploads;
    public $indicador, $subcriterio, $criterio, $evaluacion, $uni_id;
    public $ind_id, $subcriterio_id, $criterio_id, $eva_id, $fue_id, $old_archivo, $id_arch_programa;
    public $archivo, $observacion, $delete_id;
    public $nombre_indicador, $nombre_criterio;

    protected $rules = [
        'archivo' => 'required|file|max:5120',
        'observacion' => 'required',
    ];

    protected $messages = [
        'archivo.required' => 'El campo Archivo es requerido.',
        'archivo.file' => 'El campo Archivo debe ser un archivo.',
        'archivo.max' => 'El campo Archivo no debe ser mayor a 5MB.',
        'observacion.required' => 'El campo Observación es requerido.',
    ];

    public function mount($id_indicador, $id_evaluacion, $id_fuente)
    {

        $this->eva_id = $id_evaluacion;
        $this->evaluacion = Evaluacion::find($this->eva_id);
        $this->uni_id = $this->evaluacion->universidad->id;
        $this->ind_id = $id_indicador;
        $this->indicador = Indicador::find($this->ind_id);
        // DIVIDIENDO LA CADENA EN PARTES
        $parts_nombre_inidcador = explode(':', $this->indicador->indicador);
        $this->nombre_indicador = trim($parts_nombre_inidcador[1]);
        // FIN        
        $this->criterio_id = $this->indicador->cri_id;
        try {
            $this->nombre_criterio = $this->indicador->subcriterio->criterio->criterio;
            $this->subcriterio_id = $this->indicador->subcriterio->id;
        } catch (\Throwable $th) {
            $this->nombre_criterio = $this->indicador->criterio->criterio;
        }
        $this->fue_id = $id_fuente;
    }

    public function render()
    {
        $arch_condiciones_institucionales = ArcFueEva::where('fue_id', $this->fue_id)->where('eva_id', $this->eva_id)->get();
        $arch_disponibles=Archivo::all();
        $uni_id=$this->uni_id;
        return view('livewire.archivo-layout.archivo-layout', compact('arch_condiciones_institucionales','arch_disponibles','uni_id'));
    }

    // LIMPIAR LOS CAMPOS AL CANCELAR O CERRAR FORMULARIO
    public function cancel()
    {
        $this->resetInput();
    }
    // LIMPIAR LOS CAMPOS
    public function resetInput()
    {
        $this->archivo = null;
        $this->observacion = null;
    }

    public function asignarArc($arc_id){
        try {
            $userId = auth()->id();
            ArcFueEva::insert(['arc_id'=>$arc_id, 'fue_id'=>$this->fue_id, 'uni_id'=>$this->uni_id,'eva_id'=>$this->eva_id,'use_id'=>$userId]);
            $this->dispatchBrowserEvent('close-modal',["assign",$this->fue_id]);
            session()->flash('success', 'Registro agregado con éxito'); 
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('close-modal',['form_name'=>"assign",'fue_id'=>$this->fue_id]);
            session()->flash('error', 'El archivo seleccioniado ya esta asignado a la fuente de información actual'); 
        }
    }

    public function store()
    {
        try {
            $this->emit('fileUploading');
            $this->validate(['archivo' => 'required|file|max:51200']);
            $rutaArchivos = 'docs/' . $this->evaluacion->uni_id;
            $nombre_archivo_1 = $this->archivo->getClientOriginalName();
            if ($this->archivo != null) {
                $nombre_archivo = $this->archivo->storeAs($rutaArchivos, $nombre_archivo_1, 'public');
            } else {
                $nombre_archivo = $this->archivo;
            }
            Archivo::create([
                'archivo' => $nombre_archivo,
                'observacion' => $this->observacion,
            ]);
    
            $this->cancel();
            $this->dispatchBrowserEvent('close-modal');
            $this->emit('refreshComponent');
            session()->flash('success', 'Registro agregado con éxito');
        } catch (\Throwable $th) {
            dd($th);
            $this->emit('refreshComponent');
            session()->flash('error', 'Verifique los datos');
        }
    }
    

    
    

    // FUNCION PARA ACTUALIZAR LOS DATOS DEL ESTUDIANTE
    public function edit($id)
    {
        $dato = Archivo::findOrFail($id);
        $this->id_arch_programa = $dato->id;
        $this->archivo = $dato->archivo;
        $this->old_archivo = $dato->archivo;
        $this->observacion = $dato->observacion;
    }

    // FUNCION PARA ACTUALIZAR LOS DATOS
    public function update()
    {
        if ($this->id_arch_programa) {
            $rutaArchivos = 'uploads/' . $this->evaluacion->universidad->universidad . '/' . $this->evaluacion->fecha_creacion . '/' . $this->nombre_criterio . '/' . $this->nombre_indicador . '/FUENTE ' . $this->fue_id . '/';
            if ($this->archivo != $this->old_archivo) {
                $nombre_archivo_1 = $this->archivo->getClientOriginalName();
                $nombre_archivo = $this->archivo->storeAs($rutaArchivos, $nombre_archivo_1, 'public');
            } else {
                $nombre_archivo = $this->archivo;
            }
            $dato = Archivo::find($this->id_arch_programa);
            $dato->update([
                'archivo' => $nombre_archivo,
                'observacion' => $this->observacion,
                'user_id' => auth()->user()->id,
            ]);
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('success', 'Registro actualizado satisfactoriamente');
        }
    }

    // FUNCION PARA ELIMINAR DATOS
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
    }

    public function delete()
    {
        ArcFueEva::where('arc_id',$this->delete_id)->where( 'fue_id',$this->fue_id)->where('uni_id',$this->uni_id)->where('eva_id',$this->eva_id)->delete();
        $this->dispatchBrowserEvent('close-modal');
        session()->flash('delete-successfull', 'Registro desasignado con éxito.');
    }
}
