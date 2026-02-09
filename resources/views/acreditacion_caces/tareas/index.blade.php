@extends('layouts.modern')

@section('title', 'Tareas')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Sedes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('evaluaciones.show', $evaluacion->uni_id) }}">{{ $evaluacion->universidad->sede }}</a></li>
    <li class="breadcrumb-item active">Tareas</li>
@endsection

@section('content')
<div class="page-header animate-fade-in">
    <div>
        <h1>Gestión de Tareas</h1>
        <p class="text-muted mb-0">{{ $evaluacion->universidad->universidad }}</p>
    </div>
</div>

<div class="card-modern animate-fade-in">
    <div class="card-header">
        <h5><i class="bi bi-list-task me-2"></i>Lista de Criterios</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="table-modern">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Criterio</th>
                        <th>Responsable</th>
                        <th style="width: 120px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($criterios as $criterio)
                    <tr>
                        <td>
                            <span class="badge-modern badge-secondary">{{ $loop->iteration }}</span>
                        </td>
                        <td>
                            <span class="fw-medium">{{ $criterio->criterio }}</span>
                        </td>
                        <td>
                            @if($criterio->responsable)
                                <span class="badge-modern badge-success">
                                    <i class="bi bi-person-check me-1"></i>{{ $criterio->responsable }}
                                </span>
                            @else
                                <span class="badge-modern badge-warning">Sin asignar</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn-modern btn-primary-modern btn-sm" 
                                    data-bs-toggle="modal" data-bs-target="#users" 
                                    data-criterio-id="{{ $criterio->id }}">
                                <i class="bi bi-person-plus"></i> Asignar
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('acreditacion_caces.criteria-assignments.modal')
@endsection

@push('scripts')
<script>
    $('#users').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var criterioId = button.data('criterio-id');
        var modal = $(this);
        modal.find('#criterioId').val(criterioId);
    });
    
    Livewire.on('refresh', () => {
        location.reload();
    });
</script>
@endpush