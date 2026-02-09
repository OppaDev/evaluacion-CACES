@extends('layouts.modern')

@section('title', 'Oportunidad de Mejora')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Sedes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('evaluaciones.show', $evaluacion->uni_id) }}">{{ $evaluacion->universidad->sede }}</a></li>
    <li class="breadcrumb-item active">Oportunidad de Mejora</li>
@endsection

@section('content')
<div class="page-header animate-fade-in">
    <div>
        <h1>Oportunidad de Mejora</h1>
        <p class="text-muted mb-0">{{ $evaluacion->universidad->universidad }}</p>
    </div>
</div>

<div class="row justify-content-center animate-fade-in">
    <div class="col-lg-8">
        <div class="card-modern">
            <div class="card-header">
                <h5><i class="bi bi-file-earmark-excel me-2"></i>Documentos Disponibles</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center p-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="stat-icon green" style="width: 48px; height: 48px;">
                                <i class="bi bi-file-earmark-spreadsheet"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Oportunidad de Mejora</h6>
                                <p class="text-muted small mb-0">Áreas identificadas para mejora continua</p>
                            </div>
                        </div>
                        <a href="{{ route('personal.academico.excel', $evaluacion->universidad->id) }}" 
                           class="btn-modern btn-primary-modern">
                            <i class="bi bi-download me-1"></i> Descargar Excel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection