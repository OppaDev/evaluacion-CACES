@extends('layouts.app')
@section('content')
<section id="hero" class="d-flex align-items-center login-section min-vh-100">
    <div class="container-fluid d-flex justify-content-center align-items-center vh-100 bg-overlay">
        <div class="login-form p-5 bg-white rounded shadow-lg text-center">
            <img src="https://www.espe.edu.ec/wp-content/uploads/2023/03/espe.png" alt="Logo" class="mb-4" width="100"> 
            <form class="contact100-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-2">
                        <i class="bi bi-envelope" style="font-size: 30px"></i>
                    </div>
                    <div class="col-sm-10">
                        <div class="wrap-input100">
                            <input id="email" type="email"
                                class="input100 @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="Escriba su correo electrónico">
                        </div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>Error al ingresar credenciales</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <i class="bi bi-lock" style="font-size: 30px"></i>
                    </div>
                    <div class="col-sm-10">
                        <div class="wrap-input100">
                            <input id="password" type="password"
                                class="input100 @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="Escriba su contraseña">
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>Error al ingresar credenciales</strong>
                    </span>
                    @enderror
            
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
            
                            <label class="form-check-label" for="remember">
                                Recordar sesión
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-danger">Iniciar sesión</button>
                </div>
                <!-- Register buttons -->
                {{-- <div class="text-center" style="margin-top: 40px;">
                                <p>¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
                </div> --}}
            </form>
        </div>
    </div>
</section>
@endsection