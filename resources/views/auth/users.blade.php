@extends('layouts.caces')
@section('sidebar')
@include('layouts.sidebar_inicio')
@endsection

@section('content')
<div class="pagetitle">
    <h3>USUARIOS</h3>
</div>

<style>
    .switch-seder {
        position: relative;
        display: inline-block;
        width: 44px;
        height: 24px;
    }

    .switch-seder input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .switch-seder .slider {
        position: absolute;
        cursor: pointer;
        inset: 0;
        background-color: #ccc;
        transition: .3s;
        border-radius: 24px;
    }

    .switch-seder .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .3s;
        border-radius: 50%;
    }

    .switch-seder input:checked+.slider {
        background-color: #0d6efd;
    }

    .switch-seder input:checked+.slider:before {
        transform: translateX(20px);
    }

    .switch-seder input:disabled+.slider {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>

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
                        <th scope="col">Sede Registro</th>
                        <th scope="col">Sede Responsable</th>
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
                            @foreach($user->universidades as $uniReg)
                            <span class="text-secondary d-block" style="font-size: 0.85rem;">
                                {{ $uniReg->sede }}
                            </span>
                            @endforeach
                            @if($user->universidades->isEmpty())
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if(!$user->hasRole('Admin'))
                            @php $sedeRegistro = $user->universidades->first(); @endphp
                            @if($sedeRegistro)
                            <div class="d-flex align-items-center gap-2">
                                <form action="{{ route('users.toggle-seder', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    <label class="switch-seder" title="{{ $user->hasRole('SedeR') ? 'Desactivar SedeR' : 'Activar como SedeR de ' . $sedeRegistro->sede }}">
                                        <input type="checkbox"
                                            {{ $user->hasRole('SedeR') ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <span class="slider"></span>
                                    </label>
                                </form>
                                <span class="{{ $user->hasRole('SedeR') ? 'text-primary fw-bold' : 'text-muted' }}" style="font-size: 0.85rem;">
                                    {{ $sedeRegistro->sede }}
                                </span>
                            </div>
                            @else
                            <span class="text-muted">-</span>
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
                        </td>
                    </tr>
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
<div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-crear text-white pb-2 pt-2">
                <h6 class="modal-title fw-normal text-uppercase" id="newUserModalLabel">
                    <i class="bi bi-person-plus me-2"></i>Registrar Nuevo Usuario
                </h6>
                <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body px-4 py-4">
                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    {{-- Nombre --}}
                    <div class="mb-3">
                        <label for="name" class="form-label small fw-semibold text-muted">Nombre completo</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill text-crear"></i></span>
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required placeholder="Ingrese el nombre">
                        </div>
                        @error('name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-semibold text-muted">Correo electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-fill text-crear"></i></span>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required placeholder="correo@ejemplo.com">
                        </div>
                        @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Contraseña --}}
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label small fw-semibold text-muted">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill text-crear"></i></span>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password" placeholder="Contraseña">
                            </div>
                            @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password-confirm" class="form-label small fw-semibold text-muted">Confirmar</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-shield-lock-fill text-crear"></i></span>
                                <input id="password-confirm" type="password"
                                    class="form-control"
                                    name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar contraseña">
                            </div>
                        </div>
                    </div>

                    {{-- Universidad --}}
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Sede</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-building text-crear"></i></span>
                            <select class="form-select @error('universidades_seleccionadas') is-invalid @enderror"
                                name="universidades_seleccionadas" required>
                                <option value="" selected disabled>Seleccione una sede...</option>
                                @foreach($universidades as $universidad)
                                <option value="{{ $universidad->id }}">{{ $universidad->universidad }} - {{ $universidad->campus }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('universidades_seleccionadas')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Footer --}}
                    <div class="modal-footer px-0 pb-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-actualizar">
                            <i class="bi bi-check-circle me-1"></i>Registrar
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
    document.getElementById('new_user').classList.remove('collapsed');
    Livewire.on('refresh', () => {
        location.reload();
    });
</script>
@endsection