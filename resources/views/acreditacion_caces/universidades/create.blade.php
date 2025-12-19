@extends('layouts.caces')
@section('sidebar')
@include('layouts.sidebar_inicio')
@endsection
@section('content')
    <div class="pagetitle">
        <h3>UNIVERSIDADES</h3>
        <nav>
            <ol class="breadcrumb">                
                <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Universidades</a></li>
                <li class="breadcrumb-item active">Nuevo registro</li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-center">
        <div class="card" style="width: 90%">
            <div class="card-header pt-2 pb-1 mt-3">
                <h6 class="fw-normal text-crear text-uppercase">Crear registro</h6>
            </div>
            <div class="container-fluid mt-3">
                <form method="POST" action="{{ url('universidades') }}" enctype="multipart/form-data">
                    @csrf
                    @include('acreditacion_caces.universidades.form')
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-crear"><i class="bi bi-check-circle"></i>
                            GUARDAR</button>
                        <a type="button" class="btn btn-outline-crear" href="{{ route('universidades.index') }}">CANCELAR</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.getElementById('universidades').classList.remove('collapsed');
    </script>
@endsection
