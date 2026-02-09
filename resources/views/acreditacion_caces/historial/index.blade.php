@extends('layouts.modern')

@section('title', 'Análisis Histórico')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Sedes</a></li>
    <li class="breadcrumb-item active">Análisis Histórico</li>
@endsection

@section('content')
<div class="page-header animate-fade-in">
    <div>
        <h1>Análisis Histórico de Elementos Fundamentales</h1>
        <p class="text-muted mb-0">Comparativa de valoraciones entre períodos de evaluación</p>
    </div>
</div>

@php
    $totalCriterios = count($criterios) - 1;
@endphp
@foreach ($criterios as $criterio)
    @if (!$loop->last)
        <div class="card-modern mb-4 animate-fade-in">
            <div class="card-header" style="background: var(--espe-green); color: white;">
                <h5 class="mb-0">
                    <i class="bi bi-clipboard-data me-2"></i>CRITERIO {{ $criterio->id }}: {{ $criterio->criterio }}
                </h5>
            </div>
            <div class="card-body">
                    @if ($criterio->subcriterios->isEmpty())
                        <div class="alert alert-warning mb-3">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            No hay subcriterios registrados para este criterio.
                        </div>
                        @if ($criterio->indicadors->isEmpty())
                            <div class="alert alert-warning mb-0">
                                <i class="bi bi-exclamation-triangle me-1"></i>
                                No hay indicadores registrados para este criterio.
                            </div>
                        @else
                            @foreach ($criterio->indicadors as $indicador)
                                <h6 class="fw-medium text-muted mb-3"><i class="bi bi-graph-up me-1"></i>{{ $indicador->indicador }}</h6>
                                <div class="table-responsive mb-4">
                                <table class="table-modern">
                                    <thead>
                                        <tr>
                                            <th width=''>No</th>
                                            <th width=''>Elementos fundamentales</th>
                                            @foreach ($evaluaciones as $evaluacion)
                                                <th width='100px'>{{ $evaluacion->fecha_creacion }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($indicador->id == 29)
                                            <tr>
                                                <td>1</td>
                                                <td><strong>IPV:</strong> Relación de proyectos de vinculación con la
                                                    sociedad con la oferta académica.</td>
                                                @foreach ($evaluaciones as $evaluacion)
                                                    <td>
                                                    @if ($indicador->resultados && $indicador->resultados->where('eva_id', $evaluacion->id)->first())
                                                            @switch($indicador->criterio->where('eva_id',
                                                                $evaluacion->id)->first()->valoracion_29)
                                                                @case('SATISFACTORIO')
                                                                    <div class="badge bg-success">
                                                                        SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('CUASI SATISFACTORIO')
                                                                    <div class="badge bg-success">
                                                                        CUASI SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('POCO SATISFACTORIO')
                                                                    <div class="badge bg-danger">
                                                                        POCO SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('DEFICIENTE')
                                                                    <div class="badge bg-danger">
                                                                        DEFICIENTE
                                                                    </div>
                                                                @break

                                                                @default
                                                                    <div class="badge bg-secundary">
                                                                        SIN EVALUACIÓN
                                                                    </div>
                                                            @endswitch
                                                        @endif
                                                    </td>
                                                @endforeach

                                            </tr>
                                        @endif
                                        @php
                                            $totalElementos = count($indicador->elemento_fundamentals);
                                        @endphp
                                        @foreach ($indicador->elemento_fundamentals as $elementoFundamental)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $elementoFundamental->elemento }}</td>
                                                @foreach ($evaluaciones as $evaluacion)
                                                    <td>
                                                    @if ($indicador->resultados && $indicador->resultados->where('eva_id', $evaluacion->id)->first())
                                                            @switch($elementoFundamental->resultados->where('eva_id',
                                                                $evaluacion->id)->first()->valoracion)
                                                                @case('100')
                                                                    <div class="badge bg-success">
                                                                        SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('0')
                                                                    <div class="badge bg-danger">
                                                                        DEFICIENTE
                                                                    </div>
                                                                @break

                                                                @default
                                                                    <div class="badge bg-secundary">
                                                                        SIN EVALUACIÓN
                                                                    </div>
                                                            @endswitch
                                                        @endif
                                                        @if ($indicador->resultados && $indicador->resultados->where('eva_id', $evaluacion->id)->first()->valoracion))
                                                            @switch($elementoFundamental->resultados->where('eva_id',
                                                                $evaluacion->id)->first()->valoracion)
                                                                @case('100')
                                                                    <div class="badge bg-success">
                                                                        SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('75')
                                                                    <div class="badge bg-success">
                                                                        CUASI SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('50')
                                                                    <div class="badge bg-danger">
                                                                        POCO SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('25')
                                                                    <div class="badge bg-danger">
                                                                        DEFICIENTE
                                                                    </div>
                                                                @break

                                                                @default
                                                                    <div class="badge bg-secundary">
                                                                        SIN EVALUACIÓN
                                                                    </div>
                                                            @endswitch
                                                        @endif
                                                        @if (isset($elementoFundamental->resultados->where('eva_id', $evaluacion->id)->first()->valoracion))
                                                            @switch($elementoFundamental->resultados->where('eva_id',
                                                                $evaluacion->id)->first()->valoracion)
                                                                @case('100')
                                                                    <div class="badge bg-success">
                                                                        SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('75')
                                                                    <div class="badge bg-success">
                                                                        CUASI SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('50')
                                                                    <div class="badge bg-danger">
                                                                        POCO SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('25')
                                                                    <div class="badge bg-danger">
                                                                        DEFICIENTE
                                                                    </div>
                                                                @break

                                                                @default
                                                                    <div class="badge bg-secundary">
                                                                        SIN EVALUACIÓN
                                                                    </div>
                                                            @endswitch
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        @endif
                    @else
                        @foreach ($criterio->subcriterios as $subcriterio)
                            <h5>{{ $subcriterio->subcriterio }}</h5>
                            @foreach ($subcriterio->indicadors as $indicador)
                                <h6 class="text-crear">{{ $indicador->indicador }}</h6>
                                <table class="table table-hover align-middle text-uppercase pt-2 pb-2">
                                    <thead class="table-pacifico">
                                        <tr>
                                            <th width=''>No</th>
                                            <th width=''>Elementos fundamentales</th>
                                            @foreach ($evaluaciones as $evaluacion)
                                                <th width='100px'>{{ $evaluacion->fecha_creacion }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($indicador->id == 16)
                                            <tr>
                                                <td>1</td>
                                                <td><strong>TPAFD:</strong> Tasa de personal académico con formación doctoral.</td>
                                                @foreach ($evaluaciones as $evaluacion)
                                                    <td>
                                                    @if ($indicador->resultados && $indicador->resultados->where('eva_id', $evaluacion->id)->first())
    {{ $indicador->resultados->where('eva_id', $evaluacion->id)->first()->valoracion_16 }}


                                                            @switch($indicador->resultados->where('eva_id',
                                                                $evaluacion->id)->first()->valoracion_16)
                                                                @case('SATISFACTORIO')
                                                                    <div class="badge bg-success">
                                                                        SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('CUASI SATISFACTORIO')
                                                                    <div class="badge bg-success">
                                                                        CUASI SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('POCO SATISFACTORIO')
                                                                    <div class="badge bg-danger">
                                                                        POCO SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('DEFICIENTE')
                                                                    <div class="badge bg-danger">
                                                                        DEFICIENTE
                                                                    </div>
                                                                @break

                                                                @default
                                                                    <div class="badge bg-secundary">
                                                                        SIN EVALUACIÓN
                                                                    </div>
                                                            @endswitch
                                                        @endif
                                                    </td>
                                                @endforeach

                                            </tr>
                                        @endif
                                        @if ($indicador->id == 17)
                                            <tr>
                                                <td>1</td>
                                                <td><strong>TPTC:</strong> Tasa del personal académico con dedicación a tiempo completo</td>
                                                @foreach ($evaluaciones as $evaluacion)
                                                    <td>
                                                    @if ($indicador->resultados && $indicador->resultados->where('eva_id', $evaluacion->id)->first())
    {{ $indicador->resultados->where('eva_id', $evaluacion->id)->first()->valoracion_17 }}



                                                            @switch($indicador->resultados->where('eva_id',
                                                                $evaluacion->id)->first()->valoracion_17)
                                                                @case('SATISFACTORIO')
                                                                    <div class="badge bg-success">
                                                                        SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('CUASI SATISFACTORIO')
                                                                    <div class="badge bg-success">
                                                                        CUASI SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('POCO SATISFACTORIO')
                                                                    <div class="badge bg-danger">
                                                                        POCO SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('DEFICIENTE')
                                                                    <div class="badge bg-danger">
                                                                        DEFICIENTE
                                                                    </div>
                                                                @break

                                                                @default
                                                                    <div class="badge bg-secundary">
                                                                        SIN EVALUACIÓN
                                                                    </div>
                                                            @endswitch
                                                        @endif
                                                    </td>
                                                @endforeach

                                            </tr>
                                        @endif
                                        @if ($indicador->id == 19)
                                            <tr>
                                                <td>1</td>
                                                <td><strong>TDG2:</strong> Tasa de deserción institucional de oferta académica de grado al segundo año.</td>
                                                @foreach ($evaluaciones as $evaluacion)
                                                    <td>
                                                    @if ($indicador->resultados && $indicador->resultados->where('eva_id', $evaluacion->id)->first())
    {{ $indicador->resultados->where('eva_id', $evaluacion->id)->first()->valoracion_19 }}


                                                            @switch($indicador->resultados->where('eva_id',
                                                                $evaluacion->id)->first()->valoracion_19)
                                                                @case('SATISFACTORIO')
                                                                    <div class="badge bg-success">
                                                                        SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('CUASI SATISFACTORIO')
                                                                    <div class="badge bg-success">
                                                                        CUASI SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('POCO SATISFACTORIO')
                                                                    <div class="badge bg-danger">
                                                                        POCO SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('DEFICIENTE')
                                                                    <div class="badge bg-danger">
                                                                        DEFICIENTE
                                                                    </div>
                                                                @break

                                                                @default
                                                                    <div class="badge bg-secundary">
                                                                        SIN EVALUACIÓN
                                                                    </div>
                                                            @endswitch
                                                        @endif
                                                    </td>
                                                @endforeach

                                            </tr>
                                        @endif
                                        @if ($indicador->id == 21)
                                            <tr>
                                                <td>1</td>
                                                <td><strong>TTG:</strong> Tasa promedio de titulación institucional de grado.</td>
                                                @foreach ($evaluaciones as $evaluacion)
                                                    <td>
                                                        @if ($indicador->resultados && $indicador->resultados->where('eva_id', $evaluacion->id)->first())
                                                        {{ $indicador->resultados->where('eva_id', $evaluacion->id)->first()->valoracion_21 }}

                                                            @switch($indicador->resultados->where('eva_id',
                                                                $evaluacion->id)->first()->valoracion_21)
                                                                @case('SATISFACTORIO')
                                                                    <div class="badge bg-success">
                                                                        SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('CUASI SATISFACTORIO')
                                                                    <div class="badge bg-success">
                                                                        CUASI SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('POCO SATISFACTORIO')
                                                                    <div class="badge bg-danger">
                                                                        POCO SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('DEFICIENTE')
                                                                    <div class="badge bg-danger">
                                                                        DEFICIENTE
                                                                    </div>
                                                                @break

                                                                @default
                                                                    <div class="badge bg-secundary">
                                                                        SIN EVALUACIÓN
                                                                    </div>
                                                            @endswitch
                                                        @endif
                                                    </td>
                                                @endforeach

                                            </tr>
                                        @endif
                                        @if ($indicador->id == 22)
                                            <tr>
                                                <td>1</td>
                                                <td><strong>TTP:</strong>  Tasa promedio de titulación institucional de posgrado.</td>
                                                @foreach ($evaluaciones as $evaluacion)
                                                    <td>
                                                        @if ($indicador->resultados && $indicador->resultados->where('eva_id', $evaluacion->id)->first())
                                                        {{ $indicador->resultados->where('eva_id', $evaluacion->id)->first()->valoracion_22 }}

                                                            @switch($indicador->resultados->where('eva_id',
                                                                $evaluacion->id)->first()->valoracion_22)
                                                                @case('SATISFACTORIO')
                                                                    <div class="badge bg-success">
                                                                        SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('CUASI SATISFACTORIO')
                                                                    <div class="badge bg-success">
                                                                        CUASI SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('POCO SATISFACTORIO')
                                                                    <div class="badge bg-danger">
                                                                        POCO SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('DEFICIENTE')
                                                                    <div class="badge bg-danger">
                                                                        DEFICIENTE
                                                                    </div>
                                                                @break

                                                                @default
                                                                    <div class="badge bg-secundary">
                                                                        SIN EVALUACIÓN
                                                                    </div>
                                                            @endswitch
                                                        @endif
                                                    </td>
                                                @endforeach

                                            </tr>
                                        @endif
                                        @if ($indicador->id == 25)
                                            <tr>
                                                <td>1</td>
                                                <td><strong>IP:</strong> Porcentaje de proyectos concluidos o en ejecución con financiamiento externo o en redes respecto al total de proyectos de la UEP.</td>
                                                @foreach ($evaluaciones as $evaluacion)
                                                    <td>
                                                        @if ($indicador->resultados && $indicador->resultados->where('eva_id', $evaluacion->id)->first()))
                                                        {{ $indicador->resultados->where('eva_id', $evaluacion->id)->first()->valoracion_25 }}

                                                            @switch($indicador->resultados->where('eva_id',
                                                                $evaluacion->id)->first()->valoracion_25)
                                                                @case('SATISFACTORIO')
                                                                    <div class="badge bg-success">
                                                                        SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('CUASI SATISFACTORIO')
                                                                    <div class="badge bg-success">
                                                                        CUASI SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('POCO SATISFACTORIO')
                                                                    <div class="badge bg-danger">
                                                                        POCO SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('DEFICIENTE')
                                                                    <div class="badge bg-danger">
                                                                        DEFICIENTE
                                                                    </div>
                                                                @break

                                                                @default
                                                                    <div class="badge bg-secundary">
                                                                        SIN EVALUACIÓN
                                                                    </div>
                                                            @endswitch
                                                        @endif
                                                    </td>
                                                @endforeach

                                            </tr>
                                        @endif
                                        @if ($indicador->id == 26)
                                            <tr>
                                                <td>1</td>
                                                <td><strong>IP:</strong> Índice de producción académica per cápita.</td>
                                                @foreach ($evaluaciones as $evaluacion)
                                                    <td>
                                                        @if ($indicador->resultados && $indicador->resultados->where('eva_id', $evaluacion->id)->first())
                                                        {{ $indicador->resultados->where('eva_id', $evaluacion->id)->first()->valoracion_26 }}

                                                            @switch($indicador->resultados->where('eva_id',
                                                                $evaluacion->id)->first()->valoracion_26)
                                                                @case('SATISFACTORIO')
                                                                    <div class="badge bg-success">
                                                                        SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('CUASI SATISFACTORIO')
                                                                    <div class="badge bg-success">
                                                                        CUASI SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('POCO SATISFACTORIO')
                                                                    <div class="badge bg-danger">
                                                                        POCO SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('DEFICIENTE')
                                                                    <div class="badge bg-danger">
                                                                        DEFICIENTE
                                                                    </div>
                                                                @break

                                                                @default
                                                                    <div class="badge bg-secundary">
                                                                        SIN EVALUACIÓN
                                                                    </div>
                                                            @endswitch
                                                        @endif
                                                    </td>
                                                @endforeach

                                            </tr>
                                        @endif
                                        @php
                                            $totalElementos = count($indicador->elemento_fundamentals);
                                        @endphp
                                        @foreach ($indicador->elemento_fundamentals as $elementoFundamental)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $elementoFundamental->elemento }}</td>
                                                @foreach ($evaluaciones as $evaluacion)
                                                    <td>
                                                    @if ($indicador->resultados && $indicador->resultados->where('eva_id', $evaluacion->id)->first())
                                                    {{ $indicador->resultados->where('eva_id', $evaluacion->id)->first()->valoracion }}

                                                            @switch($elementoFundamental->resultados->where('eva_id',
                                                                $evaluacion->id)->first()->valoracion)
                                                                @case('100')
                                                                    <div class="badge bg-success">
                                                                        SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('75')
                                                                    <div class="badge bg-success">
                                                                        CUASI SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('50')
                                                                    <div class="badge bg-danger">
                                                                        POCO SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('25')
                                                                    <div class="badge bg-danger">
                                                                        DEFICIENTE
                                                                    </div>
                                                                @break

                                                                @default
                                                                    <div class="badge bg-secundary">
                                                                        SIN EVALUACIÓN
                                                                    </div>
                                                            @endswitch
                                                        @endif
                                                        @if (isset($elementoFundamental->resultados->where('eva_id', $evaluacion->id)->first()->valoracion))
                                                            @switch($elementoFundamental->resultados->where('eva_id',
                                                                $evaluacion->id)->first()->valoracion)
                                                                @case('100')
                                                                    <div class="badge bg-success">
                                                                        SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('75')
                                                                    <div class="badge bg-success">
                                                                        CUASI SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('50')
                                                                    <div class="badge bg-danger">
                                                                        POCO SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('25')
                                                                    <div class="badge bg-danger">
                                                                        DEFICIENTE
                                                                    </div>
                                                                @break

                                                                @default
                                                                    <div class="badge bg-secundary">
                                                                        SIN EVALUACIÓN
                                                                    </div>
                                                            @endswitch
                                                        @endif
                                                        @if (isset($elementoFundamental->resultados->where('eva_id', $evaluacion->id)->first()->valoracion))
                                                            @switch($elementoFundamental->resultados->where('eva_id',
                                                                $evaluacion->id)->first()->valoracion)
                                                                @case('100')
                                                                    <div class="badge bg-success">
                                                                        SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('75')
                                                                    <div class="badge bg-success">
                                                                        CUASI SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('50')
                                                                    <div class="badge bg-danger">
                                                                        POCO SATISFACTORIO
                                                                    </div>
                                                                @break

                                                                @case('25')
                                                                    <div class="badge bg-danger">
                                                                        DEFICIENTE
                                                                    </div>
                                                                @break

                                                                @default
                                                                    <div class="badge bg-secundary">
                                                                        SIN EVALUACIÓN
                                                                    </div>
                                                            @endswitch
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        @endforeach
                    @endif
                </div>
            </div>
        @endif
    @endforeach
@endsection
