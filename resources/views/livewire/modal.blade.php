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
                <button type="button" wire:click.prevent="save()" class="btn btn-actualizar"><i
                        class="bi bi-check-circle"></i> ACTUALIZAR</button>
            </div>
        </div>
    </div>
</div>