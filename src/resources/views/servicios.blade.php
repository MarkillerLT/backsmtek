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
         FILTROS por categoría
      ══════════════════════════════════════════════ */
      .diseno-filtros {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 3.6rem;
      }

      .diseno-filtro-btn {
        padding: 0.9rem 2rem;
        border-radius: 2.4rem;
        border: 1.5px solid var(--border-color, #d8e2e8);
        background-color: var(--bg-section, #fff);
        color: var(--text-primary, #4e5358);
        font-size: 1.4rem;
        font-weight: 600;
        font-family: "Inter", sans-serif;
        cursor: pointer;
        transition: all 0.25s ease;
        white-space: nowrap;
      }

      .diseno-filtro-btn:hover {
        border-color: var(--AzulSmtek, #2196ba);
        color: var(--AzulSmtek, #2196ba);
      }

      .diseno-filtro-btn.activo {
        background-color: var(--AzulSmtek, #2196ba);
        border-color: var(--AzulSmtek, #2196ba);
        color: #fff;
      }

      /* ══════════════════════════════════════════════
         Grid de tarjetas — mismo estilo .producto-card
      ══════════════════════════════════════════════ */
      .productos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(32rem, 1fr));
        gap: 2.4rem;
      }

      .producto-card {
        transition: opacity 0.3s ease, transform 0.3s ease;
      }

      .producto-card.oculto {
        display: none;
      }

      @media (max-width: 640px) {
        .diseno-filtros { gap: 0.7rem; }
        .diseno-filtro-btn { padding: 0.8rem 1.6rem; font-size: 1.3rem; }
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
          <a href="{{ route('servicios') }}">Servicios</a>
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

          {{-- ── Filtros por categoría ── --}}
          <div class="diseno-filtros reveal" role="tablist" aria-label="Filtrar servicios por categoría">
            <button type="button" class="diseno-filtro-btn activo" data-filtro="todos">Todos</button>
            <button type="button" class="diseno-filtro-btn" data-filtro="diseno">Diseño</button>
            <button type="button" class="diseno-filtro-btn" data-filtro="ingenieria">Ingeniería</button>
            <button type="button" class="diseno-filtro-btn" data-filtro="electrico">Eléctrico</button>
            <button type="button" class="diseno-filtro-btn" data-filtro="fabricacion">Fabricación</button>
            <button type="button" class="diseno-filtro-btn" data-filtro="ensamble">Ensamble</button>
            <button type="button" class="diseno-filtro-btn" data-filtro="calidad">Calidad</button>
          </div>

          {{--
            Cada tarjeta sigue esta misma estructura. Para agregar,
            quitar o editar un servicio, solo se replica/edita un
            bloque .producto-card — no requiere tocar el CSS ni el grid.

            data-categoria define en qué filtro aparece la tarjeta;
            debe coincidir con el data-filtro del botón correspondiente.
          --}}
          <div class="productos-grid" id="disenoGrid">

            <div class="producto-card reveal" data-categoria="diseno">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Diseño</span>
                <h3>Modelado CAD 3D</h3>
                <p>Modelado CAD 3D de piezas y dispositivos.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="diseno">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Diseño</span>
                <h3>Modelado CAD 2D</h3>
                <p>Modelado CAD 2D de modelos ya definidos.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="ingenieria">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Ingeniería</span>
                <h3>Optimización de geometrías</h3>
                <p>Optimización de geometrías para mejorar rendimiento.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="ingenieria">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Ingeniería</span>
                <h3>Conversión de formatos</h3>
                <p>Conversión de formatos de piezas.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="ingenieria">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Ingeniería</span>
                <h3>Selección de materiales</h3>
                <p>Selección de materiales y mejora de piezas.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="ingenieria">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Ingeniería</span>
                <h3>Análisis de elemento finito</h3>
                <p>Análisis de elemento finito.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="electrico">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Eléctrico</span>
                <h3>Tableros de control</h3>
                <p>Diseño de tableros de control eléctricos.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="electrico">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Eléctrico</span>
                <h3>Diagramas eléctricos</h3>
                <p>Diseño de diagramas eléctricos.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="diseno">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Diseño</span>
                <h3>Visualización 3D interactiva</h3>
                <p>Visualizaciones 3D interactivas, para aprobación de diseños.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="fabricacion">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Fabricación</span>
                <h3>Herramentales para costura</h3>
                <p>Diseño y fabricación de herramentales, para costura.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="fabricacion">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Fabricación</span>
                <h3>Fixtures de inspección</h3>
                <p>Diseño y fabricación de fixtures de inspección.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="fabricacion">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Fabricación</span>
                <h3>Estaciones de trabajo</h3>
                <p>Diseño y fabricación de estaciones de trabajo.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="fabricacion">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Fabricación</span>
                <h3>Alimentadores de material</h3>
                <p>Diseño y fabricación de alimentadores de material.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="ensamble">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Ensamble</span>
                <h3>Ensamble de maquinaria</h3>
                <p>Ensamble de maquinaria industrial y dispositivos de precisión.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="calidad">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Calidad</span>
                <h3>Pruebas funcionales</h3>
                <p>Pruebas funcionales y validaciones con el cliente.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="fabricacion">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Fabricación</span>
                <h3>Refacciones personalizadas</h3>
                <p>Diseño y fabricación de refacciones personalizadas.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="calidad">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Calidad</span>
                <h3>Inspección y diagnóstico</h3>
                <p>Servicios de inspección y diagnóstico técnico.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="fabricacion">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Fabricación</span>
                <h3>Guardas delimitadoras</h3>
                <p>Diseño y fabricación de guardas, delimitadoras.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="ensamble">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Ensamble</span>
                <h3>Estaciones de ensamble</h3>
                <p>Diseño y fabricación de estaciones de ensamble y subensamble de piezas.</p>
              </div>
            </div>

            <div class="producto-card reveal" data-categoria="calidad">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Calidad</span>
                <h3>Estaciones de inspección</h3>
                <p>Diseño y fabricación de estaciones de inspección de piezas.</p>
              </div>
            </div>

          </div>

          {{-- Se muestra solo si el filtro no encuentra ninguna tarjeta --}}
          <p id="disenoSinResultados" style="display:none; text-align:center; margin-top:3rem; font-size:1.5rem; color: var(--text-muted, #7a8390);">
            No hay servicios en esta categoría por el momento.
          </p>

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
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const botones = document.querySelectorAll('.diseno-filtro-btn');
        const tarjetas = document.querySelectorAll('#disenoGrid .producto-card');
        const sinResultados = document.getElementById('disenoSinResultados');

        botones.forEach(function (btn) {
          btn.addEventListener('click', function () {
            botones.forEach(function (b) { b.classList.remove('activo'); });
            btn.classList.add('activo');

            const filtro = btn.getAttribute('data-filtro');
            let visibles = 0;

            tarjetas.forEach(function (card) {
              const coincide = filtro === 'todos' || card.getAttribute('data-categoria') === filtro;
              card.classList.toggle('oculto', !coincide);
              if (coincide) visibles++;
            });

            sinResultados.style.display = visibles === 0 ? 'block' : 'none';
          });
        });
      });
    </script>
  </body>
</html>
