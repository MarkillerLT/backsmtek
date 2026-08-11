<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Diseño (Proyectos - Maquinados) | SMTEK Smart Technologies</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
      rel="stylesheet"
    />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/normalize.css') }}" />

    <!-- animacion principal -->
    <style>
      .reveal {
        opacity: 0;
        transform: translateY(2.4rem);
        transition:
          opacity 0.55s ease,
          transform 0.55s ease;
      }
      .reveal.visible {
        opacity: 1;
        transform: none;
      }
      @media (prefers-reduced-motion: reduce) {
        .reveal {
          opacity: 1;
          transform: none;
        }
      }

      /* ══════════════════════════════════════════════
         SECCIÓN: Diseño (Proyectos - Maquinados)
      ══════════════════════════════════════════════ */
      .diseno-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(30rem, 1fr));
        gap: 2.4rem;
      }

      .diseno-card {
        display: flex;
        flex-direction: column;
        gap: 1.4rem;
        background-color: var(--bg-section, #fff);
        border: 1px solid var(--border-color, #d8e2e8);
        border-radius: 1.2rem;
        padding: 2.4rem;
        box-shadow: 0 2px 8px rgba(26, 104, 128, 0.08);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
      }

      .diseno-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 20px rgba(26, 104, 128, 0.13);
        border-color: var(--AzulSmtek, #2196ba);
      }

      .diseno-card-header {
        display: flex;
        align-items: center;
        gap: 1.4rem;
      }

      .diseno-card-numero {
        flex-shrink: 0;
        width: 4.4rem;
        height: 4.4rem;
        border-radius: 50%;
        background-color: var(--AzulClaro, #e8f4f8);
        color: var(--AzulOscuro, #1a6880);
        font-size: 1.8rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      /* Espacio reservado para una etiqueta de categoría opcional
         (ej. "Diseño", "Fabricación", "Eléctrico") — se puede activar
         a futuro sin tocar el resto de la tarjeta. */
      .diseno-card-categoria {
        font-size: 1.15rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--AzulSmtek, #2196ba);
      }

      .diseno-card-titulo {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--text-heading, #1a2a38);
        margin: 0;
        line-height: 1.35;
      }

      .diseno-card-desc {
        font-size: 1.4rem;
        color: var(--text-primary, #4e5358);
        line-height: 1.6;
        margin: 0;
        flex: 1;
      }

      /* Espacio reservado para un botón de detalle a futuro.
         Se deja comentado en el HTML de cada tarjeta; solo hay
         que descomentar cuando exista la vista de detalle. */
      .diseno-card-link {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--AzulSmtek, #2196ba);
        text-decoration: none;
        margin-top: 0.4rem;
        transition: gap 0.2s ease;
      }
      .diseno-card-link:hover { gap: 1rem; }

      body.dark-mode .diseno-card-numero {
        background-color: rgba(33, 150, 186, 0.18);
        color: var(--AzulSmtek, #2196ba);
      }

      @media (max-width: 640px) {
        .diseno-grid { grid-template-columns: 1fr; }
      }
    </style>
  </head>
  <body>
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

      <div class="header-actions">
        <div class="auth-links">
          @if (Route::has('login'))
            @auth
              @if(auth()->user()->rol === 'admin')
                <a href="{{ url('/admin') }}">Panel de Administración</a>
              @else
                <a href="{{ url('/dashboard') }}">Dashboard</a>
              @endif
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

    <!-- Nav Bar -->
    <div class="nav-bg">
      <div class="contenedor" style="display: flex; align-items: center">
        <button
          id="hamburger"
          class="hamburger"
          aria-label="Abrir menú"
          aria-expanded="false"
          type="button"
        >
          <span></span><span></span><span></span>
        </button>

        <nav id="nav-principal" class="navegacion-principal" style="flex: 1">
          <a href="{{ url('/') }}">Inicio</a>
          <a href="{{ route('productos.catalogo') }}">Productos</a>
          <a href="{{ route('servicios')}}">Servicios</a>
          <a href="{{ url('/#contacto') }}">Contacto</a>
          <a href="{{ route('cotizacion.create') }}" class="cta-nav">Cotizar</a>
          <a href="{{ route('postulacion.create') }}" style="font-family: bold">Trabaja con nosotros</a>
        </nav>
      </div>
    </div>

    <!-- Hero -->
    <section class="hero" id="diseno">
      <div class="hero-content">
        <h1>Diseño <span>de Proyectos</span><br />y Maquinados</h1>
        <p>
          Del concepto a la pieza final: modelado, optimización y fabricación
          de soluciones mecánicas y eléctricas a la medida de tu operación.
        </p>
        <div class="hero-btns">
          <a href="{{ route('cotizacion.create') }}" class="btn-primary">Solicitar cotización</a>
          <a href="{{ url('/#contacto') }}" class="btn-outline">Hablar con un asesor</a>
        </div>
      </div>
    </section>

    <main>
      <section id="servicios-diseno">
        <div class="contenedor">
          <div class="section-header reveal">
            <span class="section-label">Portafolio de servicios</span>
            <h2>Diseño (Proyectos - Maquinados)</h2>
            <p>
              Un vistazo completo a las capacidades de diseño, ingeniería y
              fabricación que ponemos al servicio de cada proyecto.
            </p>
          </div>

          <div class="diseno-grid">

            {{--
              Cada tarjeta sigue esta misma estructura. Para agregar,
              quitar o editar un servicio, solo se replica/edita un
              bloque .diseno-card — no requiere tocar el CSS ni el grid.

              La etiqueta de categoría (.diseno-card-categoria) es opcional:
              si no se necesita, simplemente se omite esa línea.

              El enlace de detalle (.diseno-card-link) queda comentado;
              se activa el día que exista una vista de detalle por servicio.
            --}}

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">1</span>
                <div>
                  <span class="diseno-card-categoria">Diseño</span>
                  <h3 class="diseno-card-titulo">Modelado CAD 3D</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Modelado CAD 3D de piezas y dispositivos.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">2</span>
                <div>
                  <span class="diseno-card-categoria">Diseño</span>
                  <h3 class="diseno-card-titulo">Modelado CAD 2D</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Modelado CAD 2D de modelos ya definidos.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">3</span>
                <div>
                  <span class="diseno-card-categoria">Ingeniería</span>
                  <h3 class="diseno-card-titulo">Optimización de geometrías</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Optimización de geometrías para mejorar rendimiento.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">4</span>
                <div>
                  <span class="diseno-card-categoria">Ingeniería</span>
                  <h3 class="diseno-card-titulo">Conversión de formatos</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Conversión de formatos de piezas.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">5</span>
                <div>
                  <span class="diseno-card-categoria">Ingeniería</span>
                  <h3 class="diseno-card-titulo">Selección de materiales</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Selección de materiales y mejora de piezas.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">6</span>
                <div>
                  <span class="diseno-card-categoria">Ingeniería</span>
                  <h3 class="diseno-card-titulo">Análisis de elemento finito</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Análisis de elemento finito.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">7</span>
                <div>
                  <span class="diseno-card-categoria">Eléctrico</span>
                  <h3 class="diseno-card-titulo">Tableros de control</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Diseño de tableros de control eléctricos.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">8</span>
                <div>
                  <span class="diseno-card-categoria">Eléctrico</span>
                  <h3 class="diseno-card-titulo">Diagramas eléctricos</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Diseño de diagramas eléctricos.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">9</span>
                <div>
                  <span class="diseno-card-categoria">Diseño</span>
                  <h3 class="diseno-card-titulo">Visualización 3D interactiva</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Visualizaciones 3D interactivas, para aprobación de diseños.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">10</span>
                <div>
                  <span class="diseno-card-categoria">Fabricación</span>
                  <h3 class="diseno-card-titulo">Herramentales para costura</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Diseño y fabricación de herramentales, para costura.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">11</span>
                <div>
                  <span class="diseno-card-categoria">Fabricación</span>
                  <h3 class="diseno-card-titulo">Fixtures de inspección</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Diseño y fabricación de fixtures de inspección.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">12</span>
                <div>
                  <span class="diseno-card-categoria">Fabricación</span>
                  <h3 class="diseno-card-titulo">Estaciones de trabajo</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Diseño y fabricación de estaciones de trabajo.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">13</span>
                <div>
                  <span class="diseno-card-categoria">Fabricación</span>
                  <h3 class="diseno-card-titulo">Alimentadores de material</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Diseño y fabricación de alimentadores de material.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">14</span>
                <div>
                  <span class="diseno-card-categoria">Ensamble</span>
                  <h3 class="diseno-card-titulo">Ensamble de maquinaria</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Ensamble de maquinaria industrial y dispositivos de precisión.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">15</span>
                <div>
                  <span class="diseno-card-categoria">Calidad</span>
                  <h3 class="diseno-card-titulo">Pruebas funcionales</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Pruebas funcionales y validaciones con el cliente.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">16</span>
                <div>
                  <span class="diseno-card-categoria">Fabricación</span>
                  <h3 class="diseno-card-titulo">Refacciones personalizadas</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Diseño y fabricación de refacciones personalizadas.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">17</span>
                <div>
                  <span class="diseno-card-categoria">Calidad</span>
                  <h3 class="diseno-card-titulo">Inspección y diagnóstico</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Servicios de inspección y diagnóstico técnico.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">18</span>
                <div>
                  <span class="diseno-card-categoria">Fabricación</span>
                  <h3 class="diseno-card-titulo">Guardas delimitadoras</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Diseño y fabricación de guardas, delimitadoras.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">19</span>
                <div>
                  <span class="diseno-card-categoria">Ensamble</span>
                  <h3 class="diseno-card-titulo">Estaciones de ensamble</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Diseño y fabricación de estaciones de ensamble y subensamble de piezas.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

            <div class="diseno-card reveal">
              <div class="diseno-card-header">
                <span class="diseno-card-numero">20</span>
                <div>
                  <span class="diseno-card-categoria">Calidad</span>
                  <h3 class="diseno-card-titulo">Estaciones de inspección</h3>
                </div>
              </div>
              <p class="diseno-card-desc">
                Diseño y fabricación de estaciones de inspección de piezas.
              </p>
              {{-- <a href="#" class="diseno-card-link">Ver detalles →</a> --}}
            </div>

          </div>
        </div>
      </section>
    </main>

    <!--Whatsapp-->
    <a

      href="https://wa.me/524721074459?text=Hola,%20quiero%20información%20sobre%20sus%20productos."
      class="whatsapp-float"
      target="_blank"
      rel="noopener noreferrer"
      aria-label="Comunícate con ventas por WhatsApp"
    >
      <span class="whatsapp-text">Comunícate con ventas</span>
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

    <!-- Script -->
    <script src="assets/js/script.js"></script>
  </body>
</html>
