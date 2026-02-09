@extends('layouts.modern')

@section('title', 'Panel de Indicadores')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Sedes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('evaluaciones.show', $evaluacion->uni_id) }}">{{ $evaluacion->universidad->sede }}</a></li>
    <li class="breadcrumb-item active">Indicadores</li>
@endsection

@push('styles')
<style>
    .criteria-card {
        transition: all 0.3s ease;
        border: none;
        overflow: hidden;
    }
    .criteria-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }
    .criteria-header {
        padding: 1.25rem;
        color: white;
        position: relative;
        overflow: hidden;
    }
    .criteria-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        transform: rotate(30deg);
    }
    .criteria-header h6 {
        font-size: 0.95rem;
        font-weight: 600;
        margin: 0;
        position: relative;
        z-index: 1;
    }
    .criteria-body {
        padding: 1.5rem;
    }
    .score-display {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1;
    }
    .score-label {
        font-size: 0.75rem;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .hero-card {
        background: linear-gradient(135deg, var(--espe-green) 0%, var(--espe-green-dark) 100%);
        color: white;
        border-radius: var(--border-radius);
        padding: 2rem;
        margin-bottom: 1.5rem;
    }
    .hero-card .score-main {
        font-size: 4rem;
        font-weight: 700;
        line-height: 1;
    }
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
<!-- Hero Section with Main Score -->
<div class="hero-card animate-fade-in">
    <div class="row align-items-center">
        <div class="col-md-8">
            <div class="d-flex align-items-center gap-3 mb-3">
                @if($evaluacion->universidad->foto)
                    <img src="{{ asset('storage/' . $evaluacion->universidad->foto) }}" 
                         alt="Logo" style="height: 60px; width: auto; border-radius: 8px; background: white; padding: 5px;">
                @else
                    <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-building fs-2"></i>
                    </div>
                @endif
                <div>
                    <h1 class="mb-0" style="font-size: 1.5rem;">{{ $evaluacion->universidad->universidad }}</h1>
                    <p class="mb-0 opacity-75">{{ $evaluacion->universidad->sede }} - {{ $evaluacion->universidad->campus }}</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-6 col-lg-3 mb-2">
                    <div class="opacity-75 small">Ciudad</div>
                    <div class="fw-medium">{{ $evaluacion->universidad->ciudad }}</div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-2">
                    <div class="opacity-75 small">Facultad</div>
                    <div class="fw-medium">{{ $evaluacion->facultad ?: 'N/A' }}</div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-2">
                    <div class="opacity-75 small">Departamento</div>
                    <div class="fw-medium">{{ $evaluacion->departamento }}</div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-2">
                    <div class="opacity-75 small">Evaluador</div>
                    <div class="fw-medium">{{ $evaluacion->user->name }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center text-md-end mt-4 mt-md-0">
            <div class="score-label text-white opacity-75 mb-1">Puntaje Total de Autoevaluación</div>
            <div class="score-main {{ round($total_evaluacion, 2) < 80 ? 'pulse-animation' : '' }}">
                {{ round($total_evaluacion, 2) }}%
            </div>
            <div class="mt-2">
                @if(round($total_evaluacion, 2) >= 80)
                    <span class="badge bg-light text-success px-3 py-2">
                        <i class="bi bi-check-circle me-1"></i> Aprobado
                    </span>
                @else
                    <span class="badge bg-danger px-3 py-2">
                        <i class="bi bi-exclamation-triangle me-1"></i> Por mejorar
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Criteria Cards -->
<div class="page-header">
    <h1>Criterios de Evaluación</h1>
</div>

<div class="row g-4 animate-fade-in">
    @php
    $colors = ['#00713d', '#0077be', '#9b59b6', '#e67e22', '#e74c3c', '#1abc9c'];
    $icons = ['building', 'book', 'people', 'lightbulb', 'link-45deg', 'trophy'];
    @endphp
    
    @foreach ($criterios as $criterio)
        @php
        $permissions = auth()->user()->getAllPermissions();
        $hasPermission = false;
        
        if(auth()->user()->hasRole('Viewer') || (auth()->user()->hasRole('SedeR') && auth()->user()->esResponsableDeSede($evaluacion->uni_id))){
            $hasPermission = true;
        }
        
        foreach ($permissions as $permission) {
            foreach($criterio->indicadors as $indicador){
                if ($permission->name == "$evaluacion->id-$indicador->id") {
                    $hasPermission = true;
                    break;
                }
            }
            foreach($criterio->indicadorsSub as $indicador){
                if ($permission->name == "$evaluacion->id-$indicador->id") {
                    $hasPermission = true;
                    break;
                }
            }
            if($hasPermission) break;
        }
        
        $score = $total_criterios[$criterio->id];
        $isApproved = $score >= 70;
        @endphp
        
        @if (auth()->user()->can("admin") || auth()->user()->can("$evaluacion->id/$criterio->id") || $hasPermission)
        <div class="col-md-6 col-lg-4">
            <div class="card-modern criteria-card h-100">
                <a href="{{ route('resultado', [$evaluacion->id, $criterio->id]) }}" class="text-decoration-none">
                    <div class="criteria-header" style="background: {{ $colors[$criterio->id - 1] }};">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-{{ $icons[$criterio->id - 1] }} fs-5"></i>
                            <h6>{{ $criterio->criterio }}</h6>
                        </div>
                    </div>
                </a>
                <div class="criteria-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            @if($isApproved)
                                <i class="bi bi-check-circle-fill text-success" style="font-size: 2rem;"></i>
                            @else
                                <i class="bi bi-exclamation-circle-fill text-danger pulse-animation" style="font-size: 2rem;"></i>
                            @endif
                        </div>
                        <div class="text-end">
                            <div class="score-display" style="color: {{ $isApproved ? 'var(--espe-green)' : 'var(--espe-red)' }}">
                                {{ $score }}%
                            </div>
                            <div class="score-label">Puntaje obtenido</div>
                        </div>
                    </div>
                    
                    <div class="progress-modern mb-2" style="height: 10px;">
                        <div class="progress-bar {{ $isApproved ? 'bg-success' : 'bg-danger' }}" 
                             style="width: {{ $score }}%;">
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            Peso del criterio: <strong>{{ $criterio->porcentaje }}%</strong>
                        </small>
                        <a href="{{ route('resultado', [$evaluacion->id, $criterio->id]) }}" 
                           class="btn-modern btn-sm btn-ghost-modern text-primary">
                            Ver detalles <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endforeach
</div>
@endsection