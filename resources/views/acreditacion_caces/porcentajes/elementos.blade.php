@extends('layouts.modern')

@section('title', 'Porcentajes de Elementos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Sedes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('porcentaje.criterios.index') }}">Porcentajes</a></li>
    <li class="breadcrumb-item active">Elementos Fundamentales</li>
@endsection

@section('content')
<div class="page-header animate-fade-in">
    <div>
        <h1>Porcentajes de Elementos Fundamentales</h1>
        <p class="text-muted mb-0">Configurar el peso de cada elemento fundamental</p>
    </div>
</div>

<form action="{{ route('porcentaje.elementos.store') }}" method="post" enctype="multipart/form-data">
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
                    @foreach ($criterio->indicadors as $indicador)
                        @if (!$indicador->elemento_fundamentals->isEmpty())
                            <div class="mb-4">
                                <h6 class="text-muted mb-3">
                                    <i class="bi bi-graph-up me-1"></i>{{ $indicador->indicador }}
                                    <span class="badge-modern badge-info ms-2">{{ $indicador->porcentaje }}%</span>
                                </h6>
                                <div class="table-responsive">
                                    <table class="table-modern">
                                        <thead>
                                            <tr>
                                                <th style="width: 60px;">No</th>
                                                <th>Elemento Fundamental</th>
                                                <th style="width: 150px;">Porcentaje (%)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $totalElementos = count($indicador->elemento_fundamentals); @endphp
                                            @foreach ($indicador->elemento_fundamentals as $elementoFundamental)
                                            <tr>
                                                <td><span class="badge-modern badge-secondary">{{ $loop->iteration }}</span></td>
                                                <td><span class="fw-medium">{{ $elementoFundamental->elemento }}</span></td>
                                                <td>
                                                    <input class="form-control {{ empty($elementoFundamental->porcentaje) ? 'border-danger' : '' }}"
                                                           type="number" min="0" max="100" step="0.001"
                                                           name="{{ $elementoFundamental->id }}[porcentaje]"
                                                           value="{{ isset($elementoFundamental->porcentaje) ? $elementoFundamental->porcentaje : round($indicador->porcentaje / $totalElementos, 3) }}">
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            @else
                @foreach ($criterio->subcriterios as $subcriterio)
                    <div class="mb-4">
                        <h6 class="text-muted mb-3">
                            <i class="bi bi-diagram-3 me-1"></i>{{ $subcriterio->subcriterio }}
                            <span class="badge-modern badge-info ms-2">{{ $subcriterio->porcentaje }}%</span>
                        </h6>
                        @foreach ($subcriterio->indicadors as $indicador)
                            @if (!$indicador->elemento_fundamentals->isEmpty())
                                <div class="mb-3 ms-4">
                                    <h6 class="small text-muted mb-2">
                                        <i class="bi bi-graph-up me-1"></i>{{ $indicador->indicador }}
                                        <span class="badge-modern badge-secondary ms-1">{{ $indicador->porcentaje }}%</span>
                                    </h6>
                                    <div class="table-responsive">
                                        <table class="table-modern">
                                            <thead>
                                                <tr>
                                                    <th style="width: 60px;">No</th>
                                                    <th>Elemento Fundamental</th>
                                                    <th style="width: 150px;">Porcentaje (%)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $totalElementos = $indicador->elemento_fundamentals->count(); @endphp
                                                @foreach ($indicador->elemento_fundamentals as $elementoFundamental)
                                                <tr>
                                                    <td><span class="badge-modern badge-secondary">{{ $loop->iteration }}</span></td>
                                                    <td><span class="fw-medium">{{ $elementoFundamental->elemento }}</span></td>
                                                    <td>
                                                        <input class="form-control {{ empty($elementoFundamental->porcentaje) ? 'border-danger' : '' }}"
                                                               type="number" min="0" max="100" step="0.001"
                                                               name="{{ $elementoFundamental->id }}[porcentaje]"
                                                               value="{{ isset($elementoFundamental->porcentaje) ? $elementoFundamental->porcentaje : round($indicador->porcentaje / $totalElementos, 3) }}">
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    @endforeach
</form>
@endsection