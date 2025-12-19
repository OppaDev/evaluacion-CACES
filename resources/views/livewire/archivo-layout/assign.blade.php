<div class="row">
    <div class="table-responsive">
        <table id="archivos" class="table table-hover align-middle text-uppercase pt-2 pb-2">
            <thead class="table-pacifico">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">DOCUMENTO</th>
                    <th scope="col">OBSERVACION</th>
                    <th scope="col">CREADO</th>
                    <th scope="col">ACTUALIZADO</th>
                    <th scope="col">ASIGNAR</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($arch_disponibles as $archivo)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{basename($archivo->archivo)}}
                    </td>
                    <td>
                        {{ $archivo->observacion }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($archivo->created_at)->format('d-m-Y') }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($archivo->updated_at)->format('d-m-Y') }} - {{ \Carbon\Carbon::parse($evaluacion->fecha_final)->format('d-m-Y') }}
                    </td>
                    <td style="width: 160px;">
                        <button type="button" wire:click.prevent="asignarArc({{$archivo->id}})" class="btn "><i class="bi bi-check-circle-fill"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>