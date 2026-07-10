<x-guest-layout>
{{--
|--------------------------------------------------------------------------
| Vista: cotizacion.blade.php — Formulario de cotización SMTEK
| Requiere: assets/css/styles.css en layouts/guest.blade.php
|--------------------------------------------------------------------------
--}}

    {{-- ╔══════════════════════════════════════════════════════════╗
         ║  HEADER                                                 ║
         ╚══════════════════════════════════════════════════════════╝ --}}
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
         ║  NAVEGACIÓN                                             ║
         ╚══════════════════════════════════════════════════════════╝ --}}
    <div class="nav-bg">
        <div class="contenedor">
            <nav id="nav-principal" class="navegacion-principal" style="flex:1">
                <a href="{{ url('/') }}">Inicio</a>
                <a href="#">Productos</a>
                <a href="#">Servicios</a>
                <a href="#">Contacto</a>
                <a href="#" class="cta-nav activo">Cotizar</a>
                <a href="#" style="font-weight:bold">Trabaja con nosotros</a>
            </nav>
        </div>
    </div>

    {{-- ╔══════════════════════════════════════════════════════════╗
         ║  HERO — mismo que el sitio                              ║
         ╚══════════════════════════════════════════════════════════╝ --}}
    <div class="hero cotiz-hero">
        <div class="hero-content">

            {{-- ── Mensaje de éxito ── --}}
            @if(session('success'))
                <div class="cotiz-alert-wrap">
                    <div class="cotiz-alert">
                        <span class="cotiz-alert-icon">✅</span>
                        <div>
                            <strong>¡Solicitud enviada!</strong>
                            <p>{{ session('success') }}</p>
                        </div>
                        <button class="cotiz-alert-close" onclick="this.closest('.cotiz-alert-wrap').remove()" aria-label="Cerrar">✕</button>
                    </div>
                </div>
            @endif

            {{-- ── Layout: intro + card formulario ── --}}
            <div class="cotiz-layout">

                {{-- Columna izquierda: texto descriptivo --}}
                <div class="cotiz-intro">
                    <div class="cotiz-badge">Solicitud de cotización</div>
                    <h1 class="cotiz-titulo">¿Listo para <span>optimizar</span> tu proceso?</h1>
                    <p class="cotiz-desc">
                        Cuéntanos sobre tu proyecto y nuestro equipo de ingeniería te enviará
                        una propuesta personalizada en menos de 24 horas.
                    </p>

                    <ul class="cotiz-features">
                        <li>
                            <span class="cf-icon">⚡</span>
                            <div>
                                <strong>Respuesta rápida</strong>
                                <span>Cotización en menos de 24 h</span>
                            </div>
                        </li>
                        <li>
                            <span class="cf-icon">🎯</span>
                            <div>
                                <strong>Solución a medida</strong>
                                <span>Ingeniería adaptada a tu proceso</span>
                            </div>
                        </li>
                        <li>
                            <span class="cf-icon">🔒</span>
                            <div>
                                <strong>Sin compromiso</strong>
                                <span>La cotización es totalmente gratuita</span>
                            </div>
                        </li>
                    </ul>
                </div>

                {{-- Columna derecha: formulario --}}
                <div class="register-card cotiz-card">

                    <div class="register-card__header">
                        <h2>Solicitar cotización</h2>
                        <p>Completa el formulario y nos ponemos en contacto contigo.</p>
                    </div>

                    <form action="{{ route('cotizacion.store') }}" method="POST" novalidate>
                        @csrf

                        {{-- Nombre + Empresa --}}
                        <div class="register-row">
                            <div class="register-field">
                                <label for="nombre">Nombre <span class="cotiz-req">*</span></label>
                                <input
                                    id="nombre"
                                    type="text"
                                    name="nombre"
                                    value="{{ old('nombre') }}"
                                    placeholder="Juan Pérez"
                                    required
                                    autofocus
                                />
                                @error('nombre')
                                    <span class="register-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="register-field">
                                <label for="empresa">Empresa <span class="cotiz-req">*</span></label>
                                <input
                                    id="empresa"
                                    type="text"
                                    name="empresa"
                                    value="{{ old('empresa') }}"
                                    placeholder="ACME Industrial S.A."
                                    required
                                />
                                @error('empresa')
                                    <span class="register-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Correo + Teléfono --}}
                        <div class="register-row">
                            <div class="register-field">
                                <label for="correo">Correo electrónico <span class="cotiz-req">*</span></label>
                                <input
                                    id="correo"
                                    type="email"
                                    name="correo"
                                    value="{{ old('correo') }}"
                                    placeholder="correo@empresa.com"
                                    required
                                />
                                @error('correo')
                                    <span class="register-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="register-field">
                                <label for="telefono">Teléfono</label>
                                <input
                                    id="telefono"
                                    type="text"
                                    name="telefono"
                                    value="{{ old('telefono') }}"
                                    placeholder="+52 442 000 0000"
                                />
                                @error('telefono')
                                    <span class="register-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Asunto --}}
                        <div class="register-field">
                            <label for="asunto">Asunto <span class="cotiz-req">*</span></label>
                            <input
                                id="asunto"
                                type="text"
                                name="asunto"
                                value="{{ old('asunto') }}"
                                placeholder="Ej. Instalación de sensores industriales"
                                required
                            />
                            @error('asunto')
                                <span class="register-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Mensaje --}}
                        <div class="register-field">
                            <label for="mensaje">Mensaje / Descripción del proyecto <span class="cotiz-req">*</span></label>
                            <textarea
                                id="mensaje"
                                name="mensaje"
                                rows="5"
                                placeholder="Describe tu proyecto, cantidad de equipos, tipo de proceso, requerimientos especiales..."
                                required
                            >{{ old('mensaje') }}</textarea>
                            @error('mensaje')
                                <span class="register-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Botón submit --}}
                        <button type="submit" class="btn-primary register-submit">
                            Enviar cotización →
                        </button>

                        <p class="register-login-link" style="margin-top:1.6rem;">
                            <span style="font-size:1.2rem;color:var(--text-muted);">
                                * Campos obligatorios. Tu información es confidencial y no será compartida.
                            </span>
                        </p>

                    </form>
                </div>{{-- /.cotiz-card --}}

            </div>{{-- /.cotiz-layout --}}
        </div>{{-- /.hero-content --}}
    </div>{{-- /.hero --}}


    {{-- ╔══════════════════════════════════════════════════════════╗
         ║  ESTILOS ESPECÍFICOS — todo sobre variables del CSS    ║
         ╚══════════════════════════════════════════════════════════╝ --}}
    <style>
        /* ── Hero adaptado para esta página ── */
        .cotiz-hero {
            height: auto !important;
            min-height: calc(100vh - 11rem);
        }

        .cotiz-hero .hero-content {
            padding: 5rem 2rem;
            flex-direction: column;
            gap: 2.4rem;
            align-items: stretch;
            max-width: 130rem;
            margin-inline: auto;
            width: 100%;
        }

        /* ── Layout de 2 columnas ── */
        .cotiz-layout {
            display: grid;
            grid-template-columns: 1fr 1.15fr;
            gap: 5rem;
            align-items: start;
            width: 100%;
        }

        /* ── Columna izquierda: texto ── */
        .cotiz-intro {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .cotiz-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background-color: var(--acentos);
            color: #1a2a38;
            font-size: 1.2rem;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.5rem 1.4rem;
            border-radius: 2rem;
            width: fit-content;
        }

        .cotiz-titulo {
            font-size: clamp(2.8rem, 4vw, 4.2rem);
            font-weight: 800;
            color: var(--H1Negro) !important;
            line-height: 1.2;
            margin: 0;
            text-shadow: 0 1px 8px rgba(255,255,255,0.3);
        }

        .cotiz-titulo span {
            color: var(--acentos);
        }

        .cotiz-desc {
            font-size: 1.6rem;
            color: var(--H1Negro) !important;
            line-height: 1.75;
            margin: 0;
            max-width: 48rem;
            opacity: 0.85;
        }

        .cotiz-features {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 1.6rem;
        }

        .cotiz-features li {
            display: flex;
            align-items: flex-start;
            gap: 1.4rem;
        }

        .cf-icon {
            width: 4.4rem;
            height: 4.4rem;
            background: rgba(255,255,255,0.75);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            flex-shrink: 0;
            box-shadow: var(--shadow-sm);
        }

        body.dark-mode .cf-icon {
            background: rgba(255,255,255,0.08);
        }

        .cotiz-features li div {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .cotiz-features li strong {
            font-size: 1.5rem;
            color: var(--H1Negro);
            font-weight: 700;
        }

        .cotiz-features li span {
            font-size: 1.35rem;
            color: var(--H1Negro);
            opacity: 0.75;
        }

        /* ── Card formulario ── */
        .register-card {
            width: 100%;
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            padding: 4rem;
            border: 1px solid rgba(255,255,255,0.7);
        }

        body.dark-mode .register-card {
            background: rgba(26, 35, 48, 0.90);
            border-color: rgba(255,255,255,0.08);
        }

        .register-card__header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .register-card__header h2 {
            font-size: 2.4rem;
            font-weight: 800;
            margin: 0 0 0.8rem;
            color: var(--text-heading) !important;
            text-shadow: none !important;
        }

        .register-card__header p {
            font-size: 1.4rem;
            margin: 0;
            text-shadow: none;
            color: var(--text-muted) !important;
        }

        /* ── Fila de 2 columnas ── */
        .register-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.6rem;
        }

        /* ── Campos ── */
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

        .cotiz-req {
            color: var(--error);
            margin-left: 0.2rem;
        }

        .register-field input,
        .register-field textarea {
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
            resize: vertical;
        }

        body.dark-mode .register-field input,
        body.dark-mode .register-field textarea {
            background-color: #1e2d3e;
            color: var(--text-heading);
            border-color: var(--border-color);
        }

        .register-field input:focus,
        .register-field textarea:focus {
            border-color: var(--AzulSmtek);
            box-shadow: 0 0 0 3px rgba(33,150,186,0.18);
        }

        .register-error {
            font-size: 1.2rem;
            color: var(--error);
            margin-top: 0.4rem;
        }

        /* ── Botón ── */
        .register-submit {
            display: block;
            width: 100%;
            margin-bottom: 0;
            font-family: "Inter", sans-serif;
            font-size: 1.6rem;
            border: none;
            cursor: pointer;
        }

        /* ── Alerta de éxito ── */
        .cotiz-alert-wrap {
            width: 100%;
        }

        .cotiz-alert {
            display: flex;
            align-items: flex-start;
            gap: 1.4rem;
            background: rgba(255,255,255,0.92);
            border-left: 4px solid var(--contrastes);
            border-radius: var(--radius-sm);
            padding: 1.8rem 2rem;
            box-shadow: var(--shadow-md);
        }

        body.dark-mode .cotiz-alert {
            background: rgba(26,35,48,0.95);
        }

        .cotiz-alert-icon {
            font-size: 2.2rem;
            flex-shrink: 0;
        }

        .cotiz-alert div {
            flex: 1;
        }

        .cotiz-alert strong {
            display: block;
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--contrastes);
            margin-bottom: 0.3rem;
        }

        .cotiz-alert p {
            font-size: 1.4rem;
            color: var(--text-primary);
            margin: 0;
            text-shadow: none;
        }

        .cotiz-alert-close {
            background: none;
            border: none;
            font-size: 1.6rem;
            color: var(--text-muted);
            cursor: pointer;
            padding: 0;
            flex-shrink: 0;
            line-height: 1;
            transition: color var(--transition);
        }

        .cotiz-alert-close:hover {
            color: var(--error);
        }

        /* ══════════════════ RESPONSIVE ══════════════════ */
        @media (max-width: 960px) {
            .cotiz-layout {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .cotiz-intro {
                text-align: center;
                align-items: center;
            }

            .cotiz-desc {
                text-align: center;
            }
        }

        @media (max-width: 600px) {
            .register-card {
                padding: 3rem 2rem;
            }

            .register-row {
                grid-template-columns: 1fr;
            }

            .cotiz-hero .hero-content {
                padding: 3rem 1.6rem;
            }
        }
    </style>

    <script src="assets/js/script.js"></script>

</x-guest-layout>
