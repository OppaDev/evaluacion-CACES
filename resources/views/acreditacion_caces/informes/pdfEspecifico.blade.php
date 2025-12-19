<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/3.2.2/es5/tex-mml-chtml.js"></script>
<style>
    body {
        font-family: Arial;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container {
        width: 100%;
        margin: 0 auto;
        border: 1px solid #ddd;
        padding: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header {
        text-align: center;
        padding: 10px;
    }

    .header img {
        max-width: 150px;
    }

    .header h1,
    .header h2 {
        margin: 5px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table,
    th,
    td {
        border: 1px solid #000;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
    }

    .bold {
        font-weight: bold;
    }

    .highlight {
        font-weight: bold;
        color: #000;
        background-color: #f0f0f0;
    }

    .link {
        word-break: break-all;
        color: blue;
        text-decoration: none;
    }
</style>

<body>
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="width: 25%;">
                <img src="https://www.espe.edu.ec/wp-content/uploads/2023/03/espe.png" alt="Logo ESPE" style="max-width: 100%;">
            </td>
            <td class="bold" style="text-align: center; font-size: 19px">
                <center>
                    UNIVERSIDAD DE LAS FUERZAS ARMADAS - ESPE <br>
                    Informe de Autoevaluación
                </center>
            </td>
            <td style="width: 30%; border:0; padding:0; margin:0;">
                <table style="width: 100%; margin: 0; padding:0; border:inset 0">
                    <tr>
                        <td colspan=2 style="text-align: center; border:inset 0pt; border-bottom: inset 1pt">Unidad de Planificación y Desarrollo Institucional</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;border:inset 0pt;border-right:inset 1pt">Página</td>
                        <td style="border:inset 0pt">1 de 2</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    @php
    $totalCriterios = count($criterios) - 1;
    @endphp
    @foreach ($criterios as $criterio)
    <div class="card">
        @if ($criterio->subcriterios->isEmpty())
        @foreach ($criterio->indicadors as $indicador)
        <table>
            <tr>
                <td colspan=2 class="bold">Fecha evaluación: {{$evaluacion->fecha_inicial->format("d/m/Y")}}</td>
                <td colspan=2 class="bold">Periodo evaluación: {{$evaluacion->fecha_inicial->format("d/m/Y")}}-{{$evaluacion->fecha_final->format("d/m/Y")}}</td>
            </tr>
            <tr>
                <td colspan=2 class="bold">Criterio:{{$criterio->criterio}}</td>
                <td colspan=2 class="bold">EL CRITERIO NO POSEE SUBCRITERIOS</td>
            </tr>
            <tr>
                <td colspan=2 class="bold">{{$indicador->indicador}} </td>
                <td class="bold">Tipo de Indicador</td>
                <td>
                    @if ($indicador->id==16||$indicador->id==17||$indicador->id==19||$indicador->id==21||$indicador->id==22||$indicador->id==25||$indicador->id==26||$indicador->id==29)
                    <input type="checkbox"> Cualitativo
                    <input type="checkbox" checked> Cuantitativo
                    @else
                    <input type="checkbox" checked> Cualitativo
                    <input type="checkbox"> Cuantitativo
                    @endif

                </td>
            </tr>
            <tr>
                <td class="bold">Responsable:</td>
                <td colspan="3">{{$evaluacion->user->name}}</td>
            </tr>
        </table>
        @php
        $resInd='';
        $formula='';
        switch($indicador->id){
        case 16:
        $formula=$formulas->where('ind_id',$indicador->id)->first()->formula;
        ($res_16!=null)?$resInd=$res_16->valoracion_16:$resInd='Sin Calificar';
        break;
        case 17:
        $formula=$formulas->where('ind_id',$indicador->id)->first()->formula;
        ($res_17!=null)?$resInd=$res_17->valoracion_17:$resInd='Sin Calificar';
        break;
        case 19:
        $formula=$formulas->where('ind_id',$indicador->id)->first()->formula;
        ($res_19!=null)?$resInd=$res_19->valoracion_19:$resInd='Sin Calificar';
        break;
        case 21:
        $formula=$formulas->where('ind_id',$indicador->id)->first()->formula;
        ($res_21!=null)?$resInd=$res_21->valoracion_21:$resInd='Sin Calificar';
        break;
        case 22:
        $formula=$formulas->where('ind_id',$indicador->id)->first()->formula;
        ($res_22!=null)?$resInd=$res_22->valoracion_22:$resInd='Sin Calificar';
        break;
        case 25:
        $formula=$formulas->where('ind_id',$indicador->id)->first()->formula;
        ($res_25!=null)?$resInd=$res_25->valoracion_25:$resInd='Sin Calificar';
        break;
        case 26:
        $formula=$formulas->where('ind_id',$indicador->id)->first()->formula;
        ($res_26!=null)?$resInd=$res_26->valoracion_26:$resInd='Sin Calificar';
        break;
        case 29:
        $formula=$formulas->where('ind_id',$indicador->id)->first()->formula;
        ($res_29!=null)?$resInd=$res_29->valoracion_29:$resInd='Sin Calificar';
        break;
        default:
        break;
        }
        @endphp
        <table class="table table-hover align-middle text-uppercase pt-2 pb-2">
            <thead class="table-pacifico">
                <tr>
                    <th width=''>No</th>
                    <th width=''>{{($indicador->id==16||$indicador->id==17||$indicador->id==19||$indicador->id==21||$indicador->id==22||$indicador->id==25||$indicador->id==26||$indicador->id==29)?'Fórmula':'Elementos fundamentales'}}</th>
                    <th width='100px'>Valoración</th>
                </tr>
            </thead>
            <tbody>
                @if ($indicador->elemento_fundamentals->isEmpty())
                <tr>
                    <td>{{$loop->index + 1 }}</td>
                    <td>{!!$formula!!}</td>
                    <td>{{$resInd}}</td>
                </tr>
                @endif
                @foreach ($indicador->elemento_fundamentals as $elemento)
                <tr>
                    <td>{{$loop->index + 1 }}</td>
                    <td>{{($indicador->id==16||$indicador->id==17||$indicador->id==19||$indicador->id==21||$indicador->id==22||$indicador->id==25||$indicador->id==26||$indicador->id==29)?$formula:$elemento->elemento}}</td>
                    @php
                    $aux=0;
                    $valoracion='';
                    ($indicador->id==16||$indicador->id==17||$indicador->id==19||$indicador->id==21||$indicador->id==22||$indicador->id==25||$indicador->id==26||$indicador->id==29)?$valoracion=$resInd:(($resultados->where('ele_id',$elemento->id)->first())?$aux=$resultados->where('ele_id',$elemento->id)->first()->esc_id:'Sin calificar');
                    switch($aux){
                    case 0:
                    $valoracion='Sin calificar';
                    break;
                    case 1:
                    $valoracion='Satisfactorio';
                    break;
                    case 2:
                    $valoracion='Cuasi Satisfactorio';
                    break;
                    case 3:
                    $valoracion='Poco Satisfactorio';
                    break;
                    case 4:
                    $valoracion='Deficiente';
                    break;
                    }
                    @endphp
                    <td>{{$valoracion}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table>
            <tr>
                <td>Estandar:</br>{{$indicador->estandar}}</td>
            </tr>
            <tr>
                <td>Resultado:</br>{{($indicador->resIndicador->where('eva_id',$evaluacion->id)->first()!=null)?$indicador->resIndicador->where('eva_id',$evaluacion->id)->first()->resultado:'Sin resultado registrado'}}</td>
            </tr>
            <tr>
                <td>Fortalezas:</br>{{($indicador->resIndicador->where('eva_id',$evaluacion->id)->first()!=null)?$indicador->resIndicador->where('eva_id',$evaluacion->id)->first()->fortalezas:'Sin fortalezas registradas'}}</td>
            </tr>
            <tr>
                <td>Debilidades:</br>{{($indicador->resIndicador->where('eva_id',$evaluacion->id)->first()!=null)?$indicador->resIndicador->where('eva_id',$evaluacion->id)->first()->debilidades:'Sin debilidades registradas'}}</td>
            </tr>
            <tr>
                <td>Nudo Crítico:</br>{{($indicador->resIndicador->where('eva_id',$evaluacion->id)->first()!=null)?$indicador->resIndicador->where('eva_id',$evaluacion->id)->first()->nudo:'Sin nudo crítico registrado'}}</td>
            </tr>
            <tr>
                @php
                $concaux="res_$indicador->id";
                @endphp
                <td>Escala de Valoración </br>{{$resPorIndicador[$indicador->id]['val']}}</td>
            </tr>
            <tr>
                @php
                $concaux="res_$indicador->id";
                @endphp
                <td>Calificación de indicador </br>{{$resPorIndicador[$indicador->id]['cal']}}</td>
            </tr>
            <tr>
                <td>Justificación:</br>{{($indicador->resIndicador->where('eva_id',$evaluacion->id)->first()!=null)?$indicador->resIndicador->where('eva_id',$evaluacion->id)->first()->justificacion:'Sin justificación registrada'}}</td>
            </tr>
        </table>
        @endforeach
        @else
        @foreach ($criterio->subcriterios as $subcriterio)
        @foreach ($subcriterio->indicadors as $indicador)
        <table>
            <tr>
                <td colspan=2 class="bold">Fecha evaluación: {{$evaluacion->fecha_inicial->format("d/m/Y")}}</td>
                <td colspan=2 class="bold">Periodo evaluación: {{$evaluacion->fecha_inicial->format("d/m/Y")}}-{{$evaluacion->fecha_final->format("d/m/Y")}}</td>
            </tr>
            <tr>
                <td colspan=2 class="bold">Criterio:{{$criterio->criterio}}</td>
                <td colspan=2 class="bold">{{$subcriterio->subcriterio}}</td>
            </tr>
            <tr>
                <td colspan=2 class="bold">{{$indicador->indicador}} </td>
                <td class="bold">Tipo de Indicador</td>
                <td>
                    @if ($indicador->id==16||$indicador->id==17||$indicador->id==19||$indicador->id==21||$indicador->id==22||$indicador->id==25||$indicador->id==26||$indicador->id==29)
                    <input type="checkbox"> Cualitativo
                    <input type="checkbox" checked> Cuantitativo
                    @else
                    <input type="checkbox" checked> Cualitativo
                    <input type="checkbox"> Cuantitativo
                    @endif

                </td>
            </tr>
            <tr>
                <td class="bold">Responsable:</td>
                <td colspan="3">{{$evaluacion->user->name}}</td>
            </tr>
        </table>
        @php
        $resInd='';
        $formula='';
        switch($indicador->id){
        case 16:
        $formula=$formulas->where('ind_id',$indicador->id)->first()->formula;
        ($res_16!=null)?$resInd=$res_16->valoracion_16:$resInd='Sin Calificar';
        break;
        case 17:
        $formula=$formulas->where('ind_id',$indicador->id)->first()->formula;
        ($res_17!=null)?$resInd=$res_17->valoracion_17:$resInd='Sin Calificar';
        break;
        case 19:
        $formula=$formulas->where('ind_id',$indicador->id)->first()->formula;
        ($res_19!=null)?$resInd=$res_19->valoracion_19:$resInd='Sin Calificar';
        break;
        case 21:
        $formula=$formulas->where('ind_id',$indicador->id)->first()->formula;
        ($res_21!=null)?$resInd=$res_21->valoracion_21:$resInd='Sin Calificar';
        break;
        case 22:
        $formula=$formulas->where('ind_id',$indicador->id)->first()->formula;
        ($res_22!=null)?$resInd=$res_22->valoracion_22:$resInd='Sin Calificar';
        break;
        case 25:
        $formula=$formulas->where('ind_id',$indicador->id)->first()->formula;
        ($res_25!=null)?$resInd=$res_25->valoracion_25:$resInd='Sin Calificar';
        break;
        case 26:
        $formula=$formulas->where('ind_id',$indicador->id)->first()->formula;
        ($res_26!=null)?$resInd=$res_26->valoracion_26:$resInd='Sin Calificar';
        break;
        case 29:
        $formula=$formulas->where('ind_id',$indicador->id)->first()->formula;
        ($res_29!=null)?$resInd=$res_29->valoracion_29:$resInd='Sin Calificar';
        break;
        }
        @endphp
        <table class="table table-hover align-middle text-uppercase pt-2 pb-2">
            <thead class="table-pacifico">
                <tr>
                    <th width=''>No</th>
                    <th width=''>{{($indicador->id==16||$indicador->id==17||$indicador->id==19||$indicador->id==21||$indicador->id==22||$indicador->id==25||$indicador->id==26||$indicador->id==29)?'Fórmula':'Elementos fundamentales'}}</th>
                    <th width='100px'>Valoración</th>
                </tr>
            </thead>
            <tbody>
                @if ($indicador->elemento_fundamentals->isEmpty())
                <tr>
                    <td>{{$loop->index + 1 }}</td>
                    <td>{!!$formula!!}</td>
                    <td>{{$resInd}}</td>
                </tr>
                @endif
                @foreach ($indicador->elemento_fundamentals as $elemento)
                <tr>
                    <td>{{$loop->index + 1 }}</td>
                    <td>{{($indicador->id==16||$indicador->id==17||$indicador->id==19||$indicador->id==21||$indicador->id==22||$indicador->id==25||$indicador->id==26||$indicador->id==29)?$formula:$elemento->elemento}}</td>
                    @php
                    $aux=0;
                    $valoracion='';
                    ($indicador->id==16||$indicador->id==17||$indicador->id==19||$indicador->id==21||$indicador->id==22||$indicador->id==25||$indicador->id==26||$indicador->id==29)?$valoracion=$resInd:(($resultados->where('ele_id',$elemento->id)->first())?$aux=$resultados->where('ele_id',$elemento->id)->first()->esc_id:'Sin calificar');
                    switch($aux){
                    case 0:
                    $valoracion='Sin calificar';
                    break;
                    case 1:
                    $valoracion='Satisfactorio';
                    break;
                    case 2:
                    $valoracion='Cuasi Satisfactorio';
                    break;
                    case 3:
                    $valoracion='Poco Satisfactorio';
                    break;
                    case 4:
                    $valoracion='Deficiente';
                    break;
                    }
                    @endphp
                    <td>{{$valoracion}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table>
            <tr>
                <td>Estandar:</br>{{$indicador->estandar}}</td>
            </tr>
            <tr>
                <td>Resultado:</br>{{($indicador->resIndicador->where('eva_id',$evaluacion->id)->first()!=null)?$indicador->resIndicador->where('eva_id',$evaluacion->id)->first()->resultado:'Sin resultado registrado'}}</td>
            </tr>
            <tr>
                <td>Fortalezas:</br>{{($indicador->resIndicador->where('eva_id',$evaluacion->id)->first()!=null)?$indicador->resIndicador->where('eva_id',$evaluacion->id)->first()->fortalezas:'Sin fortalezas registradas'}}</td>
            </tr>
            <tr>
                <td>Debilidades:</br>{{($indicador->resIndicador->where('eva_id',$evaluacion->id)->first()!=null)?$indicador->resIndicador->where('eva_id',$evaluacion->id)->first()->debilidades:'Sin debilidades registradas'}}</td>
            </tr>
            <tr>
                <td>Nudo Crítico:</br>{{($indicador->resIndicador->where('eva_id',$evaluacion->id)->first()!=null)?$indicador->resIndicador->where('eva_id',$evaluacion->id)->first()->nudo:'Sin nudo crítico registrado'}}</td>
            </tr>
            <tr>
                <td>Escala de Valoración </br>{{$resPorIndicador[$indicador->id]['val']}}</td>
            </tr>
            <tr>
                @php
                $concaux="res_$indicador->id";
                @endphp
                <td>Calificación de indicador </br>{{$resPorIndicador[$indicador->id]['cal']}}</td>
            </tr>
            <tr>
                <td>Justificación:</br>{{($indicador->resIndicador->where('eva_id',$evaluacion->id)->first()!=null)?$indicador->resIndicador->where('eva_id',$evaluacion->id)->first()->justificacion:'Sin justificación registrada'}}</td>
            </tr>
        </table>
        @endforeach
        @endforeach
        @endif
    </div>

    @endforeach
</body>