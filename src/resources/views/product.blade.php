<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Catálogo de Productos | SMTEK Smart Technologies</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/normalize.css') }}" />

    <style>
      .reveal { opacity: 0; transform: translateY(2.4rem); transition: opacity 0.55s ease, transform 0.55s ease; }
      .reveal.visible { opacity: 1; transform: none; }
      @media (prefers-reduced-motion: reduce) { .reveal { opacity: 1; transform: none; } }

      /* ══════════════════════════════════════════════
         CATÁLOGO — Layout general
      ══════════════════════════════════════════════ */
      .catalogo-breadcrumb {
        font-size: 1.3rem;
        color: var(--text-muted, #7a8390);
        margin-bottom: 2rem;
      }
      .catalogo-breadcrumb a { color: var(--AzulSmtek, #2196ba); text-decoration: none; font-weight: 600; }
      .catalogo-breadcrumb a:hover { text-decoration: underline; }
      .catalogo-breadcrumb .actual { color: var(--text-heading, #1a2a38); font-weight: 700; }

      .catalogo-shell {
        display: flex;
        align-items: flex-start;
        gap: 2.4rem;
      }

      /* ── Sidebar ── */
      .catalogo-sidebar {
        width: 30rem;
        flex-shrink: 0;
        background-color: var(--bg-section, #fff);
        border: 1px solid var(--border-color, #d8e2e8);
        border-radius: 1.2rem;
        overflow: hidden;
        position: sticky;
        top: 2rem;
      }

      .cat-group { border-bottom: 1px solid var(--border-color, #d8e2e8); }
      .cat-group:last-child { border-bottom: none; }

      .cat-group-btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.5rem 2rem;
        background: none;
        border: none;
        cursor: pointer;
        font-family: "Inter", sans-serif;
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--text-heading, #1a2a38);
        text-align: left;
        transition: background-color 0.2s ease, color 0.2s ease;
      }
      .cat-group-btn:hover { background-color: var(--bg-body, #f5f5f5); }

      .cat-group.abierto .cat-group-btn {
        background-color: var(--AzulSmtek, #2196ba);
        color: #fff;
      }

      .cat-group-btn .chevron {
        flex-shrink: 0;
        transition: transform 0.25s ease;
        font-size: 1.2rem;
      }
      .cat-group.abierto .cat-group-btn .chevron { transform: rotate(90deg); }

      .cat-sublist {
        list-style: none;
        margin: 0;
        padding: 0;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s ease;
        background-color: var(--bg-body, #f5f5f5);
      }
      .cat-group.abierto .cat-sublist { max-height: 70rem; }

      .cat-sublist li a {
        display: block;
        padding: 1.1rem 2rem 1.1rem 3.2rem;
        font-size: 1.3rem;
        color: var(--text-primary, #4e5358);
        text-decoration: none;
        border-left: 3px solid transparent;
        transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
      }
      .cat-sublist li a:hover {
        background-color: var(--AzulClaro, #e8f4f8);
        color: var(--AzulSmtek, #2196ba);
      }
      .cat-sublist li a.activo {
        background-color: var(--AzulClaro, #e8f4f8);
        color: var(--AzulSmtek, #2196ba);
        font-weight: 700;
        border-left-color: var(--AzulSmtek, #2196ba);
      }

      /* Botón/desplegable — solo móvil */
      .catalogo-mobile-toggle {
        display: none;
        width: 100%;
        align-items: center;
        justify-content: space-between;
        padding: 1.4rem 1.8rem;
        background-color: var(--AzulSmtek, #2196ba);
        color: #fff;
        border: none;
        border-radius: 1rem;
        font-family: "Inter", sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        cursor: pointer;
        margin-bottom: 1.6rem;
      }
      .catalogo-mobile-toggle .chevron { transition: transform 0.25s ease; }
      .catalogo-mobile-toggle.abierto .chevron { transform: rotate(180deg); }

      /* ── Panel principal ── */
      .catalogo-main { flex: 1; min-width: 0; }

      .cat-panel { display: none; }
      .cat-panel.activo { display: block; }

      .catalogo-titlebar {
        background-color: var(--AzulSmtek, #2196ba);
        color: #fff;
        padding: 2rem 2.6rem;
        border-radius: 1rem;
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 2.4rem;
      }

      .catalogo-intro {
        display: flex;
        gap: 2.4rem;
        flex-wrap: wrap;
        margin-bottom: 3rem;
      }
      .catalogo-intro-img {
        width: 16rem;
        height: 12rem;
        flex-shrink: 0;
        border-radius: 1rem;
        background-color: var(--AzulClaro, #e8f4f8);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--AzulOscuro, #1a6880);
        font-size: 1.2rem;
        font-weight: 600;
        overflow: hidden;
        /* TODO: reemplazar por <img src="..." alt="..." style="width:100%;height:100%;object-fit:cover;"> */
      }
      .catalogo-intro p {
        flex: 1;
        min-width: 22rem;
        font-size: 1.45rem;
        color: var(--text-primary, #4e5358);
        line-height: 1.65;
      }

      /* ── Grid de subcategorías (tipo tarjetas Turck) ── */
      .subcat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(19rem, 1fr));
        gap: 2rem;
      }

      .subcat-card {
        display: block;
        background-color: var(--bg-section, #fff);
        border: 1px solid var(--border-color, #d8e2e8);
        border-radius: 1rem;
        overflow: hidden;
        text-decoration: none;
        cursor: pointer;
        transition: transform 0.22s ease, box-shadow 0.22s ease;
      }
      .subcat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(26, 104, 128, 0.14);
      }

      .subcat-card-img {
        aspect-ratio: 4 / 3;
        background-color: var(--bg-body, #f5f5f5);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted, #7a8390);
        font-size: 1.2rem;
        text-align: center;
        padding: 1rem;
        /* TODO: reemplazar por <img src="..." alt="..." style="width:100%;height:100%;object-fit:cover;"> */
      }

      .subcat-card-label {
        background-color: var(--AzulSmtek, #2196ba);
        color: #fff;
        font-weight: 700;
        font-size: 1.3rem;
        padding: 1.1rem 1.4rem;
      }

      /* ── Panel de detalle (al seleccionar una subcategoría) ── */
      .subcat-detail {
        display: none;
        background-color: var(--bg-section, #fff);
        border: 1px solid var(--border-color, #d8e2e8);
        border-radius: 1.2rem;
        padding: 2.4rem;
        margin-bottom: 2.8rem;
        gap: 2.4rem;
        align-items: flex-start;
        flex-wrap: wrap;
      }
      .subcat-detail.activo { display: flex; }

      .subcat-detail-back {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--AzulSmtek, #2196ba);
        text-decoration: none;
        cursor: pointer;
        background: none;
        border: none;
        font-family: "Inter", sans-serif;
        margin-bottom: 1.6rem;
        width: 100%;
      }

      .subcat-detail-img {
        width: 100%;
        max-width: 24rem;
        aspect-ratio: 4 / 3;
        flex-shrink: 0;
        border-radius: 1rem;
        background-color: var(--bg-body, #f5f5f5);
        border: 1px dashed var(--border-color, #d8e2e8);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted, #7a8390);
        font-size: 1.3rem;
        text-align: center;
        padding: 1rem;
        overflow: hidden;
        /* TODO: reemplazar por <img src="..." alt="..." style="width:100%;height:100%;object-fit:cover;"> */
      }

      .subcat-detail-info { flex: 1; min-width: 22rem; }
      .subcat-detail-info h4 {
        font-size: 1.9rem;
        font-weight: 800;
        color: var(--text-heading, #1a2a38);
        margin: 0 0 1rem;
      }
      .subcat-detail-info p {
        font-size: 1.45rem;
        color: var(--text-primary, #4e5358);
        line-height: 1.65;
        margin: 0 0 1.8rem;
      }
      .subcat-cta {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 1.1rem 2.2rem;
        background-color: var(--AzulSmtek, #2196ba);
        color: #fff;
        border-radius: 0.8rem;
        font-size: 1.35rem;
        font-weight: 700;
        text-decoration: none;
        transition: background-color 0.2s ease;
      }
      .subcat-cta:hover { background-color: var(--AzulOscuro, #1a6880); }

      body.dark-mode .catalogo-intro-img,
      body.dark-mode .subcat-card-img,
      body.dark-mode .subcat-detail-img {
        background-color: rgba(33,150,186,0.12);
      }
      body.dark-mode .cat-sublist { background-color: #16202c; }
      body.dark-mode .cat-group-btn:hover { background-color: #16202c; }

      /* ══════════════════════════════════════════════
         RESPONSIVE: sidebar → menú desplegable
      ══════════════════════════════════════════════ */
      @media (max-width: 900px) {
        .catalogo-mobile-toggle { display: flex; }

        .catalogo-shell { flex-direction: column; }

        .catalogo-sidebar {
          display: none;
          width: 100%;
          position: static;
        }
        .catalogo-sidebar.abierto-mobile {
          display: block;
          margin-bottom: 2rem;
        }

        .catalogo-titlebar { font-size: 1.8rem; padding: 1.6rem 2rem; }
        .catalogo-intro { flex-direction: column; }
        .catalogo-intro-img { width: 100%; height: 16rem; }
        .subcat-detail { flex-direction: column; }
        .subcat-detail-img { max-width: 100%; }
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
        <div id="logo-fallback" class="logo-placeholder" style="display: none">SMTEK</div>
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
                <a href="{{ route('register') }}" class="cta-nav">Registrarse</a>
              @endif
            @endauth
          @endif
        </div>

        <button id="dark-toggle" class="dark-toggle" aria-label="Cambiar modo de color" type="button">
          <span class="toggle-icon" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
              <title xmlns="">dark</title>
              <path fill="currentColor" d="M12.741 20.917a9.4 9.4 0 0 1-1.395-.105a9.141 9.141 0 0 1-1.465-17.7a1.18 1.18 0 0 1 1.21.281a1.27 1.27 0 0 1 .325 1.293a8.1 8.1 0 0 0-.353 2.68a8.27 8.27 0 0 0 4.366 6.857a7.6 7.6 0 0 0 3.711.993a1.242 1.242 0 0 1 .994 1.963a9.15 9.15 0 0 1-7.393 3.738M10.261 4.05a.2.2 0 0 0-.065.011a8.137 8.137 0 1 0 9.131 12.526a.22.22 0 0 0 .013-.235a.23.23 0 0 0-.206-.136a8.6 8.6 0 0 1-4.188-1.116a9.27 9.27 0 0 1-4.883-7.7a9.1 9.1 0 0 1 .4-3.008a.29.29 0 0 0-.069-.285a.18.18 0 0 0-.133-.057" />
            </svg>
          </span>
          <span class="toggle-label">Modo Oscuro</span>
          <div class="toggle-track" aria-hidden="true"><div class="toggle-thumb"></div></div>
        </button>
      </div>
    </header>

    <div class="nav-bg">
      <div class="contenedor" style="display: flex; align-items: center">
        <button id="hamburger" class="hamburger" aria-label="Abrir menú" aria-expanded="false" type="button">
          <span></span><span></span><span></span>
        </button>

        <nav id="nav-principal" class="navegacion-principal" style="flex: 1">
          <a href="{{ url('/') }}">Inicio</a>
          <a href="{{ route('productos.catalogo') }}">Productos</a>
          <a href="#">Servicios</a>
          <a href="{{ url('/#contacto') }}">Contacto</a>
          <a href="{{ route('cotizacion.create') }}" class="cta-nav">Cotizar</a>
          <a href="{{ route('postulacion.create') }}" style="font-family: bold">Trabaja con nosotros</a>
        </nav>
      </div>
    </div>

    <main>
      <section id="catalogo-productos" style="padding-top: 4rem;">
        <div class="contenedor">

          <div class="catalogo-breadcrumb reveal">
            <a href="{{ route('productos.catalogo') }}">Catálogo</a>
            <span> / </span>
            <span class="actual" id="breadcrumbActual">Sensores</span>
          </div>

          <!-- Toggle — solo visible en móvil -->
          <button type="button" class="catalogo-mobile-toggle" id="mobileToggle">
            <span id="mobileToggleLabel">Categorías</span>
            <span class="chevron">▾</span>
          </button>

          <div class="catalogo-shell">

            {{-- ══════════════════════════════════════
                 SIDEBAR
            ══════════════════════════════════════ --}}
            <aside class="catalogo-sidebar" id="catalogoSidebar">

              <div class="cat-group abierto" data-cat-group="sensores">
                <button type="button" class="cat-group-btn" data-cat="sensores">
                  Sensores <span class="chevron">›</span>
                </button>
                <ul class="cat-sublist">
                  <li><a href="#" data-cat="sensores" data-subcat="inductivos" class="activo">Sensores inductivos</a></li>
                  <li><a href="#" data-cat="sensores" data-subcat="capacitivos">Sensores capacitivos</a></li>
                  <li><a href="#" data-cat="sensores" data-subcat="magneticos">Sensores de campo magnético</a></li>
                  <li><a href="#" data-cat="sensores" data-subcat="ultrasonicos">Sensores ultrasónicos</a></li>
                  <li><a href="#" data-cat="sensores" data-subcat="radar">Sensores de radar</a></li>
                  <li><a href="#" data-cat="sensores" data-subcat="posicion-lineal">Sensores de posición lineal</a></li>
                  <li><a href="#" data-cat="sensores" data-subcat="encoders">Encoders</a></li>
                  <li><a href="#" data-cat="sensores" data-subcat="inclinometros">Inclinómetros</a></li>
                  <li><a href="#" data-cat="sensores" data-subcat="presion">Sensores de presión</a></li>
                  <li><a href="#" data-cat="sensores" data-subcat="temperatura">Sensores de temperatura</a></li>
                  <li><a href="#" data-cat="sensores" data-subcat="flujo">Sensores de flujo/medidores de flujo</a></li>
                  <li><a href="#" data-cat="sensores" data-subcat="nivel">Sensores de nivel</a></li>
                  <li><a href="#" data-cat="sensores" data-subcat="monitoreo">Sensores de monitoreo de estado</a></li>
                  <li><a href="#" data-cat="sensores" data-subcat="accesorios">Accesorios</a></li>
                </ul>
              </div>

              <div class="cat-group" data-cat-group="identificacion">
                <button type="button" class="cat-group-btn" data-cat="identificacion">
                  Sistemas de identificación <span class="chevron">›</span>
                </button>
                <ul class="cat-sublist">
                  <li><a href="#" data-cat="identificacion" data-subcat="lectura">Dispositivos de lectura y escritura HF/UHF</a></li>
                  <li><a href="#" data-cat="identificacion" data-subcat="tags">Tags HF/UHF</a></li>
                  <li><a href="#" data-cat="identificacion" data-subcat="interfaces-hf">Interfaces HF/UHF</a></li>
                  <li><a href="#" data-cat="identificacion" data-subcat="accesorios">Accesorios</a></li>
                </ul>
              </div>

              <div class="cat-group" data-cat-group="conectividad">
                <button type="button" class="cat-group-btn" data-cat="conectividad">
                  Conectividad <span class="chevron">›</span>
                </button>
                <ul class="cat-sublist">
                  <li><a href="#" data-cat="conectividad" data-subcat="cables">Cables</a></li>
                  <li><a href="#" data-cat="conectividad" data-subcat="bridas">Bridas</a></li>
                  <li><a href="#" data-cat="conectividad" data-subcat="distribuidores">Distribuidores de dos vías</a></li>
                  <li><a href="#" data-cat="conectividad" data-subcat="caja">Caja de conexiones</a></li>
                  <li><a href="#" data-cat="conectividad" data-subcat="conectores">Conectores armables</a></li>
                  <li><a href="#" data-cat="conectividad" data-subcat="rollo">Rollo de cable</a></li>
                  <li><a href="#" data-cat="conectividad" data-subcat="inductivo">Acoplamiento inductivo</a></li>
                  <li><a href="#" data-cat="conectividad" data-subcat="accesorios">Accesorios</a></li>
                </ul>
              </div>

              <div class="cat-group" data-cat-group="buses">
                <button type="button" class="cat-group-btn" data-cat="buses">
                  Buses de Campo <span class="chevron">›</span>
                </button>
                <ul class="cat-sublist">
                  <li><a href="#" data-cat="buses" data-subcat="eos">Sistemas de E/S</a></li>
                  <li><a href="#" data-cat="buses" data-subcat="modulo">Módulo de E/S</a></li>
                  <li><a href="#" data-cat="buses" data-subcat="componentes">Componentes para la automatización de procesos</a></li>
                  <li><a href="#" data-cat="buses" data-subcat="accesorios">Accesorios</a></li>
                </ul>
              </div>

              <div class="cat-group" data-cat-group="interfaces">
                <button type="button" class="cat-group-btn" data-cat="interfaces">
                  Interfaces <span class="chevron">›</span>
                </button>
                <ul class="cat-sublist">
                  <li><a href="#" data-cat="interfaces" data-subcat="barreras-seguridad">Barreras de seguridad</a></li>
                  <li><a href="#" data-cat="interfaces" data-subcat="barreras-zener">Barreras Zener</a></li>
                  <li><a href="#" data-cat="interfaces" data-subcat="acondicionador">Acondicionador de señal</a></li>
                  <li><a href="#" data-cat="interfaces" data-subcat="monitoreo-gabinete">Monitoreo del gabinete de control</a></li>
                  <li><a href="#" data-cat="interfaces" data-subcat="accesorios">Accesorios</a></li>
                </ul>
              </div>

              <div class="cat-group" data-cat-group="controles">
                <button type="button" class="cat-group-btn" data-cat="controles">
                  Controles industriales <span class="chevron">›</span>
                </button>
                <ul class="cat-sublist">
                  <li><a href="#" data-cat="controles" data-subcat="hmi">HMI programable</a></li>
                  <li><a href="#" data-cat="controles" data-subcat="control">Control</a></li>
                  <li><a href="#" data-cat="controles" data-subcat="gateway">Gateway programable</a></li>
                  <li><a href="#" data-cat="controles" data-subcat="reles">Relés</a></li>
                  <li><a href="#" data-cat="controles" data-subcat="accesorios">Accesorios</a></li>
                </ul>
              </div>

              <div class="cat-group" data-cat-group="fuentes">
                <button type="button" class="cat-group-btn" data-cat="fuentes">
                  Fuentes de alimentación <span class="chevron">›</span>
                </button>
                <ul class="cat-sublist">
                  <li><a href="#" data-cat="fuentes" data-subcat="din">Conmutadas para riel DIN IP20</a></li>
                  <li><a href="#" data-cat="fuentes" data-subcat="campo">Para montaje de campo IP67</a></li>
                </ul>
              </div>

              <div class="cat-group" data-cat-group="redes">
                <button type="button" class="cat-group-btn" data-cat="redes">
                  Tecnología de redes industriales <span class="chevron">›</span>
                </button>
                <ul class="cat-sublist">
                  <li><a href="#" data-cat="redes" data-subcat="switches">Conmutadores de Ethernet</a></li>
                  <li><a href="#" data-cat="redes" data-subcat="acopladores">Acopladores y convertidores</a></li>
                </ul>
              </div>

            </aside>

            {{-- ══════════════════════════════════════
                 CONTENIDO PRINCIPAL
            ══════════════════════════════════════ --}}
            <div class="catalogo-main">

              <!-- ═══ SENSORES ═══ -->
              <div class="cat-panel activo" data-panel="sensores">
                <div class="catalogo-titlebar">Sensores</div>

                <div class="catalogo-intro reveal">
                  <div class="catalogo-intro-img"><!-- TODO: imagen general Sensores -->Imagen</div>
                  <p>Los sensores proporcionan información esencial para casi todas las áreas de la automatización industrial, como señales de posición, flujo, temperatura, recorrido y ángulo, entre muchas otras variables de proceso.</p>
                </div>

                <div class="subcat-detail" data-detail-de="sensores">
                  <button type="button" class="subcat-detail-back">← Volver al listado</button>
                  <div class="subcat-detail-img"><!-- TODO: imagen de la subcategoría --></div>
                  <div class="subcat-detail-info">
                    <h4></h4>
                    <p></p>
                    <a href="{{ route('cotizacion.create') }}" class="subcat-cta">Solicitar cotización</a>
                  </div>
                </div>

                <div class="subcat-grid" data-grid-de="sensores">
                  <a href="#" class="subcat-card" data-cat="sensores" data-subcat="inductivos" data-titulo="Sensores inductivos" data-desc="Detectan objetos metálicos sin contacto físico, ideales para entornos con vibración, polvo o presencia de líquidos.">
                    <div class="subcat-card-img"><!-- TODO: imagen -->Imagen</div>
                    <div class="subcat-card-label">Sensores inductivos</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="sensores" data-subcat="capacitivos" data-titulo="Sensores capacitivos" data-desc="Detectan materiales metálicos y no metálicos —líquidos, plásticos, madera— a través de cambios en el campo capacitivo.">
                    <div class="subcat-card-img"><!-- TODO: imagen -->Imagen</div>
                    <div class="subcat-card-label">Sensores capacitivos</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="sensores" data-subcat="magneticos" data-titulo="Sensores de campo magnético" data-desc="Identifican la posición de pistones y actuadores mediante la detección de campos magnéticos, sin desgaste mecánico.">
                    <div class="subcat-card-img"><!-- TODO: imagen -->Imagen</div>
                    <div class="subcat-card-label">Sensores de campo magnético</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="sensores" data-subcat="ultrasonicos" data-titulo="Sensores ultrasónicos" data-desc="Miden distancia y detectan objetos mediante ondas de sonido, sin importar color o transparencia del material.">
                    <div class="subcat-card-img"><!-- TODO: imagen -->Imagen</div>
                    <div class="subcat-card-label">Sensores ultrasónicos</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="sensores" data-subcat="radar" data-titulo="Sensores de radar" data-desc="Ofrecen medición de nivel y distancia de alta precisión incluso en condiciones de polvo, vapor o temperaturas extremas.">
                    <div class="subcat-card-img"><!-- TODO: imagen -->Imagen</div>
                    <div class="subcat-card-label">Sensores de radar</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="sensores" data-subcat="posicion-lineal" data-titulo="Sensores de posición lineal" data-desc="Miden desplazamientos lineales con alta resolución, utilizados en aplicaciones de control de movimiento de precisión.">
                    <div class="subcat-card-img"><!-- TODO: imagen -->Imagen</div>
                    <div class="subcat-card-label">Sensores de posición lineal</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="sensores" data-subcat="encoders" data-titulo="Encoders" data-desc="Convierten el movimiento mecánico en señales eléctricas para el control preciso de velocidad y posición angular.">
                    <div class="subcat-card-img"><!-- TODO: imagen -->Imagen</div>
                    <div class="subcat-card-label">Encoders</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="sensores" data-subcat="inclinometros" data-titulo="Inclinómetros" data-desc="Miden ángulos de inclinación con alta exactitud, esenciales en maquinaria móvil y sistemas de nivelación.">
                    <div class="subcat-card-img"><!-- TODO: imagen -->Imagen</div>
                    <div class="subcat-card-label">Inclinómetros</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="sensores" data-subcat="presion" data-titulo="Sensores de presión" data-desc="Monitorean presión de líquidos y gases en procesos industriales, con salidas analógicas o digitales configurables.">
                    <div class="subcat-card-img"><!-- TODO: imagen -->Imagen</div>
                    <div class="subcat-card-label">Sensores de presión</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="sensores" data-subcat="temperatura" data-titulo="Sensores de temperatura" data-desc="Supervisan temperatura en tiempo real para proteger equipos críticos y garantizar procesos térmicos estables.">
                    <div class="subcat-card-img"><!-- TODO: imagen -->Imagen</div>
                    <div class="subcat-card-label">Sensores de temperatura</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="sensores" data-subcat="flujo" data-titulo="Sensores de flujo/medidores de flujo" data-desc="Miden el caudal de líquidos y gases en tuberías, permitiendo el control preciso de procesos industriales.">
                    <div class="subcat-card-img"><!-- TODO: imagen -->Imagen</div>
                    <div class="subcat-card-label">Sensores de flujo/medidores de flujo</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="sensores" data-subcat="nivel" data-titulo="Sensores de nivel" data-desc="Detectan el nivel de líquidos o sólidos en tanques y silos, evitando desbordamientos o desabastecimientos.">
                    <div class="subcat-card-img"><!-- TODO: imagen -->Imagen</div>
                    <div class="subcat-card-label">Sensores de nivel</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="sensores" data-subcat="monitoreo" data-titulo="Sensores de monitoreo de estado" data-desc="Recopilan datos de vibración, temperatura y desgaste para estrategias de mantenimiento predictivo.">
                    <div class="subcat-card-img"><!-- TODO: imagen -->Imagen</div>
                    <div class="subcat-card-label">Sensores de monitoreo de estado</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="sensores" data-subcat="accesorios" data-titulo="Accesorios" data-desc="Cables, soportes y componentes complementarios para la instalación y protección de sensores industriales.">
                    <div class="subcat-card-img"><!-- TODO: imagen -->Imagen</div>
                    <div class="subcat-card-label">Accesorios</div>
                  </a>
                </div>
              </div>

              <!-- ═══ SISTEMAS DE IDENTIFICACIÓN ═══ -->
              <div class="cat-panel" data-panel="identificacion">
                <div class="catalogo-titlebar">Sistemas de identificación</div>
                <div class="catalogo-intro reveal">
                  <div class="catalogo-intro-img"><!-- TODO: imagen general -->Imagen</div>
                  <p>Soluciones RFID de alta y ultra alta frecuencia para trazabilidad, identificación de piezas y control de procesos.</p>
                </div>
                <div class="subcat-detail" data-detail-de="identificacion">
                  <button type="button" class="subcat-detail-back">← Volver al listado</button>
                  <div class="subcat-detail-img"></div>
                  <div class="subcat-detail-info"><h4></h4><p></p>
                    <a href="{{ route('cotizacion.create') }}" class="subcat-cta">Solicitar cotización</a>
                  </div>
                </div>
                <div class="subcat-grid" data-grid-de="identificacion">
                  <a href="#" class="subcat-card" data-cat="identificacion" data-subcat="lectura" data-titulo="Dispositivos de lectura y escritura HF/UHF" data-desc="Equipos que leen y graban información en tags RFID en tiempo real dentro de la línea de producción.">
                    <div class="subcat-card-img">Imagen</div>
                    <div class="subcat-card-label">Dispositivos de lectura y escritura HF/UHF</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="identificacion" data-subcat="tags" data-titulo="Tags HF/UHF" data-desc="Etiquetas RFID resistentes a condiciones industriales, para identificar piezas, herramentales y contenedores.">
                    <div class="subcat-card-img">Imagen</div>
                    <div class="subcat-card-label">Tags HF/UHF</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="identificacion" data-subcat="interfaces-hf" data-titulo="Interfaces HF/UHF" data-desc="Módulos de comunicación que conectan los dispositivos de lectura RFID con los sistemas de control existentes.">
                    <div class="subcat-card-img">Imagen</div>
                    <div class="subcat-card-label">Interfaces HF/UHF</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="identificacion" data-subcat="accesorios" data-titulo="Accesorios" data-desc="Antenas, cables y montajes complementarios para sistemas de identificación RFID.">
                    <div class="subcat-card-img">Imagen</div>
                    <div class="subcat-card-label">Accesorios</div>
                  </a>
                </div>
              </div>

              <!-- ═══ CONECTIVIDAD ═══ -->
              <div class="cat-panel" data-panel="conectividad">
                <div class="catalogo-titlebar">Conectividad</div>
                <div class="catalogo-intro reveal">
                  <div class="catalogo-intro-img">Imagen</div>
                  <p>Componentes para la interconexión física de sensores, actuadores y controladores dentro de la red de planta.</p>
                </div>
                <div class="subcat-detail" data-detail-de="conectividad">
                  <button type="button" class="subcat-detail-back">← Volver al listado</button>
                  <div class="subcat-detail-img"></div>
                  <div class="subcat-detail-info"><h4></h4><p></p>
                    <a href="{{ route('cotizacion.create') }}" class="subcat-cta">Solicitar cotización</a>
                  </div>
                </div>
                <div class="subcat-grid" data-grid-de="conectividad">
                  <a href="#" class="subcat-card" data-cat="conectividad" data-subcat="cables" data-titulo="Cables" data-desc="Cables industriales blindados y resistentes, diseñados para soportar condiciones exigentes de planta.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Cables</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="conectividad" data-subcat="bridas" data-titulo="Bridas" data-desc="Elementos de sujeción para la organización y fijación segura del cableado industrial.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Bridas</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="conectividad" data-subcat="distribuidores" data-titulo="Distribuidores de dos vías" data-desc="Permiten la conexión simultánea de múltiples sensores o actuadores a un solo punto de red.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Distribuidores de dos vías</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="conectividad" data-subcat="caja" data-titulo="Caja de conexiones" data-desc="Módulos de distribución que centralizan y protegen las conexiones eléctricas en campo.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Caja de conexiones</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="conectividad" data-subcat="conectores" data-titulo="Conectores armables" data-desc="Conectores configurables en sitio que se adaptan a distintas longitudes y necesidades de instalación.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Conectores armables</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="conectividad" data-subcat="rollo" data-titulo="Rollo de cable" data-desc="Presentaciones de cable industrial a granel para instalaciones extensas o personalizadas.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Rollo de cable</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="conectividad" data-subcat="inductivo" data-titulo="Acoplamiento inductivo" data-desc="Transmisión de datos y energía sin contacto físico, ideal para partes móviles o rotativas.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Acoplamiento inductivo</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="conectividad" data-subcat="accesorios" data-titulo="Accesorios" data-desc="Componentes complementarios de conectividad: adaptadores, tapas y prensaestopas.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Accesorios</div>
                  </a>
                </div>
              </div>

              <!-- ═══ BUSES DE CAMPO ═══ -->
              <div class="cat-panel" data-panel="buses">
                <div class="catalogo-titlebar">Buses de Campo</div>
                <div class="catalogo-intro reveal">
                  <div class="catalogo-intro-img">Imagen</div>
                  <p>Sistemas de entrada/salida distribuida que integran sensores y actuadores a los buses de comunicación industrial.</p>
                </div>
                <div class="subcat-detail" data-detail-de="buses">
                  <button type="button" class="subcat-detail-back">← Volver al listado</button>
                  <div class="subcat-detail-img"></div>
                  <div class="subcat-detail-info"><h4></h4><p></p>
                    <a href="{{ route('cotizacion.create') }}" class="subcat-cta">Solicitar cotización</a>
                  </div>
                </div>
                <div class="subcat-grid" data-grid-de="buses">
                  <a href="#" class="subcat-card" data-cat="buses" data-subcat="eos" data-titulo="Sistemas de E/S" data-desc="Módulos de entrada/salida distribuida que reducen el cableado y facilitan la integración de dispositivos de campo.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Sistemas de E/S</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="buses" data-subcat="modulo" data-titulo="Módulo de E/S" data-desc="Unidades compactas de entradas y salidas digitales o analógicas para aplicaciones específicas.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Módulo de E/S</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="buses" data-subcat="componentes" data-titulo="Componentes para la automatización de procesos" data-desc="Elementos complementarios que facilitan la integración de instrumentación en procesos continuos.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Componentes para automatización</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="buses" data-subcat="accesorios" data-titulo="Accesorios" data-desc="Conectores, terminaciones y montajes para sistemas de buses de campo.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Accesorios</div>
                  </a>
                </div>
              </div>

              <!-- ═══ INTERFACES ═══ -->
              <div class="cat-panel" data-panel="interfaces">
                <div class="catalogo-titlebar">Interfaces</div>
                <div class="catalogo-intro reveal">
                  <div class="catalogo-intro-img">Imagen</div>
                  <p>Dispositivos de seguridad y acondicionamiento de señal que protegen los sistemas de control industrial.</p>
                </div>
                <div class="subcat-detail" data-detail-de="interfaces">
                  <button type="button" class="subcat-detail-back">← Volver al listado</button>
                  <div class="subcat-detail-img"></div>
                  <div class="subcat-detail-info"><h4></h4><p></p>
                    <a href="{{ route('cotizacion.create') }}" class="subcat-cta">Solicitar cotización</a>
                  </div>
                </div>
                <div class="subcat-grid" data-grid-de="interfaces">
                  <a href="#" class="subcat-card" data-cat="interfaces" data-subcat="barreras-seguridad" data-titulo="Barreras de seguridad" data-desc="Aíslan y limitan la energía eléctrica en zonas clasificadas para prevenir riesgos de ignición.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Barreras de seguridad</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="interfaces" data-subcat="barreras-zener" data-titulo="Barreras Zener" data-desc="Protegen circuitos en áreas con atmósferas explosivas mediante la limitación pasiva de corriente y voltaje.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Barreras Zener</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="interfaces" data-subcat="acondicionador" data-titulo="Acondicionador de señal" data-desc="Transforman y amplifican señales de campo para su correcta interpretación por el sistema de control.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Acondicionador de señal</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="interfaces" data-subcat="monitoreo-gabinete" data-titulo="Monitoreo del gabinete de control" data-desc="Supervisan temperatura, humedad y condiciones internas de los gabinetes eléctricos.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Monitoreo del gabinete de control</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="interfaces" data-subcat="accesorios" data-titulo="Accesorios" data-desc="Rieles, borneras y componentes complementarios para gabinetes de control.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Accesorios</div>
                  </a>
                </div>
              </div>

              <!-- ═══ CONTROLES INDUSTRIALES ═══ -->
              <div class="cat-panel" data-panel="controles">
                <div class="catalogo-titlebar">Controles industriales</div>
                <div class="catalogo-intro reveal">
                  <div class="catalogo-intro-img">Imagen</div>
                  <p>Dispositivos de control, visualización y conmutación para la operación y supervisión de procesos automatizados.</p>
                </div>
                <div class="subcat-detail" data-detail-de="controles">
                  <button type="button" class="subcat-detail-back">← Volver al listado</button>
                  <div class="subcat-detail-img"></div>
                  <div class="subcat-detail-info"><h4></h4><p></p>
                    <a href="{{ route('cotizacion.create') }}" class="subcat-cta">Solicitar cotización</a>
                  </div>
                </div>
                <div class="subcat-grid" data-grid-de="controles">
                  <a href="#" class="subcat-card" data-cat="controles" data-subcat="hmi" data-titulo="HMI programable" data-desc="Pantallas táctiles programables que permiten la visualización y operación intuitiva de procesos industriales.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">HMI programable</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="controles" data-subcat="control" data-titulo="Control" data-desc="Controladores lógicos que ejecutan la lógica de automatización de procesos industriales.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Control</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="controles" data-subcat="gateway" data-titulo="Gateway programable" data-desc="Dispositivos que traducen y enrutan la comunicación entre distintos protocolos industriales.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Gateway programable</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="controles" data-subcat="reles" data-titulo="Relés" data-desc="Dispositivos de conmutación electromecánica o de estado sólido para el control de cargas industriales.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Relés</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="controles" data-subcat="accesorios" data-titulo="Accesorios" data-desc="Zócalos, cableado y componentes complementarios para controles industriales.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Accesorios</div>
                  </a>
                </div>
              </div>

              <!-- ═══ FUENTES DE ALIMENTACIÓN ═══ -->
              <div class="cat-panel" data-panel="fuentes">
                <div class="catalogo-titlebar">Fuentes de alimentación</div>
                <div class="catalogo-intro reveal">
                  <div class="catalogo-intro-img">Imagen</div>
                  <p>Fuentes de poder confiables para alimentar equipos de control e instrumentación en planta.</p>
                </div>
                <div class="subcat-detail" data-detail-de="fuentes">
                  <button type="button" class="subcat-detail-back">← Volver al listado</button>
                  <div class="subcat-detail-img"></div>
                  <div class="subcat-detail-info"><h4></h4><p></p>
                    <a href="{{ route('cotizacion.create') }}" class="subcat-cta">Solicitar cotización</a>
                  </div>
                </div>
                <div class="subcat-grid" data-grid-de="fuentes">
                  <a href="#" class="subcat-card" data-cat="fuentes" data-subcat="din" data-titulo="Fuentes de conmutación para riel DIN IP20" data-desc="Convierten la energía de línea en voltaje estable para montaje directo en gabinetes eléctricos.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Conmutadas para riel DIN IP20</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="fuentes" data-subcat="campo" data-titulo="Fuentes de alimentación para montaje de campo IP67" data-desc="Fuentes robustas y selladas, diseñadas para instalarse directamente en campo bajo condiciones adversas.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Para montaje de campo IP67</div>
                  </a>
                </div>
              </div>

              <!-- ═══ TECNOLOGÍA DE REDES INDUSTRIALES ═══ -->
              <div class="cat-panel" data-panel="redes">
                <div class="catalogo-titlebar">Tecnología de redes industriales</div>
                <div class="catalogo-intro reveal">
                  <div class="catalogo-intro-img">Imagen</div>
                  <p>Infraestructura de red diseñada para garantizar comunicación estable y de alto desempeño en entornos industriales.</p>
                </div>
                <div class="subcat-detail" data-detail-de="redes">
                  <button type="button" class="subcat-detail-back">← Volver al listado</button>
                  <div class="subcat-detail-img"></div>
                  <div class="subcat-detail-info"><h4></h4><p></p>
                    <a href="{{ route('cotizacion.create') }}" class="subcat-cta">Solicitar cotización</a>
                  </div>
                </div>
                <div class="subcat-grid" data-grid-de="redes">
                  <a href="#" class="subcat-card" data-cat="redes" data-subcat="switches" data-titulo="Conmutadores de Ethernet" data-desc="Switches industriales que gestionan el tráfico de datos entre dispositivos conectados a la red de planta.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Conmutadores de Ethernet</div>
                  </a>
                  <a href="#" class="subcat-card" data-cat="redes" data-subcat="acopladores" data-titulo="Acopladores y convertidores" data-desc="Permiten la interconexión entre distintos medios y protocolos de comunicación de red.">
                    <div class="subcat-card-img">Imagen</div><div class="subcat-card-label">Acopladores y convertidores</div>
                  </a>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>
    </main>


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

    <footer>
      <div class="contenedor footer-inner">
        <img
          src="assets/img/1b.svg"
          alt="SMTEK Logo"
          class="footer-logo"
          onerror="
            this.style.display = 'none';
            document.getElementById('footer-logo-fallback').style.display = 'flex';
          "
        />
        <div id="footer-logo-fallback" class="footer-logo-placeholder" style="display: none">SMTEK</div>
        <p>© 2025 SMTEK Smart Technologies. Todos los derechos reservados.</p>
        <div style="display: flex; gap: 2rem">
          <a href="#">Aviso de privacidad</a>
          <a href="#">Términos de uso</a>
        </div>
      </div>
    </footer>

    <script src="assets/js/script.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const catGroups   = document.querySelectorAll('.cat-group');
        const catPanels   = document.querySelectorAll('.cat-panel');
        const sidebarLinks = document.querySelectorAll('.cat-sublist a');
        const breadcrumb  = document.getElementById('breadcrumbActual');
        const mobileToggle = document.getElementById('mobileToggle');
        const mobileToggleLabel = document.getElementById('mobileToggleLabel');
        const sidebar = document.getElementById('catalogoSidebar');

        // Nombre visible por categoría, para breadcrumb y botón móvil
        const nombresCat = {
          sensores: 'Sensores',
          identificacion: 'Sistemas de identificación',
          conectividad: 'Conectividad',
          buses: 'Buses de Campo',
          interfaces: 'Interfaces',
          controles: 'Controles industriales',
          fuentes: 'Fuentes de alimentación',
          redes: 'Tecnología de redes industriales',
        };
        mobileToggleLabel.textContent = nombresCat.sensores;

        function mostrarCategoria(cat) {
          catPanels.forEach(function (p) {
            p.classList.toggle('activo', p.getAttribute('data-panel') === cat);
          });
          catGroups.forEach(function (g) {
            g.classList.toggle('abierto', g.getAttribute('data-cat-group') === cat);
          });
          breadcrumb.textContent = nombresCat[cat] || cat;
          mobileToggleLabel.textContent = nombresCat[cat] || cat;

          // Ocultar cualquier detalle abierto y limpiar activos de sidebar al cambiar de categoría
          document.querySelectorAll('.subcat-detail').forEach(function (d) { d.classList.remove('activo'); });
          sidebarLinks.forEach(function (l) { l.classList.remove('activo'); });
        }

        function mostrarDetalle(cat, subcat, titulo, desc) {
          mostrarCategoria(cat);

          const detalle = document.querySelector('.subcat-detail[data-detail-de="' + cat + '"]');
          if (detalle) {
            detalle.querySelector('h4').textContent = titulo;
            detalle.querySelector('p').textContent = desc;
            detalle.classList.add('activo');
            detalle.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }

          sidebarLinks.forEach(function (l) {
            const match = l.getAttribute('data-cat') === cat && l.getAttribute('data-subcat') === subcat;
            l.classList.toggle('activo', match);
          });

          // En móvil, cerrar el desplegable tras seleccionar
          if (window.innerWidth <= 900) {
            sidebar.classList.remove('abierto-mobile');
            mobileToggle.classList.remove('abierto');
          }
        }

        // Clic en encabezado de categoría (sidebar)
        document.querySelectorAll('.cat-group-btn').forEach(function (btn) {
          btn.addEventListener('click', function () {
            const cat = btn.getAttribute('data-cat');
            const group = btn.closest('.cat-group');
            const yaAbierto = group.classList.contains('abierto');

            // Alterna acordeón; si se abre, también cambia el panel principal
            catGroups.forEach(function (g) { g.classList.remove('abierto'); });
            if (!yaAbierto) {
              group.classList.add('abierto');
              mostrarCategoria(cat);
            }
          });
        });

        // Clic en subcategoría del sidebar
        sidebarLinks.forEach(function (link) {
          link.addEventListener('click', function (e) {
            e.preventDefault();
            const cat = link.getAttribute('data-cat');
            const subcat = link.getAttribute('data-subcat');
            const card = document.querySelector('.subcat-card[data-cat="' + cat + '"][data-subcat="' + subcat + '"]');
            if (card) {
              mostrarDetalle(cat, subcat, card.getAttribute('data-titulo'), card.getAttribute('data-desc'));
            }
          });
        });

        // Clic en una tarjeta del grid
        document.querySelectorAll('.subcat-card').forEach(function (card) {
          card.addEventListener('click', function (e) {
            e.preventDefault();
            mostrarDetalle(
              card.getAttribute('data-cat'),
              card.getAttribute('data-subcat'),
              card.getAttribute('data-titulo'),
              card.getAttribute('data-desc')
            );
          });
        });

        // Botón "Volver al listado" dentro del detalle
        document.querySelectorAll('.subcat-detail-back').forEach(function (btn) {
          btn.addEventListener('click', function () {
            btn.closest('.subcat-detail').classList.remove('activo');
            sidebarLinks.forEach(function (l) { l.classList.remove('activo'); });
          });
        });

        // Toggle del menú desplegable en móvil
        mobileToggle.addEventListener('click', function () {
          sidebar.classList.toggle('abierto-mobile');
          mobileToggle.classList.toggle('abierto');
        });
      });
    </script>
  </body>
</html>
