<div class="row">
    <div class="col-sm-12 mb-3">
        @if ($this->archivo != '')
        <a class="text-actualizar" title="Abrir" href="{{ asset('storage/app/public') . '/' . $this->archivo }}"
            target="_blank"><i class="bi bi-check-circle-fill"></i>
        </a>
        @else
        <i class="bi bi-x-circle-fill text-eliminar"></i>
        @endif
        <label class="form-label">Fuente de información</label>
        <input type="file" wire:model="archivo" class="form-control form-control">
        @error('archivo')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div wire:loading wire:target="archivo" class="progress" style="height: 20px; margin-bottom: 15px;" id="progressContainer">
        Cargando...
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
        </div>
    </div>
    <div class="col-sm-12 mb-3">
        <label class="form-label">Observaciones / Nombre del archivo<samp class="text-eliminar">*</samp></label>
        <textarea class="comentario form-control" rows="3" wire:model.defer="observacion" placeholder="Comentario"></textarea>
        @error('observacion')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>