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
    .criterio-accordion .accordion-button.btn-elementos {
        background: var(--espe-green);
        color: white;
    }
    .criterio-accordion .accordion-button.btn-elementos:not(.collapsed) {
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
    .criterio-accordion .accordion-button.btn-elementos::after,
    .criterio-accordion .accordion-button.btn-fuente::after {
        filter: brightness(0) invert(1);
    }
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

<div class="row">
    <div class="col-xl-10">
        @foreach ($sub_criterios as $sub_criterio)
        <div class="subcriterio-card animate-fade-in">
            <div class="subcriterio-header">
                <span>{{ $sub_criterio->subcriterio }}</span>
                <span class="badge-pct">{{ $sub_criterio->porcentaje }} %</span>
            </div>

            @foreach ($sub_criterio->indicadores as $indicador)
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
                    {{-- Elementos / Fórmula --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading_{{ $indicador->id }}">
                            <button class="accordion-button collapsed btn-elementos" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $indicador->id }}" aria-expanded="false" aria-controls="collapse_{{ $indicador->id }}">
                                @if ($indicador->id == 24)
                                    <i class="bi bi-puzzle me-2"></i> Elementos Fundamentales
                                @else
                                    <i class="bi bi-calculator me-2"></i> Fórmula de Cálculo
                                @endif
                            </button>
                        </h2>
                        <div id="collapse_{{ $indicador->id }}" class="accordion-collapse collapse" aria-labelledby="heading_{{ $indicador->id }}">
                            <div class="accordion-body">
                                @php $componentName = 'criterio4.indicador' . $indicador->id; @endphp
                                @livewire($componentName, ['id_indicador' => $indicador->id, 'id_evaluacion' => $evaluacion->id])
                            </div>
                        </div>
                    </div>

                    {{-- Fuente de Información --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading_fi_{{ $indicador->id }}">
                            <button class="accordion-button collapsed btn-fuente" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_fi_{{ $indicador->id }}" aria-expanded="false" aria-controls="collapse_fi_{{ $indicador->id }}">
                                <i class="bi bi-folder2-open me-2"></i> Fuente de Información
                            </button>
                        </h2>
                        <div id="collapse_fi_{{ $indicador->id }}" class="accordion-collapse collapse" aria-labelledby="heading_fi_{{ $indicador->id }}">
                            <div class="accordion-body">
                                @php $componentName = 'criterio4.archivo-indicador' . $indicador->id; @endphp
                                @livewire($componentName, ['id_indicador' => $indicador->id, 'id_evaluacion' => $evaluacion->id])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>

    {{-- Quick Nav --}}
    <div class="col-xl-2 quick-nav-col">
        <div class="quick-nav">
            <h6 class="text-uppercase text-muted small fw-bold mb-3">
                <i class="bi bi-signpost-split me-1"></i> Indicadores
            </h6>
            <a class="nav-link" href="#indicador_24"><i class="bi bi-dot"></i> 24</a>
            <a class="nav-link" href="#indicador_25"><i class="bi bi-dot"></i> 25</a>
            <a class="nav-link" href="#indicador_26"><i class="bi bi-dot"></i> 26</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== FIX MODALS: Intercept modal triggers and show via JS API =====
    document.addEventListener('click', function(e) {
        var trigger = e.target.closest('[data-bs-toggle="modal"]');
        if (!trigger) return;

        var targetSelector = trigger.getAttribute('data-bs-target');
        if (!targetSelector) return;

        var modalEl = document.querySelector(targetSelector);
        if (!modalEl) return;

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
            document.querySelectorAll('.modal-backdrop').forEach(function(el) { el.remove(); });
            document.body.classList.remove('modal-open');
            document.body.style.removeProperty('overflow');
            document.body.style.removeProperty('padding-right');
        });
    }, true);

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

    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(el) { return new bootstrap.Tooltip(el); });

    // Centralized modal close handler
    document.addEventListener('close-modal', function(event) {
        document.querySelectorAll('.modal.show').forEach(function(modalEl) {
            var modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) modalInstance.hide();
        });
    });

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
