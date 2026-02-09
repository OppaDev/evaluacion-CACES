@extends('layouts.modern')

@section('title', 'Informes')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Sedes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('evaluaciones.show', $evaluacion->uni_id) }}">{{ $evaluacion->universidad->sede }}</a></li>
    <li class="breadcrumb-item active">Informes</li>
@endsection

@section('content')
<div class="page-header animate-fade-in">
    <div>
        <h1>Documentos e Informes</h1>
        <p class="text-muted mb-0">{{ $evaluacion->universidad->universidad }}</p>
    </div>
</div>

<div class="row justify-content-center animate-fade-in">
    <div class="col-lg-8">
        <div class="card-modern">
            <div class="card-header">
                <h5><i class="bi bi-file-earmark-text me-2"></i>Informes Disponibles</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center p-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="stat-icon green" style="width: 48px; height: 48px;">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Informe General</h6>
                                <p class="text-muted small mb-0">Resumen completo de todos los criterios evaluados</p>
                            </div>
                        </div>
                        <a href="{{ route('personal.academico.informeGeneral', $evaluacion->id) }}" 
                           class="btn-modern btn-primary-modern">
                            <i class="bi bi-download me-1"></i> Descargar PDF
                        </a>
                    </div>
                    
                    <div class="list-group-item d-flex justify-content-between align-items-center p-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="stat-icon blue" style="width: 48px; height: 48px;">
                                <i class="bi bi-file-earmark-richtext"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Informe Específico</h6>
                                <p class="text-muted small mb-0">Detalle por indicador con evidencias y observaciones</p>
                            </div>
                        </div>
                        <a href="{{ route('personal.academico.informeEspecifico', $evaluacion->id) }}" 
                           class="btn-modern btn-primary-modern">
                            <i class="bi bi-download me-1"></i> Descargar PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection