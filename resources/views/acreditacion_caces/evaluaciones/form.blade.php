<div class="row">
    <input type="hidden" name="uni_id" value="{{ $universidad->id }}">
    <div class="col-sm-6 mb-3">
        <label for="fecha_inicial" class="form-label">Periodo inicial<samp class="text-eliminar">*</samp></label>
        <input type="date" class="form-control" name="fecha_inicial" id="fecha_inicial" required
            value="{{ isset($evaluacion->fecha_inicial) ? \Carbon\Carbon::parse($evaluacion->fecha_inicial)->format('Y-m-d') : old('fecha_inicial') }}">
    </div>
    <div class="col-sm-6 mb-3">
        <label for="fecha_final" class="form-label">Periodo final<samp class="text-eliminar">*</samp></label>
        <input type="date" class="form-control" name="fecha_final" id="fecha_final" required
            value="{{ isset($evaluacion->fecha_final) ? \Carbon\Carbon::parse($evaluacion->fecha_final)->format('Y-m-d') : old('fecha_final') }}">
    </div>
    <div class="col-sm-6 mb-3">
        <label for="departamento" class="form-label">Departamento<samp class="text-eliminar">*</samp></label>
        <input type="text" class="form-control" name="departamento" id="departamento" required
            value="TODOS" readonly>
    </div>
    <div class="col-sm-6 mb-3" style="display: none;">
        <label for="facultad" class="form-label">Facultad<samp class="text-eliminar">*</samp></label>
        <input type="text" class="form-control" name="facultad" id="facultad" required value="TODOS">
    </div>
    
</div>
