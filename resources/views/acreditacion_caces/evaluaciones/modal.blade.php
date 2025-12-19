<div class="modal fade" id="crear" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-crear text-white pb-2 pt-2">
                <h6 class="modal-title fw-normal text-uppercase">Crear periodo de evaluación</h6>
                <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal" aria-label="Close"><i
                        class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('evaluaciones.store') }}" enctype="multipart/form-data">
                    @csrf
                    @include('acreditacion_caces.evaluaciones.form')                  
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-crear">
                            CREAR</button>
                        <button type="button" class="btn btn-outline-crear" data-bs-dismiss="modal"
                            aria-label="Close">CANCELAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-crear text-white pb-2 pt-2">
                <h6 class="modal-title fw-normal text-uppercase">Editar periodo de evaluación</h6>
                <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal" aria-label="Close"><i
                        class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('evaluaciones') }}" enctype="multipart/form-data">
                    @csrf
                    @include('acreditacion_caces.evaluaciones.form')
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-crear">
                            PERIODO EVALUACIÓN</button>
                        <button type="button" class="btn btn-outline-crear" data-bs-dismiss="modal"
                            aria-label="Close">CANCELAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

