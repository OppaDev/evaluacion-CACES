@extends('layouts.modern')

@section('title', 'Editar Evaluación')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Sedes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('evaluaciones.show', $universidad->id) }}">{{ $universidad->sede }}</a></li>
    <li class="breadcrumb-item active">Editar Evaluación</li>
@endsection

@section('content')
<div class="page-header animate-fade-in">
    <div>
        <h1>Editar Evaluación</h1>
        <p class="text-muted mb-0">{{ $universidad->universidad }}</p>
    </div>
</div>

<div class="row justify-content-center animate-fade-in">
    <div class="col-lg-8">
        <div class="card-modern">
            <div class="card-header">
                <h5><i class="bi bi-pencil me-2"></i>Modificar Datos</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('evaluaciones.update', $evaluacion->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('acreditacion_caces.evaluaciones.form')
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <button type="submit" class="btn-modern btn-primary-modern">
                            <i class="bi bi-check-circle me-1"></i> Actualizar
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