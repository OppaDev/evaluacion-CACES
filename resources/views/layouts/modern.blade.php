<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Sistema de Acreditación CACES - ESPE" />
    <meta name="author" content="ESPE" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Acreditación CACES') - ESPE</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://www.espe.edu.ec/wp-content/uploads/2023/03/espe.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
    
    <!-- Modern Theme -->
    <link href="{{ asset('plantilla/css/modern.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plantilla/css/modern.css') }}" rel="stylesheet">
    
    <!-- MathJax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/3.2.2/es5/tex-mml-chtml.js"></script>
    
    <!-- Livewire -->
    @livewireStyles
    
    @stack('styles')
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar-modern" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('universidades.index') }}" class="sidebar-logo">
                <img src="https://www.espe.edu.ec/wp-content/uploads/2023/03/espe.png" alt="ESPE Logo">
                {{-- <div class="sidebar-logo-text">
                    <h2>ESPE</h2>
                    <span>Acreditación CACES</span>
                </div> --}}
            </a>
        </div>
        
        <nav class="sidebar-nav" id="sidebarNav">
            @include('layouts.partials.sidebar-unified')
        </nav>
        
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST" id="logout-form-sidebar">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Header -->
    <header class="header-modern" id="header">
        <div class="breadcrumb-section">
            <button class="toggle-sidebar" id="toggleSidebar" title="Toggle sidebar">
                <i class="bi bi-list fs-4"></i>
            </button>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    @yield('breadcrumb')
                </ol>
            </nav>
        </div>
        
        <div class="header-actions">
            <div class="dropdown dropdown-modern">
                <div class="user-menu" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="user-info d-none d-md-block">
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-role">
                            @if(Auth::user()->hasRole('Admin'))
                                Administrador
                            @elseif(Auth::user()->hasRole('SedeR'))
                                Responsable de Sede
                            @elseif(Auth::user()->hasRole('CriteriaR'))
                                Responsable de Criterio
                            @elseif(Auth::user()->hasRole('IndicatorR'))
                                Responsable de Indicador
                            @elseif(Auth::user()->hasRole('Viewer'))
                                Visualizador
                            @else
                                Usuario
                            @endif
                        </div>
                    </div>
                    <i class="bi bi-chevron-down ms-1 d-none d-md-block"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <div class="dropdown-header">
                            <strong>{{ Auth::user()->name }}</strong>
                            <br>
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    @can('emp_ausencia_show')
                    <li>
                        <a class="dropdown-item" href="{{ route('ausencias') }}">
                            <i class="bi bi-calendar-x"></i>
                            Ausencias
                        </a>
                    </li>
                    @endcan
                    <li>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-modern" id="main">
        <!-- Flash Messages -->
        @if ($message = Session::get('success'))
        <div class="alert-modern alert-success animate-fade-in">
            <i class="bi bi-check-circle-fill"></i>
            <div>{{ $message }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        @if ($message = Session::get('error'))
        <div class="alert-modern alert-danger animate-fade-in">
            <i class="bi bi-exclamation-circle-fill"></i>
            <div>{{ $message }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        const body = document.body;
        
        // Check localStorage for sidebar state
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            body.classList.add('sidebar-collapsed');
        }
        
        toggleBtn.addEventListener('click', function() {
            if (window.innerWidth > 1199) {
                body.classList.toggle('sidebar-collapsed');
                localStorage.setItem('sidebarCollapsed', body.classList.contains('sidebar-collapsed'));
            } else {
                body.classList.toggle('sidebar-open');
            }
        });
        
        // Close sidebar on mobile when clicking outside
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 1199 && body.classList.contains('sidebar-open')) {
                if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                    body.classList.remove('sidebar-open');
                }
            }
        });
        
        // Submenu toggle
        document.querySelectorAll('.nav-item.has-submenu > .nav-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                if (!body.classList.contains('sidebar-collapsed')) {
                    e.preventDefault();
                    this.parentElement.classList.toggle('open');
                }
            });
        });
        
        // Auto-open active submenu
        document.querySelectorAll('.nav-submenu .nav-link.active').forEach(function(link) {
            link.closest('.nav-item.has-submenu')?.classList.add('open');
        });
        
        // DataTables default config
        if (typeof $.fn.DataTable !== 'undefined') {
            $.extend(true, $.fn.dataTable.defaults, {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rtip',
            });
        }
        
        // Delete confirmation
        document.querySelectorAll('.formulario-eliminar').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Está seguro?',
                    text: "Esta acción no se puede revertir",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#c84239',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    
    @livewireScripts
    @stack('scripts')
</body>
</html>
