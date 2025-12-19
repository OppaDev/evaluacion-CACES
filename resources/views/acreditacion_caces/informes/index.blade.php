@extends('layouts.caces')
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('content')
<div class="pagetitle">
    <h3>DOCUMENTOS IMPORTANTES</h3>
</div>
<div>
    <div class="row justify-content-center">
        <div class="card" style="width: 75%">
            <div class="card-header pt-2 pb-1 mt-3">
                <h6 class="fw-normal text-crear text-uppercase">Informes </h6>
            </div>
            <div class="card-body table-responsive text-uppercase" style="padding-top: 20px; padding-bottom: 0px">
                <table class="table table-bordered table-hover">
                    <tbody>                        
                        {{-- <tr>
                            <th scope="row">CRITERIO PERSONAL ACADEMICO</th>
                            <td>
                                <a type="button" class="nav-link text-actualizar" title="Informe"
                                    href="{{ route('personal.academico.excel',$evaluacion->universidad->id) }}">
                                    <i class="bi bi-x-circle-fill"></i> DESCARGAR EXCEL
                                </a>
                            </td>
                        </tr> --}}
                        <tr>
                            <th scope="row">INFORME GENERAL</th>
                            <td>
                                <a type="button" class="nav-link text-actualizar" title="Informe"
                                    href="{{ route('personal.academico.informeGeneral',$evaluacion->id) }}">
                                    <i class="bi bi-x-circle-fill"></i> DESCARGAR PDF
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">INFORME ESPECIFICO</th>
                            <td>
                                <a type="button" class="nav-link text-actualizar" title="Informe"
                                    href="{{ route('personal.academico.informeEspecifico',$evaluacion->id) }}">
                                    <i class="bi bi-x-circle-fill"></i> DESCARGAR PDF
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        document.getElementById('informes').classList.remove('collapsed');
    </script>
@endsection