@extends('layouts.modern')

@section('title', 'Gestión de Usuarios')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Usuarios</li>
@endsection

@section('content')
<div class="page-header animate-fade-in">
    <div>
        <h1>Gestión de Usuarios</h1>
        <p class="text-muted mb-0">Administrar usuarios del sistema</p>
    </div>
    <div class="page-actions">
        <button type="button" class="btn-modern btn-primary-modern" data-bs-toggle="modal" data-bs-target="#newUserModal">
            <i class="bi bi-person-plus me-1"></i> Nuevo Usuario
        </button>
    </div>
</div>

<div class="card-modern animate-fade-in">
    <div class="card-header">
        <h5><i class="bi bi-people me-2"></i>Lista de Usuarios</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="table-modern">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Sedes Asignadas</th>
                        <th style="width: 100px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $key => $user)
                    <tr>
                        <td><span class="badge-modern badge-secondary">{{ $key + 1 }}</span></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="stat-icon green" style="width: 32px; height: 32px; font-size: 12px;">
                                    <i class="bi bi-person"></i>
                                </div>
                                <span class="fw-medium">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                @php
                                    $roleColors = [
                                        'Admin' => 'badge-danger',
                                        'SedeR' => 'badge-success',
                                        'CriteriaR' => 'badge-info',
                                        'IndicatorR' => 'badge-warning',
                                        'Viewer' => 'badge-secondary'
                                    ];
                                    $colorClass = $roleColors[$role->name] ?? 'badge-secondary';
                                @endphp
                                <span class="badge-modern {{ $colorClass }}">{{ $role->name }}</span>
                            @endforeach
                            @if($user->roles->isEmpty())
                                <span class="text-muted small">Sin rol</span>
                            @endif
                        </td>
                        <td>
                            @php
                                // Mostrar sede si es responsable (SedeR)
                                $sedesResponsable = $user->sedesResponsable;
                                // Mostrar sedes asignadas (relación many-to-many)
                                $sedesAsignadas = $user->universidades;
                            @endphp
                            @if($sedesResponsable->count() > 0)
                                @foreach($sedesResponsable as $sede)
                                    <span class="badge-modern badge-success" title="Responsable de Sede">
                                        <i class="bi bi-star-fill me-1"></i>{{ $sede->sede }}
                                    </span>
                                @endforeach
                            @endif
                            @if($sedesAsignadas->count() > 0)
                                @foreach($sedesAsignadas as $sede)
                                    <span class="badge-modern badge-info">{{ $sede->sede }}</span>
                                @endforeach
                            @endif
                            @if($sedesResponsable->count() == 0 && $sedesAsignadas->count() == 0)
                                @if($user->hasRole('Admin'))
                                    <span class="badge-modern badge-secondary">Todas</span>
                                @elseif($user->hasRole('Viewer'))
                                    <span class="badge-modern badge-secondary">Visualizador</span>
                                @else
                                    <span class="text-muted small">Sin asignar</span>
                                @endif
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline formulario-eliminar">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-modern btn-danger-modern btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            No hay usuarios registrados
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
    <!-- Modal Nuevo Usuario -->
<div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <div class="modal-header text-white" style="background: var(--espe-green); border-radius: 16px 16px 0 0;">
                <h6 class="modal-title fw-medium" id="newUserModalLabel">
                    <i class="bi bi-person-plus me-2"></i>Nuevo Usuario
                </h6>
                <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-medium">Nombre</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" required placeholder="Nombre completo">
                        </div>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-medium">Correo Electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required placeholder="correo@ejemplo.com">
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-medium">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password" placeholder="••••••••">
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-medium">Confirmar Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                            <input type="password" class="form-control" name="password_confirmation" 
                                   required autocomplete="new-password" placeholder="••••••••">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-medium">Sedes Asignadas</label>
                        <div id="selectedUniversities" class="form-control bg-light" style="min-height: 60px;">
                            <span class="text-muted">No se han seleccionado sedes</span>
                        </div>
                        <input type="hidden" id="selectedUniversitiesIds" name="universidades_seleccionadas">
                    </div>

                    <button type="button" class="btn-modern btn-secondary-modern w-100 mb-3" 
                            data-bs-toggle="modal" data-bs-target="#uni_register">
                        <i class="bi bi-building me-1"></i> Asignar Sedes
                    </button>

                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <button type="submit" class="btn-modern btn-primary-modern">
                            <i class="bi bi-check-circle me-1"></i> Registrar
                        </button>
                        <button type="button" class="btn-modern btn-secondary-modern" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Modal de asignar sedes -->
<div class="modal fade" id="uni_register" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <div class="modal-header text-white" style="background: var(--espe-gold); border-radius: 16px 16px 0 0;">
                <h6 class="modal-title fw-medium">
                    <i class="bi bi-building me-2"></i>Asignar Sedes
                </h6>
                <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="overflow-auto" style="max-height: 300px;">
                    @foreach ($universidades as $universidad)
                    <div class="form-check mb-2 p-2 rounded" style="background: #f8fafc;">
                        <input class="form-check-input" type="checkbox" id="uni-{{ $universidad->id }}"
                               name="us[]" value="{{ $universidad->id }}">
                        <label class="form-check-label" for="uni-{{ $universidad->id }}">
                            <span class="fw-medium">{{ $universidad->universidad }}</span>
                            <span class="text-muted small">- {{ $universidad->campus }}</span>
                        </label>
                    </div>
                    @endforeach
                </div>

                <input type="hidden" id="indicadorId" name="ind_id">
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="button" class="btn-modern btn-primary-modern" id="asignarUniversidadesBtn"
                            data-bs-toggle="modal" data-bs-target="#newUserModal">
                        <i class="bi bi-check-circle me-1"></i> Asignar
                    </button>
                    <button type="button" class="btn-modern btn-secondary-modern" data-bs-toggle="modal" 
                            data-bs-target="#newUserModal">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('asignarUniversidadesBtn').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('#uni_register input[type="checkbox"]:checked');
        var universidadesSeleccionadas = [];
        var universidadesIds = [];

        checkboxes.forEach(function(checkbox) {
            var label = document.querySelector('label[for="' + checkbox.id + '"]').innerText;
            universidadesSeleccionadas.push(label);
            universidadesIds.push(checkbox.value);
        });

        var selectedUniversitiesDiv = document.getElementById('selectedUniversities');
        if (universidadesSeleccionadas.length > 0) {
            selectedUniversitiesDiv.innerHTML = universidadesSeleccionadas.map(u => 
                '<span class="badge-modern badge-success me-1 mb-1">' + u.trim() + '</span>'
            ).join('');
        } else {
            selectedUniversitiesDiv.innerHTML = '<span class="text-muted">No se han seleccionado sedes</span>';
        }

        document.getElementById('selectedUniversitiesIds').value = universidadesIds.join(',');
    });
</script>
@endpush
