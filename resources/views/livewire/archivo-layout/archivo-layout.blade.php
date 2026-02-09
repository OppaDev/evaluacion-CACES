<div>
    <section>
        <div class="card">
            <div class="card-body mt-3">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-outline-pacifico mb-4 btn-sm" data-bs-toggle="modal"
                            data-bs-target="#assign_file_{{ $fue_id }}" @if(auth()->user()->hasRole('Viewer'))
                            disabled
                            @endif><i class="bi bi-plus"></i>ASIGNAR NUEVO</button>
                    </div>

                    <div class="col-md-6">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                        @endif
                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-x-circle me-1"></i>
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                        @endif
                        @if ($message = Session::get('delete-successfull'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- Tabla -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-uppercase pt-2 pb-2">
                        <thead class="table-pacifico">
                            <tr>
                                <th>No</th>
                                <th>Observación</th>
                                <th style="width: 100px">Archivo</th>
                                <th style="width: 230px">Subido por</th>
                                <th style="width: 130px">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($arch_condiciones_institucionales->count() == 0)
                            <tr>
                                <td colspan="26" class="text-center text-muted fw-light pb-5 pt-5">
                                    <div>
                                        <i class="bi bi-clipboard-x" style="font-size: 3.5em"></i>
                                        <p class="fs-4">No hay resultados para mostrar.</p>
                                    </div>
                                </td>
                            </tr>
                            @else
                            @foreach ($arch_condiciones_institucionales as $arch_condicion_institucion)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $arch_condicion_institucion->archivo->observacion }}
                                </td>
                                <td>
                                    @isset($arch_condicion_institucion)
                                    @if ($arch_condicion_institucion->archivo != '')
                                    <a class="text-actualizar" title="Descargar" target="_blank"
                                        href="{{ asset('storage') .'/'. $arch_condicion_institucion->archivo->archivo }}"><i class="fas fa-eye"></i> Ver
                                    </a>
                                    @else
                                    <i class="bi bi-x-circle-fill text-eliminar"></i> No disponible
                                    @endif
                                    @endisset
                                </td>
                                <td>
                                    {{ $arch_condicion_institucion->user->name }}
                                </td>
                                <td style="width: 160px;">
                                    <div class="nav">
                                        @if (auth()->user()->hasRole('Admin')||auth()->user()->hasRole('CriteriaR')||auth()->user()->hasRole('IndicatorR'))
                                        <a type="button" class="nav-link text-eliminar" title="Borrar"
                                            data-bs-toggle="modal" data-bs-target="#borrar_fuente_{{ $fue_id }}"
                                            wire:click="deleteConfirmation({{ $arch_condicion_institucion->arc_id }})">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        @else
                                        N/A
                                        @endif
                                        
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- Fin Tabla -->
            </div>
        </div>
    </section>
    {{-- MODALES --}}
    @include('livewire.archivo-layout.modal')
</div>


@push('scripts')
<script>
    (function() {
        document.addEventListener('close-modal', function(event) {
            ['add_file_{{ $fue_id }}', 'assign_file_{{ $fue_id }}', 'editar_fuente_{{ $fue_id }}', 'borrar_fuente_{{ $fue_id }}'].forEach(function(id) {
                var el = document.getElementById(id);
                if (el) {
                    var instance = bootstrap.Modal.getInstance(el);
                    if (instance) instance.hide();
                }
            });
        });
    })();
</script>
@endpush