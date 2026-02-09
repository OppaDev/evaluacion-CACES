@extends('layouts.modern')

@section('title', 'Resultados - ' . $criterio->criterio)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Sedes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('evaluaciones.show', $evaluacion->uni_id) }}">{{ $evaluacion->universidad->sede }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('indicadores.index', $evaluacion->id) }}">Indicadores</a></li>
    <li class="breadcrumb-item active">{{ Str::limit($criterio->criterio, 30) }}</li>
@endsection

@push('styles')
<style>
    .pulse-animation {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
</style>
@endpush

@section('content')
<div class="page-header animate-fade-in">
    <div>
        <h1>Resultados del Criterio</h1>
        <p class="text-muted mb-0">{{ $evaluacion->universidad->universidad }}</p>
    </div>
    <div class="page-actions">
        <a href="{{ route('criterio', [$evaluacion->id, $criterio->id]) }}" class="btn-modern btn-secondary-modern">
            <i class="bi bi-pencil"></i>
            Editar Criterio
        </a>
    </div>
</div>

<!-- Main Score Card -->
<div class="row mb-4 animate-fade-in">
    <div class="col-lg-6">
        <div class="card-modern h-100">
            <div class="card-header" style="background: var(--espe-green); color: white;">
                <h5 class="mb-0"><i class="bi bi-clipboard-data me-2"></i>{{ $criterio->criterio }}</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        @if ($total_criterio >= 80)
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                        @else
                            <i class="bi bi-exclamation-circle-fill text-danger pulse-animation" style="font-size: 3rem;"></i>
                        @endif
                    </div>
                    <div class="text-end">
                        <div style="font-size: 3rem; font-weight: 700; color: {{ $total_criterio >= 80 ? 'var(--espe-green)' : 'var(--espe-red)' }};">
                            {{ $total_criterio }}%
                        </div>
                        <div class="text-muted">Puntaje obtenido</div>
                    </div>
                </div>
                
                <div class="progress-modern mb-3" style="height: 12px;">
                    <div class="progress-bar {{ $total_criterio >= 80 ? 'bg-success' : 'bg-danger' }}" 
                         style="width: {{ $total_criterio }}%;">
                    </div>
                </div>
                
                <div class="d-flex justify-content-between text-muted small">
                    <span>Peso del criterio: <strong>{{ $criterio->porcentaje }}%</strong></span>
                    <span>Meta: <strong>80%</strong></span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="card-modern h-100">
            <div class="card-header">
                <h5><i class="bi bi-info-circle me-2"></i>Resumen</h5>
            </div>
            <div class="card-body">
                @php
                if($criterio->indicadorsSub->isEmpty()){
                    $indicadors = $criterio->indicadors;
                } else {
                    $indicadors = $criterio->indicadorsSub;
                }
                $totalIndicadores = $indicadors->count();
                @endphp
                
                <div class="row text-center">
                    <div class="col-4">
                        <div class="stat-icon green mx-auto mb-2" style="width: 48px; height: 48px;">
                            <i class="bi bi-list-check"></i>
                        </div>
                        <div class="fs-4 fw-bold">{{ $totalIndicadores }}</div>
                        <div class="text-muted small">Indicadores</div>
                    </div>
                    <div class="col-4">
                        <div class="stat-icon blue mx-auto mb-2" style="width: 48px; height: 48px;">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        <div class="fs-4 fw-bold text-success">{{ $total_criterio >= 80 ? 'Sí' : 'No' }}</div>
                        <div class="text-muted small">Cumple meta</div>
                    </div>
                    <div class="col-4">
                        <div class="stat-icon gold mx-auto mb-2" style="width: 48px; height: 48px;">
                            <i class="bi bi-percent"></i>
                        </div>
                        <div class="fs-4 fw-bold">{{ $criterio->porcentaje }}%</div>
                        <div class="text-muted small">Peso total</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Indicators Grid -->
<div class="page-header">
    <h1>Indicadores del Criterio</h1>
</div>

<div class="row g-4 animate-fade-in">
    @foreach ($indicadors as $indicador)
        @if (auth()->user()->hasRole('CriteriaR') && auth()->user()->can("$evaluacion->id/$criterio->id") || auth()->user()->can('admin') || auth()->user()->can("$evaluacion->id-$indicador->id") || auth()->user()->hasRole('Viewer') || (auth()->user()->hasRole('SedeR') && auth()->user()->esResponsableDeSede($evaluacion->uni_id)))
        <div class="col-md-6">
            <div class="card-modern h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3">
                        <div class="stat-icon green flex-shrink-0" style="width: 40px; height: 40px; font-size: 16px;">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-2">
                                <a href="{{ route('criterio', [$evaluacion->id, $criterio->id]) }}#indicador_{{ $indicador->id }}" 
                                   class="text-decoration-none">
                                    {{ $indicador->indicador }}
                                </a>
                            </h6>
                            @if(isset($resultados_criterio[$indicador->id]))
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress-modern flex-grow-1" style="height: 6px;">
                                        <div class="progress-bar bg-success" style="width: {{ $resultados_criterio[$indicador->id] ?? 0 }}%;"></div>
                                    </div>
                                    <span class="badge-modern badge-success">{{ $resultados_criterio[$indicador->id] ?? 0 }}%</span>
                                </div>
                            @else
                                <span class="badge-modern badge-secondary">Sin evaluar</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endforeach
</div>
@endsection