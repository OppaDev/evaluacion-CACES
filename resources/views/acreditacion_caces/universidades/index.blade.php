@extends('layouts.modern')

@section('title', 'Sedes')

@section('breadcrumb')
    <li class="breadcrumb-item active">Sedes</li>
@endsection

@section('content')
<div class="page-header animate-fade-in">
    <div>
        <h1>Universidad de las Fuerzas Armadas ESPE</h1>
        <p class="text-muted mb-0">Gestión de Sedes y Campus</p>
    </div>
    @can('admin')
    <div class="page-actions">
        <a href="{{ route('universidades.create') }}" class="btn-modern btn-primary-modern">
            <i class="bi bi-plus-lg"></i>
            Nueva Sede
        </a>
    </div>
    @endcan
</div>

<!-- Stats Cards -->
<div class="stats-grid animate-fade-in">
    <div class="stat-card">
        <div class="stat-icon green">
            <i class="bi bi-building"></i>
        </div>
        <div class="stat-content">
            <div class="stat-label">Total Sedes</div>
            <div class="stat-value">{{ $universidades->count() }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="bi bi-person-check"></i>
        </div>
        <div class="stat-content">
            <div class="stat-label">Con Responsable</div>
            <div class="stat-value">{{ $universidades->whereNotNull('responsable_id')->count() }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange">
            <i class="bi bi-journal-check"></i>
        </div>
        <div class="stat-content">
            <div class="stat-label">Evaluaciones Activas</div>
            <div class="stat-value">{{ $universidades->sum(fn($u) => $u->evaluacions->count()) }}</div>
        </div>
    </div>
</div>

<!-- Main Table Card -->
<div class="card-modern animate-fade-in">
    <div class="card-header">
        <h5><i class="bi bi-grid-3x3-gap me-2"></i>Listado de Sedes</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="universidad" class="table-modern">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Sede</th>
                        <th>Campus</th>
                        <th>Ciudad</th>
                        <th>Responsable</th>
                        <th style="width: 100px;">Informe</th>
                        <th style="width: 140px; text-align: right;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $contador = 0; @endphp
                    @foreach ($universidades as $universidad)
                        @php
                        $hasPermission = false;
                        $evaluaciones = $universidad->evaluacions;
                        
                        if(auth()->user()->esResponsableDeSede($universidad->id)){
                            $contador += 1;
                            $hasPermission = true;
                        }
                        if(auth()->user()->hasRole('Viewer')){
                            $contador += 1;
                            $hasPermission = true;
                        }
                        foreach (auth()->user()->getAllPermissions() as $permission) {
                            foreach ($evaluaciones as $evaluacion) {
                                if (Str::startsWith($permission->name, "$evaluacion->id/") || auth()->user()->can('admin') || Str::startsWith($permission->name, "$evaluacion->id-")) {
                                    $hasPermission = true;
                                    $contador += 1;
                                    break;
                                }
                            }
                            if($evaluaciones->isEmpty() && auth()->user()->can('admin')){
                                $contador += 1;
                                $hasPermission = true;
                            }
                            if ($hasPermission) break;
                        }
                        @endphp
                        
                        @if ($hasPermission)
                        <tr>
                            <td>
                                <span class="badge-modern badge-secondary">{{ $contador }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon green" style="width: 40px; height: 40px; font-size: 16px;">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <div>
                                        <strong>{{ $universidad->sede }}</strong>
                                        <div class="text-muted small">{{ $universidad->universidad }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $universidad->campus }}</td>
                            <td>
                                <i class="bi bi-geo-alt text-muted me-1"></i>
                                {{ $universidad->ciudad }}
                            </td>
                            <td>
                                @if($universidad->responsable)
                                    <span class="badge-modern badge-success">
                                        <i class="bi bi-person-check me-1"></i>
                                        {{ $universidad->responsable->name }}
                                    </span>
                                @else
                                    <span class="badge-modern badge-secondary">
                                        <i class="bi bi-person-x me-1"></i>
                                        No asignado
                                    </span>
                                @endif
                                @can('admin')
                                <button type="button" class="btn-modern btn-ghost-modern btn-icon btn-sm ms-1" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#asignarResponsableModal{{ $universidad->id }}"
                                    data-tooltip="Asignar responsable">
                                    <i class="bi bi-person-plus"></i>
                                </button>
                                @endcan
                            </td>
                            <td class="text-center">
                                @if ($universidad->informe != '')
                                    <a href="{{ asset('storage/' . $universidad->informe) }}" 
                                       download="{{ basename($universidad->informe) }}"
                                       class="btn-modern btn-ghost-modern btn-sm text-primary"
                                       data-tooltip="Descargar informe">
                                        <i class="bi bi-file-pdf"></i>
                                        PDF
                                    </a>
                                @else
                                    <span class="text-muted small">
                                        <i class="bi bi-x-circle"></i> N/A
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="cell-actions">
                                    @can('admin')
                                    <a href="{{ route('universidades.edit', $universidad->id) }}" 
                                       class="btn-modern btn-ghost-modern btn-icon btn-sm text-primary"
                                       data-tooltip="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('universidades.destroy', $universidad->id) }}" 
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
                                    <a href="{{ route('evaluaciones.show', $universidad->id) }}" 
                                       class="btn-modern btn-primary-modern btn-sm"
                                       data-tooltip="Ver evaluaciones">
                                        <i class="bi bi-arrow-right"></i>
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
    </div>
</div>

<!-- Modales para asignar responsable -->
@can('admin')
@foreach ($universidades as $universidad)
<div class="modal fade modal-modern" id="asignarResponsableModal{{ $universidad->id }}" tabindex="-1" 
     aria-labelledby="asignarResponsableLabel{{ $universidad->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="asignarResponsableLabel{{ $universidad->id }}">
                    <i class="bi bi-person-plus me-2"></i>
                    Asignar Responsable de Sede
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('universidades.asignar-responsable', $universidad->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="d-flex align-items-center gap-3 mb-4 p-3 bg-light rounded-modern-sm">
                        <div class="stat-icon green" style="width: 48px; height: 48px;">
                            <i class="bi bi-building"></i>
                        </div>
                        <div>
                            <strong>{{ $universidad->sede }}</strong>
                            <div class="text-muted small">{{ $universidad->campus }} - {{ $universidad->ciudad }}</div>
                        </div>
                    </div>
                    
                    <div class="form-group-modern">
                        <label for="responsable_id{{ $universidad->id }}">
                            Seleccionar Responsable
                        </label>
                        <select class="form-select" name="responsable_id" id="responsable_id{{ $universidad->id }}">
                            <option value="">-- Sin responsable --</option>
                            @foreach($users as $user)
                                @if(!$user->hasRole('Admin') && !$user->hasRole('SedeR'))
                                <option value="{{ $user->id }}" {{ $universidad->responsable_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                                @endif
                            @endforeach
                        </select>
                        <div class="form-hint">
                            Solo se muestran usuarios que no son administradores ni responsables de otra sede.
                        </div>
                    </div>
                    
                    <div class="alert-modern alert-info">
                        <i class="bi bi-info-circle-fill"></i>
                        <div>
                            El usuario seleccionado recibirá el rol de <strong>Responsable de Sede</strong> y 
                            podrá asignar criterios e indicadores únicamente a usuarios de esta sede.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modern btn-secondary-modern" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn-modern btn-primary-modern">
                        <i class="bi bi-check-lg me-1"></i>
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endcan
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#universidad').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },
            columnDefs: [
                { orderable: false, targets: -1 }
            ]
        });
    });
</script>
@endpush