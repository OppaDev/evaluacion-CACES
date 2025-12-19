<?php

namespace App\Http\Livewire;

use App\Models\Evaluacion;
use Livewire\Component;
use App\Models\Indicador;
use App\Models\Permission;
use App\Models\Resultado;
use App\Models\Tarea;
use App\Models\User;

class TareasLayout extends Component
{
    public $elementos, $valoraciones, $ele_ins, $tareas, $ind_id, $eva_id, $cri_id, $usuarios, $usuario, $estado, $responsableNombre,$link;
    public $tarea, $fecha_fin, $fecha_inicio;
    public function cancel()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->tarea = null;
        $this->fecha_fin = null;
        $this->fecha_inicio = null;
    }
    public function crearTarea()
    {
        $this->validate([
            'tarea' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);
        Tarea::create([
            'ind_id' => $this->ind_id,
            'eva_id' => $this->eva_id,
            'tarea' => $this->tarea,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'estado' => 1,
            'responsable' => $this->usuario
        ]);
        try {
            Permission::firstOrCreate(['name' => "$this->eva_id-$this->ind_id", 'guard_name' => 'web']);
        } catch (\Throwable $th) {
            dd($th);
        }
        app()['cache']->forget('spatie.permission.cache');
        User::find($this->usuario)->givePermissionTo("$this->eva_id-$this->ind_id");
        session()->flash('success', 'Tarea creada exitosamente.');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->tarea = null;
        $this->fecha_inicio = null;
        $this->fecha_fin = null;
        $this->mount($this->ind_id,$this->eva_id);
    }

    public function deleteTarea($id_tar)
    {
        try {
            Tarea::find($id_tar)->delete();
            $this->mount($this->ind_id, $this->eva_id);
            session()->flash('success', 'Tarea eliminada correctamente');
        } catch (\Throwable $th) {
            session()->flash('error', 'Tarea no eliminada correctamente');
        }
    }

    public function cambiarEstado($id_tar, $id_est)
    {
        Tarea::find($id_tar)->update(['estado' => $id_est,'link'=>$this->link[$id_tar]]);
        session()->flash('success', "Tarea actualizada correctamente");
        $this->mount($this->ind_id,$this->eva_id);
        
    }

    public function mount($ind_id, $eva_id)
    {
        $this->ind_id = $ind_id;
        $this->eva_id = $eva_id;
        $this->usuarios = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })
            ->whereDoesntHave('permissions', function ($query) {
                $query->where('name', "$this->eva_id/$this->cri_id");
            })
            ->get();
        $this->elementos = Indicador::find($ind_id)->elemento_fundamentals;
        try {
            $this->cri_id = Indicador::find($ind_id)->first()->criterio->id;
        } catch (\Throwable $th) {
            $this->cri_id = Indicador::find($ind_id)->first()->subcriterio->criterio->id;
        }
        foreach ($this->elementos as $key => $elemento) {
            $aux = Resultado::where('eva_id', $eva_id)->where('ele_id', $elemento->id)->get()->first();
            $aux = ($aux != null) ? $aux->resultado : 0;
            $aux = round($aux * 100 / $elemento->porcentaje, 0);
            if ($aux >= 0 && $aux < 35) {
                $ind_val = 'DEFICIENTE';
                $this->ele_ins[$key] = $elemento;
                $this->valoraciones[$key] = $ind_val;
            }
            if ($aux >= 35 && $aux < 70) {
                $ind_val = 'POCO SATISFACTORIO';
                $this->ele_ins[$key] = $elemento;
                $this->valoraciones[$key] = $ind_val;
            }
            if ($aux >= 70 && $aux < 100) {
                $ind_val = 'CUASI SATISFACTORIO';
            }
            if ($aux == 100) {
                $ind_val = 'SATISFACTORIO';
            }
        }
        $this->tareas = Tarea::where('ind_id', $ind_id)->where('eva_id', $eva_id)->get();
        foreach ($this->tareas as $key => $tarea) {
            $this->estado[$tarea->id]=$tarea->estado;
            $this->link[$tarea->id]=$tarea->link;
        }
    }

    public function render()
    {
        return view('livewire.tareas-layout');
    }
}
