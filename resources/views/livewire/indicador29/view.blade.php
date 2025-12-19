<div>
    <div class="container text-center">
        <img src="{{ asset('img/indicador29.png') }}"width="150" height="50" alt="indicador16" class="img-fluid mx-auto">
    </div>
    <form action="">
        <table class="table table-hover align-middle pt-2 pb-2">
            <thead class="table-pacifico text-uppercase">
                <tr class="table-light">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                        <button type="button" class="btn btn-actualizar" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Mayor o igual al 1.5">
                            S
                        </button>
                        <button type="button" class="btn btn-warning text-white" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Mayor o igual al 1.0 y menor al 1.5">
                            CS
                        </button>
                        <button type="button" class="btn" style="background-color: #FF8000; color: #fff" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Mayor o igual al 0.5 y menor al 1.0">
                            PS
                        </button>
                        <button type="button" class="btn btn-eliminar" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Menor al 0.5">
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
                    <td>TPV: Total de proyectos de vinculación con la sociedad con resultados totales o
                        parciales.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="tpv">
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>TOA: Total de carreras y programas vigentes y en ejecución.</td>
                    <td>
                        <input type="number" min="0" class="form-control form-control-sm"
                            wire:model="toa">
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>IPV: Relación de proyectos de vinculación con la sociedad con la oferta académica.
                    </td>
                    <td>
                        <input type="number" step='0.01' min="0" class="form-control form-control-sm"
                            wire:model.defer="ipv" readonly>
                    </td>

                </tr>
                <tr>
                    <td>4</td>
                    <td>TOTAL</td>
                    <td>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" id="basic-addon1">%</span>
                            <input type="number" step="0.01" class="form-control resultado"
                                wire:model.defer="ipv_porcentaje" style="background-color: #fff" readonly>
                        </div>
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm"
                            onkeyup="this.value = this.value.toUpperCase();" wire:model.defer="valoracion_29"
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
                    <button type="button" wire:click.prevent="guardarIndicador29()"
                        class="btn btn-primary pb-2 pt-2"><i class="fas fa-save"></i> GUARDAR</button>
                </div>
            </div>
        </div>
    </form>
</div>
