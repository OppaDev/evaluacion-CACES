<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Informe de Autoevaluación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        h2 {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .resultados {
            margin-top: 20px;
        }

        .observaciones {
            margin-top: 20px;
        }

        .firmas {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h1>Informe de Autoevaluación</h1>

    <h2>Universidad: {{ $evaluacion->universidad->universidad }}</h2>
    <h2>Fecha de Autoevaluación : {{ $evaluacion->fecha_creacion }}</h2>

    <table>
        <tr>
            <th>Criterio de Acreditación</th>
            <th>Porcentaje de Acreditación</th>
            <th>Resultado</th>
        </tr>
        @foreach ($criterios as $key=>$criterio)
        <tr>
            <td>{{$criterio->criterio}}</td>
            <td>{{$criterio->porcentaje}}</td>
            <td>{{ $total[$key+1] }}%</td>
        </tr>
        @endforeach
        <!-- Repite esta estructura para las otras áreas -->
    </table>
    <div class="resultados">
        <h2>Puntaje Total de Autoevaluación</h2>
        <p>El puntaje total de autoevaluación obtenido es
            {{ round((array_sum($total)) / 6 ,2) }}% sobre 100%.</p>
    </div>

    <div class="resultados">
        <h2>Comentarios y Observaciones</h2>
        <p>En el proceso de autoevaluación, se observó un compromiso significativo por parte de la universidad en el
            fortalecimiento de sus condiciones institucionales. Sin embargo, se identificaron áreas de mejora en la
            infraestructura física de algunas instalaciones académicas, particularmente en el mantenimiento de
            laboratorios. Se recomienda que la universidad priorice inversiones en este aspecto para asegurar un entorno
            de aprendizaje adecuado.</p>
    </div>

    <div class="resultados">
        <h2>Conclusiones</h2>
        <p>Basándonos en los resultados de la autoevaluación, se determina que la universidad ha logrado un alto nivel de
            acreditación en áreas clave como las condiciones institucionales y la vinculación con la sociedad. Esto
            refleja un compromiso sólido con la excelencia académica y el servicio a la comunidad.</p>
    </div>

    <div class="firmas">
        <h2>Firma del Evaluador</h2>
        <p>{{ $evaluacion->universidad->evaluadores }}</p>
    </div>
</body>

</html>
