<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">

    <!-- Token de seguridad requerido por Laravel para peticiones AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets/img/logo-ti-qr.png') }}">

    <!-- METADATA INSTITUCIONAL -->
    <title>@yield('title', 'PGIQR – Plataforma de Gestión de Identidad y Operaciones QR')</title>
    <meta name="description" content="Plataforma institucional para la automatización de accesos, gestión de identidades y control de operaciones mediante códigos QR.">

    <!-- PRECONNECT & PERFORMANCE -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <!-- CSS FRAMEWORKS (Bootstrap 5.3 + Font Awesome 6) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SELECT2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous">

    <!-- ESTILOS CSS -->
    @if(file_exists(public_path('assets/css/main.css')))
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    @endif

    @stack('styles')
</head>
<body>

<!-- COMPONENTES DE LA BARRA SUPERIOR Y MENÚ -->
@include('layouts.partials.topbar')
@include('layouts.partials.navbar')

<!-- CONTENIDO DINÁMICO DE LOS MÓDULOS -->
<main class="container py-4">
    @yield('content')
</main>

@include('layouts.partials.footer')

<!-- CORE JAVASCRIPT DEPENDENCIES -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@stack('scripts')

</body>
</html>
