@extends('app')

@section('encabezados')
    
    <title>Control Médico - Sistema</title>
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
        <div class="row mb-5">
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
                                Control Médico / Paciente
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
                        <div class="col-4 text-right">
                            <button type="button" class="btn btn-success px-3" data-toggle="modal" data-target="#crear" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                Ingresar Nuevo Control
                            </button>

                            <!-- MODAL CREAR NUEVO CONTROL DE MEDICO ASIGNADO -->
                            <div class="modal fade" id="crear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('medicopaciente.crear', $id) }}" method="post">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Crear Asignación de Médico de Atención</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">

                                                <input type="hidden" name="paciente" value="{{ $id }}">

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="fecha" class="ml-2">Fecha de Atención</label>
                                                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="medico" class="ml-2">Médicos</label>
                                                        <select class="custom-select" id="medico" name="medico" required>
                                                            @foreach ($medicos as $medico)
                                                                <option value="{{ $medico['Id_Medico'] }}">{{ $medico['Nombres_Medico'] }} {{ $medico['Apellidos_Medico'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-success">Actualizar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>












                            {{-- <a href="{{ route('pdfFichaCD4CargaViral', $id) }}" class="btn btn-secondary px-3">
                                Generar PDF
                            </a> --}}
                        </div>
                    </div>

                </div>

                <div class="col-12 mb-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Fecha de atención</th>
                                <th>Nombre del médico</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($controlMedico as $control)
                                <tr>
                                    <td>{{ $control['Fecha_ingreso'] }}</td>
                                    <td>{{ $control['medico']['Nombres_Medico'] }} {{ $control['medico']['Apellidos_Medico'] }}</td>
                                    <th>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editar-{{ $control['Id_Control'] }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#borrar-{{ $control['Id_Control'] }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </th>
                                </tr>

                                <!-- MODAL EDITAR EL MEDICO ASIGNADO -->
                                <div class="modal fade" id="editar-{{ $control['Id_Control'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('medicopaciente.actualizar', [$id, $control['Id_Control']]) }}" method="post">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cambiar Médico de Atención</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="medico" class="ml-2">Médicos</label>
                                                            <select class="custom-select" id="medico" name="medico" required>
                                                                @foreach ($medicos as $medico)
                                                                    <option value="{{ $medico['Id_Medico'] }}">{{ $medico['Nombres_Medico'] }} {{ $medico['Apellidos_Medico'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal -->
                                <div class="modal fade" id="borrar-{{ $control['Id_Control'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('medicopaciente.borrar', [$id, $control['Id_Control']]) }}" method="post">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Registro</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Esta seguro que desea eliminar este registro?
                                                    <span class="d-block"><b>Código: </b>{{ $control['Id_Control'] }}</span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
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