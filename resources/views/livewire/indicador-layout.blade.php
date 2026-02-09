@extends('layouts.modern')

@section('title', $criterio->criterio)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('universidades.index') }}">Sedes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('evaluaciones.show', $evaluacion->uni_id) }}">{{ $evaluacion->universidad->sede }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resultado', ['eva_id' => $evaluacion->id, 'cri_id' => $criterio->id]) }}">Indicadores</a></li>
    <li class="breadcrumb-item active">{{ $criterio->criterio }}</li>
@endsection

@push('styles')
<style>
    /* Criterio Hero */
    .criterio-hero {
        background: linear-gradient(135deg, var(--espe-green) 0%, var(--espe-green-dark) 100%);
        color: white;
        border-radius: var(--border-radius);
        padding: 1.5rem 2rem;
        margin-bottom: 1.5rem;
    }
    .criterio-hero h1 {
        font-size: 1.35rem;
        font-weight: 700;
        margin: 0;
    }
    .badge-pct {
        background: rgba(255,255,255,0.2);
        color: white;
        font-size: 1.1rem;
        font-weight: 700;
        padding: 0.4rem 1rem;
        border-radius: 50px;
    }

    /* Subcriterio Card */
    .subcriterio-card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-sm);
        margin-bottom: 1.5rem;
        overflow: hidden;
        background: white;
        transition: box-shadow 0.3s ease;
    }
    .subcriterio-card:hover {
        box-shadow: var(--shadow-md);
    }
    .subcriterio-header {
        background: linear-gradient(135deg, #1B295B, #2a3d7c);
        color: white;
        padding: 1rem 1.25rem;
        font-weight: 600;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .subcriterio-header .badge-pct {
        font-size: 0.85rem;
        padding: 0.25rem 0.75rem;
    }

    /* Indicador Section */
    .indicador-section {
        padding: 1.5rem;
        border-bottom: 1px solid var(--border-color);
    }
    .indicador-section:last-child {
        border-bottom: none;
    }
    .indicador-title {
        color: var(--espe-green);
        font-size: 1.05rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    .badge-pct-sm {
        background: var(--espe-red);
        color: white;
        font-size: 0.78rem;
        font-weight: 600;
        padding: 0.2rem 0.6rem;
        border-radius: 50px;
    }

    /* Indicador Metadata Grid */
    .indicador-meta {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }
    .indicador-meta-item {
        background: var(--bg-secondary);
        border-radius: 8px;
        padding: 0.75rem 1rem;
    }
    .indicador-meta-item .label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-secondary);
        margin-bottom: 0.25rem;
    }
    .indicador-meta-item .value {
        font-size: 0.88rem;
        color: var(--text-primary);
    }

    /* Accordions */
    .criterio-accordion .accordion-item {
        border: 1px solid var(--border-color);
        border-radius: 8px !important;
        margin-bottom: 0.5rem;
        overflow: hidden;
    }
    .criterio-accordion .accordion-button {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.75rem 1rem;
    }
    .criterio-accordion .accordion-button:not(.collapsed) {
        box-shadow: none;
    }
    .criterio-accordion .accordion-button.btn-elementos,
    .criterio-accordion .accordion-button.btn-formula {
        background: var(--espe-green);
        color: white;
    }
    .criterio-accordion .accordion-button.btn-elementos:not(.collapsed),
    .criterio-accordion .accordion-button.btn-formula:not(.collapsed) {
        background: var(--espe-green-dark);
        color: white;
    }
    .criterio-accordion .accordion-button.btn-fuente {
        background: #4a5fa0;
        color: white;
    }
    .criterio-accordion .accordion-button.btn-fuente:not(.collapsed) {
        background: #3b4d85;
        color: white;
    }
    .criterio-accordion .accordion-button.btn-mejora {
        background: var(--espe-red);
        color: white;
    }
    .criterio-accordion .accordion-button.btn-mejora:not(.collapsed) {
        background: #a83530;
        color: white;
    }
    .criterio-accordion .accordion-button.btn-elementos::after,
    .criterio-accordion .accordion-button.btn-formula::after,
    .criterio-accordion .accordion-button.btn-fuente::after,
    .criterio-accordion .accordion-button.btn-mejora::after {
        filter: brightness(0) invert(1);
    }

    /* Quick Navigation */
    .quick-nav {
        position: sticky;
        top: 80px;
    }
    .quick-nav .nav-link {
        padding: 0.4rem 0.75rem;
        font-size: 0.82rem;
        color: var(--text-secondary);
        border-left: 2px solid var(--border-color);
        transition: all 0.2s ease;
        display: block;
        text-decoration: none;
    }
    .quick-nav .nav-link:hover,
    .quick-nav .nav-link.active {
        color: var(--espe-green);
        border-left-color: var(--espe-green);
        background: rgba(0,113,61,0.05);
    }

    @media (max-width: 1199px) {
        .indicador-meta { grid-template-columns: 1fr; }
        .quick-nav-col { display: none; }
    }
</style>
@endpush

@section('content')
{{-- Hero --}}
<div class="criterio-hero animate-fade-in">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div>
            <h1>{{ $criterio->criterio }}</h1>
            <p class="mb-0 opacity-75" style="font-size: 0.9rem;">
                {{ $evaluacion->universidad->sede }} &mdash; {{ $evaluacion->universidad->campus }}
            </p>
        </div>
        <span class="badge-pct">{{ $criterio->porcentaje }} %</span>
    </div>
</div>

@php
    if ($sub_criterios->isEmpty()) {
        $indicadores = $indicadors;
    } else {
        $indicadores = $criterio->indicadorsSub;
    }
@endphp

<div class="row">
    {{-- ====== MAIN CONTENT ====== --}}
    <div class="col-xl-10">

        @if (!$sub_criterios->isEmpty())
            {{-- === CON SUBCRITERIOS === --}}
            @foreach ($sub_criterios as $sub_criterio)
            <div class="subcriterio-card animate-fade-in">
                <div class="subcriterio-header">
                    <span>{{ $sub_criterio->subcriterio }}</span>
                    <span class="badge-pct">{{ $sub_criterio->porcentaje }} %</span>
                </div>

                @foreach ($sub_criterio->indicadors as $indicador)
                    @php $ind_cri_id = $indicador->subcriterio->criterio->id; @endphp
                    @if (
                        (auth()->user()->can("$evaluacion->id/$ind_cri_id") && auth()->user()->hasRole('CriteriaR'))
                        || auth()->user()->can('admin')
                        || auth()->user()->can("$evaluacion->id-$indicador->id")
                        || auth()->user()->hasRole('Viewer')
                    )
                    <div class="indicador-section" id="indicador_{{ $indicador->id }}">
                        <div class="indicador-title">
                            <i class="bi bi-clipboard-data"></i>
                            {{ $indicador->indicador }}
                            <span class="badge-pct-sm">{{ $indicador->porcentaje }} %</span>
                        </div>
                        <div class="indicador-meta">
                            <div class="indicador-meta-item">
                                <div class="label">Estándar</div>
                                <div class="value">{{ $indicador->estandar }}</div>
                            </div>
                            <div class="indicador-meta-item">
                                <div class="label">Período de Evaluación</div>
                                <div class="value">{{ $indicador->periodo }}</div>
                            </div>
                        </div>
                        <div class="accordion criterio-accordion">
                            @if (!$indicador->elemento_fundamentals->isEmpty())
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading_{{ $indicador->id }}">
                                    <button class="accordion-button collapsed btn-elementos" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $indicador->id }}" aria-expanded="false" aria-controls="collapse_{{ $indicador->id }}">
                                        <i class="bi bi-puzzle me-2"></i> Elementos Fundamentales
                                    </button>
                                </h2>
                                <div id="collapse_{{ $indicador->id }}" class="accordion-collapse collapse" aria-labelledby="heading_{{ $indicador->id }}">
                                    <div class="accordion-body">
                                        @livewire('indicador-layout', ['id_indicador' => $indicador->id, 'id_evaluacion' => $evaluacion->id])
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading_{{ $indicador->id }}">
                                    <button class="accordion-button collapsed btn-formula" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $indicador->id }}" aria-expanded="false" aria-controls="collapse_{{ $indicador->id }}">
                                        <i class="bi bi-calculator me-2"></i> Fórmula de Cálculo
                                    </button>
                                </h2>
                                <div id="collapse_{{ $indicador->id }}" class="accordion-collapse collapse" aria-labelledby="heading_{{ $indicador->id }}">
                                    <div class="accordion-body">
                                        @livewire("indicador$indicador->id", ['id_indicador' => $indicador->id, 'id_evaluacion' => $evaluacion->id])
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading_fi_{{ $indicador->id }}">
                                    <button class="accordion-button collapsed btn-fuente" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_fi_{{ $indicador->id }}" aria-expanded="false" aria-controls="collapse_fi_{{ $indicador->id }}">
                                        <i class="bi bi-folder2-open me-2"></i> Fuente de Información
                                    </button>
                                </h2>
                                <div id="collapse_fi_{{ $indicador->id }}" class="accordion-collapse collapse" aria-labelledby="heading_fi_{{ $indicador->id }}">
                                    <div class="accordion-body">
                                        @livewire('fuente-layout', ['id_indicador' => $indicador->id, 'id_evaluacion' => $evaluacion->id])
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading_tarea_{{ $indicador->id }}">
                                    <button class="accordion-button collapsed btn-mejora" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_tarea_{{ $indicador->id }}" aria-expanded="false" aria-controls="collapse_tarea_{{ $indicador->id }}">
                                        <i class="bi bi-check2-circle me-2"></i> Acciones de Mejora
                                    </button>
                                </h2>
                                <div id="collapse_tarea_{{ $indicador->id }}" class="accordion-collapse collapse" aria-labelledby="heading_tarea_{{ $indicador->id }}">
                                    <div class="accordion-body">
                                        @livewire("tareas-layout", [$indicador->id, $evaluacion->id])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            @endforeach

        @else
            {{-- === SIN SUBCRITERIOS === --}}
            @foreach ($indicadors as $indicador)
                @php $ind_cri_id = $indicador->criterio->id; @endphp
                @if (
                    (auth()->user()->can("$evaluacion->id/$ind_cri_id") && auth()->user()->hasRole('CriteriaR'))
                    || auth()->user()->can('admin')
                    || auth()->user()->can("$evaluacion->id-$indicador->id")
                    || auth()->user()->can("CriteriaR")
                    || auth()->user()->hasRole('Viewer')
                )
                <div class="subcriterio-card animate-fade-in">
                    <div class="indicador-section" id="indicador_{{ $indicador->id }}">
                        <div class="indicador-title">
                            <i class="bi bi-clipboard-data"></i>
                            {{ $indicador->indicador }}
                            <span class="badge-pct-sm">{{ $indicador->porcentaje }} %</span>
                        </div>
                        <div class="indicador-meta">
                            <div class="indicador-meta-item">
                                <div class="label">Estándar</div>
                                <div class="value">{{ $indicador->estandar }}</div>
                            </div>
                            <div class="indicador-meta-item">
                                <div class="label">Período de Evaluación</div>
                                <div class="value">{{ $indicador->periodo }}</div>
                            </div>
                        </div>
                        <div class="accordion criterio-accordion">
                            @if (!$indicador->elemento_fundamentals->isEmpty())
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading_{{ $indicador->id }}">
                                    <button class="accordion-button collapsed btn-elementos" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $indicador->id }}" aria-expanded="false" aria-controls="collapse_{{ $indicador->id }}">
                                        <i class="bi bi-puzzle me-2"></i> Elementos Fundamentales
                                    </button>
                                </h2>
                                <div id="collapse_{{ $indicador->id }}" class="accordion-collapse collapse" aria-labelledby="heading_{{ $indicador->id }}">
                                    <div class="accordion-body">
                                        @livewire('indicador-layout', ['id_indicador' => $indicador->id, 'id_evaluacion' => $evaluacion->id])
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading_{{ $indicador->id }}">
                                    <button class="accordion-button collapsed btn-formula" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $indicador->id }}" aria-expanded="false" aria-controls="collapse_{{ $indicador->id }}">
                                        <i class="bi bi-calculator me-2"></i> Fórmula de Cálculo
                                    </button>
                                </h2>
                                <div id="collapse_{{ $indicador->id }}" class="accordion-collapse collapse" aria-labelledby="heading_{{ $indicador->id }}">
                                    <div class="accordion-body">
                                        @livewire("indicador$indicador->id", ['id_indicador' => $indicador->id, 'id_evaluacion' => $evaluacion->id])
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading_fi_{{ $indicador->id }}">
                                    <button class="accordion-button collapsed btn-fuente" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_fi_{{ $indicador->id }}" aria-expanded="false" aria-controls="collapse_fi_{{ $indicador->id }}">
                                        <i class="bi bi-folder2-open me-2"></i> Fuente de Información
                                    </button>
                                </h2>
                                <div id="collapse_fi_{{ $indicador->id }}" class="accordion-collapse collapse" aria-labelledby="heading_fi_{{ $indicador->id }}">
                                    <div class="accordion-body">
                                        @livewire('fuente-layout', ['id_indicador' => $indicador->id, 'id_evaluacion' => $evaluacion->id])
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading_tarea_{{ $indicador->id }}">
                                    <button class="accordion-button collapsed btn-mejora" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_tarea_{{ $indicador->id }}" aria-expanded="false" aria-controls="collapse_tarea_{{ $indicador->id }}">
                                        <i class="bi bi-check2-circle me-2"></i> Acciones de Mejora
                                    </button>
                                </h2>
                                <div id="collapse_tarea_{{ $indicador->id }}" class="accordion-collapse collapse" aria-labelledby="heading_tarea_{{ $indicador->id }}">
                                    <div class="accordion-body">
                                        @livewire("tareas-layout", [$indicador->id, $evaluacion->id])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        @endif
    </div>

    {{-- ====== QUICK NAV ====== --}}
    <div class="col-xl-2 quick-nav-col">
        <div class="quick-nav">
            <h6 class="text-uppercase text-muted small fw-bold mb-3">
                <i class="bi bi-signpost-split me-1"></i> Indicadores
            </h6>
            @foreach ($indicadores as $indicador)
                <a class="nav-link" href="#indicador_{{ $indicador->id }}">
                    <i class="bi bi-dot"></i> {{ $indicador->id }}
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== FIX MODALS: Intercept modal triggers and show via JS API =====
    // This ensures modals work even inside stacking contexts (transform, animation, etc.)
    document.addEventListener('click', function(e) {
        var trigger = e.target.closest('[data-bs-toggle="modal"]');
        if (!trigger) return;

        var targetSelector = trigger.getAttribute('data-bs-target');
        if (!targetSelector) return;

        var modalEl = document.querySelector(targetSelector);
        if (!modalEl) return;

        // Prevent Bootstrap's default handler
        e.preventDefault();
        e.stopPropagation();

        // Move modal to body temporarily for correct positioning
        var originalParent = modalEl.parentElement;
        var placeholder = document.createComment('modal-placeholder');
        originalParent.insertBefore(placeholder, modalEl);
        document.body.appendChild(modalEl);

        var modal = bootstrap.Modal.getOrCreateInstance(modalEl, {
            backdrop: 'static',
            keyboard: false
        });
        modal.show();

        // When hidden, move modal back to preserve Livewire bindings
        modalEl.addEventListener('hidden.bs.modal', function handler() {
            modalEl.removeEventListener('hidden.bs.modal', handler);
            if (placeholder.parentNode) {
                placeholder.parentNode.insertBefore(modalEl, placeholder);
                placeholder.remove();
            }
            // Clean up residual backdrops
            document.querySelectorAll('.modal-backdrop').forEach(function(el) { el.remove(); });
            document.body.classList.remove('modal-open');
            document.body.style.removeProperty('overflow');
            document.body.style.removeProperty('padding-right');
        });
    }, true); // Use capture phase to intercept before Bootstrap

    // Scroll-spy for quick nav
    const navLinks = document.querySelectorAll('.quick-nav .nav-link');
    const sections = document.querySelectorAll('[id^="indicador_"]');
    if (sections.length && navLinks.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    navLinks.forEach(l => l.classList.remove('active'));
                    const active = document.querySelector('.quick-nav a[href="#' + entry.target.id + '"]');
                    if (active) active.classList.add('active');
                }
            });
        }, { rootMargin: '-100px 0px -60% 0px' });
        sections.forEach(s => observer.observe(s));
    }

    // Expand criterio in sidebar
    const el = document.getElementById('criterio_{{ $criterio->id }}');
    if (el) el.classList.remove('collapsed');

    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(el) { return new bootstrap.Tooltip(el); });

    // ===== CENTRALIZED MODAL CLOSE HANDLER =====
    document.addEventListener('close-modal', function(event) {
        document.querySelectorAll('.modal.show').forEach(function(modalEl) {
            var modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) {
                modalInstance.hide();
            }
        });
    });

    // Livewire refresh handler
    if (typeof Livewire !== 'undefined') {
        Livewire.on('refresh', () => location.reload());

        Livewire.on('refreshComponent', () => {
            if (Livewire.components && Livewire.components.components) {
                Livewire.components.components.forEach(function(component) {
                    component.call('render');
                });
            }
        });
    }
});
</script>
@endpush
