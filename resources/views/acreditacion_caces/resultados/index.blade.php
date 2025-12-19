@extends('layouts.caces')
@section('sidebar')
@include('layouts.sidebar_resultados')
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
    <h3>{{ $evaluacion->universidad->universidad }}</h3>
</div>
<h6>RESULTADOS DE EVALUACIÓN CACES 2023 PARA EL CRITERIO: {{ $criterio->criterio }}</h6>
<div class="row">
    <div class="col-sm-6">
        <div class="card mb-3">
            <div class="card-header text-white" style="background-color: #008A94">{{ $criterio->criterio }}</div>
            <div class="card-body pt-3" style="margin-top: 20px;">
                <div class="row text-center">
                    <div class="col-sm-4">
                        @if ($total_criterio >= 80)
                        <i class="bi bi-check-circle-fill text-actualizar" style="font-size: 40px"></i>
                        @else
                        <i class="bi bi-exclamation-circle-fill alerta" style="font-size: 40px"></i>
                        @endif
                    </div>
                    <div class="col-sm-8">
                        <h2 style="font-size: 40px; color:{{$total_criterio >= 80 ? '#00c851' : '#ff3547' }}">
                            {{ $total_criterio }}%
                        </h2>
                        <p>Puntaje eje de evaluación: <span class="text-danger">{{$criterio->porcentaje}} -> 100%</span></p>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        style="width: {{$total_criterio}}%; background-color: {{ $total_criterio >= 80 ? '#00c851' : '#ff3547' }};"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ $total_criterio }}%</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @php
    if($criterio->indicadorsSub->isEmpty()){
        $indicadors=$criterio->indicadors;
    }
    else{
        $indicadors=$criterio->indicadorsSub;
    }
    @endphp
    @foreach ($indicadors as $indicador)
    
    @if (auth()->user()->hasRole('CriteriaR')&&auth()->user()->can("$evaluacion->id/$criterio->id")||auth()->user()->can('admin') || auth()->user()->can("$evaluacion->id-$indicador->id")||auth()->user()->hasRole('Viewer'))
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><a href="{{ route('criterio', [$evaluacion->id,$criterio->id]) }} #indicador_{{$indicador->id}}">{{$indicador->indicador}}</a></h5>
                <div id="indicador_1"></div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
@endsection
@section('scripts')
<script>
    document.getElementById('criterio_{{$criterio->id}}').classList.remove('collapsed');
</script>
@endsection