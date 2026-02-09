@extends('layouts.modern')

@section('title', 'Asignar Indicadores')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Sedes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('evaluaciones.show', $evaluacion->uni_id) }}">{{ $evaluacion->universidad->sede }}</a></li>
    <li class="breadcrumb-item active">Asignar Indicadores</li>
@endsection

@section('content')
<div class="page-header animate-fade-in">
    <div>
        <h1>Asignación de Indicadores</h1>
        <p class="text-muted mb-0">Asignar responsables a cada indicador de evaluación</p>
    </div>
</div>

@foreach ($criterios as $criterio)
    @if(auth()->user()->can("$evaluacion->id/$criterio->id") || auth()->user()->can('admin'))
        @if(!$criterio->subcriterios->isEmpty())
            <div class="card-modern mb-4 animate-fade-in">
                <div class="card-header" style="background: var(--espe-green); color: white;">
                    <h5 class="mb-0"><i class="bi bi-list-check me-2"></i>{{ $criterio->criterio }}</h5>
                </div>
                @foreach($criterio->subcriterios as $subcriterio)
                    <div class="card-header bg-light">
                        <h6 class="mb-0 text-muted"><i class="bi bi-diagram-3 me-2"></i>{{ $subcriterio->subcriterio }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th style="width: 60px;">No</th>
                                        <th>Indicador</th>
                                        <th>Responsable</th>
                                        <th style="width: 120px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subcriterio->indicadors as $indicador)
                                    <tr>
                                        <td><span class="badge-modern badge-secondary">{{ $loop->iteration }}</span></td>
                                        <td><span class="fw-medium">{{ $indicador->indicador }}</span></td>
                                        <td>
                                            @if(isset($permisos[$indicador->id]) && $permisos[$indicador->id])
                                                <span class="badge-modern badge-success">
                                                    <i class="bi bi-person-check me-1"></i>{{ $permisos[$indicador->id] }}
                                                </span>
                                            @else
                                                <span class="badge-modern badge-warning">Sin asignar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn-modern btn-primary-modern btn-sm" 
                                                    data-bs-toggle="modal" data-bs-target="#users" 
                                                    data-indicador-id="{{ $indicador->id }}">
                                                <i class="bi bi-person-plus"></i>
                                            </button>
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
            <div class="card-modern mb-4 animate-fade-in">
                <div class="card-header" style="background: var(--espe-green); color: white;">
                    <h5 class="mb-0"><i class="bi bi-list-check me-2"></i>{{ $criterio->criterio }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th>Indicador</th>
                                    <th>Responsable</th>
                                    <th style="width: 120px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($criterio->indicadors as $indicador)
                                <tr>
                                    <td><span class="badge-modern badge-secondary">{{ $loop->iteration }}</span></td>
                                    <td><span class="fw-medium">{{ $indicador->indicador }}</span></td>
                                    <td>
                                        @if(isset($permisos[$indicador->id]) && $permisos[$indicador->id])
                                            <span class="badge-modern badge-success">
                                                <i class="bi bi-person-check me-1"></i>{{ $permisos[$indicador->id] }}
                                            </span>
                                        @else
                                            <span class="badge-modern badge-warning">Sin asignar</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn-modern btn-primary-modern btn-sm" 
                                                data-bs-toggle="modal" data-bs-target="#users" 
                                                data-indicador-id="{{ $indicador->id }}">
                                            <i class="bi bi-person-plus"></i>
                                        </button>
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

@push('scripts')
<script>
    $('#users').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var indicadorId = button.data('indicador-id');
        var modal = $(this);
        modal.find('#indicadorId').val(indicadorId);
    });
    
    Livewire.on('refresh', () => {
        location.reload();
    });
</script>
@endpush