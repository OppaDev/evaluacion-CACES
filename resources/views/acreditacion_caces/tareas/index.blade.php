@extends('layouts.caces')
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<div class="pagetitle">
    <h3>Evaluación</h3>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Evaluación</li>
        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-header pb-2">
        <h6 class="fw-normal text-pacifico text-uppercase">Lista Criterios</h6>
    </div>
    <div class="card-body mt-3">
        <div class="table-responsive">
            <table id="universidad" class="table table-hover align-middle text-uppercase pt-2 pb-2">
                <thead class="table-pacifico">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">CRITERIO</th>
                        <th scope="col">RESPONSABLE</th>
                        <th scope="col">ASIGNAR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($criterios as $criterio)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $criterio->criterio }}
                        </td>
                        <td>
                            <label>{{$criterio->responsable}}</label>

                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#users" data-criterio-id="{{$criterio->id}}">ASIGNAR</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-4 ">
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
            </div>
        </div>
    </div>
</div>
@include('acreditacion_caces.criteria-assignments.modal')
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#users').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var criterioId = button.data('criterio-id');

        var modal = $(this);
        modal.find('#criterioId').val(criterioId);
    });
</script>
<script>
    document.getElementById('criteria-assignments').classList.remove('collapsed');
    Livewire.on('refresh', () => {
        location.reload();
    });
</script>
@endsection