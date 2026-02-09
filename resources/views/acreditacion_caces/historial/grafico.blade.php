@extends('layouts.modern')

@section('title', 'Análisis Histórico')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Sedes</a></li>
    <li class="breadcrumb-item active">Análisis Histórico</li>
@endsection

@section('content')
<div class="page-header animate-fade-in">
    <div>
        <h1>Análisis Histórico</h1>
        <p class="text-muted mb-0">Comparativa de resultados por período de evaluación</p>
    </div>
</div>

<div class="card-modern mb-4 animate-fade-in">
    <div class="card-header">
        <h5><i class="bi bi-table me-2"></i>Cuadro Comparativo</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th class="text-center">Período</th>
                        <th class="text-center">
                            <span class="badge-modern badge-info" data-bs-toggle="tooltip" title="Condiciones Institucionales">
                                C1
                            </span>
                        </th>
                        <th class="text-center">
                            <span class="badge-modern badge-info" data-bs-toggle="tooltip" title="Docencia">
                                C2
                            </span>
                        </th>
                        <th class="text-center">
                            <span class="badge-modern badge-info" data-bs-toggle="tooltip" title="Condiciones del Personal Académico">
                                C3
                            </span>
                        </th>
                        <th class="text-center">
                            <span class="badge-modern badge-info" data-bs-toggle="tooltip" title="Investigación e Innovación">
                                C4
                            </span>
                        </th>
                        <th class="text-center">
                            <span class="badge-modern badge-info" data-bs-toggle="tooltip" title="Vinculación con la Sociedad">
                                C5
                            </span>
                        </th>
                        <th class="text-center">
                            <span class="badge-modern badge-info" data-bs-toggle="tooltip" title="Sistema de Gestión de Calidad">
                                C6
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resultado_total as $key => $resultado)
                    <tr>
                        <td><span class="badge-modern badge-secondary">{{ $loop->iteration }}</span></td>
                        <td class="text-center fw-medium">{{ $resultado['fecha_evaluacion'] }}</td>
                        <td class="text-center"><span class="badge-modern {{ $resultado['criterio_1'] >= 80 ? 'badge-success' : 'badge-danger' }}">{{ $resultado['criterio_1'] }}%</span></td>
                        <td class="text-center"><span class="badge-modern {{ $resultado['criterio_2'] >= 80 ? 'badge-success' : 'badge-danger' }}">{{ $resultado['criterio_2'] }}%</span></td>
                        <td class="text-center"><span class="badge-modern {{ $resultado['criterio_3'] >= 80 ? 'badge-success' : 'badge-danger' }}">{{ $resultado['criterio_3'] }}%</span></td>
                        <td class="text-center"><span class="badge-modern {{ $resultado['criterio_4'] >= 80 ? 'badge-success' : 'badge-danger' }}">{{ $resultado['criterio_4'] }}%</span></td>
                        <td class="text-center"><span class="badge-modern {{ $resultado['criterio_5'] >= 80 ? 'badge-success' : 'badge-danger' }}">{{ $resultado['criterio_5'] }}%</span></td>
                        <td class="text-center"><span class="badge-modern {{ $resultado['criterio_6'] >= 80 ? 'badge-success' : 'badge-danger' }}">{{ $resultado['criterio_6'] }}%</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card-modern animate-fade-in">
    <div class="card-header">
        <h5><i class="bi bi-graph-up me-2"></i>Gráfico Comparativo</h5>
    </div>
    <div class="card-body">
        <div id="chart"></div>
    </div>
</div>

@php
    $colores = [];
    foreach ($evaluaciones as $evaluacion) {
        $red = rand(50, 150);
        $green = rand(50, 150);
        $blue = rand(50, 150);
        $colores[] = "rgb($red, $green, $blue)";
    }
@endphp
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var criterios = [
        @foreach ($resultado_total as $key => $resultado)
        {
            name: "{{ $resultado['fecha_evaluacion'] }}",
            data: [{{ $resultado['criterio_1'] }}, {{ $resultado['criterio_2'] }},
                {{ $resultado['criterio_3'] }}, {{ $resultado['criterio_4'] }}, 
                {{ $resultado['criterio_5'] }}, {{ $resultado['criterio_6'] }}]
        },
        @endforeach
    ];

    var colores = {!! json_encode($colores) !!};
    var options = {
        series: criterios,
        chart: {
            height: 450,
            type: 'line',
            dropShadow: {
                enabled: true,
                color: '#000',
                top: 18,
                left: 7,
                blur: 10,
                opacity: 0.2
            },
            toolbar: { show: true }
        },
        colors: colores.length ? colores : ['#00713d', '#c84239', '#d4a84b'],
        dataLabels: { enabled: true },
        stroke: { curve: 'smooth', width: 3 },
        title: {
            text: 'Comparativa de resultados por criterio',
            align: 'left',
            style: { fontSize: '16px', fontWeight: 600, color: '#1e293b' }
        },
        grid: {
            borderColor: '#e2e8f0',
            row: { colors: ['#f8fafc', 'transparent'], opacity: 0.5 }
        },
        markers: { size: 5 },
        xaxis: {
            categories: ['Criterio 1', 'Criterio 2', 'Criterio 3', 'Criterio 4', 'Criterio 5', 'Criterio 6'],
            title: { text: 'Criterios' }
        },
        yaxis: {
            title: { text: 'Porcentaje' },
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
@endpush
