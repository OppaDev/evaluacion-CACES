<div>
    <div>
        <h5>Elementos A Mejorar</h5>
        <table class="table table-hover align-middle pt-2 pb-2">
            <thead class="table-pacifico text-uppercase">
                <tr>
                    <th>Elemento</th>
                    <th style="width: 230px">Valoración</th>
                </tr>
            <tbody>
                @if($ele_ins==null)
                <tr>
                    <td colspan="26" class="text-center text-muted fw-light pb-5 pt-5">
                        <div>
                            <i class="bi bi-x" style="font-size: 3.5em"></i>
                            <p class="fs-4">No existen elementos insatisfactorios para mostrar.</p>
                        </div>
                    </td>
                </tr>
                @else
                @foreach ($ele_ins as $key => $elemento)
                <tr>
                    <td>
                        {{$elemento['elemento']}}
                    </td>
                    <td>{{$valoraciones[$key]}}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div>
        <h5>Acciones de mejora</h5>
        </br>
        <button type="button" class="btn btn-outline-pacifico mb-4 btn-sm" data-bs-toggle="modal"
            data-bs-target="#assign_tarea_{{ $ind_id }}" @if(auth()->user()->hasRole('Viewer'))
            disabled
            @endif><i class="bi bi-plus"></i>CREAR NUEVA TAREA</button>
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <table class="table table-hover align-middle pt-2 pb-2">
            <thead class="table-pacifico text-uppercase">
                <tr>
                    <th>No</th>
                    <th style="width: 230px">Tarea</th>
                    <th style="width: 230px">Responsable</th>
                    <th style="width: 230px">Periodo</th>
                    <th style="width: 200px">Estado Actual</th>
                    @if(auth()->user()->can("$eva_id/$cri_id")||auth()->user()->can("$eva_id-$ind_id")||auth()->user()->hasRole('Admin'))
                    <th style="width: 50px">Acciones</th>
                    @endif
                    @if(auth()->user()->can("$eva_id/$cri_id")||auth()->user()->hasRole('Admin'))
                    <th style="width: 230px">Estado</th>
                    @endif
                </tr>
            <tbody>
                @if($tareas->isEmpty())
                <tr>
                    <td colspan="26" class="text-center text-muted fw-light pb-5 pt-5">
                        <div>
                            <i class="bi bi-clipboard-x" style="font-size: 3.5em"></i>
                            <p class="fs-4">No hay tareas para mostrar.</p>
                        </div>
                    </td>
                </tr>
                @else
                @foreach ($tareas as $key => $tarea)
                <tr>
                    <td>
                        {{$key + 1 }}
                    </td>
                    <td>{{$tarea->tarea}}</td>
                    <td>{{$tarea->responsable_user->name}}</td>
                    <td>{{$tarea->fecha_inicio}} - {{$tarea->fecha_fin}}</td>
                    <td>
                        @if ($tarea->estado==1)
                        <div class="p-2" style="border-radius: 20px">Creado</div>
                        @endif
                        @if ($tarea->estado==2)
                        <div style="display: inline-block; padding: 8px 12px; font-size: 14px; border-radius: 8px; background-color: yellow; color: black; text-align: center; min-width: 100px; margin: 5px;">
                            En proceso
                        </div>
                        @endif
                        @if ($tarea->estado==3)
                        <div style="display: inline-block; padding: 8px 12px; font-size: 14px; border-radius: 8px; background-color: orange; color: white; text-align: center; min-width: 100px; margin: 5px;">
                            Retrasado
                        </div>
                        @endif
                        @if ($tarea->estado==4)
                        <div style="display: inline-block; padding: 8px 12px; font-size: 14px; border-radius: 8px; background-color: green; color: white; text-align: center; min-width: 100px; margin: 5px;">
                            Cumplido
                        </div>
                        @endif
                        @if ($tarea->estado==5)
                        <div style="display: inline-block; padding: 8px 12px; font-size: 14px; border-radius: 8px; background-color: red; color: white; text-align: center; min-width: 100px; margin: 5px;">
                            No cumplido
                        </div>
                        @endif
                    </td>
                    @if(auth()->user()->can("$eva_id/$cri_id")||auth()->user()->can("$eva_id-$ind_id")&&auth()->user()->hasRole('IndicatorR')||auth()->user()->hasRole('Admin')&&$tarea->estado==1)
                    <td>
                        <button
                            wire:click="deleteTarea({{$tarea->id}})"
                            type="button"
                            class="btn btn-eliminar">
                            <i class="bi bi-trash"></i>
                        </button>

                    </td>
                    @else
                    <td></td>
                    @endif
                    @if(auth()->user()->can("$eva_id/$cri_id")||auth()->user()->hasRole('Admin'))
                    <td>
                        <select wire:model="estado.{{$tarea->id}}" class="form-select">
                            <option value="1" disabled @if($tarea->estado==1) selected="true" @endif>Creado</option>
                            <option value="2" @if($tarea->estado==2) selected="true" @endif>En proceso</option>
                            <option value="3" @if($tarea->estado==3) selected="true" @endif>Retrasado</option>
                            <option value="4" @if($tarea->estado==4) selected="true" @endif>Cumplido</option>
                            <option value="5" @if($tarea->estado==5) selected="true" @endif>No cumplido</option>
                        </select>
                    </td>
                    <td>
                        <button
                            wire:click="cambiarEstado({{$tarea->id}},{{$estado[$tarea->id]}})"
                            type="button"
                            class="btn btn-success">
                            <i class="bi bi-floppy"></i>
                        </button>
                    </td>
                    @endif
                </tr>
                <tr>
                    <thead class="table-pacifico text-uppercase">
                        <td colspan="8">Link de evidencia</td>

                    </thead>
                </tr>
                <tr>
                    <td colspan="8">
                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Link de evidencia</label>
                            <input
                                type="text"
                                id="link"
                                class="form-control"
                                wire:model.defer="link.{{$tarea->id}}"
                                placeholder="Ingresa el link de la evidencia"
                                required>
                            @error('tarea') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div wire:ignore.self class="modal fade" id="assign_tarea_{{ $ind_id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content px-0">
                <div class="modal-header bg-crear text-white pb-2 pt-2">
                    <h6 class="modal-title fw-normal text-uppercase">Nueva tarea</h6>
                    <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal" aria-label="Close"
                        wire:click.prevent="cancel()"><i class="bi bi-x-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div>
                        @include('livewire.form')
                    </div>
                </div>
                <div class="modal-footer justify-content-right">
                    <button type="button" wire:click.prevent="crearTarea()" class="btn btn-actualizar"><i
                            class="bi bi-check-circle"></i> ACTUALIZAR</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('close-modal', event => {
        $('#assign_tarea_{{ $ind_id }}').modal('hide');
    });
    Livewire.on('refreshComponent', () => {
        Livewire.components.components.forEach(component => {
            component.call('render');
        });
    });
</script>
@endpush