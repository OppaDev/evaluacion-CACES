@extends('layouts.caces')
@section('sidebar')
    @include('layouts.sidebar_inicio')
@endsection

@section('content')
<div class="pagetitle">
    <h3>REGISTRAR USUARIO</h3>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Registrar usuario</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-header pb-2">
        <h6 class="fw-normal text-pacifico text-uppercase">Llene los campos</h6>
    </div>
    <div class="card-body mt-3">
        <div class="row p-2">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Nombre del usuario -->
                <div class="row">
                    <div class="col-1">
                        <i class="bi bi-person-fill" style="font-size: 30px"></i>
                    </div>
                    <div class="col">
                        <div class="wrap-input100">
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required placeholder='Nombre'>
                        </div>
                    </div>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Correo del usuario -->
                <div class="row">
                    <div class="col-1">
                        <i class="bi bi-envelope" style="font-size: 30px"></i>
                    </div>
                    <div class="col">
                        <div class="wrap-input100">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required placeholder="Correo">
                        </div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Contraseña del usuario -->
                <div class="row">
                    <div class="col-1">
                        <i class="bi bi-lock" style="font-size: 30px"></i>
                    </div>
                    <div class="col">
                        <div class="wrap-input100">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="Contraseña">
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Confirmar contraseña del usuario -->
                <div class="row">
                    <div class="col-1">
                        <i class="bi bi-shield-lock" style="font-size: 30px"></i>
                    </div>
                    <div class="col">
                        <div class="wrap-input100">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Confirmar contraseña">
                        </div>
                    </div>
                </div>

                <!-- Universidades seleccionadas (campo oculto para IDs) -->
                <div class="row">
                    <div class="col-1">
                        <i class="bi bi-university" style="font-size: 30px"></i>
                    </div>
                    <div class="col">
                        <div class="wrap-input100">
                            <div class="form-group">
                                <label for="selectedUniversities">Universidades seleccionadas:</label>
                                <div id="selectedUniversities" class="form-control" readonly>
                                    No universities selected.
                                </div>
                                <!-- Campo oculto para almacenar los IDs de las universidades seleccionadas -->
                                <input type="hidden" id="selectedUniversitiesIds" name="universidades_seleccionadas">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botón para abrir el modal de asignar universidades -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#uni_register" data-indicador-id="">ASIGNAR</button>

                <!-- Botón de registro -->
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success">Registrarse</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de asignar universidades -->
<div class="modal fade" id="uni_register" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-crear text-white pb-2 pt-2">
                <h6 class="modal-title fw-normal text-uppercase">Asignar universidades</h6>
                <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="overflow-auto">
                        @foreach ($universidades as $universidad)
                        <input class="form-check-input" type="checkbox" id="uni-{{$universidad->id}}" name="us[]" value="{{$universidad->id}}">
                        <label class="form-check-label" for="uni-{{$universidad->id}}">
                            {{$universidad->universidad}} - {{$universidad->campus}}
                        </label>
                        <br />
                        @endforeach
                    </div>

                    <input type="hidden" id="indicadorId" name="ind_id">
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-crear" id="asignarUniversidadesBtn">ASIGNAR</button>
                        <button type="button" class="btn btn-outline-crear" data-bs-dismiss="modal" aria-label="Close">
                            CANCELAR
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Agregar el event listener para el botón "ASIGNAR"
    document.getElementById('asignarUniversidadesBtn').addEventListener('click', function () {
        // Obtener todas las universidades seleccionadas
        var checkboxes = document.querySelectorAll('#uni_register input[type="checkbox"]:checked');

        // Crear una lista de las universidades seleccionadas y otra de los IDs
        var universidadesSeleccionadas = [];
        var universidadesIds = [];

        checkboxes.forEach(function (checkbox) {
            var label = document.querySelector('label[for="' + checkbox.id + '"]').innerText;
            universidadesSeleccionadas.push(label);
            universidadesIds.push(checkbox.value); // Obtener los IDs seleccionados
        });

        // Mostrar las universidades seleccionadas en la vista principal
        var selectedUniversitiesDiv = document.getElementById('selectedUniversities');
        if (universidadesSeleccionadas.length > 0) {
            selectedUniversitiesDiv.innerHTML = universidadesSeleccionadas.join('<br>');
        } else {
            selectedUniversitiesDiv.innerHTML = 'No universities selected.';
        }

        // Guardar los IDs seleccionados en el campo oculto
        document.getElementById('selectedUniversitiesIds').value = universidadesIds.join(',');

        // Cerrar el modal después de asignar
        var modal = bootstrap.Modal.getInstance(document.getElementById('uni_register'));
        modal.hide();
    });
</script>
<script>
    document.getElementById('new_user').classList.remove('collapsed');
    Livewire.on('refresh', () => {
        location.reload();
    });
</script>
@endsection
