<body>
    <h2>Informe de Acreditación CACES</h2>

    <h2>{{ $evaluacion->universidad->universidad }}</h2>
    <h2>Fecha de Evaluación: {{ $evaluacion->fecha_creacion }}</h2>
    @php
        $totalCriterios = count($criterios) - 1;
    @endphp
    @foreach ($criterios as $criterio)
        @if (!$loop->last)
            <div class="card">
                <h3 style="color: #3993fa">CRITERIO {{ $loop->index + 1 }}:
                    {{ $criterio->criterio }}</h3>
                @if ($criterio->subcriterios->isEmpty())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        No hay subcriterios registrados para este criterio.
                    </div>
                    @if ($criterio->indicadores->isEmpty())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            No hay indicadores registrados para este criterio.
                        </div>
                    @else
                        @foreach ($criterio->indicadores as $indicador)
                        <table>
                            <tr>
                                <td style="font-weight: bold; background-color: gray">
                                    {{ $indicador->indicador }}
                                </td>
                            </tr>
                        </table>
                            <table class="table table-hover align-middle text-uppercase pt-2 pb-2">
                                <thead class="table-pacifico">
                                    <tr>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            ELEMENTO
                                            FUNDAMENTAL </th>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            VALORACIÓN ACTUAL
                                        </th>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            META POR INDICADOR</th>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            ACTIVIDADES
                                        </th>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            FECHA DE INICIO
                                        </th>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            FECHA FIN
                                        </th>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            CARGO DEL RESPONSABLE</th>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            PRESUPUESTO
                                        </th>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            MODO DE VERIFICACIÓN
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($indicador->resDocentes as $resDocente)
                                        @if ($resDocente->evaluacion->fecha_creacion == $evaluacion->fecha_creacion)
                                            <tr>
                                                <td>{{ $resDocente->ElementoFundamental->elemento }}</td>
                                                    @if ($resDocente->valoracion == 100)
                                                        <td style="color: green">SATISFACTORIO</td>
                                                    @elseif($resDocente->valoracion == 0)
                                                        <td style="color: red">DEFICIENTE</td>
                                                    @endif
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($indicador->resVinculacions as $resVinculacion)
                                        @if ($resVinculacion->evaluacion->fecha_creacion == $evaluacion->fecha_creacion)
                                            <tr>
                                                <td>{{ $resVinculacion->ElementoFundamental->elemento }}</td>
                                                    @if ($resVinculacion->valoracion == 100)
                                                        <td style="color: green">SATISFACTORIO</td>
                                                    @elseif($resVinculacion->valoracion == 75)
                                                        <td style="color: green">CUASI SATISFACTORIO</td>
                                                    @elseif($resVinculacion->valoracion == 50)
                                                        <td style="color: red">POCO SATISFACTORIO</td>
                                                    @elseif($resVinculacion->valoracion == 25)
                                                        <td style="color: red">DEFICIENTE</td>
                                                    @endif
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($indicador->resGestionCalidads as $resGestionCalidad)
                                        @if ($resGestionCalidad->evaluacion->fecha_creacion == $evaluacion->fecha_creacion)
                                            <tr>
                                                <td>{{ $resGestionCalidad->ElementoFundamental->elemento }}</td>
                                                    @if ($resGestionCalidad->valoracion == 100)
                                                        <td style="color: green">SATISFACTORIO</td>
                                                    @elseif($resGestionCalidad->valoracion == 75)
                                                        <td style="color: green">CUASI SATISFACTORIO</td>
                                                    @elseif($resGestionCalidad->valoracion == 50)
                                                        <td style="color: red">POCO SATISFACTORIO</td>
                                                    @elseif($resGestionCalidad->valoracion == 25)
                                                        <td style="color: red">DEFICIENTE</td>
                                                    @endif
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    @endif
                @else
                    @foreach ($criterio->subcriterios as $subcriterio)
                    <table>
                        <tr>
                            <td style="font-weight: bold; color: brown">
                                {{ $subcriterio->subcriterio }}
                            </td>
                        </tr>
                    </table>                    
                        @foreach ($subcriterio->indicadores as $indicador)
                            <table>
                                <tr>
                                    <td style="font-weight: bold; background-color: gray">
                                        {{ $indicador->indicador }}
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-hover align-middle text-uppercase pt-2 pb-2">
                                <thead class="table-pacifico">
                                    <tr>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            ELEMENTO
                                            FUNDAMENTAL </th>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            VALORACIÓN ACTUAL
                                        </th>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            META POR INDICADOR</th>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            ACTIVIDADES
                                        </th>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            FECHA DE INICIO
                                        </th>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            FECHA FIN
                                        </th>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            CARGO DEL RESPONSABLE</th>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            PRESUPUESTO
                                        </th>
                                        <th
                                            style="font-weight: bold; text-align: center; color: #FFFFFF; background-color: #1B295B ">
                                            MODO DE VERIFICACIÓN
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($indicador->resCondicionInstitucions as $resCondicionInstitucion)
                                        @if ($resCondicionInstitucion->evaluacion->fecha_creacion == $evaluacion->fecha_creacion)
                                            <tr>
                                                <td>{{ $resCondicionInstitucion->ElementoFundamental->elemento }}</td>
                                                    @if ($resCondicionInstitucion->valoracion == 100)
                                                        <td style="color: green">SATISFACTORIO</td>
                                                    @elseif($resCondicionInstitucion->valoracion == 75)
                                                        <td style="color: green">CUASI SATISFACTORIO</td>
                                                    @elseif($resCondicionInstitucion->valoracion == 50)
                                                        <td style="color: red">POCO SATISFACTORIO</td>
                                                    @elseif($resCondicionInstitucion->valoracion == 25)
                                                        <td style="color: red">DEFICIENTE</td>
                                                    @endif
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($indicador->resAcademicos as $resAcademico)
                                        @if ($resAcademico->evaluacion->fecha_creacion == $evaluacion->fecha_creacion)
                                            <tr>
                                                <td>{{ $resAcademico->ElementoFundamental->elemento }}</td>
                                                    @if ($resAcademico->valoracion == 100)
                                                        <td style="color: green">SATISFACTORIO</td>
                                                    @elseif($resAcademico->valoracion == 75)
                                                        <td style="color: green">CUASI SATISFACTORIO</td>
                                                    @elseif($resAcademico->valoracion == 50)
                                                        <td style="color: red">POCO SATISFACTORIO</td>
                                                    @elseif($resAcademico->valoracion == 25)
                                                        <td style="color: red">DEFICIENTE</td>
                                                    @endif
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($indicador->resInvestigacions as $resInvestigacion)
                                        @if ($resInvestigacion->evaluacion->fecha_creacion == $evaluacion->fecha_creacion)
                                            <tr>
                                                <td>{{ $resInvestigacion->ElementoFundamental->elemento }}</td>
                                                    @if ($resInvestigacion->valoracion == 100)
                                                        <td style="color: green">SATISFACTORIO</td>
                                                    @elseif($resInvestigacion->valoracion == 75)
                                                        <td style="color: green">CUASI SATISFACTORIO</td>
                                                    @elseif($resInvestigacion->valoracion == 50)
                                                        <td style="color: red">POCO SATISFACTORIO</td>
                                                    @elseif($resInvestigacion->valoracion == 25)
                                                        <td style="color: red">DEFICIENTE</td>
                                                    @endif
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($indicador->res_indicador_16 as $indicador_16)
                                        @if ($indicador_16->evaluacion->fecha_creacion == $evaluacion->fecha_creacion)
                                            <tr>
                                                <td>TPAFD: Tasa de personal académico con formación doctoral.</td>
                                                    @if ($indicador_16->valoracion_16 == 'SATISFACTORIO')
                                                        <td style="color: green">SATISFACTORIO</td>
                                                    @elseif($indicador_16->valoracion_16 == 'CUASI SATISFACTORIO')
                                                        <td style="color: green">CUASI SATISFACTORIO</td>
                                                    @elseif($indicador_16->valoracion_16 == 'POCO SATISFACTORIO')
                                                        <td style="color: red">POCO SATISFACTORIO</td>
                                                    @elseif($indicador_16->valoracion_16 == 'DEFICIENTE')
                                                        <td style="color: red">DEFICIENTE</td>
                                                    @endif
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($indicador->res_indicador_17 as $indicador_17)
                                        @if ($indicador_17->evaluacion->fecha_creacion == $evaluacion->fecha_creacion)
                                            <tr>
                                                <td>TPTC: Tasa del personal académico con dedicación a tiempo completo
                                                </td>
                                                    @if ($indicador_17->valoracion_17 == 'SATISFACTORIO')
                                                        <td style="color: green">SATISFACTORIO</td>
                                                    @elseif($indicador_17->valoracion_17 == 'CUASI SATISFACTORIO')
                                                        <td style="color: green">CUASI SATISFACTORIO</td>
                                                    @elseif($indicador_17->valoracion_17 == 'POCO SATISFACTORIO')
                                                        <td style="color: red">POCO SATISFACTORIO</td>
                                                    @elseif($indicador_17->valoracion_17 == 'DEFICIENTE')
                                                        <td style="color: red">DEFICIENTE</td>
                                                    @endif
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($indicador->res_indicador_19 as $indicador_19)
                                        @if ($indicador_19->evaluacion->fecha_creacion == $evaluacion->fecha_creacion)
                                            <tr>
                                                <td> TDG2: Tasa de deserción institucional de oferta académica de grado
                                                    al segundo año.</td>
                                                    @if ($indicador_19->valoracion_19 == 'SATISFACTORIO')
                                                        <td style="color: green">SATISFACTORIO</td>
                                                    @elseif($indicador_19->valoracion_19 == 'CUASI SATISFACTORIO')
                                                        <td style="color: green">CUASI SATISFACTORIO</td>
                                                    @elseif($indicador_19->valoracion_19 == 'POCO SATISFACTORIO')
                                                        <td style="color: red">POCO SATISFACTORIO</td>
                                                    @elseif($indicador_19->valoracion_19 == 'DEFICIENTE')
                                                        <td style="color: red">DEFICIENTE</td>
                                                    @endif
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($indicador->res_indicador_21 as $indicador_21)
                                        @if ($indicador_21->evaluacion->fecha_creacion == $evaluacion->fecha_creacion)
                                            <tr>
                                                <td>TTG: Tasa promedio de titulación institucional de grado.</td>
                                                    @if ($indicador_21->valoracion_21 == 'SATISFACTORIO')
                                                        <td style="color: green">SATISFACTORIO</td>
                                                    @elseif($indicador_21->valoracion_21 == 'CUASI SATISFACTORIO')
                                                        <td style="color: green">CUASI SATISFACTORIO</td>
                                                    @elseif($indicador_21->valoracion_21 == 'POCO SATISFACTORIO')
                                                        <td style="color: red">POCO SATISFACTORIO</td>
                                                    @elseif($indicador_21->valoracion_21 == 'DEFICIENTE')
                                                        <td style="color: red">DEFICIENTE</td>
                                                    @endif
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($indicador->res_indicador_22 as $indicador_22)
                                        @if ($indicador_22->evaluacion->fecha_creacion == $evaluacion->fecha_creacion)
                                            <tr>
                                                <td>TTP: Tasa promedio de titulación institucional de posgrado.</td>
                                                    @if ($indicador_22->valoracion_22 == 'SATISFACTORIO')
                                                        <td style="color: green">SATISFACTORIO</td>
                                                    @elseif($indicador_22->valoracion_22 == 'CUASI SATISFACTORIO')
                                                        <td style="color: green">CUASI SATISFACTORIO</td>
                                                    @elseif($indicador_22->valoracion_22 == 'POCO SATISFACTORIO')
                                                        <td style="color: red">POCO SATISFACTORIO</td>
                                                    @elseif($indicador_22->valoracion_22 == 'DEFICIENTE')
                                                        <td style="color: red">DEFICIENTE</td>
                                                    @endif
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($indicador->res_indicador_25 as $indicador_25)
                                        @if ($indicador_25->evaluacion->fecha_creacion == $evaluacion->fecha_creacion)
                                            <tr>
                                                <td> IP: Porcentaje de proyectos concluidos o en ejecución con
                                                    financiamiento externo o en redes respecto al total de proyectos de
                                                    la UEP.</td>
                                                    @if ($indicador_25->valoracion_25 == 'SATISFACTORIO')
                                                        <td style="color: green">SATISFACTORIO</td>
                                                    @elseif($indicador_25->valoracion_25 == 'CUASI SATISFACTORIO')
                                                        <td style="color: green">CUASI SATISFACTORIO</td>
                                                    @elseif($indicador_25->valoracion_25 == 'POCO SATISFACTORIO')
                                                        <td style="color: red">POCO SATISFACTORIO</td>
                                                    @elseif($indicador_25->valoracion_25 == 'DEFICIENTE')
                                                        <td style="color: red">DEFICIENTE</td>
                                                    @endif
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($indicador->res_indicador_26 as $indicador_26)
                                        @if ($indicador_26->evaluacion->fecha_creacion == $evaluacion->fecha_creacion)
                                            <tr>
                                                <td> IP: Índice de producción académica per cápita.</td>
                                                    @if ($indicador_26->valoracion_26 == 'SATISFACTORIO')
                                                        <td style="color: green">SATISFACTORIO</td>
                                                    @elseif($indicador_26->valoracion_26 == 'CUASI SATISFACTORIO')
                                                        <td style="color: green">CUASI SATISFACTORIO</td>
                                                    @elseif($indicador_26->valoracion_26 == 'POCO SATISFACTORIO')
                                                        <td style="color: red">POCO SATISFACTORIO</td>
                                                    @elseif($indicador_26->valoracion_26 == 'DEFICIENTE')
                                                        <td style="color: red">DEFICIENTE</td>
                                                    @endif
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    @endforeach
                @endif
            </div>
        @endif
    @endforeach
</body>
