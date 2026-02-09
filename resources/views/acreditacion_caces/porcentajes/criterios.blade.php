@extends('layouts.modern')

@section('title', 'Porcentajes de Criterios')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Sedes</a></li>
    <li class="breadcrumb-item active">Porcentajes de Criterios</li>
@endsection

@section('content')
<div class="page-header animate-fade-in">
    <div>
        <h1>Porcentajes de Criterios</h1>
        <p class="text-muted mb-0">Configurar el peso de cada criterio en la evaluación</p>
    </div>
</div>

<div class="card-modern animate-fade-in">
    <div class="card-header">
        <h5><i class="bi bi-percent me-2"></i>Configuración de Porcentajes</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('porcentaje.criterios.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="d-flex justify-content-between align-items-center mb-4">
                <button type="submit" class="btn-modern btn-primary-modern">
                    <i class="bi bi-check-circle me-1"></i> Guardar Cambios
                </button>
            </div>
            
            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Criterio</th>
                            <th style="width: 150px;">Porcentaje (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalCriterios = count($criterios);
                        @endphp
                        @foreach ($criterios as $criterio)
                        <tr>
                            <td><span class="badge-modern badge-secondary">{{ $loop->iteration }}</span></td>
                            <td><span class="fw-medium">{{ $criterio->criterio }}</span></td>
                            <td>
                                <input class="form-control {{ empty($criterio->porcentaje) ? 'border-danger' : '' }}" 
                                       type="number" min="0" max="100" step="0.001"
                                       name="{{ $criterio->id }}[porcentaje]"
                                       value="{{ isset($criterio->porcentaje) ? $criterio->porcentaje : round(100 / $totalCriterios, 3) }}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
@endsection