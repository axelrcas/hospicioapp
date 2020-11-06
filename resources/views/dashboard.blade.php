@extends('app')

@section('encabezados')
    
    <title>Dashboard - Sistema</title>
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
                            <a  class="nav-link active font-weight-bold" 
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
                            <a  class="nav-link text-white"
                                href="{{ route('medicos.index') }}">
                                <span data-feather="file"></span>
                                <i class="fas fa-hospital-user mr-2"></i>
                                Médicos
                            </a>
                        </li>
        
                    {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Saved reports</span>
                        <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>

                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">
                                <span data-feather="file-text"></span>
                                Current month
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">
                                <span data-feather="file-text"></span>
                                Last quarter
                            </a>
                        </li>
                    </ul> --}}

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
                    <div class="alert alert-secondary" role="alert">
                        Usuario Autenticado: <span class="font-weight-bold ml-1 text-primary">{{ auth()->user()->usuario }}</span>
                    </div>
                </div>

                <div class="col-12">

                    <h2 class="mb-2">Dashboard</h2>
                    <hr class="mt-0">

                    <div class="row text-white">

                        <div class="col-md-3 col-12">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>{{ $totalPacientes }}</h3>
                                    <p>Pacientes</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-friends"></i>
                                </div>
                                <a href="{{ route('pacientes.index') }}" class="small-box-footer">
                                    Más Información <i class="fas fa-long-arrow-alt-right ml-2"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $totalMedicos }}</h3>
                                    <p>Médicos</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-hospital-user"></i>
                                </div>
                                <a href="{{ route('medicos.index') }}" class="small-box-footer">
                                    Más Información <i class="fas fa-long-arrow-alt-right ml-2"></i>
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
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>

@endsection