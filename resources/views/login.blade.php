@extends('app')

@section('encabezados')
    
    <title>Login - Sistema</title>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('src/css/adminlte.min.css') }}">

@endsection

@section('contenido')
    
    <div class="hold-transition login-page fnd-azul-light">
        <div class="login-box">

            <div class="login-logo">
                <img src="{{ asset('src/img/logos/logo.png') }}" alt="CBP" class="img-login"> 
            </div>
            
            <div class="card py-3 shadow">
                <div class="card-body login-card-body">

                    @if (session()->has('flash'))
                        <div class="alert alert-warning mt-n2 text-center" role="alert">
                            <i class="fas fa-info-circle mr-2"></i>
                            {{ session('flash') }}
                        </div>
                    @endif

                    <h3 class="login-box-msg">Inicio de Sesión</h3>
            
                    <form action="{{ route('login') }}" method="POST" novalidate>
                        @csrf
                        <div class="input-group mb-3">
                            <input name="usuario"
                                type="text" 
                                class="form-control @error('usuario') is-invalid @enderror" 
                                value="{{ old('usuario') }}"
                                placeholder="Usuario"
                            >
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>

                            @error('usuario')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input name="password"
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                placeholder="Contraseña"
                            >
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>

                    </form>
            
                    <p class="mt-4 mb-0 text-center">
                        <a href="forgot-password.html">¿Olvidaste tu contraseña?</a>
                    </p>

                </div>
            </div>
        </div>
    </div>

@endsection 