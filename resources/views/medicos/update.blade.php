@extends('app')

@section('encabezados')
    
    <title>Médicos - Sistema</title>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('src/css/dashboard.css') }}">
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ asset('src/css/datatables.min.css') }}">

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
                            <a  class="nav-link text-white" 
                                href="{{ route('dashboard') }}">
                                <i class="fas fa-home mr-2"></i>
                                Tablero 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link text-white" 
                                href="{{ route('pacientes.index') }}">
                                <i class="fas fa-user-friends mr-2"></i>
                                Pacientes 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link active font-weight-bold"
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
                        <div class="col-12">
                            <a href="{{ route('medicos.index') }}" class="btn btn-secondary btn-sm px-3 mb-3">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Regresar
                            </a>
                            {{-- <a href="{{ route('descargarPDF', $medico['Id_Medico']) }}" class="btn btn-primary btn-sm px-3 float-right">
                                <i class="fas fa-download mr-2"></i>
                                Descargar Ficha del Paciente
                            </a> --}}
                            <h2 class="my-2">Actualizar Médico</h2>
                        </div>
                    </div>

                    <hr class="mt-0">

                </div>

                <div class="col-12 mb-3">
                    <form action="{{ route('medicos.update', $medico['Id_Medico']) }}" method="POST">

                        @csrf
                        <div class="row">

                            <!-- DATOS PERSONALES -->
                            <div class="col-12 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                    
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="nombre" class="ml-2">Nombre</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $medico['Nombres_Medico'] }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="apellidos" class="ml-2">Apellidos</label>
                                                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $medico['Apellidos_Medico'] }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="dpi" class="ml-2">DPI</label>
                                                    <input type="number" class="form-control" id="dpi" name="dpi" value="{{ $medico['DPI'] }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="telefono" class="ml-2">DPI</label>
                                                    <input type="number" class="form-control" id="telefono" name="telefono" value="{{ $medico['Telefono'] }}" required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-12 mb-5 text-center text-md-right">
                            <button type="submit" class="btn btn-success btn-lg px-5">
                                Actualizar Información
                            </button>
                        </div>

                    </form>
                </div>

            </main>

        </div>
    </div>

@endsection

@section('scripts')
    
    <script src="{{ asset('src/js/dashboard.js') }}"></script>

@endsection