@extends('layouts.modern')

@section('title', 'Evaluaciones - ' . $universidad->sede)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Sedes</a></li>
    <li class="breadcrumb-item active">{{ $universidad->sede }}</li>
@endsection

@section('content')
<div class="page-header animate-fade-in">
    <div>
        <h1>Evaluaciones</h1>
        <p class="text-muted mb-0">
            <i class="bi bi-building me-1"></i>
            {{ $universidad->sede }} - {{ $universidad->campus }}
        </p>
    </div>
    @can('admin')
    <div class="page-actions">
        <button type="button" class="btn-modern btn-primary-modern" data-bs-toggle="modal" data-bs-target="#crear">
            <i class="bi bi-plus-lg"></i>
            Nueva Evaluación
        </button>
    </div>
    @endcan
</div>

<!-- Stats Cards -->
<div class="stats-grid animate-fade-in">
    <div class="stat-card">
        <div class="stat-icon green">
            <i class="bi bi-journal-check"></i>
        </div>
        <div class="stat-content">
            <div class="stat-label">Total Evaluaciones</div>
            <div class="stat-value">{{ $evaluaciones->count() }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="bi bi-calendar-check"></i>
        </div>
        <div class="stat-content">
            <div class="stat-label">Última Evaluación</div>
            <div class="stat-value">
                @if($evaluaciones->count() > 0)
                    {{ \Carbon\Carbon::parse($evaluaciones->last()->fecha_final)->format('Y') }}
                @else
                    N/A
                @endif
            </div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold">
            <i class="bi bi-person-badge"></i>
        </div>
        <div class="stat-content">
            <div class="stat-label">Responsable de Sede</div>
            <div class="stat-value" style="font-size: 1rem;">
                {{ $universidad->responsable->name ?? 'No asignado' }}
            </div>
        </div>
    </div>
</div>

<!-- Quick Navigation -->
<div class="d-flex gap-2 mb-4 animate-fade-in">
    <a href="{{ route('historico.grafico.index', $universidad->id) }}" class="btn-modern btn-secondary-modern">
        <i class="bi bi-bar-chart-line"></i>
        Ver Gráfico Histórico
    </a>
    <a href="{{ route('historico.index', $universidad->id) }}" class="btn-modern btn-secondary-modern">
        <i class="bi bi-clock-history"></i>
        Ver Histórico
    </a>
</div>

<!-- Main Table Card -->
<div class="card-modern animate-fade-in">
    <div class="card-header">
        <h5><i class="bi bi-table me-2"></i>Listado de Evaluaciones</h5>
    </div>
    <div class="card-body p-0">
        @if($evaluaciones->count() > 0)
        <div class="table-responsive">
            <table id="evaluacionesTable" class="table-modern">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Fecha Creación</th>
                        <th>Período</th>
                        <th>Administrador</th>
                        <th>Departamento</th>
                        <th style="width: 160px; text-align: right;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $contador = 0; @endphp
                    @foreach ($evaluaciones as $evaluacion)
                        @php
                        $hasPermission = false;
                        
                        if(auth()->user()->esResponsableDeSede($evaluacion->uni_id)){
                            $contador += 1;
                            $hasPermission = true;
                        }
                        if(auth()->user()->hasRole('Viewer')){
                            $contador += 1;
                            $hasPermission = true;
                        }
                        foreach (auth()->user()->getAllPermissions() as $permission) {
                            if (Str::startsWith($permission->name, "$evaluacion->id/") || auth()->user()->can('admin') || Str::startsWith($permission->name, "$evaluacion->id-")) {
                                $hasPermission = true;
                                $contador += 1;
                                break;
                            }
                        }
                        @endphp
                        
                        @if ($hasPermission)
                        <tr>
                            <td>
                                <span class="badge-modern badge-secondary">{{ $contador }}</span>
                            </td>
                            <td>
                                <i class="bi bi-calendar3 text-muted me-1"></i>
                                {{ \Carbon\Carbon::parse($evaluacion->fecha_creacion)->format('d/m/Y') }}
                            </td>
                            <td>
                                <span class="badge-modern badge-info">
                                    {{ \Carbon\Carbon::parse($evaluacion->fecha_inicial)->format('M Y') }} 
                                    <i class="bi bi-arrow-right mx-1"></i>
                                    {{ \Carbon\Carbon::parse($evaluacion->fecha_final)->format('M Y') }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="user-avatar" style="width: 32px; height: 32px; font-size: 12px; background: linear-gradient(135deg, var(--espe-green), var(--espe-green-light)); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                                        {{ strtoupper(substr($evaluacion->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <span>{{ $evaluacion->user->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td>{{ $evaluacion->departamento }}</td>
                            <td>
                                <div class="cell-actions">
                                    @can('admin')
                                    <a href="{{ route('evaluaciones.edit', $evaluacion->id) }}" 
                                       class="btn-modern btn-ghost-modern btn-icon btn-sm text-primary"
                                       data-tooltip="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('evaluaciones.destroy', $evaluacion->id) }}" 
                                          method="POST" class="d-inline formulario-eliminar">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn-modern btn-ghost-modern btn-icon btn-sm text-danger"
                                                data-tooltip="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                    <a href="{{ route('indicadores.index', $evaluacion->id) }}" 
                                       class="btn-modern btn-primary-modern btn-sm">
                                        <i class="bi bi-speedometer2"></i>
                                        Ingresar
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="bi bi-journal-x"></i>
            </div>
            <h3>No hay evaluaciones</h3>
            <p>Aún no se han creado evaluaciones para esta sede.</p>
            @can('admin')
            <button type="button" class="btn-modern btn-primary-modern" data-bs-toggle="modal" data-bs-target="#crear">
                <i class="bi bi-plus-lg"></i>
                Crear Primera Evaluación
            </button>
            @endcan
        </div>
        @endif
    </div>
</div>

@include('acreditacion_caces.evaluaciones.modal')
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#evaluacionesTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },
            columnDefs: [
                { orderable: false, targets: -1 }
            ],
            order: [[0, 'desc']]
        });
    });
</script>
@endpush