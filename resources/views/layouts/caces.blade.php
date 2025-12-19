<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Acreditación</title>

    <!-- Favicons -->
    {{-- <link href="assets/img/favicon.png" rel="icon"> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
    <!-- Styles -->
    {{-- <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/koz.css') }}" rel="stylesheet"> --}}

    <link rel="stylesheet" href="https://unpkg.com/@jarstone/dselect/dist/css/dselect.css">
    {{-- DATA TABLE --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    {{-- ICONOS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    {{-- PARA PRODUCCION --}}
    {{-- <link href="{{ asset('public/plantilla/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet"> --}}

    <!-- Template Main CSS File -->
    {{-- PARA PRODUCCION --}}
    <link href="{{ asset('public/plantilla/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plantilla/css/fondo_home.css') }}" rel="stylesheet">
    {{-- PARA DESARROLLO --}}
    <link href="{{ asset('plantilla/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('plantilla/css/fondo_home.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/3.2.2/es5/tex-mml-chtml.js"></script>
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <!-- Logo -->
        <div class="d-flex align-items-center justify-content-between">
            <a class="logo d-flex align-items-center">
                <img src="https://www.espe.edu.ec/wp-content/uploads/2023/03/espe.png" alt="espe_logo">
                <span class="d-none d-lg-block text-danger">MENU</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn  "></i>
        </div><!-- Fin Logo -->
        <!-- Navegacion -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <!-- imagen perfil -->
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-person"></i>
                        <!-- <img src="{{ asset('storage/app/public') . '/' . Auth::user()->foto }}" alt="Profile"
                            class="rounded-circle"> -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="https://unpkg.com/@jarstone/dselect/dist/js/dselect.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('public/js/scripts.js') }}"></script> --}}
    <!-- Template Main JS File -->
    {{-- PARA PRODUCCION --}}
    {{-- <script src="{{ asset('public/plantilla/js/main.js') }}"></script> --}}
    {{-- PARA DESARROLLO --}}
    <script src="{{ asset('plantilla/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @yield('scripts')
</body>

</html>
