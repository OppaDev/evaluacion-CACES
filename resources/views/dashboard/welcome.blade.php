@extends('layouts.caces_livewire')

@section('sidebar')
    @include('layouts.sidebar_inicio')
@endsection

@section('content')
<div class="container-fluid">
    <div class="pagetitle">
        <h3>Bienvenido al Sistema de Autoevaluación</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Sedes Disponibles</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        @if($universidades->isEmpty())
            <div class="col-12 text-center mt-5">
                <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading"><i class="bi bi-info-circle"></i> No hay sedes asignadas</h4>
                    <p>Actualmente no tienes sedes asignadas para visualizar. Por favor contacta al administrador.</p>
                </div>
            </div>
        @else
            @foreach($universidades as $universidad)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 hover-card" style="border-radius: 15px; overflow: hidden;">
                        <div class="position-relative" style="height: 220px;">
                            {{-- Imagen --}}
                            @if($universidad->foto)
                            <img src="{{ asset('storage/' . $universidad->foto) }}" 
                                 class="card-img-top w-100 h-100" 
                                 style="object-fit: cover; object-position: center;"
                                 alt="Foto de {{ $universidad->sede }}">
                            @else
                            <div class="d-flex justify-content-center align-items-center w-100 h-100 bg-secondary text-white">
                                <i class="bi bi-building fs-1"></i>
                            </div>
                            @endif

                            {{-- Badge SEDE --}}
                            <div class="position-absolute top-0 start-0 m-3 px-3 py-1 bg-white rounded-pill shadow-sm">
                                <span class="fw-bold text-pacifico" style="font-size: 0.8rem; letter-spacing: 0.5px;">SEDE</span>
                            </div>

                            {{-- Título Overlay --}}
                            <div class="position-absolute bottom-0 start-0 w-100 p-3" 
                                 style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                                <h3 class="text-white fw-bold mb-0 text-shadow">{{ $universidad->sede ?? 'Sede Principal' }}</h3>
                            </div>
                        </div>
                        
                        <div class="card-body pt-3 pb-0">
                            {{-- Ciudad Pill --}}
                            <div class="d-inline-block bg-light rounded-pill px-3 py-1 mb-3 border">
                                <span class="text-muted small">
                                    Ciudad: <span class="fw-normal text-dark">{{ $universidad->ciudad }}</span>
                                </span>
                            </div>

                            <p class="card-text text-secondary mb-3">
                                Accede a las evaluaciones de CACES del campus {{ $universidad->sede }}.
                            </p>
                        </div>

                        <div class="card-footer bg-white border-0 px-3 pb-4 pt-2">
                            <a href="{{ route('evaluaciones.show', $universidad->id) }}" 
                               class="btn btn-pacifico w-100 fw-bold py-2" 
                               style="border-radius: 8px;">
                                Acceder
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<style>
    .hover-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        cursor: pointer;
    }
</style>
@endsection
