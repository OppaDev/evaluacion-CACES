<div class="modal fade" id="users" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <div class="modal-header text-white pb-2 pt-3" style="background: var(--espe-green); border-radius: 16px 16px 0 0;">
                <h6 class="modal-title fw-medium"><i class="bi bi-person-plus me-2"></i>Asignar Responsable - {{ $criterio->criterio }}</h6>
                <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ url('criteria-assignments') }}" enctype="multipart/form-data">
                    @csrf
                    @include('acreditacion_caces.criteria-assignments.form')
                    <input type="hidden" value="{{ $evaluacion->id }}" id="evaluacionId" name="eva_id">
                    <input type="hidden" id="criterioId" name="cri_id">
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <button type="submit" class="btn-modern btn-primary-modern">
                            <i class="bi bi-check-circle me-1"></i> Asignar
                        </button>
                        <button type="button" class="btn-modern btn-secondary-modern" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
