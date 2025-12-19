<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @livewireStyles
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ACREDITACION') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/@jarstone/dselect/dist/css/dselect.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="{{ asset('public/plantilla/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plantilla/css/fondo_home.css') }}" rel="stylesheet">
    <link href="{{ asset('plantilla/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('plantilla/css/fondo_home.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <!-- Logo -->
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="{{ asset('img/Logo_ESPE.png') }}" alt="">
                <span class="d-none d-lg-block">ESPE</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- Fin Logo -->
        <!-- Navegacion -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item pe-3">
                    <a class="logo d-flex align-items-center" style="width: 100%;">
                        {{-- <img src="assets/img/logo.png" alt=""> --}}
                        <span class="d-none d-lg-block">ESPE - Sistema de Autoevaluación Institucional</span>
                    </a>
                </li>
                <li class="nav-item dropdown pe-3">
                    <!-- imagen perfil -->
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('storage/app/public') . '/' . Auth::user()->foto }}" alt="Profile"
                            class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                    </a><!-- Fin imagen perfil -->
                    <!-- perfil items -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @can('emp_ausencia_show')
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('ausencias') }}">
                                <i class="bi bi-question-circle"></i>
                                <span>Ausencias</span>
                            </a>
                        </li>
                        @endcan
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Cerrar Sesión</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    </ul><!-- Fin perfil items -->
                </li>
            </ul>
        </nav><!-- Fin navegacion -->
    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            @yield('sidebar')
        </ul>
    </aside>
    <!-- Fin del Sidebar-->

    <div class="d-flex flex-column min-vh-100">
        <main id="main" class="main">
            @yield('content')
        </main><!-- Fin de #main -->

        <!-- ======= Footer ======= -->
        <footer id="footer" class="footer mt-auto">
            <div class="credits">
            </div>
        </footer><!-- Fin de Footer -->
    </div>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Scripts -->
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- DATA TABLE --}}
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    {{-- DATA TABLE --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="https://unpkg.com/@jarstone/dselect/dist/js/dselect.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    {{-- <script src="{{ asset('public/js/scripts.js') }}"></script> --}}
    <!-- Template Main JS File -->
    {{-- PARA PRODUCCION --}}
    <script src="{{ asset('public/plantilla/js/main.js') }}"></script>
    {{-- PARA DESARROLLO --}}
    <script src="{{ asset('plantilla/js/main.js') }}"></script>
    @stack('scripts')
    @livewireScripts
</body>

</html>