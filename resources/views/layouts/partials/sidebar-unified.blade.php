@php
    // Detectar contexto actual basado en la ruta
    $currentRoute = Route::currentRouteName() ?? '';
    $routeParams = Route::current() ? Route::current()->parameters() : [];
    
    // Variables de contexto
    $inEvaluacion = false;
    $inPorcentajes = false;
    $inResultados = false;
    $inInformes = false;
    $currentEvaluacion = null;
    $currentUniversidad = null;
    $currentCriterio = null;
    
    // Lista de rutas donde NO mostrar el contexto de sede (páginas principales)
    $rutasPrincipales = ['universidades.index', 'universidades.create', 'universidades.edit', 'users', 'porcentaje.criterios.index', 'porcentaje.subcriterios.index', 'porcentaje.indicadores.index', 'porcentaje.elementos.index'];
    $enPaginaPrincipal = in_array($currentRoute, $rutasPrincipales);
    
    // Lista de rutas donde estamos DENTRO de una evaluación específica
    $rutasEvaluacion = ['indicadores.index', 'criterio', 'resultado', 'informes.criterios.index', 'informes.mejora', 'criteria.assignments.show', 'indicador.assignments.show', 'personal.academico.informeGeneral', 'personal.academico.informeEspecifico'];
    $dentroDeEvaluacion = in_array($currentRoute, $rutasEvaluacion);
    
    // Detectar contexto de universidad/sede
    if (!$enPaginaPrincipal) {
        if (isset($evaluacion) && $evaluacion) {
            $currentUniversidad = $evaluacion->universidad ?? null;
            // Solo marcar inEvaluacion si estamos en una ruta de evaluación específica
            if ($dentroDeEvaluacion) {
                $inEvaluacion = true;
                $currentEvaluacion = $evaluacion;
            }
        } elseif (isset($universidad) && $universidad) {
            $currentUniversidad = $universidad;
        }
    }
    
    // Detectar sección específica
    if (Str::contains($currentRoute, 'porcentaje')) {
        $inPorcentajes = true;
    }
    if (Str::contains($currentRoute, 'resultado')) {
        $inResultados = true;
    }
    if (Str::contains($currentRoute, 'informe')) {
        $inInformes = true;
    }
    
    // Obtener criterios si estamos en evaluación
    $criteriosNav = [];
    if ($inEvaluacion && isset($criterios) && $criterios) {
        $criteriosNav = $criterios;
    }
    
    $icons = ['building', 'book', 'people', 'lightbulb', 'link', 'trophy'];
@endphp

<ul class="nav flex-column">
    {{-- ============================================= --}}
    {{-- SECCIÓN PRINCIPAL - SIEMPRE VISIBLE --}}
    {{-- ============================================= --}}
    <li class="nav-section">
        <span class="nav-section-title"><span>Principal</span></span>
    </li>
    
    <li class="nav-item {{ $currentRoute == 'universidades.index' ? 'active' : '' }}">
        <a class="nav-link {{ $currentRoute == 'universidades.index' ? 'active' : '' }}" href="{{ route('universidades.index') }}">
            <i class="bi bi-grid-3x3-gap"></i>
            <span>Sedes</span>
        </a>
    </li>
    
    @can('admin')
    <li class="nav-item {{ $currentRoute == 'users' ? 'active' : '' }}">
        <a class="nav-link {{ $currentRoute == 'users' ? 'active' : '' }}" href="{{ route('users') }}">
            <i class="bi bi-people"></i>
            <span>Usuarios</span>
        </a>
    </li>
    @endcan

    {{-- ============================================= --}}
    {{-- CONFIGURACIÓN GLOBAL (SOLO ADMIN) --}}
    {{-- ============================================= --}}
    @can('admin')
    <li class="nav-section">
        <span class="nav-section-title"><span>Configuración</span></span>
    </li>
    
    <li class="nav-item has-submenu {{ $inPorcentajes ? 'open' : '' }}">
        <a class="nav-link" href="#">
            <i class="bi bi-sliders"></i>
            <span>Porcentajes</span>
            <i class="bi bi-chevron-right arrow"></i>
        </a>
        <ul class="nav-submenu">
            <li class="nav-item">
                <a class="nav-link {{ $currentRoute == 'porcentaje.criterios.index' ? 'active' : '' }}" 
                   href="{{ route('porcentaje.criterios.index') }}">
                    <i class="bi bi-check-square"></i>
                    <span>Criterios</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $currentRoute == 'porcentaje.subcriterios.index' ? 'active' : '' }}" 
                   href="{{ route('porcentaje.subcriterios.index') }}">
                    <i class="bi bi-list-check"></i>
                    <span>Subcriterios</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $currentRoute == 'porcentaje.indicadores.index' ? 'active' : '' }}" 
                   href="{{ route('porcentaje.indicadores.index') }}">
                    <i class="bi bi-graph-up"></i>
                    <span>Indicadores</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $currentRoute == 'porcentaje.elementos.index' ? 'active' : '' }}" 
                   href="{{ route('porcentaje.elementos.index') }}">
                    <i class="bi bi-diamond"></i>
                    <span>Elementos Fund.</span>
                </a>
            </li>
        </ul>
    </li>
    @endcan

    {{-- ============================================= --}}
    {{-- CONTEXTO DE UNIVERSIDAD/SEDE --}}
    {{-- ============================================= --}}
    @if($currentUniversidad)
    <li class="nav-section">
        <span class="nav-section-title"><span>Sede Actual</span></span>
    </li>
    
    {{-- Badge de contexto --}}
    <div class="context-badge">
        <div class="context-badge-title">Sede</div>
        <div class="context-badge-value">{{ $currentUniversidad->sede ?? 'N/A' }}</div>
    </div>
    
    <li class="nav-item {{ Str::contains($currentRoute, 'evaluaciones') && !$inEvaluacion ? 'active' : '' }}">
        <a class="nav-link {{ Str::contains($currentRoute, 'evaluaciones') && !$inEvaluacion ? 'active' : '' }}" 
           href="{{ route('evaluaciones.show', $currentUniversidad->id) }}">
            <i class="bi bi-journal-check"></i>
            <span>Evaluaciones</span>
        </a>
    </li>
    
    <li class="nav-item {{ $currentRoute == 'historico.grafico.index' ? 'active' : '' }}">
        <a class="nav-link {{ $currentRoute == 'historico.grafico.index' ? 'active' : '' }}" 
           href="{{ route('historico.grafico.index', $currentUniversidad->id) }}">
            <i class="bi bi-bar-chart-line"></i>
            <span>Gráfico Histórico</span>
        </a>
    </li>
    
    <li class="nav-item {{ $currentRoute == 'historico.index' ? 'active' : '' }}">
        <a class="nav-link {{ $currentRoute == 'historico.index' ? 'active' : '' }}" 
           href="{{ route('historico.index', $currentUniversidad->id) }}">
            <i class="bi bi-clock-history"></i>
            <span>Histórico</span>
        </a>
    </li>
    @endif

    {{-- ============================================= --}}
    {{-- CONTEXTO DE EVALUACIÓN --}}
    {{-- ============================================= --}}
    @if($inEvaluacion && $currentEvaluacion)
    <li class="nav-section">
        <span class="nav-section-title"><span>Evaluación</span></span>
    </li>
    
    {{-- Badge de contexto de evaluación --}}
    <div class="context-badge">
        <div class="context-badge-title">Período</div>
        <div class="context-badge-value">
            {{ \Carbon\Carbon::parse($currentEvaluacion->fecha_inicial)->format('Y') }} - 
            {{ \Carbon\Carbon::parse($currentEvaluacion->fecha_final)->format('Y') }}
        </div>
    </div>
    
    <li class="nav-item {{ $currentRoute == 'indicadores.index' ? 'active' : '' }}">
        <a class="nav-link {{ $currentRoute == 'indicadores.index' ? 'active' : '' }}" 
           href="{{ route('indicadores.index', $currentEvaluacion->id) }}">
            <i class="bi bi-speedometer2"></i>
            <span>Panel de Indicadores</span>
        </a>
    </li>
    
    {{-- Asignaciones (Admin y SedeR) --}}
    @if(auth()->user()->can('admin') || (auth()->user()->hasRole('SedeR') && auth()->user()->esResponsableDeSede($currentEvaluacion->uni_id)))
    <li class="nav-item has-submenu">
        <a class="nav-link" href="#">
            <i class="bi bi-person-plus"></i>
            <span>Asignaciones</span>
            <i class="bi bi-chevron-right arrow"></i>
        </a>
        <ul class="nav-submenu">
            <li class="nav-item">
                <a class="nav-link {{ $currentRoute == 'criteria.assignments.show' ? 'active' : '' }}" 
                   href="{{ route('criteria.assignments.show', $currentEvaluacion->id) }}">
                    <i class="bi bi-file-earmark-person"></i>
                    <span>Asignar Criterios</span>
                </a>
            </li>
            @if(auth()->user()->can('admin') || auth()->user()->can('CriteriaR') || (auth()->user()->hasRole('SedeR') && auth()->user()->esResponsableDeSede($currentEvaluacion->uni_id)))
            <li class="nav-item">
                <a class="nav-link {{ $currentRoute == 'indicador.assignments.show' ? 'active' : '' }}" 
                   href="{{ route('indicador.assignments.show', $currentEvaluacion->id) }}">
                    <i class="bi bi-graph-up-arrow"></i>
                    <span>Asignar Indicadores</span>
                </a>
            </li>
            @endif
        </ul>
    </li>
    @elseif(auth()->user()->can('CriteriaR'))
    <li class="nav-item {{ $currentRoute == 'indicador.assignments.show' ? 'active' : '' }}">
        <a class="nav-link {{ $currentRoute == 'indicador.assignments.show' ? 'active' : '' }}" 
           href="{{ route('indicador.assignments.show', $currentEvaluacion->id) }}">
            <i class="bi bi-graph-up-arrow"></i>
            <span>Asignar Indicadores</span>
        </a>
    </li>
    @endif

    {{-- Criterios --}}
    @if(count($criteriosNav) > 0)
    <li class="nav-section">
        <span class="nav-section-title"><span>Criterios</span></span>
    </li>
    
    @foreach ($criteriosNav as $criterio)
        @php
            $permissions = auth()->user()->getAllPermissions();
            $hasPermission = false;
            
            if(auth()->user()->hasRole('Viewer') || auth()->user()->hasRole('SedeR') && auth()->user()->esResponsableDeSede($currentEvaluacion->uni_id)){
                $hasPermission = true;
            }
            
            foreach ($permissions as $permission) {
                foreach($criterio->indicadors as $indicador){
                    if ($permission->name == "$currentEvaluacion->id-$indicador->id") {
                        $hasPermission = true;
                        break;
                    }
                }
                foreach($criterio->indicadorsSub ?? [] as $indicador){
                    if ($permission->name == "$currentEvaluacion->id-$indicador->id") {
                        $hasPermission = true;
                        break;
                    }
                }
                if($hasPermission) break;
            }
            
            $criterioActive = isset($criterioActual) && $criterioActual->id == $criterio->id;
        @endphp
        
        @if (auth()->user()->can("admin") || auth()->user()->can("$currentEvaluacion->id/$criterio->id") || $hasPermission)
        <li class="nav-item {{ $criterioActive ? 'active' : '' }}">
            <a class="nav-link {{ $criterioActive ? 'active' : '' }}" 
               href="{{ route('criterio', [$currentEvaluacion->id, $criterio->id]) }}">
                <i class="bi bi-{{ $icons[$criterio->id - 1] ?? 'circle' }}"></i>
                <span>{{ mb_convert_case($criterio->criterio, MB_CASE_TITLE, "UTF-8") }}</span>
            </a>
        </li>
        @endif
    @endforeach
    @endif

    {{-- Resultados --}}
    <li class="nav-section">
        <span class="nav-section-title"><span>Reportes</span></span>
    </li>
    
    <li class="nav-item has-submenu {{ $inResultados ? 'open' : '' }}">
        <a class="nav-link" href="#">
            <i class="bi bi-clipboard-data"></i>
            <span>Resultados</span>
            <i class="bi bi-chevron-right arrow"></i>
        </a>
        <ul class="nav-submenu">
            @foreach ($criteriosNav as $criterio)
                @php
                    $permissions = auth()->user()->getAllPermissions();
                    $hasPermission = false;
                    
                    if(auth()->user()->hasRole('Viewer') || auth()->user()->hasRole('SedeR') && auth()->user()->esResponsableDeSede($currentEvaluacion->uni_id)){
                        $hasPermission = true;
                    }
                    
                    foreach ($permissions as $permission) {
                        foreach($criterio->indicadors as $indicador){
                            if ($permission->name == "$currentEvaluacion->id-$indicador->id") {
                                $hasPermission = true;
                                break;
                            }
                        }
                        if($hasPermission) break;
                    }
                @endphp
                
                @if (auth()->user()->can("admin") || auth()->user()->can("$currentEvaluacion->id/$criterio->id") || $hasPermission)
                <li class="nav-item">
                    <a class="nav-link {{ $currentRoute == 'resultado' && isset($criterioActual) && $criterioActual->id == $criterio->id ? 'active' : '' }}" 
                       href="{{ route('resultado', [$currentEvaluacion->id, $criterio->id]) }}">
                        <i class="bi bi-{{ $icons[$criterio->id - 1] ?? 'circle' }}"></i>
                        <span>{{ Str::limit(mb_convert_case($criterio->criterio, MB_CASE_TITLE, "UTF-8"), 20) }}</span>
                    </a>
                </li>
                @endif
            @endforeach
        </ul>
    </li>
    
    <li class="nav-item {{ Str::contains($currentRoute, 'informes') ? 'active' : '' }}">
        <a class="nav-link {{ Str::contains($currentRoute, 'informes') ? 'active' : '' }}" 
           href="{{ route('informes.criterios.index', $currentEvaluacion->id) }}">
            <i class="bi bi-file-earmark-pdf"></i>
            <span>Informes</span>
        </a>
    </li>
    @endif
</ul>
