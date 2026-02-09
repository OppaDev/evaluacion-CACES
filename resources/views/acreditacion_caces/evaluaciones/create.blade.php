@extends('layouts.modern')

@section('title', 'Nueva Evaluación')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Sedes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('evaluaciones.show', $universidad->id) }}">{{ $universidad->sede }}</a></li>
    <li class="breadcrumb-item active">Nueva Evaluación</li>
@endsection

@section('content')
<div class="page-header animate-fade-in">
    <div>
        <h1>Crear Nueva Evaluación</h1>
        <p class="text-muted mb-0">{{ $universidad->universidad }}</p>
    </div>
</div>

<div class="row justify-content-center animate-fade-in">
    <div class="col-lg-8">
        <div class="card-modern">
            <div class="card-header">
                <h5><i class="bi bi-plus-circle me-2"></i>Datos de la Evaluación</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('evaluaciones.store', $universidad->id) }}" enctype="multipart/form-data">
                    @csrf
                    @include('acreditacion_caces.evaluaciones.form')
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <button type="submit" class="btn-modern btn-primary-modern">
                            <i class="bi bi-check-circle me-1"></i> Guardar
                        </button>
                        <a href="{{ route('evaluaciones.show', $universidad->id) }}" class="btn-modern btn-secondary-modern">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection