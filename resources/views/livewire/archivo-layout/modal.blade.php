<!-- Modal Crear -->
<div wire:ignore.self class="modal fade" id="assign_file_{{ $fue_id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content px-0">
            <div class="modal-header bg-crear text-white pb-2 pt-2">
                <h6 class="modal-title fw-normal text-uppercase">Nuevo registro</h6>
                <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal" aria-label="Close"
                    wire:click.prevent="cancel()"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                @include('livewire.archivo-layout.assign')
            </div>
            <div class="modal-footer justify-content-right">
                <button type="button" class="btn btn-outline-pacifico mb-4 btn-sm" data-bs-toggle="modal"
                    data-bs-target="#add_file_{{ $fue_id }}"><i class="bi bi-plus">AGREGAR</i></button>
            </div>
        </div>
    </div>
</div>

{{-- ////////////////////////////////////MODAL EDITAR/////////////////////////////////////////// --}}

<div wire:ignore.self class="modal fade" id="editar_fuente_{{ $fue_id }}" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-actualizar text-white pb-2 pt-2">
                <h6 class="modal-title fw-normal text-uppercase">Actualizar información</h6>
                <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal" aria-label="Close"
                    wire:click.prevent="cancel()"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                @include('livewire.archivo-layout.add')
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" wire:click.prevent="update()" class="btn btn-actualizar"><i
                        class="bi bi-check-circle"></i> ACTUALIZAR</button>
                <button type="button" wire:click.prevent="cancel()" class="btn btn-outline-actualizar"
                    data-bs-dismiss="modal">CANCELAR</button>
            </div>
        </div>
    </div>
</div>
{{-- ////////////////////////////////////MODAL BORRAR/////////////////////////////////////////// --}}

<div wire:ignore.self class="modal fade" id="borrar_fuente_{{ $fue_id }}" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-eliminar text-white pb-2 pt-2">
                <h6 class="modal-title fw-normal text-uppercase">Desasiganr archivo</h6>
                <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal" aria-label="Close"
                    wire:click.prevent="cancel()"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body text-dark">
                <div class="row">
                    <div class="col-sm-2 fs-2 text-center">
                        <p><i class="bi bi-exclamation-circle text-eliminar"></i></p>
                    </div>
                    <div class="col-sm-10 fs-5">
                        <p>¿Está seguro de que desea desasignar el registro seleccionado?</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" wire:click.prevent="delete()" class="btn btn-eliminar"><i
                        class="bi bi-trash px-1"></i>DESASIGNAR</button>
                <button type="button" wire:click.prevent="cancel()" class="btn btn-outline-eliminar"
                    data-bs-dismiss="modal">CANCELAR</button>
            </div>
        </div>
    </div>
</div>

{{-- ////////////////////////////////////MODAL ASSIGNAR/////////////////////////////////////////// --}}

<div wire:ignore.self class="modal fade" id="add_file_{{ $fue_id }}" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-actualizar text-white pb-2 pt-2">
                <h6 class="modal-title fw-normal text-uppercase">AÑADIR NUEVO ARCHIVO</h6>
                <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal" aria-label="Close"
                    wire:click.prevent="cancel()"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                @include('livewire.archivo-layout.add')
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" wire:click.prevent="store()" class="btn btn-actualizar" wire:loading.attr="disabled" wire:target="archivo"><i
                        class="bi bi-check-circle"></i> AÑADIR</button>
                <button type="button" wire:click.prevent="cancel()" class="btn btn-outline-actualizar"
                    data-bs-dismiss="modal">CANCELAR</button>
            </div>
        </div>
    </div>
</div>