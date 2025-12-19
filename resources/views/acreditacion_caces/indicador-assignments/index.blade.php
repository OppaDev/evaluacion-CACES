@extends('layouts.caces')
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('content')
<div class="pagetitle">
    <h3>ASIGNAR INDICADORES</h3>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Asignar indicadores</li>
        </ol>
    </nav>
</div>
@foreach ($criterios as $criterio )
@if(auth()->user()->can("$evaluacion->id/$criterio->id")||auth()->user()->can('admin'))
@if(!$criterio->subcriterios->isEmpty())
<div class="card">
    <div class="card-header pb-2">
        <h6 class="fw-normal text-pacifico text-uppercase">Lista Indicadores de {{$criterio->criterio}}</h6>
    </div>
    @foreach($criterio->subcriterios as $subcriterio)
    <div class="card-header pb-2">
        <h6 class="fw-normal text-pacifico text-uppercase">{{$subcriterio->subcriterio}}</h6>
    </div>
    <div class="card-body mt-3">
        <div class="table-responsive">
            <table id="indicador" class="table table-hover align-middle text-uppercase pt-2 pb-2">
                <thead class="table-pacifico">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">INDICADORES</th>
                        <th scope="col">RESPONSABLE</th>
                        <th scope="col">ASIGNAR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcriterio->indicadors as $indicador)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $indicador->indicador }}
                        </td>
                        <td>
                            <label>{{$permisos[$indicador->id]}}</label>

                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#users" data-indicador-id="{{$indicador->id}}">ASIGNAR</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>
@else

<div class="card">
    <div class="card-header pb-2">
        <h6 class="fw-normal text-pacifico text-uppercase">Lista Indicadores de {{$criterio->criterio}}</h6>
    </div>
    <div class="card-body mt-3">
        <div class="table-responsive">
            <table id="indicador" class="table table-hover align-middle text-uppercase pt-2 pb-2">
                <thead class="table-pacifico">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">INDICADORES</th>
                        <th scope="col">RESPONSABLE</th>
                        <th scope="col">ASIGNAR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($criterio->indicadors as $indicador)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $indicador->indicador }}
                        </td>
                        <td>
                            <label>{{$permisos[$indicador->id]}}</label>

                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#users" data-indicador-id="{{$indicador->id}}">ASIGNAR</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endcan
@endforeach
@include('acreditacion_caces.indicador-assignments.modal')
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#users').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var indicadorId = button.data('indicador-id');

        var modal = $(this);
        modal.find('#indicadorId').val(indicadorId);
    });
</script>
<script>
    document.getElementById('indicador-assignments').classList.remove('collapsed');
    Livewire.on('refresh', () => {
        location.reload();
    });
</script>
@endsection