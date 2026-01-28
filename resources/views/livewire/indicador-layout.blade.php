@extends('layouts.caces_livewire')
@section('sidebar')
@include('layouts.sidebar')
@endsection
@section('styles')
<style>
    body {
        padding-top: 100px;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-11" style="width: 95%">
        <div class="pagetitle">
            <h3>{{ $criterio->criterio }} <b style="margin-left: 20px; color: red;">{{ $criterio->porcentaje }} %</b>
            </h3>
        </div>
        @php
        if($sub_criterios->isEmpty()){
        $indicadores=$indicadors;
        }
        else{
        $indicadores=$criterio->indicadorsSub;
        }
        @endphp
        @if (!$sub_criterios->isEmpty())
        @foreach ($sub_criterios as $sub_criterio)
        <div class="card">
            <div class="card-header" style="font-size: 15px; color: #1B295B">
                {{ $sub_criterio->subcriterio }} <b
                    style="margin-left: 20px; color: red;">{{ $sub_criterio->porcentaje }}
                    %</b>
            </div>
            @foreach ($sub_criterio->indicadors as $indicador)
            @php
            $ind_cri_id=$indicador->subcriterio->criterio->id;
            @endphp
            @if ((auth()->user()->can("$evaluacion->id/$ind_cri_id")&&auth()->user()->hasRole('CriteriaR'))||auth()->user()->can('admin') || auth()->user()->can("$evaluacion->id-$indicador->id")||auth()->user()->hasRole('Viewer') || auth()->user()->hasRole('SedeR'))
            <div class="card-body" id="indicador_{{ $indicador->id }}" style="padding-top: 25px;">
                <h5 class="card-title mt-3" style="color: #0c63e4">{{ $indicador->indicador }} <b
                        style="margin-left: 20px; color: red;">{{ $indicador->porcentaje }} %</b>
                </h5>
                <span><b>ESTANDAR</b></span>
                <p class="card-text">{{ $indicador->estandar }}</p>
                <span><b>PERÍODO DE EVALUACIÓN</b></span>
                <p class="card-text">{{ $indicador->periodo }}</p>
                <div class="accordion">
                    {{-- ACORDION PARA ELEMENTOS FUNDAMENTALES --}}
                    @if (!$indicador->elemento_fundamentals->isEmpty())
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading_{{ $indicador->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_{{ $indicador->id }}" aria-expanded="false"
                                aria-controls="collapse_{{ $indicador->id }}">
                                <span>ELEMENTOS FUNDAMENTALES</span>
                            </button>
                        </h2>
                        <div id="collapse_{{ $indicador->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading_{{ $indicador->id }}" data-bs-parent="#caces">
                            <div class="accordion-body">
                                @livewire('indicador-layout', ['id_indicador' => $indicador->id, 'id_evaluacion' => $evaluacion->id])
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading_{{ $indicador->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_{{ $indicador->id }}" aria-expanded="false"
                                aria-controls="collapse_{{ $indicador->id }}">
                                <span>FORMULA DE CALCULO</span>
                            </button>
                        </h2>
                        <div id="collapse_{{ $indicador->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading_{{ $indicador->id }}" data-bs-parent="#caces">
                            <div class="accordion-body">
                                @livewire("indicador$indicador->id", ['id_indicador' => $indicador->id, 'id_evaluacion' => $evaluacion->id])
                            </div>
                        </div>
                    </div>
                    @endif
                    {{-- FIN ACORDION PARA ELEMENTOS FUNDAMENTALES --}}
                    {{-- ACORDION PARA FUENTES DE INFORMACION --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading_fi_{{ $indicador->id }}">
                            <button class="accordion-button collapsed" style="background: #697bbc" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse_fi_{{ $indicador->id }}"
                                aria-expanded="false" aria-controls="collapse_fi_{{ $indicador->id }}">
                                <span>FUENTE DE INFORMACIÓN</span>
                            </button>
                        </h2>
                        <div id="collapse_fi_{{ $indicador->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading_fi_{{ $indicador->id }}" data-bs-parent="#caces">
                            <div class="accordion-body">
                                @livewire('fuente-layout', ['id_indicador' => $indicador->id, 'id_evaluacion' => $evaluacion->id])
                            </div>
                        </div>
                    </div>
                    {{-- ACCIONES DE MEJORA - Desactivado temporalmente (tabla tareas no existe)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading_tarea_{{ $indicador->id }}">
                            <button class="accordion-button collapsed" style="background: #c84239" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_tarea_{{ $indicador->id }}" aria-expanded="false"
                                aria-controls="collapse_{{ $indicador->id }}">
                                <span>ACCIONES DE MEJORA</span>
                            </button>
                        </h2>
                        <div id="collapse_tarea_{{ $indicador->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading_{{ $indicador->id }}" data-bs-parent="#caces">
                            <div class="accordion-body">
                                @livewire("tareas-layout",[$indicador->id,$evaluacion->id])
                            </div>
                        </div>
                    </div>
                    --}}
                    {{-- FIN ACORDION PARA FUENTES DE INFORMACION --}}
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @endforeach
        @else
        @foreach ($indicadors as $indicador)
        @php
        $ind_cri_id=$indicador->criterio->id;
        @endphp
        @if ((auth()->user()->can("$evaluacion->id/$ind_cri_id")&&auth()->user()->hasRole('CriteriaR'))||auth()->user()->can('admin') || auth()->user()->can("$evaluacion->id-$indicador->id") || auth()->user()->can("CriteriaR")||auth()->user()->hasRole('Viewer') || auth()->user()->hasRole('SedeR'))
        <div class="card-body" id="indicador_{{ $indicador->id }}" style="padding-top: 25px;">
            <h5 class="card-title mt-3" style="color: #0c63e4">{{ $indicador->indicador }} <b
                    style="margin-left: 20px; color: red;">{{ $indicador->porcentaje }} %</b>
            </h5>
            <span><b>ESTANDAR</b></span>
            <p class="card-text">{{ $indicador->estandar }}</p>
            <span><b>PERÍODO DE EVALUACIÓN</b></span>
            <p class="card-text">{{ $indicador->periodo }}</p>
            <div class="accordion">
                {{-- ACORDION PARA ELEMENTOS FUNDAMENTALES --}}
                @if (!$indicador->elemento_fundamentals->isEmpty())
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_{{ $indicador->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse_{{ $indicador->id }}" aria-expanded="false"
                            aria-controls="collapse_{{ $indicador->id }}">
                            <span>ELEMENTOS FUNDAMENTALES</span>
                        </button>
                    </h2>
                    <div id="collapse_{{ $indicador->id }}" class="accordion-collapse collapse"
                        aria-labelledby="heading_{{ $indicador->id }}" data-bs-parent="#caces">
                        <div class="accordion-body">
                            @livewire('indicador-layout', ['id_indicador' => $indicador->id, 'id_evaluacion' => $evaluacion->id])
                        </div>
                    </div>
                </div>
                @else
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_{{ $indicador->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse_{{ $indicador->id }}" aria-expanded="false"
                            aria-controls="collapse_{{ $indicador->id }}">
                            <span>FORMULA DE CALCULO</span>
                        </button>
                    </h2>
                    <div id="collapse_{{ $indicador->id }}" class="accordion-collapse collapse"
                        aria-labelledby="heading_{{ $indicador->id }}" data-bs-parent="#caces">
                        <div class="accordion-body">
                            @livewire("indicador$indicador->id", ['id_indicador' => $indicador->id, 'id_evaluacion' => $evaluacion->id])
                        </div>
                    </div>
                </div>
                @endif
                {{-- FIN ACORDION PARA ELEMENTOS FUNDAMENTALES --}}
                {{-- ACORDION PARA FUENTES DE INFORMACION --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_fi_{{ $indicador->id }}">
                        <button class="accordion-button collapsed" style="background: #697bbc" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse_fi_{{ $indicador->id }}"
                            aria-expanded="false" aria-controls="collapse_fi_{{ $indicador->id }}">
                            <span>FUENTE DE INFORMACIÓN</span>
                        </button>
                    </h2>
                    <div id="collapse_fi_{{ $indicador->id }}" class="accordion-collapse collapse"
                        aria-labelledby="heading_fi_{{ $indicador->id }}" data-bs-parent="#caces">
                        <div class="accordion-body">
                            @livewire('fuente-layout', ['id_indicador' => $indicador->id, 'id_evaluacion' => $evaluacion->id])
                        </div>
                    </div>
                </div>
                {{-- ACCIONES DE MEJORA - Desactivado temporalmente (tabla tareas no existe)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_tarea_{{ $indicador->id }}">
                        <button class="accordion-button collapsed" style="background: #c84239" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse_tarea_{{ $indicador->id }}" aria-expanded="false"
                            aria-controls="collapse_{{ $indicador->id }}">
                            <span>ACCIONES DE MEJORA</span>
                        </button>
                    </h2>
                    <div id="collapse_tarea_{{ $indicador->id }}" class="accordion-collapse collapse"
                        aria-labelledby="heading_{{ $indicador->id }}" data-bs-parent="#caces">
                        <div class="accordion-body">
                            @livewire("tareas-layout",[$indicador->id,$evaluacion->id])
                        </div>
                    </div>
                </div>
                --}}
                {{-- FIN ACORDION PARA FUENTES DE INFORMACION --}}
            </div>
        </div>
        @endif
        @endforeach
        @endif

    </div>
    <div class="col-sm-1" style="width: 5%">
        <aside id="sidebar" class="" style="position: fixed">
            <ul class="sidebar-nav" id="sidebar-nav">
                @foreach ($indicadores as $indicador)
                <li class="nav-item">
                    <a class="nav-link collapsed" id="inicio" href="#indicador_{{$indicador->id}}">
                        <i class="bi bi-arrow-return-left"></i><span>{{$indicador->id}}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </aside>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.getElementById('criterio_{{$criterio->id}}').classList.remove('collapsed');
    Livewire.on('refresh', () => {
        location.reload();
    });
</script>
@endpush