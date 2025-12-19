@extends('layouts.caces')
@section('sidebar')
@include('layouts.sidebar_evaluacion')
@endsection
@section('content')
<div class="pagetitle">
    <h3>EVALUACIONES</h3>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Evaluaciones</li>
        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-header pb-2">
        <h6 class="fw-normal text-pacifico text-uppercase">Evaluaciones</h6>
    </div>
    <div class="card-body mt-3">
        @can('admin')
        <div class="row justify-content-between">
            <div class="col-md-3">
                <button type="button" class="btn btn-outline-pacifico mb-4 btn-sm" data-bs-toggle="modal"
                    data-bs-target="#crear">NUEVO REGISTRO</button>
            </div>
            <div class="col-md-4">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>
        </div>
        @endcan
        <!-- Tabla -->
        <div class="table-responsive">
            <table id="universidad" class="table table-hover align-middle text-uppercase pt-2 pb-2">
                <thead class="table-pacifico">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">FECHA DE CREACIÓN</th>
                        <th scope="col">PERÍODO</th>
                        <th scope="col">ADMINISTRADOR</th>
                        <th scope="col">DEPARTAMENTO</th>
                        <!-- <th scope="col">FACULTAD</th> -->
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $contador=0;
                    @endphp
                    @foreach ($evaluaciones as $evaluacion)
                    @php
                    $hasPermission = false;
                    if(auth()->user()->hasRole('Viewer')){
                        $contador += 1;
                        $hasPermission = true;
                    }
                    foreach (auth()->user()->getAllPermissions() as $permission) {
                    if (Str::startsWith($permission->name, "$evaluacion->id/")||auth()->user()->can('admin')||Str::startsWith($permission->name, "$evaluacion->id-")) {
                    $hasPermission = true;
                    $contador+=1;
                    break;
                    }
                    }
                    @endphp
                    @if ($hasPermission)
                    <tr>
                        <td>
                            {{ $contador }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($evaluacion->fecha_creacion)->format('d-m-Y') }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($evaluacion->fecha_inicial)->format('d-m-Y') }} - {{ \Carbon\Carbon::parse($evaluacion->fecha_final)->format('d-m-Y') }}
                        </td>
                        <td>
                            {{ $evaluacion->user->name }}
                        </td>
                        <td>
                            {{ $evaluacion->departamento }}
                        </td>
                        
                            <!-- <td>{{ $evaluacion->facultad }}</td> --> 
                        
                        <td style="width: 160px;">
                            <div class="nav fs-6">
                                @can('admin')
                                <a type="button" class="nav-link text-actualizar" title="Editar"
                                    href="{{ route('evaluaciones.edit', $evaluacion->id) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('evaluaciones.destroy', $evaluacion->id) }}" method="POST"
                                    class="d-inline formulario-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn text-eliminar" title="Borrar"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                                @endcan
                                <a type="button" class="nav-link text-crear" title="Ingresar"
                                    href="{{ route('indicadores.index', $evaluacion->id) }}">
                                    <i class="fas fa-sign-in-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Fin Tabla -->
    </div>
</div>
@include('acreditacion_caces.evaluaciones.modal')
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('.formulario-eliminar').submit(function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Está seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            iconColor: '#ff3547',
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonColor: '#ff3547',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });
    // DATA TABLE
    var table = new DataTable('#universidad', {
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
    });
    document.getElementById('evaluaciones').classList.remove('collapsed');
</script>
@endsection