<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Acreditación</title>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- ICONOS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <link href="{{ asset('plantilla/css/login.css') }}" rel="stylesheet">
</head>

<body class="img js-fullheight">
    <div id="app">
        <div class="d-flex flex-column login-content">
            <main>
                @yield('content')
            </main>

            <!-- ======= Footer ======= -->
            <footer id="footer" class="footer mt-auto">
                <div class="credits">
                </div>
            </footer><!-- Fin de Footer -->
        </div>
</body>

</html>
