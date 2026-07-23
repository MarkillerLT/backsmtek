<x-guest-layout>
    <header>
        <div class="logo">
        <img
          id="logo-img"
          src="assets/img/1.svg"
          alt="SMTEK Logo"
          onerror="
            this.style.display = 'none';
            document.getElementById('logo-fallback').style.display = 'flex';
          "
        />
        <div id="logo-fallback" class="logo-placeholder" style="display: none">
          SMTEK
        </div>
      </div>
    <div>
<div class="header-actions">

        <div class="auth-links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashoard') }}">Dashboar</a>
                @else
                    <a href="{{ route('login') }}">Ingresar</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="cta-nav">
                            Registrarse
                        </a>
                    @endif
                @endauth
            @endif
        </div>

      <button
        id="dark-toggle"
        class="dark-toggle"
        aria-label="Cambiar modo de color"
        type="button"
      >
        <span class="toggle-icon" aria-hidden="true">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="1em"
            height="1em"
            viewBox="0 0 24 24"
          >
            <title xmlns="">dark</title>
            <path
              fill="currentColor"
              d="M12.741 20.917a9.4 9.4 0 0 1-1.395-.105a9.141 9.141 0 0 1-1.465-17.7a1.18 1.18 0 0 1 1.21.281a1.27 1.27 0 0 1 .325 1.293a8.1 8.1 0 0 0-.353 2.68a8.27 8.27 0 0 0 4.366 6.857a7.6 7.6 0 0 0 3.711.993a1.242 1.242 0 0 1 .994 1.963a9.15 9.15 0 0 1-7.393 3.738M10.261 4.05a.2.2 0 0 0-.065.011a8.137 8.137 0 1 0 9.131 12.526a.22.22 0 0 0 .013-.235a.23.23 0 0 0-.206-.136a8.6 8.6 0 0 1-4.188-1.116a9.27 9.27 0 0 1-4.883-7.7a9.1 9.1 0 0 1 .4-3.008a.29.29 0 0 0-.069-.285a.18.18 0 0 0-.133-.057"
            />
          </svg>
        </span>
        <span class="toggle-label">Modo Oscuro</span>
        <div class="toggle-track" aria-hidden="true">
          <div class="toggle-thumb"></div>
        </div>
      </button>
    </div>

    </header>

    {{-- ╔══════════════════════════════════════════════════════════╗
         ║  NAVEGACIÓN PRINCIPAL                                   ║
         ╚══════════════════════════════════════════════════════════╝ --}}
    <div class="nav-bg">
        <div class="contenedor">
            <nav id="nav-principal" class="navegacion-principal" style="flex: 1">
                <a href="{{ url('/') }}">Inicio</a>
                <a href="#">Productos</a>
                <a href="#">Servicios</a>
                <a href="#">Contacto</a>
                <a href="#" class="cta-nav">Cotizar</a>
                <a href="#" style="font-weight: bold">Trabaja con nosotros</a>
            </nav>
        </div>
    </div>

    {{-- ╔══════════════════════════════════════════════════════════╗
         ║  HERO — fondo de imagen igual que el sitio              ║
         ╚══════════════════════════════════════════════════════════╝ --}}
    <div class="hero">
        <div class="hero-content">

            <div class="register-card login-card">

                <div class="register-card__header">
                    <h1>Iniciar sesión</h1>
                    <p>Ingresa tus datos para acceder a tu cuenta.</p>
                </div>

                {{-- Mensaje de sesión (link de reseteo enviado, etc.) --}}
                @if (session('status'))
                    <div class="login-status">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Correo --}}
                    <div class="register-field">
                        <label for="email">Correo electrónico</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="correo@ejemplo.com"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        @error('email')
                            <span class="register-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Contraseña --}}
                    <div class="register-field">
                        <label for="password">Contraseña</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Tu contraseña"
                            required
                            autocomplete="current-password"
                        />
                        @error('password')
                            <span class="register-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Recuérdame + Olvidé mi contraseña --}}
                    <div class="login-row">
                        <label class="login-remember">
                            <input type="checkbox" name="remember">
                            <span>Recuérdame</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="login-forgot" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    {{-- Botón submit --}}
                    <button type="submit" class="btn-primary register-submit">
                        Iniciar sesión
                    </button>

                    {{-- Link a registro --}}
                    <p class="register-login-link">
                        ¿No tienes cuenta?
                        <a href="{{ route('register') }}">Regístrate aquí</a>
                    </p>

                </form>
            </div>{{-- /.register-card --}}

        </div>{{-- /.hero-content --}}
    </div>{{-- /.hero --}}


    {{-- ╔══════════════════════════════════════════════════════════╗
         ║  ESTILOS ESPECÍFICOS DE ESTA VISTA                     ║
         ║  (idénticos a register.blade.php para consistencia)   ║
         ╚══════════════════════════════════════════════════════════╝ --}}
    <style>
        .hero {
            min-height: calc(100vh - 11rem);
            height: auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-content {
            width: 100%;
            padding: 4rem 2rem;
            justify-content: center;
        }

        /* ── Card principal (compartida con register) ── */
        .register-card {
            width: min(48rem, 100%);
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            padding: 4rem;
            border: 1px solid rgba(255, 255, 255, 0.7);
        }

        body.dark-mode .register-card {
            background: rgba(26, 35, 48, 0.90);
            border-color: rgba(255, 255, 255, 0.08);
        }

        .register-card__header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .register-card__header h1 {
            font-size: 2.6rem;
            font-weight: 800;
            margin: 0 0 0.8rem;
            color: var(--text-heading) !important;
            text-shadow: none !important;
            -webkit-text-stroke: 0 !important;
        }

        .register-card__header p {
            font-size: 1.4rem;
            margin: 0;
            text-shadow: none;
            color: var(--text-muted) !important;
        }

        .register-field {
            display: flex;
            flex-direction: column;
            margin-bottom: 1.8rem;
        }

        .register-field label {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.6rem;
            letter-spacing: 0.02em;
        }

        .register-field input {
            width: 100%;
            padding: 1.2rem 1.6rem;
            font-size: 1.5rem;
            font-family: "Inter", sans-serif;
            color: var(--text-primary);
            background-color: var(--blanco);
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-sm);
            outline: none;
            transition: border-color var(--transition), box-shadow var(--transition);
        }

        body.dark-mode .register-field input {
            background-color: #1e2d3e;
            color: var(--text-heading);
            border-color: var(--border-color);
        }

        .register-field input:focus {
            border-color: var(--AzulSmtek);
            box-shadow: 0 0 0 3px rgba(33, 150, 186, 0.18);
        }

        .register-error {
            font-size: 1.2rem;
            color: var(--error);
            margin-top: 0.4rem;
        }

        .register-submit {
            display: block;
            width: 100%;
            margin-bottom: 2rem;
            font-family: "Inter", sans-serif;
            font-size: 1.6rem;
            border: none;
        }

        .register-login-link {
            text-align: center;
            font-size: 1.4rem;
            color: var(--text-muted);
            margin: 0;
        }

        .register-login-link a {
            color: var(--AzulSmtek);
            font-weight: 700;
            text-decoration: none;
            transition: color var(--transition);
        }

        .register-login-link a:hover {
            color: var(--AzulOscuro);
        }

        /* ── Mensaje de estado (status de sesión) ── */
        .login-status {
            background-color: var(--AzulClaro);
            color: var(--AzulOscuro);
            border-radius: var(--radius-sm);
            padding: 1.2rem 1.6rem;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 2rem;
            border-left: 4px solid var(--contrastes);
        }

        body.dark-mode .login-status {
            background-color: #1a3040;
            color: var(--AzulClaro);
        }

        /* ── Fila: Recuérdame + Olvidé contraseña ── */
        .login-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2.4rem;
        }

        .login-remember {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-size: 1.35rem;
            color: var(--text-muted);
            cursor: pointer;
        }

        .login-remember input[type="checkbox"] {
            width: 1.7rem;
            height: 1.7rem;
            accent-color: var(--AzulSmtek);
            cursor: pointer;
        }

        .login-forgot {
            font-size: 1.35rem;
            font-weight: 600;
            color: var(--AzulSmtek);
            text-decoration: none;
            transition: color var(--transition);
        }

        .login-forgot:hover {
            color: var(--AzulOscuro);
            text-decoration: underline;
        }

        /* ══════════════════ RESPONSIVE ══════════════════ */
        @media (max-width: 600px) {
            .register-card {
                padding: 3rem 2rem;
            }

            .login-row {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 480px) {
            .register-card__header h1 {
                font-size: 2.2rem;
            }
        }
    </style>
    <script src="assets/js/script.js"></script>
</x-guest-layout>
