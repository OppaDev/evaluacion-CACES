@extends('layouts.modern')

@section('title', 'Porcentajes de Subcriterios')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Sedes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('porcentaje.criterios.index') }}">Porcentajes</a></li>
    <li class="breadcrumb-item active">Subcriterios</li>
@endsection

@section('content')
<div class="page-header animate-fade-in">
    <div>
        <h1>Porcentajes de Subcriterios</h1>
        <p class="text-muted mb-0">Configurar el peso de cada subcriterio dentro de su criterio</p>
    </div>
</div>

<form action="{{ route('porcentaje.subcriterios.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="d-flex justify-content-between align-items-center mb-4 animate-fade-in">
        <button type="submit" class="btn-modern btn-primary-modern">
            <i class="bi bi-check-circle me-1"></i> Guardar Cambios
        </button>
    </div>

    @foreach ($criterios as $criterio)
    <div class="card-modern mb-4 animate-fade-in">
        <div class="card-header" style="background: var(--espe-green); color: white;">
            <h5 class="mb-0">
                <i class="bi bi-diagram-3 me-2"></i>{{ $criterio->criterio }}
                <span class="badge bg-white text-success ms-2">{{ $criterio->porcentaje }}%</span>
            </h5>
        </div>
        <div class="card-body">
            @if ($criterio->subcriterios->isEmpty())
                <div class="alert alert-warning mb-0">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    No hay subcriterios registrados para este criterio.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th>Subcriterio</th>
                                <th style="width: 150px;">Porcentaje (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalSubcriterios = count($criterio->subcriterios);
                            @endphp
                            @foreach ($criterio->subcriterios as $subcriterio)
                            <tr>
                                <td><span class="badge-modern badge-secondary">{{ $loop->iteration }}</span></td>
                                <td><span class="fw-medium">{{ $subcriterio->subcriterio }}</span></td>
                                <td>
                                    <input class="form-control {{ empty($subcriterio->porcentaje) ? 'border-danger' : '' }}"
                                           type="number" min="0" max="100" step="0.001"
                                           name="{{ $subcriterio->id }}[porcentaje]"
                                           value="{{ isset($subcriterio->porcentaje) ? $subcriterio->porcentaje : round($criterio->porcentaje / $totalSubcriterios, 3) }}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    @endforeach
</form>
@endsection