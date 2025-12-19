@extends('layouts.caces')
@section('sidebar')
    @include('layouts.sidebar_evaluacion')
@endsection
@section('content')
    <div class="pagetitle">
        <h3>ANÁLISIS HISTORICO</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Análisis Histórico</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-header pb-2">
            <h6 class="fw-normal text-pacifico text-uppercase">Cuadro comparativo</h6>
        </div>
        <div class="card-body mt-3">
            <!-- Tabla -->
            <table class="table table-hover align-middle text-uppercase pt-2 pb-2">
                <thead class="table-pacifico">
                    <tr>
                        <th width=''>No</th>
                        <th class="text-center">Periodo</th>
                        <th class="text-center">
                            <button type="button" class="btn btn-pacifico btn-sm" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Condiciones Institucionales">
                                CRITERIO 1
                            </button>
                        </th>
                        <th class="text-center">
                            <button type="button" class="btn btn-pacifico btn-sm" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Docencia">
                                CRITERIO 2
                            </button>
                        <th class="text-center">
                            <button type="button" class="btn btn-pacifico btn-sm" data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Condiciones del Personal Académico, Apoyo Académico y Estudiantes">
                                CRITERIO 3
                            </button>
                        <th class="text-center">
                            <button type="button" class="btn btn-pacifico btn-sm" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Investigación e Innovación">
                                CRITERIO 4
                            </button>
                        <th class="text-center">
                            <button type="button" class="btn btn-pacifico btn-sm" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Vinculación con la Sociedad">
                                CRITERIO 5
                            </button>
                        <th class="text-center">
                            <button type="button" class="btn btn-pacifico btn-sm" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Sistema de Gestión de la Calidad">
                                CRITERIO 6
                            </button>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($resultado_total as $key => $resultado)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td class="text-center">
                                {{ $resultado['fecha_evaluacion']}}</td>
                            <td class="text-center">{{ $resultado['criterio_1'] }} %</td>
                            <td class="text-center">{{ $resultado['criterio_2'] }} %</td>
                            <td class="text-center">{{ $resultado['criterio_3'] }} %</td>
                            <td class="text-center">{{ $resultado['criterio_4'] }} %</td>
                            <td class="text-center">{{ $resultado['criterio_5'] }} %</td>
                            <td class="text-center">{{ $resultado['criterio_6'] }} %</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Fin Tabla -->
        </div>
    </div>
    {{-- ///////////////////////////////////////////////// --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Line Chart -->
                    <div id="chart"></div>
                    <!-- End Line Chart -->

                </div>

            </div>
        </div>
    </div>
    {{-- //////////////////////////////////////////////// --}}

    {{-- @foreach ($resultado_total as $key => $resultado)
        <tr>
            {name: {{ $resultado['fecha_evaluacion'] }},
            data: [{{ $resultado['criterio_1'] }}, {{ $resultado['criterio_2'] }}, {{ $resultado['criterio_3'] }},
            {{ $resultado['criterio_4'] }}, {{ $resultado['criterio_5'] }},{{ $resultado['criterio_6'] }}]},
        </tr>
    @endforeach --}}
    @php
        $colores = [];
    @endphp

    @foreach ($evaluaciones as $evaluacion)
        @php
            $red = rand(50, 150); // Componente rojo aleatorio
            $green = rand(50, 150); // Componente verde aleatorio
            $blue = rand(50, 150); // Componente azul aleatorio
            $color = "rgb($red, $green, $blue)"; // Color aleatorio en formato RGB
            $colores[] = $color; // Agregar el color al arreglo
        @endphp
    @endforeach
@endsection
@section('scripts')
    <script>
        document.getElementById('grafico').classList.remove('collapsed');
    </script>
    <script>
        var criterios = [
            @foreach ($resultado_total as $key => $resultado)
                {
                    name: "{{ $resultado['fecha_evaluacion'] }}",
                    data: [{{ $resultado['criterio_1'] }}, {{ $resultado['criterio_2'] }},
                        {{ $resultado['criterio_3'] }},
                        {{ $resultado['criterio_4'] }}, {{ $resultado['criterio_5'] }},
                        {{ $resultado['criterio_6'] }}
                    ]
                },
            @endforeach
        ];

        var colores = {!! json_encode($colores) !!};
        var options = {
            series: criterios,
            chart: {
                height: 500,
                type: 'line',
                dropShadow: {
                    enabled: true,
                    color: '#000',
                    top: 18,
                    left: 7,
                    blur: 10,
                    opacity: 0.2
                },
                toolbar: {
                    show: false
                }
            },
            colors: colores,
            dataLabels: {
                enabled: true,
            },
            stroke: {
                curve: 'smooth'
            },
            title: {
                text: 'Comparativa de resultados por criterio',
                align: 'left'
            },
            grid: {
                borderColor: '#e7e7e7',
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            markers: {
                size: 1
            },
            xaxis: {
                categories: ['Criterio 1', 'Criterio 2', 'Criterio 3', 'Criterio 4', 'Criterio 5', 'Criterio 6'],
                title: {
                    text: 'Criterios'
                }
            },
            yaxis: {
                title: {
                    text: 'Porcentaje'
                },
                min: 0,
                max: 100
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                floating: true,
                offsetY: -25,
                offsetX: -5
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endsection
