@extends('app')

@section('encabezados')
    
    <title>Control de Estado Nutricional - Sistema</title>
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
                                Control de Estado Nutricional
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
                   
                    <form action="{{ route('paciente.nutricion.actualizar', [$id, $no]) }}" method="post">
                        @csrf
                        <input type="hidden" name="idpaciente" id="idpaciente" value="{{ $paciente['Id_Paciente'] }}">
                        
                        <div class="row">

                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="fecha" class="ml-2">Fecha</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $estadoNutricional['Fecha_E'] }}" required>
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="peso" class="ml-2">Peso</label>
                                    <input type="text" class="form-control" id="peso" name="peso" value="{{ $estadoNutricional['Peso'] }}">
                                </div>
                            </div>

                            <div class="col-12 col-md-2">
                                <div class="form-group mt-3 ml-5">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <label for="tercero" class="mt-2 mr-2">Tercero:</label>
                                            <input type="checkbox" id="tercero" name="tercero" @if ( $estadoNutricional['Tercero'] == "true" ) checked @endif>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-2">
                                <div class="form-group mt-3 ml-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <label for="segundo" class="mt-2 mr-2">Segundo:</label>
                                            <input type="checkbox" id="segundo" name="segundo" @if ( $estadoNutricional['Segundo'] == "true" ) checked @endif>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-2">
                                <div class="form-group mt-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <label for="primero" class="mt-2 mr-2">Primero:</label>
                                            <input type="checkbox" id="primero" name="primero" @if ( $estadoNutricional['Primero'] == "true" ) checked @endif>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="observaciones" class="ml-2">Observaciones</label>
                                    <input type="text" class="form-control" id="observaciones" name="observaciones" value="{{ $estadoNutricional['Observaciones'] }}">
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-success px-5 mt-2">
                                    Actualizar
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