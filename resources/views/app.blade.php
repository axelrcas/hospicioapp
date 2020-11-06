<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Icono de la Aplicación -->
    <link rel="icon" type="image/png" href="{{ asset('src/img/logos/cbpicon.svg') }}"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('src/css/fontawesome-free/css/all.min.css') }}">
    <!--    CSS - Bootstrap y Propios    -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('src/css/generales.css') }}">

    <!-- Headers para eliminar el Control Cache en Formularios -->
    <?php
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    ?>

    <!--    Headers para cada Plantilla    -->
    @yield('encabezados')
</head>
<body>

    <!--    Contenido de Plantillas    -->
    @yield('contenido')

    <!--    Bootstrap Javascript    -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')

</body>
</html>