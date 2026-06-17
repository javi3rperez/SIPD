@extends('layouts.app')

@section('content')
<style>
    
    /* Fondo completo con imagen */
    .login-page {
        background-image: url('{{ asset("imagenes/fondo-login.jpg") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        position: relative;
        min-height: 100vh;
    }

    /* Overlay oscuro para que el formulario resalte */
    .login-page::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(104, 99, 99, 0.65);
        z-index: 1;
    }
    /* Forzar eliminación de espacios del layout */
body, .app-wrapper, main, .py-4 {
    padding-top: 0 !important;
    margin-top: 0 !important;
}

    /* Contenedor principal */
    .login-container {
        position: relative;
        z-index: 2;
    }

    /* Tarjeta de login - diseño moderno y elegante */
    .login-card {
        background: #ffffff;
        border-radius: 21px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .login-card:hover {
        transform: translateY(-5px);
    }

    /* Header de la tarjeta */
    .login-header {
        background: linear-gradient(135deg, #2caf11 0%, #2caf11 100%);
        padding: 2rem 1.5rem 1.5rem;
        text-align: center;
        border-bottom: 3px solid #f8f3e2;
    }

    /* Logo en header */
    .login-logo {
        max-height: 70px;
        margin-bottom: 1rem;
        filter: brightness(0) invert(1);
    }

    /* Cuerpo del formulario */
    .login-body {
        padding: 2rem;
    }

    /* Inputs modernos */
    .input-moderno {
        border: 2px solid #e1e8ed;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }

    .input-moderno:focus {
        border-color: #2caf11;
        box-shadow: 0 0 0 3px rgba(26, 74, 122, 0.1);
        background-color: #ffffff;
    }

    /* Botón principal */
    .btn-login {
        background: linear-gradient(135deg, #2caf11 0%, #2caf11 100%);
        border: none;
        border-radius: 12px;
        padding: 0.875rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        background: linear-gradient(135deg, #2caf11 0%, #2caf11 100%);
    }

    /* Enlaces */
    .link-forgot {
        color: #1a4a7a;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .link-forgot:hover {
        color: #0f2b4d;
        text-decoration: underline;
    }

    /* Checkbox personalizado */
    .checkbox-custom {
        width: 18px;
        height: 18px;
        margin-right: 8px;
        cursor: pointer;
        accent-color: #1a4a7a;
    }

    /* Separador */
    .separador {
        height: 1px;
        background: linear-gradient(90deg, transparent, #dee2e6, transparent);
        margin: 1.5rem 0;
    }

    /* Animación de entrada */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-login {
        animation: fadeInUp 0.6s ease-out;
    }

    /* Textos */
    .text-empresa {
        font-size: 0.8rem;
        color: #6c757d;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .login-body {
            padding: 1.5rem;
        }
        
        .login-header {
            padding: 1.5rem 1rem 1rem;
        }
    }
</style>

<div class="login-page">
    
    <div class="login-container d-flex align-items-center min-vh-100 py-5">
        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5 col-xl-4">
                    
                    <!-- Tarjeta de login -->
                    <div class="login-card animate-login">
                        
                        <!-- Header con logo -->
                        <div class="login-header">
                            <img src="{{ asset('imagenes/cootranshuila.png') }}" 
                                 alt="Cootranshuila" 
                                 class="login-logo">
                            <h3 class="text-white mb-2 fw-bold">Bienvenido</h3>
                            <p class="text-white-50 mb-0 small">Al sistema integral de procesos disciplinario S.I.P.D</p>
                        </div>
                        
                        <!-- Formulario -->
                        <div class="login-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <!-- Campo Email -->
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-semibold text-secondary mb-2">
                                        <i class="bi bi-envelope-fill me-2"></i>Correo Electrónico
                                    </label>
                                    <input type="email" 
                                           class="form-control input-moderno @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}"
                                           placeholder="usuario@cootranshuila.com"
                                           required 
                                           autofocus>
                                    @error('email')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <!-- Campo Contraseña -->
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-semibold text-secondary mb-2">
                                        <i class="bi bi-lock-fill me-2"></i>Contraseña
                                    </label>
                                    <input type="password" 
                                           class="form-control input-moderno @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Ingrese su contraseña"
                                           required>
                                    @error('password')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <!-- Opciones -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" 
                                               class="checkbox-custom" 
                                               name="remember" 
                                               id="remember" 
                                               {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label text-muted small" for="remember">
                                            Recordarme
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="link-forgot">
                                            <i class="bi bi-question-circle me-1"></i>¿Olvidó su contraseña?
                                        </a>
                                    @endif
                                </div>
                                
                                <!-- Botón Login -->
                                <button type="submit" class="btn btn-login text-white">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    Iniciar Sesión
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                                
                                <!-- Separador decorativo -->
                                <div class="separador"></div>
                                
                              
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection