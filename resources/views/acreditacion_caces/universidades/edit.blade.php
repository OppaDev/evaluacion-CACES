@extends('layouts.modern')

@section('title', 'Editar Sede')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Sedes</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
<div class="page-header animate-fade-in">
    <div>
        <h1>Editar Sede</h1>
        <p class="text-muted mb-0">{{ $universidad->sede }} - {{ $universidad->campus }}</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card-modern animate-fade-in">
            <div class="card-header">
                <h5><i class="bi bi-pencil me-2"></i>Información de la Sede</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('universidades.update', $universidad->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('acreditacion_caces.universidades.form')
                    <div class="d-flex justify-content-center gap-3 mt-4 pt-3 border-top">
                        <a href="{{ route('universidades.index') }}" class="btn-modern btn-secondary-modern">
                            <i class="bi bi-x-lg me-1"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn-modern btn-primary-modern">
                            <i class="bi bi-check-lg me-1"></i>
                            Actualizar Sede
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
