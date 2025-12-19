@extends('layouts.caces')
@section('sidebar')
    @include('layouts.sidebar_porcentajes')
@endsection
@section('content')
    <div class="pagetitle">
        <h3>PORCENTAJES DE LOS CRITERIOS</h3>
    </div>

    <div class="card">
        <div class="card-header pb-2">
            <h6 class="fw-normal text-pacifico text-uppercase">Criterios</h6>
        </div>
        <div class="card-body mt-3">
            <!-- Tabla -->
            <form action="{{ route('porcentaje.criterios.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-crear mb-4"><i class="bi bi-check-circle"></i>
                            GUARDAR</button>
                    </div>
                    <div class="col-md-4">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-x-circle me-1"></i>
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
                <table class="table table-hover align-middle text-uppercase pt-2 pb-2">
                    <thead class="table-pacifico">
                        <tr>
                            <th width=''>No</th>
                            <th width=''>Criterio</th>
                            <th width='100px'>Porcentaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalCriterios = count($criterios) ;
                        @endphp

                        @foreach ($criterios as $criterio)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $criterio->criterio }}</td>
                            <td><input
                                    class="form-control form-control-sm {{ empty($criterio->porcentaje) ? 'alert-danger' : '' }}"
                                    type="number" min=0 max=100 step="0.001"
                                    name="{{ $criterio->id }}[porcentaje]"
                                    value="{{ isset($criterio->porcentaje) ? $criterio->porcentaje : round(100 / $totalCriterios, 3) }}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            <!-- Fin Tabla -->
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.getElementById('porcentaje_criterios').classList.remove('collapsed');
    </script>
@endsection
