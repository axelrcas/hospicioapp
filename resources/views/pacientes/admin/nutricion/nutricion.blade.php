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
                        <div class="col-4 text-right">
                            <a href="{{ route('paciente.nutricion.nuevo', $id) }}" class="btn btn-success px-3">
                                Ingresar Nuevo Control
                            </a>
                            <a href="{{ route('pdfFichaControlNutricional', $id) }}"  target="_blanck" class="btn btn-secondary px-3">
                                Generar PDF
                            </a>
                        </div>
                    </div>

                </div>
                
                <div class="row px-3 mb-3">

                    <div class="col-12 col-md-3">
                        <b>Fecha de Nacimiento:</b>
                        {{ $paciente['Fecha_Nacimiento'] }}
                    </div>

                    <div class="col-12 col-md-2">
                        <b>Talla:</b>
                        {{ $control['Talla'] }}
                    </div>

                    <div class="col-12 col-md-2">
                        <b>Peso Mínimo:</b>
                        {{ $control['Peso_Min'] }}
                    </div>

                    <div class="col-12 col-md-2">
                        <b>Peso Máximo:</b>
                        {{ $control['Peso_Max'] }}
                    </div>

                    <div class="col-12 col-md-3">
                        <div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-secondary btn-sm float-right px-3" data-toggle="modal" data-target="#staticBackdrop">
                                Actualizar Control
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Actualizar Control de Estado Nutricional</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    
                                        <form action="{{ route('paciente.nutricion.updateControl', [$id, $control['Id_MP']]) }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                
                                                <div class="row text-left">
                                                                                                            
                                                    <input type="hidden" id="idPaciente" name="idPaciente" value="{{ $paciente['Id_Paciente'] }}">
                                                    <input type="hidden" id="idControl" name="idControl" value="{{ $control['Id_MP'] }}">

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
                                                            <input type="text" class="form-control" id="talla" name="talla" value="{{ $control['Talla'] }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="pesomin" class="ml-2">Peso Mínimo</label>
                                                            <input type="text" class="form-control" id="pesomin" name="pesomin" value="{{ $control['Peso_Min'] }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="pesomax" class="ml-2">Peso Máximo</label>
                                                            <input type="text" class="form-control" id="pesomax" name="pesomax" value={{ $control['Peso_Max'] }}>
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
                        </div>

                        <div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger btn-sm float-right px-3 mr-1" data-toggle="modal" data-target="#staticBackdrop2">
                                Eliminar Control
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop2">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Actualizar Control de Estado Nutricional</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    
                                        <form action="{{ route('paciente.nutricion.deleteControl', [$id, $control['Id_MP']]) }}" method="post">
                                            @csrf
                                            <div class="modal-body">

                                                ¿Seguro que desea eliminar este Control?

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Peso</th>
                                <th>Tercero</th>
                                <th>Segundo</th>
                                <th>Primero</th>
                                <th>Observaciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nutricional as $nutri)
                                <tr>
                                    <td>{{ $nutri['Fecha_E'] }}</td>
                                    <td>{{ $nutri['Peso'] }}</td>
                                    <td>
                                        @if ( $nutri['Tercero'] == "true" )
                                            <span class="h3"><i class="fas fa-check text-secondary"></i></span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ( $nutri['Segundo'] == "true" )
                                            <span class="h3"><i class="fas fa-check text-secondary"></i></span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ( $nutri['Primero'] == "true" )
                                            <span class="h3"><i class="fas fa-check text-secondary"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $nutri['Observaciones'] }}</td>
                                    <th>
                                        <a href="{{ route('paciente.nutricion.actualizar', [$id, $nutri['Id_Estado_N']]) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#borrar-{{ $nutri['Id_Estado_N'] }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </th>
                                </tr>

                                <div class="modal fade" id="borrar-{{ $nutri['Id_Estado_N'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('paciente.nutricion.borrar', [$id, $nutri['Id_Estado_N']]) }}" method="post">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Registro</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Esta seguro que desea eliminar este registro?
                                                    <span class="d-block"><b>Código: </b>{{ $nutri['Id_Estado_N'] }}</span>
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