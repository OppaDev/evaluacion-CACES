@extends('layouts.caces')
@section('sidebar')
    @include('layouts.sidebar_inicio')
@endsection

@section('content')
    <div class="pagetitle">
        <h3>USUARIOS</h3>
    </div>

    <div class="card">
        <div class="">
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
        <div class="card-header pb-2 d-flex justify-content-between">
            <h6 class="fw-normal text-pacifico text-uppercase">Lista de Usuarios</h6>
            <div class="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link collapsed button" type="button" data-bs-toggle="modal"
                        data-bs-target="#newUserModal">
                        <i class="bi bi-person"></i><span>Nuevo Usuario</span>
                    </a>
                </li>
            </div>
        </div>

        <div class="card-body mt-3">
            <div class="row p-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Sede</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @forelse ($users as $key => $user)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge 
                                            @if($role->name == 'Admin') bg-danger
                                            @elseif($role->name == 'SedeR') bg-primary
                                            @elseif($role->name == 'CriteriaR') bg-success
                                            @elseif($role->name == 'IndicatorR') bg-info
                                            @else bg-secondary
                                            @endif">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                    @if($user->roles->isEmpty())
                                        <span class="badge bg-secondary">Sin rol</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->hasRole('SedeR'))
                                        @php $sede = $user->universidades->first(); @endphp
                                        @if($sede)
                                            <span class="text-primary">{{ $sede->universidad }}</span>
                                        @else
                                            <span class="text-muted">No asignada</span>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- Botón Eliminar --}}
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link link-danger fs-6 p-0 m-0" title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                    {{-- Gestión SedeR (solo si no es Admin) --}}
                                    @if(!$user->hasRole('Admin'))
                                        @if($user->hasRole('SedeR'))
                                            {{-- Botón Remover SedeR --}}
                                            <form action="{{ route('users.remove-seder', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link link-warning fs-6 p-0 m-0 ms-2" title="Remover SedeR">
                                                    <i class="bi bi-person-dash"></i>
                                                </button>
                                            </form>
                                        @else
                                            {{-- Botón Asignar SedeR --}}
                                            <button type="button" class="btn btn-link link-primary fs-6 p-0 m-0 ms-2" 
                                                data-bs-toggle="modal" data-bs-target="#assignSedeRModal{{ $user->id }}" 
                                                title="Asignar como SedeR">
                                                <i class="bi bi-person-plus"></i>
                                            </button>
                                        @endif
                                    @endif
                                </td>
                            </tr>

                            {{-- Modal para asignar SedeR --}}
                            @if(!$user->hasRole('Admin') && !$user->hasRole('SedeR'))
                            <div class="modal fade" id="assignSedeRModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h6 class="modal-title">Asignar SedeR</h6>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('users.assign-seder', $user) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <p class="small mb-2">Asignar a <strong>{{ $user->name }}</strong> como responsable de:</p>
                                                <select name="universidad_id" class="form-select" required>
                                                    <option value="">Seleccionar universidad...</option>
                                                    @foreach($universidades as $universidad)
                                                        <option value="{{ $universidad->id }}">{{ $universidad->universidad }} - {{ $universidad->campus }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-sm btn-primary">Asignar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @empty
                            <tr>
                                <td colspan="6">No hay usuarios registrados</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-0">
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
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required placeholder='Nombre'>
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
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="Contraseña">
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
                                        <input type="hidden" id="selectedUniversitiesIds"
                                            name="universidades_seleccionadas">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botón para abrir el modal de asignar universidades -->
                        <button type="button" class="btn btn-danger my-3" data-bs-toggle="modal"
                            data-bs-target="#uni_register" data-indicador-id="">ASIGNAR</button>

                        <!-- Botón de registro -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Registrarse</button>
                        </div>
                    </form>
                </div>
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
                                <input class="form-check-input" type="checkbox" id="uni-{{ $universidad->id }}"
                                    name="us[]" value="{{ $universidad->id }}">
                                <label class="form-check-label" for="uni-{{ $universidad->id }}">
                                    {{ $universidad->universidad }} - {{ $universidad->campus }}
                                </label>
                                <br />
                            @endforeach
                        </div>

                        <input type="hidden" id="indicadorId" name="ind_id">
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-crear" id="asignarUniversidadesBtn"
                                data-bs-toggle="modal" data-bs-target="#newUserModal">ASIGNAR</button>
                            <button type="button" class="btn btn-outline-crear" data-bs-toggle="modal"
                                data-bs-target="#newUserModal">
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
        document.getElementById('asignarUniversidadesBtn').addEventListener('click', function() {
            // Obtener todas las universidades seleccionadas
            var checkboxes = document.querySelectorAll('#uni_register input[type="checkbox"]:checked');

            // Crear una lista de las universidades seleccionadas y otra de los IDs
            var universidadesSeleccionadas = [];
            var universidadesIds = [];

            checkboxes.forEach(function(checkbox) {
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
            // var modal = bootstrap.Modal.getInstance(document.getElementById('uni_register'));
            // modal.hide();
        });
    </script>
    <script>
        document.getElementById('new_user').classList.remove('collapsed');
        Livewire.on('refresh', () => {
            location.reload();
        });
    </script>
@endsection
