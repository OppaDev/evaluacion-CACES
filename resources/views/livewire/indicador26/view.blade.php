<div>
    <div class="container text-center">
        <img src="{{ asset('img/indicador26_1.png') }}" width="150" height="70" alt="indicador16" class="img-fluid mx-auto">
    </div>
    <form action="">
        {{-- PARA CALCULAR EL PAC --}}
        <table class="table table-hover align-middle pt-2 pb-2">
            <thead class="table-pacifico text-uppercase">
                <tr>
                    <th>No</th>
                    <th>Indices de impacto</th>
                    <th style="width: 130px">N° de publicaciones</th>
                    <th style="width: 130px">Con Componente intercultural</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><strong>Q1:</strong> Total de publicaciones en revistas indexadas en bases de datos Scopus de acuerdo con el cuartil de Scimago.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="q1">
                    </td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="q1_ci">
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><strong>Q2:</strong> Total de publicaciones en revistas indexadas en bases de datos Scopus de acuerdo con el cuartil de Scimago.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="q2">
                    </td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="q2_ci">
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><strong>Q3:</strong> Total de publicaciones en revistas indexadas en bases de datos Scopus de acuerdo con el cuartil de Scimago.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="q3">
                    </td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="q3_ci">
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><strong>Q4:</strong> Total de publicaciones en revistas indexadas en bases de datos Scopus de acuerdo con el cuartil de Scimago.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="q4">
                    </td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="q4_ci">
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><strong>ACI:</strong> Total de publicaciones en revistas indexadas en bases de datos Scopus o Web of Science en que no cuentan con cuartil.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="aci">
                    </td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="aci_ci">
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td><strong>BR:</strong> Total de artículos publicados en revistas indexadas en bases regionales de acuerdo con el Anexo 1.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="br">
                    </td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="br_ci">
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td><strong>LA:</strong> Total de artículos publicados en revistas indexadas en Latindex Catálogo 2.0.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="la">
                    </td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="la_ci">
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td><strong>PAC:</strong> Publicación académica científica.</td>
                    <td colspan="2">
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="pac" readonly>
                    </td>
                </tr>
            </tbody>
        </table>
        {{-- PARA CALCULAR EL PA --}}
        <div class="container text-center">
            <img src="{{ asset('img/indicador26_2.png') }}" width="250" height="70" alt="indicador16" class="img-fluid mx-auto">
        </div>
        <table class="table table-hover align-middle pt-2 pb-2">
            <thead class="table-pacifico text-uppercase">
                <tr>
                    <th>No</th>
                    <th>Término</th>
                    <th style="width: 130px">Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><strong>OPI:</strong> Obra relevante de producción artística revisada por curadores o expertos externos a la institución y expuesta en un evento internacional o que han ganado un premio internacional.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="opi">
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><strong>OPN:</strong> Obra relevante de producción artística revisada por curadores o expertos externos a la institución y expuesta en un evento nacional o que ha ganado un premio nacional.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="opn">
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><strong>PA:</strong> Producción artística.</td>
                    <td colspan="2">
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="pa" readonly>
                    </td>
                </tr>
            </tbody>
        </table>
        {{-- PARA CALCULAR EL LyCL --}}
        <div class="container text-center">
            <img src="{{ asset('img/indicador26_3.png') }}" width="200" height="70" alt="indicador16" class="img-fluid mx-auto">
        </div>
        <table class="table table-hover align-middle pt-2 pb-2">
            <thead class="table-pacifico text-uppercase">
                <tr>
                    <th>No</th>
                    <th>Término</th>
                    <th style="width: 130px">Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><strong>Li:</strong> Libro publicados por el profesor e investigador i-ésimo.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="li">
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><strong>CL:</strong> Número de capítulos de libros publicados en los que se colabora en algún/os capítulo/s.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="cl">
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><strong>TC:</strong> Número total de capítulos revisados por pares que tiene el j-ésimo libro.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="tc">
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><strong>LyCL:</strong> Libros y capítulos de libros revisados por pares.</td>
                    <td colspan="2">
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="lycl" readonly>
                    </td>
                </tr>
            </tbody>
        </table>
        {{-- PARA CALCULAR EL IP --}}
        <div class="container text-center">
            <img src="{{ asset('img/indicador26.png') }}" width="250" height="70" alt="indicador16" class="img-fluid mx-auto">
        </div>
        <table class="table table-hover align-middle pt-2 pb-2">
            <thead class="table-pacifico text-uppercase">
                <tr class="table-light">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                        <button type="button" class="btn btn-actualizar" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Mayor o igual a 1">
                            S
                        </button>
                        <button type="button" class="btn btn-warning text-white" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Mayor o igual a 1,0 y menor a 1,5.">
                            CS
                        </button>
                        <button type="button" class="btn" style="background-color: #FF8000; color: #fff" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Mayor o igual al 0,5 y menor a 1,0.">
                            PS
                        </button>
                        <button type="button" class="btn btn-eliminar" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Menor al 0,5.">
                            D
                        </button>
                    </th>
                </tr>
                <tr>
                    <th>No</th>
                    <th>Término</th>
                    <th style="width: 130px">Valor/porcentaje</th>
                    <th style="width: 230px">Valoración</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><strong>PAC:</strong> Publicación académica científica.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="pac" readonly>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><strong>PA:</strong> Producción artística.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="pa" readonly>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><strong>LyCL:</strong> Libros y capítulos de libros revisados por pares.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="lycl" readonly>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><strong>PIA:</strong> Propiedad intelectual aplicada, resultado de un proyecto de investigación, vinculación o producción artística.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="pia">
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><strong>PTC:</strong> Total del personal académico con dedicación a tiempo completo vinculado en el último año concluido antes de inicio del proceso de evaluación.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="ptc">
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td><strong>PMT:</strong> Total del personal académico con dedicación a medio tiempo vinculado en el último año concluido antes de inicio del proceso de evaluación.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="pmt">
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td><strong>IP:</strong> Índice de producción académica per cápita.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="ip" style="background-color: #fff" readonly>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td><strong>TOTAL</strong></td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="ip_porcentaje" style="background-color: #fff" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm"
                            onkeyup="this.value = this.value.toUpperCase();" wire:model.defer="valoracion_26"
                            placeholder="" style="background-color: #fff" readonly>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="table table-hover align-middle pt-2 pb-2">
            <div class="card-body">
                <div class="mb-3">
                    <label for="resultados" class="form-label">Resultados</label>
                    <textarea class="form-control" wire:model.defer="ind_res" rows="3" placeholder="Ingresa los resultados obtenidos"></textarea>
                </div>
                <!-- Debilidades -->
                <div class="mb-3">
                    <label for="debilidades" class="form-label">Debilidades</label>
                    <textarea class="form-control" wire:model.defer="ind_deb" rows="3" placeholder="Describe las debilidades identificadas"></textarea>
                </div>
                <!-- Fortalezas -->
                <div class="mb-3">
                    <label for="fortalezas" class="form-label">Fortalezas</label>
                    <textarea class="form-control" wire:model.defer="ind_for" rows="3" placeholder="Especifica las fortalezas observadas"></textarea>
                </div>
                <!-- Nudo Crítico -->
                <div class="mb-3">
                    <label for="nudo_critico" class="form-label">Nudo Crítico</label>
                    <textarea class="form-control" wire:model.defer="ind_nud" rows="3" placeholder="Expón el nudo crítico identificado"></textarea>
                </div>
                <!-- Justificación -->
                <div class="mb-3">
                    <label for="justificacion" class="form-label">Justificación</label>
                    <textarea class="form-control" wire:model.defer="ind_jus" rows="3" placeholder="Proporciona la justificación correspondiente"></textarea>
                </div>
            </div>
        </div>
        {{-- ////////////////////////////////////////////////////// --}}
        <div class="row">
            <div class="col-sm-8">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>
            <div class="col-sm-4">
                <div class="d-flex justify-content-end">
                    <button type="button" wire:click.prevent="guardarIndicador26()"
                        class="btn btn-primary pb-2 pt-2"><i class="fas fa-save"></i> GUARDAR</button>
                </div>
            </div>
        </div>
    </form>
</div>