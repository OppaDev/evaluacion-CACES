<div>
    <form>
        <table class="table table-hover align-middle pt-2 pb-2">
            <thead class="table-pacifico text-uppercase">
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
                    <th style="width: 130px">Porcentaje</th>
                    <th style="width: 230px">Valoración</th>
                    <th style="width: 230px">Comentario</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($elementosFundamentales as $elementoFundamental)
                    <tr>
                        <td>E. F. 20.{{ $loop->index + 1 }}</td>
                        <td>{{ $elementoFundamental->elemento }} <br> <strong>Puntuación:
                            </strong><span class="text-danger text-center">{{ $elementoFundamental->porcentaje }}
                                %</span></td>
                        <td>
                            @if (isset($valoracion[$elementoFundamental->id]))
                                @if ($valoracion[$elementoFundamental->id] == 100 || $valoracion[$elementoFundamental->id] == 75)
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
                                wire:model="valoracion.{{ $elementoFundamental->id }}">
                                <option selected>Seleccionar...</option>
                                @foreach ($escalas as $escala)
                                    <option value="{{ $escala->porcentaje }}">
                                        {{ $escala->escala }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <div>
                                <textarea class="comentario form-control" id="comentario" rows="2"
                                    wire:model.defer="observacion.{{ $elementoFundamental->id }}" placeholder="Comentario"></textarea>
                            </div>
                        </td>
                    </tr>
                @endforeach
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
                    <button type="button" wire:click.prevent="guardarIndicador20()"
                        class="btn btn-primary pb-2 pt-2"><i class="fas fa-save"></i> GUARDAR</button>
                </div>
            </div>
        </div>
    </form>
</div>
@push('scripts')
    <script>        
        document.getElementById('criterio_3').classList.remove('collapsed');
    </script>
@endpush
