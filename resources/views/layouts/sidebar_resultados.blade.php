<li class="nav-item">
    <a class="nav-link collapsed" id="inicio" href="{{ route('indicadores.index', $evaluacion->id) }}">
        <i class="bi bi-arrow-return-left"></i><span>Regresar</span>
    </a>
</li>
<li>
    <hr class="modulo-divider">
</li>
<li class="nav-heading">Inicio</li>
<li class="nav-item">
    <a class="nav-link collapsed" id="indicadores" href="{{ route('indicadores.index', $evaluacion->id) }}">
        <i class="bi bi-bar-chart"></i><span>Indicadores</span>
    </a>
</li>
<li>
    <hr class="modulo-divider">
</li>
<!-- ======= Sidebar ======= -->
<li class="nav-heading">Resultados</li>
@php
$icons=['building','book','people','lightbulb','link','trophy'];
@endphp
@foreach ($criterios as $criterio )
@php
$permissions = auth()->user()->getAllPermissions();

$hasPermission = false;
if(auth()->user()->hasRole('Viewer')){
$hasPermission = true;
}
foreach ($permissions as $permission) {
foreach($criterio->indicadors as $indicador){
if ($permission->name == "$evaluacion->id-$indicador->id") {
$hasPermission = true;
break;
}
}
foreach($criterio->indicadorsSub as $indicador){
if ($permission->name == "$evaluacion->id-$indicador->id") {
$hasPermission = true;
break;
}
}
if($hasPermission){
break;
}
}
@endphp
@if (auth()->user()->can("admin")||auth()->user()->can("$evaluacion->id/$criterio->id")||$hasPermission)
<li class="nav-item">
    <a class="nav-link collapsed" id="criterio_{{$criterio->id}}"
        href="{{ route('resultado', [$evaluacion->id,$criterio->id]) }}">
        <i class="bi bi-{{$icons[$criterio->id-1]}}"></i><span>{{mb_convert_case($criterio->criterio,MB_CASE_TITLE, "UTF-8")}}</span>
    </a>
</li>
@endif
@endforeach

<!-- ======= Sidebar ======= -->
<li>
    <hr class="modulo-divider">
</li>
<li class="nav-heading">Informes</li>
<li class="nav-item">
    <a class="nav-link collapsed" id="informes" href="{{ route('informes.criterios.index', $evaluacion->id) }}">
        <i class="bi bi-file-text"></i><span>Informes</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" id="" href="#">
        <i class="bi bi-lightbulb"></i><span>Oportunidad de Mejora</span>
    </a>
</li>