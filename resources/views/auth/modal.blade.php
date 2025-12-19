<div class="modal fade" id="uni_register" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-crear text-white pb-2 pt-2">
                <h6 class="modal-title fw-normal text-uppercase">Asignar universidades</h6>
                <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal" aria-label="Close"><i
                        class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('register') }}" enctype="multipart/form-data">
                    @csrf
                    @include('auth.form')
                    <input type="hidden" id="indicadorId" name="ind_id">
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-crear">
                            ASIGNAR</button>
                        <button type="button" class="btn btn-outline-crear" data-bs-dismiss="modal"
                            aria-label="Close">CANCELAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
