<li class="nav-heading">Principal</li>
<li class="nav-item">
    <a class="nav-link collapsed" id="dashboard" href="{{ route('home') }}">
        <i class="bi bi-house"></i><span>Home</span>
    </a>
</li>

<li>
    <hr class="modulo-divider">
</li>

@can('admin')
<li class="nav-heading">CONFIGURACIÓN</li>
<li class="nav-item">
    <a class="nav-link collapsed" id="universidades" href="{{ route('universidades.index') }}">
        <i class="bi bi-building"></i><span>Gestión de Sedes</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" id="new_user" href="{{ route('users') }}">
        <i class="bi bi-person"></i><span>Usuarios</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" id="porcentaje_criterio" href="{{ route('porcentaje.criterios.index') }}">
        <i class="bi bi-percent"></i><span>Porcentajes Criterios</span>
    </a>
</li>
<li>
    <hr class="modulo-divider">
</li>
@endcan
