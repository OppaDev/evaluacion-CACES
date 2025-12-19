@extends('layouts.caces')
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('content')
    <div class="pagetitle">
        <h3>CONDICIONES DEL PERSONAL ACADÉMICO, APOYO ACADÉMICO Y ESTUDIANTES <b
                style="margin-left: 20px; color: red">{{ $criterio->porcentaje }} %</b></h3>
        <form action="#" method="post" enctype="multipart/form-data">
            @csrf
            @foreach ($sub_criterios as $sub_criterio)
                @if ($loop->index == 0)
                    <div class="card">
                        <div class="card-header">
                            {{ $sub_criterio->subcriterio }} <b
                                style="margin-left: 20px; color: red">{{ $sub_criterio->porcentaje }} %</b>
                        </div>
                        @foreach ($sub_criterio->indicadores as $indicador)
                            @if ($loop->index == 0 || $loop->index == 1 || $loop->index == 2)
                                <div class="card-body">
                                    <h5 class="card-title">{{ $indicador->indicador }} <b
                                            style="margin-left: 20px; color: red">{{ $indicador->porcentaje }} %</b> </h5>
                                    <span><b>ESTANDAR</b></span>
                                    <p class="card-text">{{ $indicador->estandar }}</p>
                                    <span><b>PERÍODO DE EVALUACIÓN</b></span>
                                    <p class="card-text">{{ $indicador->periodo }}</p>
                                    <span><b>ELEMENTOS FUNDAMENTALES</b></span>
                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr class="table-light">
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    <button type="button" class="btn btn-actualizar" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="La Institución cumple con el estándar de forma completa y consistente a traves de todos sus elementos fundamentales">
                                                        S
                                                    </button>
                                                    <button type="button" class="btn btn-actualizar" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="La Institución cumple con el estándar; sin embargo registra debilidades en el cumplimiento de los elementos fundamentales los cuales se encuentran en proceso de mejorar para alcanzar el estándar">
                                                        CS
                                                    </button>
                                                    <button type="button" class="btn btn-eliminar" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="La institución registra debilidades en el cumplimiento de los elementos fundamentales, los cuales no se encuentran en proceso de mejora o los mismos no son suficientes para alcanzar el estándar">
                                                        PS
                                                    </button>
                                                    <button type="button" class="btn btn-eliminar" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="La institución no cumple con el estándar">
                                                        D
                                                    </button>
                                                </th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <th>No</th>
                                                <th>Elemento</th>
                                                <th>Porcentaje</th>
                                                <th style="width: 230px">Valoración</th>
                                                <th style="width: 230px">Comentario</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($indicador->elementosFundamentales as $elementoFundamental)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $elementoFundamental->elemento }} <br> <strong>Puntuación: </strong><span
                                                        class="text-danger text-center">{{ $elementoFundamental->porcentaje }}
                                                        %</span></td>
                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text" id="basic-addon1">%</span>
                                                        <input type="number" class="form-control resultado"
                                                            style="background-color: #fff" value="0" readonly>
                                                    </div>
                                                    <input type="number" id="porcentElemento" class="porcentajeElemento"
                                                        value="{{ $elementoFundamental->porcentaje }}" hidden>
                                                </td>
                                                    <td>
                                                        <select class="selectEscala form-select form-select-sm"
                                                            aria-label=".form-select-sm example">
                                                            <option selected>Seleccionar...</option>
                                                            @foreach ($escalas as $escala)
                                                                <option value="{{ $escala->porcentaje }}">
                                                                    {{ $escala->escala }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <textarea class="comentario form-control" rows="2" placeholder="Comentario"></textarea>
                                                            {{-- <input type="number" class="resultado" value="0"> --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <span><b>FUENTE DE INFORMACIÓN</b></span>
                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr>
                                                <th>No</th>
                                                <th>Fuente</th>
                                                <th style="width: 230px">Archivo</th>
                                                <th style="width: 230px">Comentario</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($indicador->fuentesInformaciones as $fuenteInformacion)
                                                <tr>
                                                    <td>{{ chr($loop->index + 65) }}</td>
                                                    <td>{{ $fuenteInformacion->documento }}</td>
                                                    <td>
                                                        <div class="mb-3">
                                                            <input class="form-control form-control-sm" id="formFileSm"
                                                                type="file">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <textarea class="form-control" rows="2" placeholder="Comentario"></textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            @if ($loop->index == 3)
                                <div class="card-body">
                                    <h5 class="card-title">{{ $indicador->indicador }} <b
                                            style="margin-left: 20px; color: red;">{{ $indicador->porcentaje }} %</b></h5>
                                    <span><b>ESTANDAR para UEP con oferta académica de grado y posgrado</b></span>
                                    <p class="card-text">La institución cuenta con una tasa de formación doctoral de al
                                        menos el 20% de su
                                        personal académico.</p>
                                    <span><b>ESTANDAR para UEP con oferta académica únicamente de posgrado</b></span>
                                    <p class="card-text">La institución cuenta con una tasa de formación doctoral de al
                                        menos el 80% de su
                                        personal académico.</p>
                                    <span><b>PERÍODO DE EVALUACIÓN</b></span>
                                    <p class="card-text">Los periodos académicos concluidos en el año previo al inicio
                                        del proceso de
                                        evaluación.</p>

                                    <div class="container text-center">
                                        <img src="{{ asset('img/indicador16.png') }}"width="250" height="150"
                                            alt="indicador16" class="img-fluid mx-auto">
                                    </div>

                                    <span><b>FORMA DE CÁLCULO</b></span>
                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr>
                                                <th>No</th>
                                                <th>Término</th>
                                                <th style="width: 230px">Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>1</td>
                                                <td>TPAFD: Tasa de personal académico con formación doctoral.</td>
                                                <td><input disabled type="number" id="ind16TPAFD" value="0"
                                                        oninput="calcularTotalIndicador16()">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>TPhd: Total del Personal académico con formación doctoral vinculado en el período de evaluación.</td>
                                                <td><input type="number" id="ind16TPhd" value="0"
                                                        oninput="calcularTotalIndicador16()">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>TP: Total del Personal académico de la institución vinculado en el período de evaluación.
                                                </td>
                                                <td><input type="number" id="ind16TP" value="0"
                                                        oninput="calcularTotalIndicador16()">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <span><b>LINEAMIENTOS</b></span>

                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr>
                                                <th>No</th>
                                                <th>Lineamiento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lineamientos16 as $lineamiento)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $lineamiento->lineamiento }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>


                                    <span><b>FUENTE DE INFORMACIÓN</b></span>
                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr>
                                                <th>No</th>
                                                <th>Fuente</th>
                                                <th style="width: 230px">Archivo</th>
                                                <th style="width: 230px">Comentario</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($indicador->fuentesInformaciones as $fuenteInformacion)
                                                <tr>
                                                    <td>{{ chr($loop->index + 65) }}</td>
                                                    <td>{{ $fuenteInformacion->documento }}</td>
                                                    <td>
                                                        <div class="mb-3">
                                                            <input class="form-control form-control-sm" id="formFileSm"
                                                                type="file">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <textarea class="form-control" rows="2" placeholder="Comentario"></textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            @if ($loop->index == 4)
                                <div class="card-body">
                                    <h5 class="card-title">{{ $indicador->indicador }} <b
                                            style="margin-left: 20px; color: red">{{ $indicador->porcentaje }} %</b></h5>
                                    <span><b>ESTANDAR </b></span>
                                    <p class="card-text">{{ $indicador->estandar }}</p>

                                    <span><b>PERÍODO DE EVALUACIÓN</b></span>
                                    <p class="card-text">{{ $indicador->periodo }}</p>

                                    <div class="container text-center">
                                        <img src="{{ asset('img/indicador17.png') }}"width="250" height="150"
                                            alt="indicador16" class="img-fluid mx-auto">
                                    </div>

                                    <span><b>FORMA DE CÁLCULO</b></span>
                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr>
                                                <th>No</th>
                                                <th>Término</th>
                                                <th style="width: 230px">Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>1</td>
                                                <td>TPTC: Tasa de personal académico con dedicación a tiempo completo.</td>
                                                <td><input disabled type="number" id="ind17TPTC" value="0"
                                                        oninput="calcularTotalIndicador17()">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>PTC: Total del personal académico con dedicación a tiempo completo a
                                                    nivel institucional
                                                    vinculados en el período de evaluación.</td>
                                                <td><input type="number" id="ind17PTC" value="0"
                                                        oninput="calcularTotalIndicador17()">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>TP: Total del Personal académico de la institución vinculado en el
                                                    período de
                                                    evaluación.
                                                </td>
                                                <td><input type="number" id="ind17TP" value="0"
                                                        oninput="calcularTotalIndicador17()">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <span><b>LINEAMIENTOS</b></span>

                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr>
                                                <th>No</th>
                                                <th>Lineamiento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lineamientos17 as $lineamiento)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $lineamiento->lineamiento }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <span><b>FUENTE DE INFORMACIÓN</b></span>
                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr>
                                                <th>No</th>
                                                <th>Fuente</th>
                                                <th style="width: 230px">Archivo</th>
                                                <th style="width: 230px">Comentario</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($indicador->fuentesInformaciones as $fuenteInformacion)
                                                <tr>
                                                    <td>{{ chr($loop->index + 65) }}</td>
                                                    <td>{{ $fuenteInformacion->documento }}</td>
                                                    <td>
                                                        <div class="mb-3">
                                                            <input class="form-control form-control-sm" id="formFileSm"
                                                                type="file">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <textarea class="form-control" rows="2" placeholder="Comentario"></textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
                @if ($loop->index == 1)
                    <div class="card">
                        <div class="card-header">
                            {{ $sub_criterio->subcriterio }} <b
                                style="margin-left: 20px; color: red;">{{ $indicador->porcentaje }} %</b>
                        </div>
                        @foreach ($sub_criterio->indicadores as $indicador)
                            @if ($loop->index == 0 || $loop->index == 2 || $loop->index == 5)
                                <div class="card-body">
                                    <h5 class="card-title">{{ $indicador->indicador }} <b
                                            style="margin-left: 20px; color: red">{{ $indicador->porcentaje }} %</b></h5>
                                    <span><b>ESTANDAR</b></span>
                                    <p class="card-text">{{ $indicador->estandar }}</p>
                                    <span><b>PERÍODO DE EVALUACIÓN</b></span>
                                    <p class="card-text">{{ $indicador->periodo }}</p>
                                    <span><b>ELEMENTOS FUNDAMENTALES</b></span>
                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr class="table-light">
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    <button type="button" class="btn btn-actualizar" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="La Institución cumple con el estándar de forma completa y consistente a traves de todos sus elementos fundamentales">
                                                        S
                                                    </button>
                                                    <button type="button" class="btn btn-actualizar" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="La Institución cumple con el estándar; sin embargo registra debilidades en el cumplimiento de los elementos fundamentales los cuales se encuentran en proceso de mejorar para alcanzar el estándar">
                                                        CS
                                                    </button>
                                                    <button type="button" class="btn btn-eliminar" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="La institución registra debilidades en el cumplimiento de los elementos fundamentales, los cuales no se encuentran en proceso de mejora o los mismos no son suficientes para alcanzar el estándar">
                                                        PS
                                                    </button>
                                                    <button type="button" class="btn btn-eliminar" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="La institución no cumple con el estándar">
                                                        D
                                                    </button>
                                                </th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <th>No</th>
                                                <th>Elemento</th>
                                                <th>Porcentaje</th>
                                                <th style="width: 230px">Valoración</th>
                                                <th style="width: 230px">Comentario</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($indicador->elementosFundamentales as $elementoFundamental)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $elementoFundamental->elemento }} <br> <strong>Puntuación: </strong><span
                                                        class="text-danger text-center">{{ $elementoFundamental->porcentaje }}
                                                        %</span></td>
                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text" id="basic-addon1">%</span>
                                                        <input type="number" class="form-control resultado"
                                                            style="background-color: #fff" value="0" readonly>
                                                    </div>
                                                    <input type="number" id="porcentElemento" class="porcentajeElemento"
                                                        value="{{ $elementoFundamental->porcentaje }}" hidden>
                                                </td>
                                                    <td>
                                                        <select class="selectEscala form-select form-select-sm"
                                                            aria-label=".form-select-sm example">
                                                            <option selected>Seleccionar...</option>
                                                            @foreach ($escalas as $escala)
                                                                <option value="{{ $escala->porcentaje }}">
                                                                    {{ $escala->escala }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <textarea class="comentario form-control" rows="2" placeholder="Comentario"></textarea>
                                                            {{-- <input type="number" class="resultado" value="0"> --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <span><b>FUENTE DE INFORMACIÓN</b></span>
                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr>
                                                <th>No</th>
                                                <th>Fuente</th>
                                                <th style="width: 230px">Archivo</th>
                                                <th style="width: 230px">Comentario</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($indicador->fuentesInformaciones as $fuenteInformacion)
                                                <tr>
                                                    <td>{{ chr($loop->index + 65) }}</td>
                                                    <td>{{ $fuenteInformacion->documento }}</td>
                                                    <td>
                                                        <div class="mb-3">
                                                            <input class="form-control form-control-sm" id="formFileSm"
                                                                type="file">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <textarea class="form-control" rows="2" placeholder="Comentario"></textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            @if ($loop->index == 1)
                                <div class="card-body">
                                    <h5 class="card-title">{{ $indicador->indicador }} <b
                                            style="margin-left: 20px; color: red;">{{ $indicador->porcentaje }} %</b></h5>
                                    <span><b>ESTANDAR </b></span>
                                    <p class="card-text">La institución cuenta con una tasa promedio de deserción de
                                        estudiantes de grado al segundo año de máximo el 14%.</p>

                                    <span><b>PERÍODO DE EVALUACIÓN</b></span>
                                    <p class="card-text">Periodos académicos concluidos tres años antes del inicio del
                                        proceso
                                        de evaluación.</p>

                                    <div class="container text-center">
                                        <img src="{{ asset('img/indicador19.png') }}"width="250" height="150"
                                            alt="indicador16" class="img-fluid mx-auto">
                                    </div>

                                    <span><b>FORMA DE CÁLCULO</b></span>
                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr>
                                                <th>No</th>
                                                <th>Término</th>
                                                <th style="width: 230px">Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>1</td>
                                                <td>TDG2: Tasa de deserción institucional de oferta académica de grado al
                                                    segundo año.</td>
                                                <td><input type="number" id="ind19TDG2" value="0"
                                                        oninput="calcularTotalIndicador19()"></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>N: Número de cohortes iniciadas en el período de evaluación.</td>
                                                <td><input type="number" id="ind19N" value="0"
                                                        oninput="calcularTotalIndicador19()"></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Ai: Cohorte i-ésima de estudiantes que inician el primer nivel</td>
                                                <td><input type="number" id="ind19Ai" value="0"
                                                        oninput="calcularTotalIndicador19()"></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Ai+2: Cohorte i-ésima de estudiantes que inician el primer nivel</td>
                                                <td><input type="number" id="ind19Ai+2" value="0"
                                                        oninput="calcularTotalIndicador19()"></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>NEGAi+2: Número de estudiantes de grado del período A que no continuaron
                                                    sus
                                                    estudios en el período Ai + 2.</td>
                                                <td><input type="number" id="ind19NEGAi+2" value="0"
                                                        oninput="calcularTotalIndicador19()"></td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>NEGAi: Número de estudiantes de grado que iniciaron sus estudios en la
                                                    cohorte Ai.</td>
                                                <td><input type="number" id="ind19NEGAi" value="0"
                                                        oninput="calcularTotalIndicador19()"></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>Total</td>
                                                <td><input disabled type="number" id="ind19total" value="0"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <span><b>LINEAMIENTOS</b></span>

                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr>
                                                <th>No</th>
                                                <th>Lineamiento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lineamientos19 as $lineamiento)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $lineamiento->lineamiento }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <span><b>FUENTE DE INFORMACIÓN</b></span>
                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr>
                                                <th>No</th>
                                                <th>Fuente</th>
                                                <th style="width: 230px">Archivo</th>
                                                <th style="width: 230px">Comentario</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($indicador->fuentesInformaciones as $fuenteInformacion)
                                                <tr>
                                                    <td>{{ chr($loop->index + 65) }}</td>
                                                    <td>{{ $fuenteInformacion->documento }}</td>
                                                    <td>
                                                        <div class="mb-3">
                                                            <input class="form-control form-control-sm" id="formFileSm"
                                                                type="file">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <textarea class="form-control" rows="2" placeholder="Comentario"></textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            @if ($loop->index == 3)
                                <div class="card-body">
                                    <h5 class="card-title">{{ $indicador->indicador }} <b
                                            style="margin-left: 20px; color: red;">{{ $indicador->porcentaje }} %</b></h5>
                                    <span><b>ESTANDAR </b></span>
                                    <p class="card-text">La institución cuenta con una tasa promedio de titulación
                                        institucional de la oferta académica de grado de al menos el 50%.</p>

                                    <span><b>PERÍODO DE EVALUACIÓN</b></span>
                                    <p class="card-text">Corresponde al tiempo máximo de duración de las carreras de la UEP
                                        más
                                        un año adicional antes del inicio del proceso de evaluación.</p>

                                    <div class="container text-center">
                                        <img src="{{ asset('img/indicador21.png') }}"width="250" height="150"
                                            alt="indicador16" class="img-fluid mx-auto">
                                    </div>

                                    <span><b>FORMA DE CÁLCULO</b></span>
                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr>
                                                <th>No</th>
                                                <th>Término</th>
                                                <th style="width: 230px">Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>1</td>
                                                <td>TTG: Tasa promedio de titulación institucional de grado.</td>
                                                <td>
                                                    <input type="number" id="ind21TTG" value="0"
                                                        oninput="calcularTotalIndicador21()">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>N: Número de cohortes iniciadas en el período de evaluación.</td>
                                                <td>
                                                    <input type="number" id="ind21N" value="0"
                                                        oninput="calcularTotalIndicador21()">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>NEGTi: Número de estudiantes de grado matriculados en el primer nivel
                                                    que se
                                                    titularon en el plazo establecido segun el tiempo de duración de la
                                                    carrera
                                                    y hasta un año adicional en la iésima cohorte.</td>
                                                <td>
                                                    <input type="number" id="ind21NEGTi" value="0"
                                                        oninput="calcularTotalIndicador21()">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>TEGi: Total de estudiantes de grado matriculados en el primer nivel en
                                                    la
                                                    iésima cohorte.</td>
                                                <td>
                                                    <input type="number" id="ind21TEGi" value="0"
                                                        oninput="calcularTotalIndicador21()">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>Total</td>
                                                <td><input disabled type="number" id="ind21total" value="0"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <span><b>LINEAMIENTOS</b></span>

                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr>
                                                <th>No</th>
                                                <th>Lineamiento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lineamientos21 as $lineamiento)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $lineamiento->lineamiento }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <span><b>FUENTE DE INFORMACIÓN</b></span>
                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr>
                                                <th>No</th>
                                                <th>Fuente</th>
                                                <th style="width: 230px">Archivo</th>
                                                <th style="width: 230px">Comentario</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($indicador->fuentesInformaciones as $fuenteInformacion)
                                                <tr>
                                                    <td>{{ chr($loop->index + 65) }}</td>
                                                    <td>{{ $fuenteInformacion->documento }}</td>
                                                    <td>
                                                        <div class="mb-3">
                                                            <input class="form-control form-control-sm" id="formFileSm"
                                                                type="file">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <textarea class="form-control" rows="2" placeholder="Comentario"></textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            @if ($loop->index == 4)
                                <div class="card-body">
                                    <h5 class="card-title">{{ $indicador->indicador }} <b
                                            style="margin-left: 20px; color: red;">{{ $indicador->porcentaje }} %</b></h5>
                                    <span><b>ESTANDAR </b></span>
                                    <p class="card-text">La institución cuenta con una tasa promedio de titulación
                                        institucional de la oferta académica de posgrado de al menos el 82%.</p>

                                    <span><b>PERÍODO DE EVALUACIÓN</b></span>
                                    <p class="card-text">Corresponde al tiempo máximo de duración de los programas de la
                                        UEP
                                        más un año adicional antes del inicio del proceso de evaluación.</p>

                                    <div class="container text-center">
                                        <img src="{{ asset('img/indicador22.png') }}"width="250" height="150"
                                            alt="indicador16" class="img-fluid mx-auto">
                                    </div>

                                    <span><b>FORMA DE CÁLCULO</b></span>
                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr>
                                                <th>No</th>
                                                <th>Término</th>
                                                <th style="width: 230px">Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>1</td>
                                                <td>TTP: Tasa promedio de titulación institucional de posgrado.</td>
                                                <td><input type="number" id="ind22TTP" value="0"
                                                        oninput="calcularTotalIndicador22()"></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>N: Número de cohortes iniciadas en el período de evaluación.</td>
                                                <td><input type="number" id="ind22N" value="0"
                                                        oninput="calcularTotalIndicador22()"></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>NEPTi: Número de estudiantes de posgrado matriculados en el programa y
                                                    que
                                                    se titularon en el plazo establecido y hasta un año adicional en la
                                                    iésima
                                                    cohorte.</td>
                                                <td><input type="number" id="ind22NEPTi" value="0"
                                                        oninput="calcularTotalIndicador22()"></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>TECi: Total de estudiantes de posgrado matriculados en las cohortes
                                                    definidas.</td>
                                                <td><input type="number" id="ind22TECi" value="0"
                                                        oninput="calcularTotalIndicador22()"></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>Total</td>
                                                <td><input disabled type="number" id="ind22total" value="0"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <span><b>LINEAMIENTOS</b></span>

                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr>
                                                <th>No</th>
                                                <th>Lineamiento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lineamientos22 as $lineamiento)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $lineamiento->lineamiento }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <span><b>FUENTE DE INFORMACIÓN</b></span>
                                    <table class="table table-hover align-middle pt-2 pb-2">
                                        <thead class="table-pacifico text-uppercase">
                                            <tr>
                                                <th>No</th>
                                                <th>Fuente</th>
                                                <th style="width: 230px">Archivo</th>
                                                <th style="width: 230px">Comentario</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($indicador->fuentesInformaciones as $fuenteInformacion)
                                                <tr>
                                                    <td>{{ chr($loop->index + 65) }}</td>
                                                    <td>{{ $fuenteInformacion->documento }}</td>
                                                    <td>
                                                        <div class="mb-3">
                                                            <input class="form-control form-control-sm" id="formFileSm"
                                                                type="file">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <textarea class="form-control" rows="2" placeholder="Comentario"></textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            @endforeach
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        document.getElementById('personal_academico').classList.remove('collapsed');

        var ind22NInput = document.getElementById("ind22N");
        var ind22NEPTiInput = document.getElementById("ind22NEPTi");
        var ind22TECiInput = document.getElementById("ind22TECi");
        var ind22TTPInput = document.getElementById("ind22TTP");
        var ind22TotalInput = document.getElementById("ind22total");

        var ind21TTGInput = document.getElementById("ind21TTG");
        var ind21NInput = document.getElementById("ind21N");
        var ind21NEGTiInput = document.getElementById("ind21NEGTi");
        var ind21TEGiInput = document.getElementById("ind21TEGi");
        var ind21totalInput = document.getElementById("ind21total");

        var ind19TDG2Input = document.getElementById("ind19TDG2");
        var ind19NInput = document.getElementById("ind19N");
        var ind19AiInput = document.getElementById("ind19Ai");
        var ind19AiPlus2Input = document.getElementById("ind19Ai+2");
        var ind19NEGAiPlus2Input = document.getElementById("ind19NEGAi+2");
        var ind19NEGAiInput = document.getElementById("ind19NEGAi");
        var ind19TotalInput = document.getElementById("ind19total");

        var ind16TPAFDInput = document.getElementById("ind16TPAFD");
        var ind16TPhdInput = document.getElementById("ind16TPhd");
        var ind16TPInput = document.getElementById("ind16TP");

        var ind17TPTCInput = document.getElementById("ind17TPTC");
        var ind17PTCInput = document.getElementById("ind17PTC");
        var ind17TPInput = document.getElementById("ind17TP");

        var selectElements = document.querySelectorAll('.selectEscala');
        var porcentajeElements = document.querySelectorAll('.porcentajeElemento');
        var comentarios = document.querySelectorAll('.resultado');

        selectElements.forEach(function(selectElement, index) {
            selectElement.addEventListener('change', function() {
                var selectedValue = parseFloat(selectElement.value);
                var porcentaje = parseFloat(porcentajeElements[index].value);

                if (!isNaN(selectedValue) && !isNaN(porcentaje)) {
                    var resultado = selectedValue * porcentaje / 100;
                    comentarios[index].value = resultado.toFixed(3);
                } else {
                    comentarios[index].value = '';
                }
            });
        });


        function calcularTotalIndicador17() {
            var ind17PTC = parseFloat(ind17PTCInput.value) || 0;
            var ind17TP = parseFloat(ind17TPInput.value) || 0;

            var total = 100 * (ind17PTC / ind17TP);

            ind17TPTCInput.value = total;
        }

        function calcularTotalIndicador16() {
            var ind16TPhd = parseFloat(ind16TPhdInput.value) || 0;
            var ind16TP = parseFloat(ind16TPInput.value) || 0;

            var total = 100* (ind16TPhd/ ind16TP);

            ind16TPAFDInput.value = total;
        }

        function calcularTotalIndicador22() {
            var ind22N = parseFloat(ind22NInput.value) || 0;
            var ind22NEPTi = parseFloat(ind22NEPTiInput.value) || 0;
            var ind22TECi = parseFloat(ind22TECiInput.value) || 0;
            var ind22TTP = parseFloat(ind22TTPInput) || 0;

            var total = ind22N + ind22NEPTi + ind22TECi + ind22TTP;

            ind22TotalInput.value = total;
        }

        function calcularTotalIndicador21() {
            var ind21TTG = parseFloat(ind21TTGInput.value) || 0;
            var ind21N = parseFloat(ind21NInput.value) || 0;
            var ind21NEGTi = parseFloat(ind21NEGTiInput.value) || 0;
            var ind21TEGi = parseFloat(ind21TEGiInput) || 0;

            var total = ind21TTG + ind21N + ind21NEGTi + ind21TEGi;

            ind21totalInput.value = total;
        }

        function calcularTotalIndicador19() {
            var ind19TDG2 = parseFloat(ind19TDG2Input.value) || 0;
            var ind19N = parseFloat(ind19NInput.value) || 0;
            var ind19Ai = parseFloat(ind19AiInput.value) || 0;
            var ind19AiPlus2 = parseFloat(ind19AiPlus2Input.value) || 0;
            var ind19NEGAiPlus2 = parseFloat(ind19NEGAiPlus2Input.value) || 0;
            var ind19NEGAi = parseFloat(ind19NEGAiInput.value) || 0;

            var total = ind19TDG2 + ind19N + ind19Ai + ind19AiPlus2 + ind19NEGAiPlus2 + ind19NEGAi;

            ind19TotalInput.value = total;
        }

        ind17TPTCInput.addEventListener("input", calcularTotalIndicador17);
        ind17PTCInput.addEventListener("input", calcularTotalIndicador17);
        ind17TPInput.addEventListener("input", calcularTotalIndicador17);

        ind22NInput.addEventListener("input", calcularTotalIndicador22);
        ind22NEPTiInput.addEventListener("input", calcularTotalIndicador22);
        ind22TECiInput.addEventListener("input", calcularTotalIndicador22);
        ind22TTPInput.addEventListener("input", calcularTotalIndicador22);

        ind21TTGInput.addEventListener("input", calcularTotalIndicador21);
        ind21NInput.addEventListener("input", calcularTotalIndicador21);
        ind21NEGTiInput.addEventListener("input", calcularTotalIndicador21);
        ind21TEGiInput.addEventListener("input", calcularTotalIndicador21);

        ind19TDG2Input.addEventListener("input", calcularTotalIndicador19);
        ind19NInput.addEventListener("input", calcularTotalIndicador19);
        ind19AiInput.addEventListener("input", calcularTotalIndicador19);
        ind19AiPlus2Input.addEventListener("input", calcularTotalIndicador19);
        ind19NEGAiPlus2Input.addEventListener("input", calcularTotalIndicador19);
        ind19NEGAiInput.addEventListener("input", calcularTotalIndicador19);

        ind16TPAFDInput.addEventListener("input", calcularTotalIndicador16);
        ind16TPhdInput.addEventListener("input", calcularTotalIndicador16);
        ind16TPInput.addEventListener("input", calcularTotalIndicador16);

        calcularTotalIndicador17();
        calcularTotalIndicador16();
        calcularTotalIndicador22();
        calcularTotalIndicador21();
        calcularTotalIndicador19();
    </script>
@endsection
