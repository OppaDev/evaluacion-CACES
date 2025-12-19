@extends('layouts.caces_livewire')
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('styles')
    <style>
        body {
            padding-top: 100px;
            /* Ajusta la altura según la barra de navegación */
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
            @foreach ($sub_criterios as $sub_criterio)
                <div class="card">
                    <div class="card-header" style="font-size: 15px; color: #1B295B">
                        {{ $sub_criterio->subcriterio }} <b
                            style="margin-left: 20px; color: red;">{{ $sub_criterio->porcentaje }}
                            %</b>
                    </div>
                    @foreach ($sub_criterio->indicadores as $indicador)
                        <div class="card-body" id="indicador_{{ $indicador->id }}" style="padding-top: 25px;">
                            <h5 class="card-title mt-3" style="color: #0c63e4">{{ $indicador->indicador }} <b
                                    style="margin-left: 20px; color: red;">{{ $indicador->porcentaje }} %</b>
                            </h5>
                            <span><b>ESTANDAR</b></span>
                            <p class="card-text">{{ $indicador->estandar }}</p>
                            <span><b>PERÍODO DE EVALUACIÓN</b></span>
                            <p class="card-text">{{ $indicador->periodo }}</p>
                            <div class="accordion" id="">
                                {{-- ACORDION PARA ELEMENTOS FUNDAMENTALES --}}
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading_{{ $indicador->id }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse_{{ $indicador->id }}" aria-expanded="false"
                                            aria-controls="collapse_{{ $indicador->id }}">
                                            @if ($indicador->id == 24)
                                                <span>ELEMENTOS FUNDAMENTALES</span>
                                            @else
                                                <span>FÓRMULA DE CÁLCULO</span>
                                            @endif
                                        </button>
                                    </h2>
                                    <div id="collapse_{{ $indicador->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading_{{ $indicador->id }}" data-bs-parent="#caces">
                                        <div class="accordion-body">
                                            @php
                                                $componentName = 'criterio4.indicador' . $indicador->id;
                                            @endphp
                                            @livewire($componentName, ['id_indicador' => $indicador->id, 'id_evaluacion' => $evaluacion->id])

                                        </div>
                                    </div>
                                </div>
                                {{-- FIN ACORDION PARA ELEMENTOS FUNDAMENTALES --}}
                                {{-- ACORDION PARA FUENTES DE INFORMACION --}}
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading_fi_{{ $indicador->id }}">
                                        <button class="accordion-button collapsed" style="background: #697bbc"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse_fi_{{ $indicador->id }}" aria-expanded="false"
                                            aria-controls="collapse_fi_{{ $indicador->id }}">
                                            <span>FUENTE DE INFORMACIÓN</span>
                                        </button>
                                    </h2>
                                    <div id="collapse_fi_{{ $indicador->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading_fi_{{ $indicador->id }}" data-bs-parent="#caces">
                                        <div class="accordion-body">
                                            @php
                                                $componentName = 'criterio4.archivo-indicador' . $indicador->id;
                                            @endphp
                                            @livewire($componentName, ['id_indicador' => $indicador->id, 'id_evaluacion' => $evaluacion->id])
                                        </div>
                                    </div>
                                </div>
                                {{-- FIN ACORDION PARA FUENTES DE INFORMACION --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="col-sm-1" style="width: 5%">
            <aside id="sidebar" class="" style="position: fixed">
                <ul class="sidebar-nav" id="sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link collapsed" id="inicio" href="#indicador_24">
                            <i class="bi bi-arrow-return-left"></i><span>24</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" id="inicio" href="#indicador_25">
                            <i class="bi bi-arrow-return-left"></i><span>25</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" id="inicio" href="#indicador_26">
                            <i class="bi bi-arrow-return-left"></i><span>26</span>
                        </a>
                    </li>
                </ul>
            </aside>
        </div>
    </div>
@endsection
