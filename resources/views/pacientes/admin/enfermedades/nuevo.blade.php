@extends('app')

@section('encabezados')
    
    <title>Enfermedades - Sistema</title>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('src/css/dashboard.css') }}">
    <!-- Datatable -->
    {{-- <link rel="stylesheet" href="{{ asset('src/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/css/responsive.dataTables.min.css') }}"> --}}

@endsection

@section('contenido')

    <nav class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow py-2 fnd-azul-light">
        
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="/">Hospicio Santa María</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed my-1" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <ul class="navbar-nav px-3 d-none d-md-block">
            <li class="nav-item text-nowrap">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                </form>
            </li>
        </ul>
    </nav>
  
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky fnd-azul-dark">
                    <ul class="nav flex-column">
                        <li class="nav-item text-center pb-5 pt-5 mb-4 fnd-azul-light"> 
                            <img src="{{ asset('src/img/logos/logo.png') }}" alt="CBP" class="img-login mt-3"> 
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link text-white  " 
                                href="{{ route('dashboard') }}">
                                <i class="fas fa-home mr-2"></i>
                                Tablero 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link active font-weight-bold" 
                                href="{{ route('pacientes.index') }}">
                                <i class="fas fa-user-friends mr-2"></i>
                                Pacientes 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link text-white"
                                href="{{ route('medicos.index') }}">
                                <span data-feather="file"></span>
                                <i class="fas fa-hospital-user mr-2"></i>
                                Médicos
                            </a>
                        </li>
                    </ul>

                    <ul class="nav flex-column mb-2 d-block d-md-none">
                        <li class="nav-item mx-5 my-5">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-block">Cerrar Sesión</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
    
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 pt-3">
                
                <div class="col-12 mb-3">

                    <div class="row">
                        <div class="col-12 text-center">
                            <h2 class="my-2">
                                Control de Enfermedades Oportunistas
                            </h2>
                        </div>
                        {{-- <div class="col-md-6 text-left text-md-right pb-2 pb-md-0">
                            <a href="{{ route('pacientes.createForm') }}" class="btn btn-success px-4">
                                <i class="far fa-plus-square mr-2"></i>
                                Crear Nuevo Paciente
                            </a>
                        </div> --}}
                    </div>

                    <hr class="mt-0">

                    <div class="row">
                        <div class="col-8">
                            <h2>
                                <b>Paciente: </b>
                                {{ $paciente['Nombres_Paciente'] }} {{ $paciente['Apellidos_Paciente'] }}
                            </h2>
                        </div>
                    </div>

                </div>

                <div class="col-12 mb-3">
                   
                    <form action="{{ route('paciente.enfermedades.crear', $id) }}" method="post">
                        @csrf
                        <div class="row">

                            <div class="col-12 col-md-10">
                                <div class="form-group">
                                    <label for="enfermedades" class="ml-2">Enfermedades Oportunistas</label>
                                    <input type="text" class="form-control" id="enfermedades" name="enfermedades" required>
                                </div>
                            </div>

                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <label for="medicamentos" class="ml-2">¿Toma Medicamentos?</label>
                                    <select class="custom-select" id="medicamentos" name="medicamentos" required>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="fecha" class="ml-2">Fecha Inicio</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="mejora" class="ml-2">Fecha Mejora</label>
                                    <input type="date" class="form-control" id="mejora" name="mejora">
                                </div>
                            </div>

                            <div class="col-12 col-md-6 text-right">
                                <button type="submit" class="btn btn-success px-5 mt-4">
                                    Guardar
                                </button>
                            </div>

                        </div>

                    </form>

                </div>

            </main>

        </div>
    </div>

@endsection

@section('scripts')
    
    {{-- <script src="{{ asset('src/js/dashboard.js') }}"></script>
    <!-- Datatable -->
    <script src="{{ asset('src/js/datatables.min.js') }}"></script>
    <script src="{{ asset('src/js/dataTables.responsive.min.js') }}"></script> --}}

    {{-- <script>
        $(document).ready( function () {
            $('#table_id').DataTable( {
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
            } );
        } );
    </script> --}}

@endsection