@extends('layouts.modern')

@section('title', 'Porcentajes de Indicadores')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Sedes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('porcentaje.criterios.index') }}">Porcentajes</a></li>
    <li class="breadcrumb-item active">Indicadores</li>
@endsection

@section('content')
<div class="page-header animate-fade-in">
    <div>
        <h1>Porcentajes de Indicadores</h1>
        <p class="text-muted mb-0">Configurar el peso de cada indicador</p>
    </div>
</div>

<form action="{{ route('porcentaje.indicadores.store') }}" method="post" enctype="multipart/form-data">
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
                <i class="bi bi-clipboard-data me-2"></i>{{ $criterio->criterio }}
                <span class="badge bg-white text-success ms-2">{{ $criterio->porcentaje }}%</span>
            </h5>
        </div>
        <div class="card-body">
            @if ($criterio->subcriterios->isEmpty())
                @if ($criterio->indicadors->isEmpty())
                    <div class="alert alert-warning mb-0">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        No hay indicadores registrados para este criterio.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th>Indicador</th>
                                    <th style="width: 150px;">Porcentaje (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalIndicadores = count($criterio->indicadors); @endphp
                                @foreach ($criterio->indicadors as $indicador)
                                <tr>
                                    <td><span class="badge-modern badge-secondary">{{ $loop->iteration }}</span></td>
                                    <td><span class="fw-medium">{{ $indicador->indicador }}</span></td>
                                    <td>
                                        <input class="form-control {{ empty($indicador->porcentaje) ? 'border-danger' : '' }}"
                                               type="number" min="0" max="100" step="0.001"
                                               name="{{ $indicador->id }}[porcentaje]"
                                               value="{{ isset($indicador->porcentaje) ? $indicador->porcentaje : round($criterio->porcentaje / $totalIndicadores, 3) }}">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @else
                @foreach ($criterio->subcriterios as $subcriterio)
                    <div class="mb-4">
                        <h6 class="text-muted mb-3">
                            <i class="bi bi-diagram-3 me-1"></i>{{ $subcriterio->subcriterio }}
                            <span class="badge-modern badge-info ms-2">{{ $subcriterio->porcentaje }}%</span>
                        </h6>
                        <div class="table-responsive">
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th style="width: 60px;">No</th>
                                        <th>Indicador</th>
                                        <th style="width: 150px;">Porcentaje (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $totalIndicadores = count($subcriterio->indicadors); @endphp
                                    @foreach ($subcriterio->indicadors as $indicador)
                                    <tr>
                                        <td><span class="badge-modern badge-secondary">{{ $loop->iteration }}</span></td>
                                        <td><span class="fw-medium">{{ $indicador->indicador }}</span></td>
                                        <td>
                                            <input class="form-control {{ empty($indicador->porcentaje) ? 'border-danger' : '' }}"
                                                   type="number" min="0" max="100" step="0.001"
                                                   name="{{ $indicador->id }}[porcentaje]"
                                                   value="{{ isset($indicador->porcentaje) ? $indicador->porcentaje : round($subcriterio->porcentaje / $totalIndicadores, 3) }}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    @endforeach
</form>
@endsection