@extends('layouts.caces')
@section('sidebar')
@include('layouts.sidebar')
@endsection


<style>
    .alerta {
        animation-name: example-text;
        animation-duration: 1s;
        animation-iteration-count: infinite;
        color: red;
    }

    @keyframes example-text {
        0% {
            color: red;
        }

        50% {
            color: white;
        }

        100% {
            color: red;
        }
    }
</style>

@section('content')
<div class="pagetitle">
    <h3>AUTOEVALUACIÓN {{ date('Y') }}</h3>
    <h3>El puntaje total de autoevaluación obtenido es
        @if (round($total_evaluacion,2) >= 80)
        <samp style="color: green">
            {{ round($total_evaluacion, 2) }}%
        </samp>
        @else
        <span style="color: red">
            {{ round($total_evaluacion, 2) }}%
        </span>
        @endif
    </h3>
</div>
<div class="row justify-content-center">
    <div class="card pt-5 pb-3" style="width: 100%">
        <div class="row">
            <div class="col-md-4 text-center">
                @isset($evaluacion->universidad->foto)
                @if ($evaluacion->universidad->foto != '')
                <img src="{{ asset('storage/' . $evaluacion->universidad->foto) }}" alt="foto"
                    width="auto" height="140px" title='foto'>
                @endif
                @else
                <i class="bi bi-person-square" height="50px"></i>
                @endisset
                <div class="pagetitle pt-3">
                    <h3 class="text-uppercase">{{ $evaluacion->universidad->universidad }}</h3>
                    <p class="fs-6 text-uppercase">{{ $evaluacion->universidad->codigo_unico }}</p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="card-text text-uppercase"><strong>Universidad:</strong>
                                {{ $evaluacion->universidad->universidad }}
                            </p>
                            <p class="card-text text-uppercase"><strong>Campus:</strong>
                                {{ $evaluacion->universidad->campus }}
                            </p>
                            <p class="card-text text-uppercase"><strong>Sede:</strong>
                                <span class="text-uppercase">{{ $evaluacion->universidad->sede }}</span>
                            </p>
                            <p class="card-text text-uppercase"><strong>Ciudad:</strong>
                                {{ $evaluacion->universidad->ciudad }}
                            </p>
                            <p class="card-text text-uppercase"><strong>Fecha de evaluacion:</strong>
                                {{ $evaluacion->fecha_creacion }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="card-text text-uppercase"><strong>Facultad:</strong>
                                {{ $evaluacion->facultad }}
                            </p>
                            <p class="card-text text-uppercase"><strong>Departamento:</strong>
                                {{ $evaluacion->departamento }}
                            </p>
                            <p class="card-text text-uppercase"><strong>Evaluador:</strong>
                                {{ $evaluacion->user->name}}
                            </p>
                            <p class="card-text text-uppercase"><strong>Contraparte:</strong>
                                Unidad de Acreditación</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    @php
    $colors=['#008A94','#AD2E0D','#287C27','#7A287C','#967a02','#39389E'];
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
    <div class="col-sm-4">
        <div class="card mb-3">
            <a href="{{ route('resultado', [$evaluacion->id,$criterio->id]) }}">
                <div class="card-header text-white" style="background-color: {{$colors[$criterio->id-1]}}">{{$criterio->criterio}}
                </div>
            </a>
            <div class="card-body pt-3" style="margin-top: 20px;">
                <div class="row text-center">
                    <div class="col-sm-4">
                        @if ($total_criterios[$criterio->id] >= 70)
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 40px"></i>
                        @else
                        <i class="bi bi-exclamation-circle-fill alerta" style="font-size: 40px"></i>
                        @endif
                    </div>
                    <div class="col-sm-8">
                        <h2 style="font-size: 40px;  color:{{ $total_criterios[$criterio->id] >= 70 ? '#287C27' : '#ff3547' }}">
                            {{ $total_criterios[$criterio->id] }}%
                        </h2>
                        <p>Puntaje eje de evaluación: <span class="text-danger">{{$criterio->porcentaje}} -> 100%</span></p>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        style="width: {{ $total_criterios[$criterio->id] }}%; background-color: {{ $total_criterios[$criterio->id] >= 70 ? '#287C27' : '#ff3547' }};"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ $total_criterios[$criterio->id] }}%</div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>

@endsection
@section('scripts')
<script>
    document.getElementById('indicadores').classList.remove('collapsed');
</script>
@endsection