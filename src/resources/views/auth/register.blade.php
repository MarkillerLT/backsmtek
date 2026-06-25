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
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
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

            {{-- Card de registro centrado sobre el hero --}}
            <div class="register-card">

                <div class="register-card__header">
                    <h1>Crear cuenta</h1>
                    <p>Regístrate para acceder a todos nuestros servicios y productos.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Nombre + Apellido en dos columnas --}}
                    <div class="register-row">
                        <div class="register-field">
                            <label for="name">Nombre</label>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Juan"
                                required
                                autofocus
                                autocomplete="name"
                            />
                            @error('name')
                                <span class="register-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="register-field">
                            <label for="last_name">Apellido</label>
                            <input
                                id="last_name"
                                type="text"
                                name="last_name"
                                value="{{ old('last_name') }}"
                                placeholder="Pérez"
                                autocomplete="family-name"
                                required
                            />
                        </div>
                    </div>

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
                            autocomplete="username"
                            required
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
                            placeholder="Mínimo 8 caracteres"
                            required
                            autocomplete="new-password"
                        />
                        @error('password')
                            <span class="register-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Confirmar contraseña --}}
                    <div class="register-field">
                        <label for="password_confirmation">Confirmar contraseña</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            placeholder="Repite tu contraseña"
                            required
                            autocomplete="new-password"
                        />
                        @error('password_confirmation')
                            <span class="register-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Términos (Jetstream) --}}
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="register-terms">
                            <input type="checkbox" id="terms" name="terms" required />
                            <label for="terms">
                                Acepto los
                                <a href="{{ route('terms.show') }}" target="_blank">Términos de servicio</a>
                                y la
                                <a href="{{ route('policy.show') }}" target="_blank">Política de privacidad</a>.
                            </label>
                        </div>
                        @error('terms')
                            <span class="register-error" style="margin-top:-1rem;display:block;margin-bottom:1rem;">
                                {{ $message }}
                            </span>
                        @enderror
                    @endif

                    {{-- Botón submit --}}
                    <button type="submit" class="btn-primary register-submit">
                        Crear cuenta
                    </button>

                    {{-- Link a login --}}
                    <p class="register-login-link">
                        ¿Ya tienes cuenta?
                        <a href="{{ route('login') }}">Inicia sesión aquí</a>
                    </p>

                </form>
            </div>{{-- /.register-card --}}

        </div>{{-- /.hero-content --}}
    </div>{{-- /.hero --}}


    {{-- ╔══════════════════════════════════════════════════════════╗
         ║  ESTILOS ESPECÍFICOS DE ESTA VISTA                     ║
         ║  (todo usa tus variables CSS del styles.css)           ║
         ╚══════════════════════════════════════════════════════════╝ --}}
    <style>
        /* Ajuste del hero para esta página: ocupa el resto de la pantalla */
        .hero {
            min-height: calc(100vh - 11rem); /* descuenta header + nav */
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

        /* ── Card principal ── */
        .register-card {
            width: min(52rem, 100%);
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

        /* ── Encabezado de la card ── */
        .register-card__header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .register-card__header h1 {
            font-size: 2.6rem;
            font-weight: 800;
            color: var(--text-heading);
            margin: 0 0 0.8rem;
            /* Sobreescribimos el h1 del hero que es blanco */
            color: var(--text-heading) !important;
            text-shadow: none !important;
            -webkit-text-stroke: 0 !important;
        }

        .register-card__header p {
            font-size: 1.4rem;
            color: var(--text-muted);
            margin: 0;
            text-shadow: none;
            color: var(--text-muted) !important;
        }

        /* ── Fila de dos columnas (nombre / apellido) ── */
        .register-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.6rem;
        }

        /* ── Campo individual ── */
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

        /* ── Mensaje de error de validación ── */
        .register-error {
            font-size: 1.2rem;
            color: var(--error);
            margin-top: 0.4rem;
        }

        /* ── Checkbox de términos ── */
        .register-terms {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 2.4rem;
        }

        .register-terms input[type="checkbox"] {
            width: 1.8rem;
            height: 1.8rem;
            margin-top: 0.15rem;
            accent-color: var(--AzulSmtek);
            flex-shrink: 0;
            cursor: pointer;
        }

        .register-terms label {
            font-size: 1.35rem;
            color: var(--text-muted);
            line-height: 1.5;
            cursor: pointer;
        }

        .register-terms a {
            color: var(--AzulSmtek);
            font-weight: 600;
            text-decoration: underline;
            transition: color var(--transition);
        }

        .register-terms a:hover {
            color: var(--AzulOscuro);
        }

        /* ── Botón submit: reutiliza .btn-primary del CSS global ── */
        .register-submit {
            display: block;
            width: 100%;
            margin-bottom: 2rem;
            font-family: "Inter", sans-serif;
            font-size: 1.6rem;
            border: none;
        }

        /* ── Link a login ── */
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

        /* ══════════════════ RESPONSIVE ══════════════════ */
        @media (max-width: 600px) {
            .register-card {
                padding: 3rem 2rem;
            }

            .register-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .register-card__header h1 {
                font-size: 2.2rem;
            }
        }
    </style>

    {{-- ╔══════════════════════════════════════════════════════════╗
         ║  DARK MODE — mismo script que el resto del sitio       ║
         ╚══════════════════════════════════════════════════════════╝ --}}
    <script src="assets/js/script.js"></script>

</x-guest-layout>
