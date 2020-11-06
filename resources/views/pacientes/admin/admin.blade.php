@extends('app')

@section('encabezados')
    
    <title>Paciente - Sistema</title>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('src/css/dashboard.css') }}">
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ asset('src/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/css/responsive.dataTables.min.css') }}">

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
                
                <div class="col-12">

                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="my-2">
                                <b>Paciente: </b>
                                {{ $paciente['Nombres_Paciente'] }} {{ $paciente['Apellidos_Paciente'] }}
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

                </div>

                <div class="row text-center">
                    <div class="col-sm-3 my-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h3 class="card-title py-2">Control Médico/Paciente</h3>
                                <a  href="{{ route('medicopaciente.index', $id) }}"   
                                    class="btn btn-primary btn-block mb-2">
                                    Ingresar
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 my-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h3 class="card-title py-2">Control de CD4 Y Carga Viral</h3>
                                <a  href="{{ route('paciente.cd4cargaviral', $id) }}"   
                                    class="btn btn-primary btn-block mb-2">
                                    Ingresar
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 my-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h3 class="card-title py-2">Control de Estado Nutricional</h3>

                                @if ( count($hasControlNutricional->json()) == 0 )
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-block mb-2" data-toggle="modal" data-target="#staticBackdrop">
                                        Crear Control
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Crear Control de Estado Nutricional</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            
                                                <form action="{{ route('paciente.nutricion.crearControl', $id) }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        
                                                        <div class="row text-left">
                                                                                                                    
                                                            <input type="hidden" id="idPaciente" name="idPaciente" value="{{ $paciente['Id_Paciente'] }}">

                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="paciente" class="ml-2">Paciente</label>
                                                                    <input type="text" class="form-control" id="paciente" name="paciente" disabled
                                                                        value="{{ $paciente['Nombres_Paciente'] }} {{ $paciente['Apellidos_Paciente'] }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="fechanac" class="ml-2">Fecha de Nacimiento</label>
                                                                    <input type="text" class="form-control" id="fechanac" name="fechanac" disabled
                                                                        value="{{ $paciente['Fecha_Nacimiento'] }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="talla" class="ml-2">Talla</label>
                                                                    <input type="text" class="form-control" id="talla" name="talla">
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="pesomin" class="ml-2">Peso Mínimo</label>
                                                                    <input type="text" class="form-control" id="pesomin" name="pesomin">
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="pesomax" class="ml-2">Peso Máximo</label>
                                                                    <input type="text" class="form-control" id="pesomax" name="pesomax">
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary">Crear</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <a  href="{{ route('paciente.nutricion', $id) }}"   
                                        class="btn btn-primary btn-block mb-2">
                                        Ingresar
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 my-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h3 class="card-title py-2">Control de Enfermedades</h3>
                                <a  href="{{ route('paciente.enfermedades', $id) }}"   
                                    class="btn btn-primary btn-block mb-2">
                                    Ingresar
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 my-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h3 class="card-title py-2">Control de Glicemia</h3>
                                <a  href="{{ route('paciente.glicemia', $id) }}"   
                                    class="btn btn-primary btn-block mb-2">
                                    Ingresar
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 my-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h3 class="card-title py-2">Control de CVI</h3>
                                <a  href="{{ route('paciente.cvi', $id) }}"   
                                    class="btn btn-primary btn-block mb-2">
                                    Ingresar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


            </main>

        </div>
    </div>

@endsection

@section('scripts')
    
    <script src="{{ asset('src/js/dashboard.js') }}"></script>
    <!-- Datatable -->
    <script src="{{ asset('src/js/datatables.min.js') }}"></script>
    <script src="{{ asset('src/js/dataTables.responsive.min.js') }}"></script>

    <script>
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
    </script>

@endsection