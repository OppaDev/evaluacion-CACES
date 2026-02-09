@extends('layouts.app')
@section('content')
<style>
    .login-section {
        background: linear-gradient(135deg, #00713d 0%, #004d2a 100%);
        min-height: 100vh;
    }
    .login-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        padding: 3rem;
        max-width: 420px;
        width: 100%;
    }
    .login-input {
        width: 100%;
        padding: 14px 16px 14px 48px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f8fafc;
    }
    .login-input:focus {
        outline: none;
        border-color: #00713d;
        background: white;
        box-shadow: 0 0 0 4px rgba(0, 113, 61, 0.1);
    }
    .input-group-login {
        position: relative;
        margin-bottom: 1.25rem;
    }
    .input-group-login i {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
        font-size: 18px;
        z-index: 1;
    }
    .btn-login {
        width: 100%;
        padding: 14px;
        background: #00713d;
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .btn-login:hover {
        background: #005c32;
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0, 113, 61, 0.3);
    }
</style>
<section class="d-flex align-items-center justify-content-center login-section">
    <div class="login-card text-center animate__animated animate__fadeIn">
        <img src="https://www.espe.edu.ec/wp-content/uploads/2023/03/espe.png" alt="ESPE Logo" class="mb-4" width="100"> 
        <h4 class="fw-bold mb-1" style="color: #1e293b;">Bienvenido</h4>
        <p class="text-muted mb-4">Sistema de Evaluación CACES</p>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group-login">
                <i class="bi bi-envelope"></i>
                <input id="email" type="email" class="login-input @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                       placeholder="Correo electrónico">
            </div>
            @error('email')
                <div class="alert alert-danger py-2 mb-3" style="border-radius: 8px; font-size: 14px;">
                    <i class="bi bi-exclamation-circle me-1"></i>Credenciales incorrectas
                </div>
            @enderror
            
            <div class="input-group-login">
                <i class="bi bi-lock"></i>
                <input id="password" type="password" class="login-input @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="current-password"
                       placeholder="Contraseña">
            </div>
            @error('password')
                <div class="alert alert-danger py-2 mb-3" style="border-radius: 8px; font-size: 14px;">
                    <i class="bi bi-exclamation-circle me-1"></i>Credenciales incorrectas
                </div>
            @enderror

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label text-muted small" for="remember">Recordar sesión</label>
                </div>
            </div>
            
            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
            </button>
        </form>
        
        <p class="text-muted small mt-4 mb-0">&copy; {{ date('Y') }} Universidad de las Fuerzas Armadas ESPE</p>
    </div>
</section>
@endsection