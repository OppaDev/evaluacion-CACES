<div>
    <form>
        <div>
            <div class="mb-3">
                <input
                    type="text"
                    id="tarea"
                    class="form-control"
                    wire:model.defer="tarea"
                    placeholder="Ingresa el nombre de la tarea"
                    required>
                @error('tarea') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                <input
                    type="date"
                    id="fecha_inicio"
                    class="form-control"
                    wire:model.defer="fecha_inicio">
                @error('fecha_inicio') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                <input
                    type="date"
                    id="fecha_fin"
                    class="form-control"
                    wire:model.defer="fecha_fin">
                @error('fecha_fin') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Selecciona un Responsable</label>
                <select
                    id="usuario"
                    class="form-control"
                    wire:model.defer="usuario">
                    <option value="">Seleccione un usuario</option>
                    @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                    @endforeach
                </select>
                @error('usuario') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </form>
</div>