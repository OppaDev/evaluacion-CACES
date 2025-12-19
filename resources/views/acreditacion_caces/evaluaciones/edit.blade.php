@extends('layouts.caces')
@section('sidebar')
@include('layouts.sidebar_evaluacion')
@endsection
@section('content')
    <div class="pagetitle">
        <h3>EVALUACIONES</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('evaluaciones.show',$universidad->id) }}">Evaluaciones</a></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-center">
        <div class="card" style="width: 90%">
            <div class="card-header pt-2 pb-1 mt-3">
                <h6 class="fw-normal text-actualizar text-uppercase">Editar registro</h6>
            </div>
            <div class="container-fluid mt-3">
                <form method="POST" action="{{ route('evaluaciones.update', $evaluacion->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('acreditacion_caces.evaluaciones.form')
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-actualizar"><i class="bi bi-check-circle"></i>
                            ACTUALIZAR</button>
                        <a type="button" class="btn btn-outline-actualizar"
                            href="{{ route('evaluaciones.show', $universidad->id) }}">CANCELAR</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.getElementById('evaluaciones').classList.remove('collapsed');
    </script>
@endsection
