<div>
    <div class="container text-center">
        <img src="{{ asset('img/indicador21.png') }}" width="250" height="150" alt="indicador16" class="img-fluid mx-auto">
    </div>
    <table class="table table-hover align-middle pt-2 pb-2">
        <thead class="table-pacifico text-uppercase">
            <tr>
                <th>No</th>
                <th>Término</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><strong>TTG:</strong> Tasa promedio de titulación institucional de grado.
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td><strong>n:</strong> Número de cohortes iniciadas en el periodo de evaluación.</td>
            </tr>
            <tr>
                <td>3</td>
                <td><strong>NEGT<sub>i</sub>:</strong> Número de estudiantes de grado matriculados en primer nivel que
                    se titularon en el plazo establecido según el tiempo de duración de la carrera y hasta un año
                    adicional en la ésima cohorte.
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td><strong>TEG<sub>i</sub>:</strong> Total de estudiantes de grado matriculados en primer nivel en la
                    ésima cohorte.
                </td>
            </tr>
        </tbody>
    </table>
    <div style="display: flex; justify-content: center">
        <form action="">
            <table class="table table-hover align-middle pt-2 pb-2" style="width: 600px">
                <thead class="table-pacifico text-uppercase">
                    <tr class="table-light">
                        <th colspan="4"></th>
                        <th>
                            <button type="button" class="btn btn-actualizar" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Mayor o igual al 50%">
                                S
                            </button>
                            <button type="button" class="btn btn-warning text-white" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Mayor o igual a 33% y menor al 50%">
                                CS
                            </button>
                            <button type="button" class="btn" style="background-color: #FF8000; color: #fff" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Mayor o igual al 16% y menor al 33%.">
                                PS
                            </button>
                            <button type="button" class="btn btn-eliminar" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Menor al 16%.">
                                D
                            </button>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="4" style="width: 130px">Valor/porcentaje</th>
                        <th style="width: 230px">Valoración</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> <strong>n:</strong></td>
                        <td colspan="3">
                            {{-- <input type="number" min="1" max="6" class="form-control form-control-sm" wire:model="n"> --}}
                            <select id="" class="form-select form-select-sm" wire:model="n">
                                <option selected>Seleccionar...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </td>
                    </tr>
                    @if ($n == 1 || $n == 2 || $n == 3 || $n == 4 || $n == 5 || $n == 6)
                    <tr>
                        <td><strong>NEGT<sub>1</sub>:</strong></td>
                        <td>
                            <input type="number" min="1" class="form-control form-control-sm"
                                wire:model="negt_1">
                        </td>
                        <td><strong>TEG<sub>1</sub>:</strong></td>
                        <td>
                            <input type="number" min="1" class="form-control form-control-sm"
                                wire:model="teg_1">
                        </td>
                    </tr>
                    @endif
                    @if ($n == 2 || $n == 3 || $n == 4 || $n == 5 || $n == 6)
                    <tr>
                        <td><strong>NEGT<sub>2</sub>:</strong></td>
                        <td>
                            <input type="number" min="1" class="form-control form-control-sm"
                                wire:model="negt_2">
                        </td>
                        <td><strong>TEG<sub>2</sub>:</strong></td>
                        <td>
                            <input type="number" min="1" class="form-control form-control-sm"
                                wire:model="teg_2">
                        </td>
                    </tr>
                    @endif
                    @if ($n == 3 || $n == 4 || $n == 5 || $n == 6)
                    <tr>
                        <td><strong>NEGT<sub>3</sub>:</strong></td>
                        <td>
                            <input type="number" min="1" class="form-control form-control-sm"
                                wire:model="negt_3">
                        </td>
                        <td><strong>TEG<sub>3</sub>:</strong></td>
                        <td>
                            <input type="number" min="1" class="form-control form-control-sm"
                                wire:model="teg_3">
                        </td>
                    </tr>
                    @endif
                    @if ($n == 4 || $n == 5 || $n == 6)
                    <tr>
                        <td><strong>NEGT<sub>4</sub>:</strong></td>
                        <td>
                            <input type="number" min="1" class="form-control form-control-sm"
                                wire:model="negt_4">
                        </td>
                        <td><strong>TEG<sub>4</sub>:</strong></td>
                        <td>
                            <input type="number" min="1" class="form-control form-control-sm"
                                wire:model="teg_4">
                        </td>
                    </tr>
                    @endif
                    @if ($n == 5 || $n == 6)
                    <tr>
                        <td><strong>NEGT<sub>5</sub>:</strong></td>
                        <td>
                            <input type="number" min="1" class="form-control form-control-sm"
                                wire:model="negt_5">
                        </td>
                        <td><strong>TEG<sub>5</sub>:</strong></td>
                        <td>
                            <input type="number" min="1" class="form-control form-control-sm"
                                wire:model="teg_5">
                        </td>
                    </tr>
                    @endif
                    @if ($n == 6)
                    <tr>
                        <td><strong>NEGT<sub>6</sub>:</strong></td>
                        <td>
                            <input type="number" min="1" class="form-control form-control-sm"
                                wire:model="negt_6">
                        </td>
                        <td><strong>TEG<sub>6</sub>:</strong></td>
                        <td>
                            <input type="number" min="1" class="form-control form-control-sm"
                                wire:model="teg_6">
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td><strong>TTG:</strong></td>
                        <td colspan="3">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text" id="basic-addon1">%</span>
                                <input type="number" step="0.01" min="1" class="form-control resultado"
                                    wire:model.defer="ttg" style="background-color: #fff" readonly>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td><strong>TOTAL:</strong></td>
                        <td colspan="3">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text" id="basic-addon1">%</span>
                                <input type="number" step="0.01" class="form-control resultado"
                                    wire:model.defer="ttg_porcentaje" style="background-color: #fff" readonly>
                            </div>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm"
                                onkeyup="this.value = this.value.toUpperCase();" wire:model.defer="valoracion_21"
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
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                    @endif
                </div>
                <div class="col-sm-4">
                    <div class="d-flex justify-content-end">
                        <button type="button" wire:click.prevent="guardarIndicador21()"
                            class="btn btn-primary pb-2 pt-2"><i class="fas fa-save"></i> GUARDAR</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>