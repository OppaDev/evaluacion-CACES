<div>
    <form>
        <table class="table table-hover align-middle pt-2 pb-2">
            <thead class="table-pacifico text-uppercase">
                @if ($elementosFundamentales->isEmpty())
                <div>
                    <p>
                        $$ {{$formula->formula}} $$
                    </p>
                </div>
                <tr>
                    <th>Variable</th>
                    <th>Descripcion</th>
                    <th style="width: 230px">Valoración</th>
                </tr>
            <tbody>
                @foreach ($variables as $variable)
                <tr>
                    <td>
                        {{$variable['var']}}
                    </td>
                    <td>{{$variable['desc']}}</td>
                    <td><input type="number" step="0.01" class="form-control resultado"
                            wire:model.defer="valoracion.{{ $variable['var'] }}"
                            style="background-color: #fff" @if ($variables[0]==$variable)
                            disabled
                            @endif></td>
                </tr>
                @endforeach
            </tbody>
            @else
            <tr class="table-light">
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>
                    <button type="button" class="btn btn-actualizar" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="La Institución cumple con el estándar de forma completa y consistente a traves de todos sus elementos fundamentales">
                        S
                    </button>
                    <button type="button" class="btn btn-warning text-white" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="La Institución cumple con el estándar; sin embargo registra debilidades en el cumplimiento de los elementos fundamentales los cuales se encuentran en proceso de mejorar para alcanzar el estándar">
                        CS
                    </button>
                    <button type="button" class="btn" style="background-color: #FF8000; color: #fff" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="La institución registra debilidades en el cumplimiento de los elementos fundamentales, los cuales no se encuentran en proceso de mejora o los mismos no son suficientes para alcanzar el estándar">
                        PS
                    </button>
                    <button type="button" class="btn btn-eliminar" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="La institución no cumple con el estándar">
                        D
                    </button>
                </th>
                <th></th>
            </tr>
            <tr>
                <th style="width: 75px">No</th>
                <th>Elemento</th>
                <th></th>
                <th style="width: 130px">Resultado</th>
                <th style="width: 230px">Valoración</th>
                <th style="width: 230px">Comentario</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($elementosFundamentales as $elementoFundamental)
                <tr>
                    <td>E. F. {{$elementoFundamental->indicador->id}}.{{ $loop->index + 1 }}</td>
                    <td>{{ $elementoFundamental->elemento }} <br> <strong>Puntuación:
                        </strong><span class="text-danger text-center">{{ $elementoFundamental->porcentaje }}
                            %</span></td>
                    <td>
                        @if (isset($valoracion[$elementoFundamental->id]))
                        @if ($valoracion[$elementoFundamental->id] == 100 || $valoracion[$elementoFundamental->id] == 70)
                        <i class="bi bi-check-circle-fill text-actualizar" style="font-size: 20px"></i>
                        @else
                        <i class="bi bi-x-circle-fill text-eliminar" style="font-size: 20px"></i>
                        @endif
                        @else
                        <i class="bi bi-x-circle-fill text-eliminar" style="font-size: 20px"></i>
                        @endif
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" id="basic-addon1">%</span>
                            <input type="number" step="0.01" class="form-control resultado"
                                wire:model.defer="porcentaje.{{ $elementoFundamental->id }}"
                                style="background-color: #fff" readonly>
                        </div>
                    </td>
                    <td>
                        <select id="selectEscala" class="selectEscala form-select form-select-sm"
                            wire:model="valoracion.{{ $elementoFundamental->id }}" @if(auth()->user()->hasRole('Viewer') || (auth()->user()->hasRole('SedeR') && !auth()->user()->hasRole('IndicatorR') && !auth()->user()->hasRole('CriteriaR')))
                            disabled
                            @endif>
                            <option value={{0}}>Seleccionar...</option>
                            @foreach ($escalas as $escala)
                            <option value="{{ $escala->porcentaje }}">
                                {{ $escala->escala }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <div>
                            <div class="modal fade" id="observacion{{$elementoFundamental->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header bg-crear text-white pb-2 pt-2">
                                            <h6 class="modal-title fw-normal text-uppercase">Observación</h6>
                                            <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal" aria-label="Close"><i
                                                    class="bi bi-x-lg"></i></button>
                                        </div>
                                        <div class="modal-body">
                                            <textarea class="comentario form-control" id="comentario" rows="20"
                                                wire:model.defer="observacion.{{ $elementoFundamental->id }}" placeholder="Comentario" @if(auth()->user()->hasRole('Viewer') || (auth()->user()->hasRole('SedeR') && !auth()->user()->hasRole('IndicatorR') && !auth()->user()->hasRole('CriteriaR')))
                                disabled
                                @endif></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <center>
                                <button type="button" class="btn btn-outline-pacifico mb-4 btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#observacion{{$elementoFundamental->id}}"><i class="bi bi-file-earmark-text"></i></button>
                            </center>
                        </div>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td>TOTAL</td>
                    <td>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" id="basic-addon1">%</span>
                            <input type="number" step="0.01" class="form-control resultado"
                                wire:model.defer="res_ind" style="background-color: #fff" readonly>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <input type="text" class="form-control form-control-sm"
                            onkeyup="this.value = this.value.toUpperCase();" wire:model.defer="ind_val"
                            placeholder="" style="color: {{ $this->check ? '#008F39' : '#8B0000' }}" readonly>
                    </td>
                </tr>
            </tbody>
            @endif
        </table>
        <div class="table table-hover align-middle pt-2 pb-2">
            <div class="card-body">
                <div class="mb-3">
                    <label for="resultados" class="form-label">Resultados</label>
                    <textarea class="form-control" wire:model.defer="ind_res" rows="3" placeholder="Ingrese los resultados obtenidos"></textarea>
                </div>
                <!-- Debilidades -->
                <div class="mb-3">
                    <label for="debilidades" class="form-label">Debilidades</label>
                    <textarea class="form-control" wire:model.defer="ind_deb" rows="3" placeholder="Describa las debilidades identificadas"></textarea>
                </div>
                <!-- Fortalezas -->
                <div class="mb-3">
                    <label for="fortalezas" class="form-label">Fortalezas</label>
                    <textarea class="form-control" wire:model.defer="ind_for" rows="3" placeholder="Especifique las fortalezas observadas"></textarea>
                </div>
                <!-- Nudo Crítico -->
                <div class="mb-3">
                    <label for="nudo_critico" class="form-label">Nudo Crítico</label>
                    <textarea class="form-control" wire:model.defer="ind_nud" rows="3" placeholder="Exponga el nudo crítico identificado"></textarea>
                </div>
                <!-- Justificación -->
                <div class="mb-3">
                    <label for="justificacion" class="form-label">Justificación</label>
                    <textarea class="form-control" wire:model.defer="ind_jus" rows="3" placeholder="Proporcione la justificación correspondiente"></textarea>
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
                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                    <i class="bi bi-x-circle me-1"></i>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>

            <div class="col-sm-4">
                @php
                $action="";
                if ($elementosFundamentales->isEmpty()){
                $buttonName="CALCULAR";
                $action="formula_$ind_id()";
                }
                else{
                $buttonName="GUARDAR";
                $action="guardarIndicador()";
                }
                @endphp
                <div class="d-flex justify-content-end">
                    <button type="button" wire:click.prevent={{$action}}
                        class="btn btn-primary pb-2 pt-2" @if(auth()->user()->hasRole('Viewer') || (auth()->user()->hasRole('SedeR') && !auth()->user()->hasRole('IndicatorR') && !auth()->user()->hasRole('CriteriaR')))
                        disabled
                        @endif><i class="fas fa-save"></i> {{$buttonName}}</button>
                </div>
            </div>
        </div>
    </form>
</div>