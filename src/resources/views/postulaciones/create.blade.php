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

   <div class="nav-bg">
        <div class="contenedor">
            <nav id="nav-principal" class="navegacion-principal" style="flex:1">
                <a href="{{ url('/') }}">Inicio</a>
                <a href="#">Productos</a>
                <a href="#">Servicios</a>
                <a href="#">Contacto</a>
                <a href="{{ route('cotizacion.create') }}" class="cta-nav">Cotizar</a>
                <a href="{{ route('postulacion.create')}}" style="font-family: bold">Trabaja con nosotros</a>

            </nav>
        </div>
    </div>

    {{-- ╔══════════════════════════════════════════════════════════╗
         ║  HERO                                                   ║
         ╚══════════════════════════════════════════════════════════╝ --}}
    <div class="hero postul-hero">
        <div class="hero-content">

            {{-- ── Alerta de éxito ── --}}
            @if(session('success'))
                <div class="cotiz-alert-wrap">
                    <div class="cotiz-alert">
                        <span class="cotiz-alert-icon">🎉</span>
                        <div>
                            <strong>¡Solicitud enviada!</strong>
                            <p>{{ session('success') }}</p>
                        </div>
                        <button class="cotiz-alert-close" onclick="this.closest('.cotiz-alert-wrap').remove()" aria-label="Cerrar">✕</button>
                    </div>
                </div>
            @endif

            {{-- ── Layout 2 columnas ── --}}
            <div class="cotiz-layout">

                {{-- Columna izquierda: pitch --}}
                <div class="cotiz-intro">
                    <div class="cotiz-badge">Únete al equipo</div>

                    <h1 class="cotiz-titulo">
                        Construye el futuro de la <span>industria</span> con nosotros
                    </h1>

                    <p class="cotiz-desc">
                        En SMTEK buscamos personas apasionadas por la tecnología industrial,
                        la automatización y la mejora continua. Si quieres crecer en un entorno
                        dinámico y de alto impacto, este es tu lugar.
                    </p>

                    <ul class="cotiz-features">
                        <li>
                            <span class="cf-icon">🚀</span>
                            <div>
                                <strong>Crecimiento real</strong>
                                <span>Plan de carrera y capacitación constante</span>
                            </div>
                        </li>
                        <li>
                            <span class="cf-icon">🤝</span>
                            <div>
                                <strong>Ambiente colaborativo</strong>
                                <span>Equipo multidisciplinario y proyectos retadores</span>
                            </div>
                        </li>
                        <li>
                            <span class="cf-icon">🏭</span>
                            <div>
                                <strong>Impacto industrial</strong>
                                <span>Soluciones que transforman procesos reales</span>
                            </div>
                        </li>
                        <li>
                            <span class="cf-icon">📄</span>
                            <div>
                                <strong>Proceso transparente</strong>
                                <span>Te contactamos en menos de 5 días hábiles</span>
                            </div>
                        </li>
                    </ul>
                </div>

                {{-- Columna derecha: formulario --}}
                <div class="register-card cotiz-card">

                    <div class="register-card__header">
                        <h2>Trabaja con nosotros</h2>
                        <p>Completa el formulario y adjunta tu CV en PDF.</p>
                    </div>

                    <form
                        action="{{ route('postulacion.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        novalidate
                    >
                        @csrf

                        {{-- Nombre + Teléfono --}}
                        <div class="register-row">
                            <div class="register-field">
                                <label for="nombre">Nombre completo <span class="cotiz-req">*</span></label>
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

                        {{-- Correo + Puesto --}}
                        <div class="register-row">
                            <div class="register-field">
                                <label for="correo">Correo electrónico <span class="cotiz-req">*</span></label>
                                <input
                                    id="correo"
                                    type="email"
                                    name="correo"
                                    value="{{ old('correo') }}"
                                    placeholder="correo@ejemplo.com"
                                    required
                                />
                                @error('correo')
                                    <span class="register-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="register-field">
                                <label for="puesto">Puesto de interés <span class="cotiz-req">*</span></label>
                                <input
                                    id="puesto"
                                    type="text"
                                    name="puesto"
                                    value="{{ old('puesto') }}"
                                    placeholder="Ej. Técnico en automatización"
                                    required
                                />
                                @error('puesto')
                                    <span class="register-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Mensaje --}}
                        <div class="register-field">
                            <label for="mensaje">Cuéntanos sobre ti <span class="cotiz-req">*</span></label>
                            <textarea
                                id="mensaje"
                                name="mensaje"
                                rows="4"
                                placeholder="Experiencia, habilidades, por qué quieres unirte a SMTEK..."
                                required
                            >{{ old('mensaje') }}</textarea>
                            @error('mensaje')
                                <span class="register-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Upload CV --}}
                        <div class="register-field">
                            <label>Currículum <span class="cotiz-req">*</span></label>
                            <div class="cv-dropzone" id="cvDropzone">
                                <input
                                    type="file"
                                    name="cv"
                                    id="cvInput"
                                    accept=".pdf,application/pdf"
                                    required
                                    class="cv-input-hidden"
                                />
                                <div class="cv-dropzone-content" id="cvContent">
                                    <span class="cv-icon">📄</span>
                                    <span class="cv-label">Arrastra tu CV aquí o <u>haz clic para seleccionar</u></span>
                                    <span class="cv-hint">Solo PDF · Máx. 5 MB</span>
                                </div>
                                <div class="cv-selected" id="cvSelected" style="display:none;">
                                    <span class="cv-icon">✅</span>
                                    <span class="cv-filename" id="cvFilename"></span>
                                    <button type="button" class="cv-remove" id="cvRemove" aria-label="Quitar archivo">✕</button>
                                </div>
                            </div>
                            @error('cv')
                                <span class="register-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Botón submit --}}
                        <button type="submit" class="btn-primary register-submit">
                            Enviar solicitud →
                        </button>

                        <p style="margin-top:1.6rem;text-align:center;font-size:1.2rem;color:var(--text-muted);">
                            * Campos obligatorios. Tu información es tratada con total confidencialidad.
                        </p>

                    </form>
                </div>{{-- /.cotiz-card --}}

            </div>{{-- /.cotiz-layout --}}
        </div>{{-- /.hero-content --}}
    </div>{{-- /.hero --}}
        <!--Whatsapp-->
<a
    href="https://wa.me/524721074459?text=Hola,%20quiero%20información%20sobre%20sus%20productos."
    class="whatsapp-float"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Comunícate con ventas por WhatsApp"
>
    <span class="whatsapp-text">Comunícate con ventas</span>

    <!-- SVG -->
    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 48 48">
        <path fill="#fff" d="M4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98c-0.001,0,0,0,0,0h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303z"/>
        <path fill="#fff" d="M4.868,43.803c-0.132,0-0.26-0.052-0.355-0.148c-0.125-0.127-0.174-0.312-0.127-0.483l2.639-9.636c-1.636-2.906-2.499-6.206-2.497-9.556C4.532,13.238,13.273,4.5,24.014,4.5c5.21,0.002,10.105,2.031,13.784,5.713c3.679,3.683,5.704,8.577,5.702,13.781c-0.004,10.741-8.746,19.48-19.486,19.48c-3.189-0.001-6.344-0.788-9.144-2.277l-9.875,2.589C4.953,43.798,4.911,43.803,4.868,43.803z"/>
        <path fill="#cfd8dc" d="M24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5"/>
        <path fill="#40c351" d="M35.176,12.832c-2.98-2.982-6.941-4.625-11.157-4.626c-8.704,0-15.783,7.076-15.787,15.774c-0.001,2.981,0.833,5.883,2.413,8.396l0.376,0.597l-1.595,5.821l5.973-1.566l0.577,0.342c2.422,1.438,5.2,2.198,8.032,2.199h0.006c8.698,0,15.777-7.077,15.78-15.776C39.795,19.778,38.156,15.814,35.176,12.832z"/>
        <path fill="#fff" fill-rule="evenodd" clip-rule="evenodd" d="M19.268,16.045c-0.355-0.79-0.729-0.806-1.068-0.82c-0.277-0.012-0.593-0.011-0.909-0.011c-0.316,0-0.83,0.119-1.265,0.594c-0.435,0.475-1.661,1.622-1.661,3.956c0,2.334,1.7,4.59,1.937,4.906c0.237,0.316,3.282,5.259,8.104,7.161c4.007,1.58,4.823,1.266,5.693,1.187c0.87-0.079,2.807-1.147,3.202-2.255c0.395-1.108,0.395-2.057,0.277-2.255c-0.119-0.198-0.435-0.316-0.909-0.554s-2.807-1.385-3.242-1.543c-0.435-0.158-0.751-0.237-1.068,0.238c-0.316,0.474-1.225,1.543-1.502,1.859c-0.277,0.317-0.554,0.357-1.028,0.119c-0.474-0.238-2.002-0.738-3.815-2.354c-1.41-1.257-2.362-2.81-2.639-3.285c-0.277-0.474-0.03-0.731,0.208-0.968c0.213-0.213,0.474-0.554,0.712-0.831c0.237-0.277,0.316-0.475,0.474-0.791c0.158-0.317,0.079-0.594-0.04-0.831C20.612,19.329,19.69,16.983,19.268,16.045z"/>
    </svg>
</a>


    <!-- Footer -->
    <footer>
      <div class="contenedor footer-inner">
        <img
          src="assets/img/1b.svg"
          alt="SMTEK Logo"
          class="footer-logo"
          onerror="
            this.style.display = 'none';
            document.getElementById('footer-logo-fallback').style.display =
              'flex';
          "
        />
        <div
          id="footer-logo-fallback"
          class="footer-logo-placeholder"
          style="display: none"
        >
          SMTEK
         </div>

        <p>© 2025 SMTEK Smart Technologies. Todos los derechos reservados.</p>

        <div style="display: flex; gap: 2rem">
          <a href="#">Aviso de privacidad</a>
          <a href="#">Términos de uso</a>
        </div>
      </div>
    </footer>

    <style>
        /* ── Hero ── */
        .postul-hero {
            height: auto !important;
            min-height: calc(100vh - 11rem);
        }

        .postul-hero .hero-content {
            padding: 5rem 2rem;
            flex-direction: column;
            gap: 2.4rem;
            align-items: stretch;
            max-width: 130rem;
            margin-inline: auto;
            width: 100%;
        }

        .cotiz-layout {
            display: grid;
            grid-template-columns: 1fr 1.15fr;
            gap: 5rem;
            align-items: start;
            width: 100%;
        }

        .cotiz-intro {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .cotiz-badge {
            display: inline-flex;
            align-items: center;
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

        .cotiz-titulo span { color: var(--acentos); }

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

        /* ── Card ── */
        .register-card {
            width: 100%;
            background: rgba(255,255,255,0.88);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            padding: 4rem;
            border: 1px solid rgba(255,255,255,0.7);
        }

        body.dark-mode .register-card {
            background: rgba(26,35,48,0.90);
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

        .register-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.6rem;
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

        .cotiz-req { color: var(--error); margin-left: 0.2rem; }

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

        .register-submit {
            display: block;
            width: 100%;
            font-family: "Inter", sans-serif;
            font-size: 1.6rem;
            border: none;
            cursor: pointer;
            margin-bottom: 0;
        }

        .cv-dropzone {
            position: relative;
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-sm);
            background-color: var(--blanco);
            padding: 2.4rem 2rem;
            cursor: pointer;
            transition: border-color var(--transition), background-color var(--transition), box-shadow var(--transition);
            text-align: center;
        }

        body.dark-mode .cv-dropzone {
            background-color: #1e2d3e;
        }

        .cv-dropzone:hover,
        .cv-dropzone.drag-over {
            border-color: var(--AzulSmtek);
            background-color: var(--AzulClaro);
            box-shadow: 0 0 0 3px rgba(33,150,186,0.18);
        }

        body.dark-mode .cv-dropzone:hover,
        body.dark-mode .cv-dropzone.drag-over {
            background-color: rgba(33,150,186,0.1);
        }

        .cv-input-hidden {
            position: absolute;
            inset: 0;
            width: 100% !important;
            height: 100% !important;
            opacity: 0;
            cursor: pointer;
            padding: 0 !important;
            border: none !important;
            background: none !important;
            z-index: 2;
        }

        .cv-dropzone-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.6rem;
            pointer-events: none;
        }

        .cv-icon {
            font-size: 2.8rem;
        }

        .cv-label {
            font-size: 1.4rem;
            color: var(--text-primary);
            font-weight: 500;
        }

        .cv-hint {
            font-size: 1.2rem;
            color: var(--text-muted);
        }

        .cv-selected {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.2rem;
            pointer-events: none;
        }

        .cv-filename {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--contrastes);
            word-break: break-all;
        }

        .cv-remove {
            background: none;
            border: none;
            font-size: 1.6rem;
            color: var(--error);
            cursor: pointer;
            pointer-events: all;
            z-index: 3;
            position: relative;
            line-height: 1;
            transition: transform var(--transition);
        }

        .cv-remove:hover {
            transform: scale(1.2);
        }

        .cotiz-alert-wrap { width: 100%; }

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

        .cotiz-alert-icon { font-size: 2.2rem; flex-shrink: 0; }

        .cotiz-alert div { flex: 1; }

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

        .cotiz-alert-close:hover { color: var(--error); }

        @media (max-width: 960px) {
            .cotiz-layout {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .cotiz-intro {
                text-align: center;
                align-items: center;
            }

            .cotiz-desc { text-align: center; }
        }

        @media (max-width: 600px) {
            .register-card { padding: 3rem 2rem; }
            .register-row  { grid-template-columns: 1fr; }

            .postul-hero .hero-content { padding: 3rem 1.6rem; }
        }
    </style>

        <script src="assets/js/script.js"></script>
        <script>

        (function () {
            const dropzone = document.getElementById('cvDropzone');
            const input    = document.getElementById('cvInput');
            const content  = document.getElementById('cvContent');
            const selected = document.getElementById('cvSelected');
            const filename = document.getElementById('cvFilename');
            const removeBtn = document.getElementById('cvRemove');
            // Cambio por click normal
            input.addEventListener('change', function () {
                if (this.files[0]) showFile(this.files[0]);
            });

            // Drag & drop
            dropzone.addEventListener('dragover', function (e) {
                e.preventDefault();
                this.classList.add('drag-over');
            });

            dropzone.addEventListener('dragleave', function () {
                this.classList.remove('drag-over');
            });

            dropzone.addEventListener('drop', function (e) {
                e.preventDefault();
                this.classList.remove('drag-over');
                const file = e.dataTransfer.files[0];
                if (file && file.type === 'application/pdf') {
                    // Asignar al input para que se envíe con el form
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    input.files = dt.files;
                    showFile(file);
                }
            });

            // Quitar archivo
            removeBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                clearFile();
            });
        })();
    </script>

</x-guest-layout>
