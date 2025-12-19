<div>
    @foreach ($fuentesInformaciones as $fuenteInformacion)
        <tr>
            <td colspan="6">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_sfi_{{ $fuenteInformacion->id }}">
                        <button class="accordion-button collapsed pt-1 pb-1" style="background: #f8d7da; color: black"
                            type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse_sfi_{{ $fuenteInformacion->id }}" aria-expanded="false"
                            aria-controls="collapse_sfi_{{ $fuenteInformacion->id }}">
                            <div style="width: 7%">
                                {{ "F. I. $ind_id ." . $loop->iteration }}
                            </div>
                            <div style="width: 93%">
                                {{ $fuenteInformacion->documento }}
                            </div>
                        </button>
                    </h2>
                    <div id="collapse_sfi_{{ $fuenteInformacion->id }}" class="accordion-collapse collapse"
                        aria-labelledby="heading_sfi_{{ $fuenteInformacion->id }}" data-bs-parent="#caces">
                        <div class="accordion-body">
                            @livewire('archivo-layout.archivo-layout', ['id_indicador' => $indicador->id, 'id_evaluacion' => $evaluacion->id, 'id_fuente' => $fuenteInformacion->id])
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
</div>