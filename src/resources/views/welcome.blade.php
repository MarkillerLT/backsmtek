<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SMTEK Smart Technologies</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
      rel="stylesheet"
    />
    <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
        <link rel="stylesheet" href="{{asset('assets/css/normalize.css')}}" />
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
    .video-wrap {
  position: relative;
  width: 100%;
  max-width: 100%;
  margin: 4rem auto 0;
  aspect-ratio: 16 / 9;
  border-radius: 1.2rem;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(26, 104, 128, 0.13);
  border: 1px solid var(--border-color, #d8e2e8);
}
.video-wrap iframe {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  border: 0;
}
@media (max-width: 768px) {
  .video-wrap {
    border-radius: 0.8rem;
  }
}
    /* ── Pestañas de sucursal ── */
.sucursal-tabs {
  display: flex;
  gap: 0.8rem;
  margin: 1.6rem 0 2.4rem;
  border-bottom: 1px solid var(--border-color, #d8e2e8);
}
.sucursal-tab {
  background: none;
  border: none;
  border-bottom: 3px solid transparent;
  padding: 1rem 0.4rem 1.2rem;
  margin-right: 1.8rem;
  font-size: 1.4rem;
  font-weight: 700;
  color: var(--text-muted, #7a8390);
  cursor: pointer;
  font-family: "Inter", sans-serif;
  transition: color 0.25s ease, border-color 0.25s ease;
}
.sucursal-tab:hover {
  color: var(--AzulSmtek, #2196ba);
}
.sucursal-tab.activo {
  color: var(--AzulSmtek, #2196ba);
  border-bottom-color: var(--AzulSmtek, #2196ba);
}
.sucursal-panel {
  display: flex;
  flex-direction: column;
  gap: 1.6rem;
}
.sucursal-panel[hidden] {
  display: none;
}
/* ── Mapa sincronizado con sucursal activa ── */
.mapa-wrap {
  position: relative;
  width: 100%;
  height: 100%;
  min-height: 38rem;
  border-radius: 1.2rem;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(26, 104, 128, 0.13);
  border: 1px solid var(--border-color, #d8e2e8);
}
.mapa-panel {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
}
.mapa-panel[hidden] {
  display: none;
}
.mapa-panel iframe {
  display: block;
  width: 100%;
  height: 100%;
}
@media (max-width: 960px) {
  .mapa-wrap {
    min-height: 28rem;
  }
}
/* ── Misión y Visión ── */
.mision-vision-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 2.4rem;
}
.mv-card {
  background-color: var(--bg-section, #fff);
  border: 1px solid var(--border-color, #d8e2e8);
  border-radius: 1.2rem;
  padding: 2.8rem;
  box-shadow: 0 2px 8px rgba(26, 104, 128, 0.08);
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.mv-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 4px 20px rgba(26, 104, 128, 0.13);
}
.mv-card h3 {
  font-size: 1.9rem;
  font-weight: 800;
  color: var(--text-heading, #1a2a38);
  margin: 0 0 1.2rem;
}
.mv-card p {
  font-size: 1.5rem;
  color: var(--text-primary, #4e5358);
  line-height: 1.7;
  margin: 0;
}
.mv-card-full {
  grid-column: 1 / -1;
  margin-top: 2.4rem;
}
@media (max-width: 768px) {
  .mision-vision-grid {
    grid-template-columns: 1fr;
  }
}
/* ── Corrección: centrar última fila incompleta en servicios ── */
.servicios-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 2.5rem;
}
.servicio-card {
    flex: 1 1 25rem;
    max-width: 32rem;
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
          <a href="{{ url('/')}}">Inicio</a>
<!-- descomentar cuando se rellene productos-->
<!-- <a href="{{ route('productos.catalogo')}}">Catalogo</a>  -->
<!-- descomentar cuando se rellene productos-->

          <a href="{{ route('servicios')}}">Servicios</a>
          <a href="{{ url('/#contacto')}}">Contacto</a>
          <a href="{{ url('/products')}}">Productos</a>
          <a href="{{ route('cotizacion.create') }}" class="cta-nav">Cotizar</a>
          <a href="{{ route('postulacion.create')}}" style="font-family: bold">Trabaja con nosotros</a>
        </nav>
      </div>
    </div>
    <!-- hero -->
    <section class="hero" id="inicio">
      <video
        class="hero-video"
        autoplay
        muted
        loop
        playsinline
        poster="{{ asset('assets/img/her.jpg') }}"
      >
        <source src="{{ asset('videoh/torno.mp4') }}" type="video/mp4">
      </video>
      <div class="hero-content">
        <h1>Transformamos Procesos <span>Industriales </span><br />con Soluciones de Industria 4.0</h1>
        <p>
        Diseñamos e integramos proyectos llave en mano de automatización, digitalización
        y monitoreo industrial para aumentar la productividad, mejorar la trazabilidad
        y optimizar la toma de decisiones, máximos resultados.
       </p>
        <div class="hero-btns">
          <a href="{{ route('cotizacion.create')}}" class="btn-primary">Ver Servicios</a>
          <a href="{{ route('productos.catalogo')}}" class="btn-outline">Ver productos</a>
        </div>
      </div>
    </section>
    <main>
      <!-- seccion que hacemos -->
      <section id="servicios">
        <div class="contenedor">
          <div class="section-header reveal">
            <span class="section-label">Nuestro alcance</span>
            <h2>¿Qué hacemos?</h2>
            <p>
            Soluciones diseñadas para la industria 4.0
            </p>
          </div>
          <div class="servicios-grid">
            <div class="servicio-card reveal">
              <span class="servicio-icono"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  viewBox="0 0 24 24"
                >
                  <title xmlns="">gear</title>
                  <g fill="none" stroke="currentColor" stroke-width="2">
                    <path
                      d="M14 3.269C14 2.568 13.432 2 12.731 2H11.27C10.568 2 10 2.568 10 3.269c0 .578-.396 1.074-.935 1.286q-.128.052-.253.106c-.531.23-1.162.16-1.572-.249a1.27 1.27 0 0 0-1.794 0L4.412 5.446a1.27 1.27 0 0 0 0 1.794c.41.41.48 1.04.248 1.572a8 8 0 0 0-.105.253c-.212.539-.708.935-1.286.935C2.568 10 2 10.568 2 11.269v1.462C2 13.432 2.568 14 3.269 14c.578 0 1.074.396 1.286.935q.052.128.105.253c.231.531.161 1.162-.248 1.572a1.27 1.27 0 0 0 0 1.794l1.034 1.034a1.27 1.27 0 0 0 1.794 0c.41-.41 1.04-.48 1.572-.249q.125.055.253.106c.539.212.935.708.935 1.286c0 .701.568 1.269 1.269 1.269h1.462c.701 0 1.269-.568 1.269-1.269c0-.578.396-1.074.935-1.287q.128-.05.253-.104c.531-.232 1.162-.161 1.571.248a1.27 1.27 0 0 0 1.795 0l1.034-1.034a1.27 1.27 0 0 0 0-1.794c-.41-.41-.48-1.04-.249-1.572q.055-.125.106-.253c.212-.539.708-.935 1.286-.935c.701 0 1.269-.568 1.269-1.269V11.27c0-.701-.568-1.269-1.269-1.269c-.578 0-1.074-.396-1.287-.935a8 8 0 0 0-.105-.253c-.23-.531-.16-1.162.249-1.572a1.27 1.27 0 0 0 0-1.794l-1.034-1.034a1.27 1.27 0 0 0-1.794 0c-.41.41-1.04.48-1.572.249a8 8 0 0 0-.253-.106C14.396 4.343 14 3.847 14 3.27Z"
                    />
                    <path d="M16 12a4 4 0 1 1-8 0a4 4 0 0 1 8 0Z" />
                  </g></svg
              ></span>
              <h3>Automatización industrial</h3>
              <p>
            Diseño e integración de sistemas PLC, HMI y SCADA para el control eficiente de procesos productivos.
              </p>
            </div>
            <div class="servicio-card reveal">
              <span class="servicio-icono"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  viewBox="0 0 640 640"
                >
                  <title xmlns="">chain</title>
                  <path
                    fill="currentColor"
                    d="M451.5 160c-16.6 0-32.7 4.5-46.8 12.7c-15.8-16-34.2-29.4-54.5-39.5c28.2-24 64.1-37.2 101.3-37.2C537.9 96 608 166 608 252.5c0 41.5-16.5 81.3-45.8 110.6l-71.1 71.1C461.8 463.5 422 480 380.5 480C294.1 480 224 410 224 323.5c0-1.5 0-3 .1-4.5c.5-17.7 15.2-31.6 32.9-31.1s31.6 15.2 31.1 32.9v2.6c0 51.1 41.4 92.5 92.5 92.5c24.5 0 48-9.7 65.4-27.1l71.1-71.1c17.3-17.3 27.1-40.9 27.1-65.4c0-51.1-41.4-92.5-92.5-92.5zm-144.3 77.3c-1.9-.8-3.8-1.9-5.5-3.1c-12.6-6.5-27-10.2-42.1-10.2c-24.5 0-48 9.7-65.4 27.1l-71.1 71.1C105.8 339.5 96 363.1 96 387.6c0 51.1 41.4 92.5 92.5 92.5c16.5 0 32.6-4.4 46.7-12.6c15.8 16 34.2 29.4 54.6 39.5c-28.2 23.9-64 37.2-101.3 37.2c-86.4 0-156.5-70-156.5-156.5c0-41.5 16.5-81.3 45.8-110.6l71.1-71.1c29.3-29.3 69.1-45.8 110.6-45.8c86.6 0 156.5 70.6 156.5 156.9v3.9c-.4 17.7-15.1 31.6-32.8 31.2s-31.6-15.1-31.2-32.8v-2.3c0-33.7-18-63.3-44.8-79.6z"
                  /></svg
              ></span>
              <h3>Industria 4.0 e IIoT</h3>
              <p>
            Conectamos máquinas, líneas de producción y sistemas para obtener información en tiempo real.
            </p>
            </div>
            <div class="servicio-card reveal">
              <span class="servicio-icono"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  viewBox="0 0 24 24"
                >
                  <title xmlns="">analytics-outline-rounded</title>
                  <path
                    fill="currentColor"
                    d="M7.874 12.143q-.143.144-.143.357V16q0 .214.143.357t.357.143t.357-.143T8.73 16v-3.5q0-.213-.144-.357T8.231 12t-.357.143m7.539-5q-.144.144-.144.357V16q0 .214.144.357t.356.143t.357-.143t.143-.357V7.5q0-.213-.143-.357T15.769 7t-.357.143m-3.769 7q-.143.144-.143.357V16q0 .214.143.357T12 16.5t.357-.143T12.5 16v-1.5q0-.213-.143-.357T12 14t-.357.143M5.616 20q-.691 0-1.153-.462T4 18.384V5.616q0-.691.463-1.153T5.616 4h12.769q.69 0 1.153.463T20 5.616v12.769q0 .69-.462 1.153T18.384 20zm0-1h12.769q.23 0 .423-.192t.192-.424V5.616q0-.231-.192-.424T18.384 5H5.616q-.231 0-.424.192T5 5.616v12.769q0 .23.192.423t.423.192M5 5v14zm7.357 6.357q.143-.143.143-.357t-.143-.357T12 10.5t-.357.143T11.5 11t.143.357t.357.143t.357-.143"
                  /></svg
              ></span>
              <h3>Trazabilidad de Producción</h3>
              <p>
            Captura y seguimiento de datos críticos durante todo el proceso de manufactura, historial, registros críticos, análisis de datos.
              </p>
            </div>
            <div class="servicio-card reveal">
              <span class="servicio-icono"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  viewBox="0 0 24 24"
                >
                  <title xmlns="">security</title>
                  <path
                    fill="currentColor"
                    d="M12 20.962q-3.014-.895-5.007-3.651T5 11.1V5.692l7-2.615l7 2.615V11.1q0 3.454-1.993 6.21T12 20.963m0-1.062q2.425-.75 4.05-2.962T17.95 12H12V4.144L6 6.375v5.156q0 .194.05.469H12z"
                  /></svg
              ></span>
              <h3>Sistemas MES</h3>
              <p>
            Monitoreo y control de producción para mejorar eficiencia y disponibilidad.
              </p>
            </div>
            <div class="servicio-card reveal">
              <span class="servicio-icono"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  viewBox="0 0 24 24"
                >
                  <title xmlns="">outline-cloud</title>
                  <path
                    fill="currentColor"
                    d="M12 6c2.62 0 4.88 1.86 5.39 4.43l.3 1.5l1.53.11A2.98 2.98 0 0 1 22 15c0 1.65-1.35 3-3 3H6c-2.21 0-4-1.79-4-4c0-2.05 1.53-3.76 3.56-3.97l1.07-.11l.5-.95A5.47 5.47 0 0 1 12 6m0-2C9.11 4 6.6 5.64 5.35 8.04A5.994 5.994 0 0 0 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5c0-2.64-2.05-4.78-4.65-4.96A7.49 7.49 0 0 0 12 4"
                  /></svg
              ></span>
              <h3>Visión Artificial</h3>
              <p>
            Sistemas de inspección automática para garantizar calidad y reducir errores humanos.
              </p>
            </div>
            <div class="servicio-card reveal">
              <span class="servicio-icono"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  viewBox="0 0 24 24"
                >
                  <title xmlns="">customer-support</title>
                  <g fill="none" stroke="currentColor" stroke-width="1.5">
                    <path
                      d="M17 10.805c0-.346 0-.519.052-.673c.151-.448.55-.621.95-.803c.448-.205.672-.307.895-.325c.252-.02.505.034.721.155c.286.16.486.466.69.714c.943 1.146 1.415 1.719 1.587 2.35c.14.51.14 1.044 0 1.553c-.251.922-1.046 1.694-1.635 2.41c-.301.365-.452.548-.642.655a1.27 1.27 0 0 1-.721.155c-.223-.018-.447-.12-.896-.325c-.4-.182-.798-.355-.949-.803c-.052-.154-.052-.327-.052-.673zm-10 0c0-.436-.012-.827-.364-1.133c-.128-.111-.298-.188-.637-.343c-.449-.204-.673-.307-.896-.325c-.667-.054-1.026.402-1.41.87c-.944 1.145-1.416 1.718-1.589 2.35a2.94 2.94 0 0 0 0 1.553c.252.921 1.048 1.694 1.636 2.409c.371.45.726.861 1.363.81c.223-.018.447-.12.896-.325c.34-.154.509-.232.637-.343c.352-.306.364-.697.364-1.132z"
                    />
                    <path
                      stroke-linecap="square"
                      stroke-linejoin="round"
                      d="M5 9c0-3.314 3.134-6 7-6s7 2.686 7 6"
                    />
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M19 17v.8c0 1.767-1.79 3.2-4 3.2h-2"
                    />
                  </g>
                </svg>
              </span>
              <h3>Dashboards y Analisis</h3>
              <p>
            Visualización de KPIs, OEE, producción y calidad mediante paneles personalizados.
Dashboard en nube, para consulta y toma de decisiones en remoto.
              </p>
            </div>
          </div>
        </div>
      </section>
      <!-- Aliados seccion -->
      <section class="aliados-section" id="aliados">
        <div class="contenedor">
          <div class="section-header reveal">
            <span class="section-label">Partners</span>
            <h2>Aliados comerciales</h2>
            <p>
              Trabajamos con las marcas líderes de la industria para ofrecerte
              las mejores soluciones tecnológicas disponibles en el mercado.
            </p>
          </div>
          <div class="aliados-grid">
            <div class="aliado-card reveal">
              <div class="aliado-logo-placeholder">
            <svg width="220.46" height="50.109" viewBox="0 0 220.46 50.109" id="logo_white_border" x="1586.4" y="137.46" xmlns="http://www.w3.org/2000/svg"><g stroke-linejoin="round"><path d="M110.23 49.309c-14.69 0-28.94-.621-42.356-1.847-12.968-1.184-24.618-2.88-34.626-5.041-10.044-2.169-17.942-4.7-23.475-7.525C3.819 31.856.8 28.546.8 25.054c0-3.492 3.019-6.803 8.973-9.842 5.533-2.825 13.431-5.356 23.475-7.525 10.008-2.16 21.658-3.856 34.626-5.04C81.29 1.42 95.54.8 110.23.8s28.94.621 42.356 1.846c12.968 1.185 24.618 2.88 34.626 5.041 10.044 2.169 17.942 4.7 23.475 7.525 5.954 3.04 8.973 6.35 8.973 9.842 0 3.491-3.019 6.803-8.973 9.842-5.533 2.825-13.431 5.356-23.475 7.525-10.008 2.16-21.658 3.857-34.626 5.041-13.417 1.226-27.667 1.847-42.356 1.847Z"></path><path d="M110.23 48.509c59.994 0 108.63-10.501 108.63-23.455C218.86 12.1 170.224 1.6 110.23 1.6 50.236 1.6 1.6 12.1 1.6 25.054s48.636 23.455 108.63 23.455m0 1.6c-14.714 0-28.989-.623-42.43-1.85-13-1.187-24.681-2.888-34.72-5.056-10.112-2.183-18.076-4.738-23.67-7.594-2.936-1.499-5.212-3.09-6.764-4.728C.89 29.03 0 27.068 0 25.054c0-2.015.89-3.975 2.646-5.828 1.552-1.638 3.828-3.228 6.763-4.727 5.595-2.856 13.559-5.41 23.67-7.594C43.12 4.738 54.801 3.037 67.801 1.85 81.24.622 95.516 0 110.23 0c14.713 0 28.988.622 42.429 1.85 13 1.187 24.682 2.888 34.721 5.055 10.112 2.183 18.076 4.738 23.67 7.594 2.936 1.499 5.212 3.089 6.764 4.727 1.756 1.853 2.646 3.813 2.646 5.828 0 2.014-.89 3.975-2.646 5.827-1.552 1.639-3.828 3.23-6.763 4.728-5.595 2.856-13.559 5.41-23.67 7.594-10.04 2.168-21.722 3.869-34.722 5.056-13.44 1.227-27.716 1.85-42.43 1.85Z" fill="#fff"></path></g><path d="M18.09 31.163c-.141 0-.252-.07-.252-.193v-2.692c0-.354.094-.494.284-.494h3.521v-6.691h-3.38c-.314 0-.393-.088-.393-.265v-2.46c0-.354.126-.478.284-.478h21.877c2.609 0 5.642 1.381 5.642 3.327 0 1.735-2.121 2.833-3.112 3.38.629.265 3.238.656 3.238 3.187 0 2.9-3.9 3.379-4.4 3.379Zm11.521-3.273h5.3c.959 0 1.73-.676 1.73-1.224 0-.619-.927-1.044-1.6-1.044h-5.43Zm0-6.744v2.232h5.419c.456 0 1.565-.471 1.606-1.277.026-.513-.944-.956-1.589-.956ZM61.869 31.163a.333.333 0 0 1-.361-.336v-2.583a.241.241 0 0 1 .253-.266h2.657l-1.276-1.87h-4.874l-1.275 1.87h2.243c.173 0 .252.105.252.212v2.637c0 .213-.063.336-.22.336h-9.992c-.36 0-.628-.035-.628-.283v-2.702c0-.195.078-.3.313-.3h3.223l6.1-9.61a.651.651 0 0 1 .55-.372h7.227a.621.621 0 0 1 .581.372l6.334 9.788h2.778c.267 0 .267.319.267.584v2.238c0 .213-.157.283-.44.283Zm-2.943-7.814h3.841l-1.226-2.089a5.238 5.238 0 0 0-1.279 0ZM125.665 17.89a.843.843 0 0 1 .486.213l8.08 7.7v-4.568h-2.762c-.236 0-.362-.089-.362-.23v-2.727c0-.211.111-.389.22-.389h9.831c.283 0 .345.265.345.443v2.584c0 .229-.156.318-.359.318h-2.653v9.451c0 .3-.078.477-.285.477h-9.679a.575.575 0 0 1-.392-.123l-8.849-8.442v5.221h2.934c.189 0 .393.089.393.265v2.695c0 .265-.126.388-.314.388h-10.072c-.157 0-.234-.123-.234-.354v-2.675c0-.142.078-.318.393-.318h2.714v-6.584h-2.825c-.11 0-.266-.053-.266-.318v-2.762c0-.176.157-.265.392-.265ZM92.977 17.89a.845.845 0 0 1 .486.213l8.079 7.7v-4.568h-2.761c-.236 0-.362-.089-.362-.23v-2.727c0-.211.111-.389.22-.389h9.832c.283 0 .346.265.346.443v2.584c0 .229-.158.318-.361.318h-2.655v9.451c0 .3-.078.477-.282.477h-9.682a.575.575 0 0 1-.392-.123l-8.849-8.442v5.221h2.935c.188 0 .392.089.392.265v2.695c0 .265-.125.388-.313.388H79.544c-.158 0-.236-.123-.236-.354v-2.675c0-.142.079-.318.393-.318h2.715v-6.584h-2.825c-.11 0-.267-.053-.267-.318v-2.762c0-.176.158-.265.393-.265ZM171.346 17.89c.282 0 .361.124.361.389v4.652c0 .178-.048.3-.2.3h-5.758c-.112 0-.206 0-.206-.124V21.27h-9.084v2.073h5.061c.156 0 .221.036.221.177v2.343c0 .142-.19.177-.377.177h-4.905v1.831h9.211v-1.42c0-.158.046-.353.3-.353h5.752c.109 0 .174.089.174.337v4.481c0 .125-.066.248-.362.248h-26.655c-.2 0-.393.018-.393-.193v-2.793a.27.27 0 0 1 .236-.3h3.566v-6.625h-3.583c-.125 0-.219.036-.219-.177V18.05c0-.088.158-.16.393-.16ZM195.07 17.89a18.753 18.753 0 0 1 5.172.743c.976.442 2.4 1.345 2.4 2.779 0 1.327-1.6 2.318-3.145 2.99a3.874 3.874 0 0 1 2.5 2.885c.109.337.252.567.5.567a1.025 1.025 0 0 0 1.211-1.139v-.5c0-.106.061-.176.22-.176h1.854c.109 0 .172.07.172.283v1.564c0 1.893-2.467 3.273-3.615 3.273H196.1a2.926 2.926 0 0 1-2.207-1.481c-.236-.441-.581-1.822-.74-2.248a2.515 2.515 0 0 0-2.435-1.45h-3.962v1.928h3.663c.143 0 .236.016.236.1v3.05c0 .088-.093.105-.236.105h-15.2c-.08 0-.173-.07-.173-.248v-2.9c0-.088.08-.212.173-.212h3.473v-6.725h-3.489c-.143 0-.235-.036-.235-.265v-2.675c0-.124.062-.248.171-.248Zm-8.314 3.256v2.332h4.795c1.022 0 2.263-.6 2.263-1.286 0-.832-1.62-1.044-1.887-1.044Z" fill="#fff"></path></svg>
            </div>
              <span>BANNER</span>
            </div>
            <div class="aliado-card reveal">
              <div class="aliado-logo-placeholder">
            <img
                src="{{ asset('assets/img/turck.jpg') }}"
                alt="Banner Engineering"
            >
            </div>
              <span>TURCK</span>
            </div>
            <div class="aliado-card reveal">
              <div class="aliado-logo-placeholder">
            <img
                src="{{ asset('assets/img/kubler.png') }}"
                alt="kubler logo"
            >
            </div>
              <span>Kübler</span>
            </div>
            <div class="aliado-card reveal">
              <div class="aliado-logo-placeholder">
            <img
                src="{{ asset('assets/img/puls.webp') }}"
                alt="Puls logo"
            >
            </div>
              <span>PULS</span>
            </div>
            <div class="aliado-card reveal">
              <div class="aliado-logo-placeholder">
            <img
                src="{{ asset('assets/img/sprayzone.png') }}"
                alt="Omron logo"
            >
                </div>
              <span>SprayZone</span>
            </div>
            <div class="aliado-card reveal">
              <div class="aliado-logo-placeholder">
            <img
                src="{{ asset('assets/img/avtron.webp') }}"
                alt="Siemens logo"
            >
            </div>
              <span>AVTRON</span>
            </div>
          </div>
        </div>
      </section>
      <!-- Contadores section -->
      <section class="contador-section" id="resultados">
        <div class="contenedor">
          <div class="section-header reveal">
            <span class="section-label">Nuestros números</span>
            <h2>Contador de éxito</h2>
            <p>
              Más de una década de resultados medibles respaldan cada solución
              que entregamos.
            </p>
          </div>
          <div class="contador-grid">
            <div class="contador-item reveal">
              <span
                class="contador-numero"
                data-counter
                data-target="340"
                data-suffix="+"
                >0+</span
              >
              <span class="contador-label">Proyectos completados</span>
            </div>
            <div class="contador-item reveal">
              <span
                class="contador-numero"
                data-counter
                data-target="120"
                data-suffix="+"
                >0+</span
              >
              <span class="contador-label">Clientes activos</span>
            </div>
            <div class="contador-item reveal">
              <span
                class="contador-numero"
                data-counter
                data-target="99"
                data-suffix="%"
                >0%</span
              >
              <span class="contador-label">Uptime garantizado</span>
            </div>
            <div class="contador-item reveal">
              <span
                class="contador-numero"
                data-counter
                data-target="12"
                data-suffix=" años"
                >0</span
              >
              <span class="contador-label">De experiencia</span>
            </div>
          </div>
        </div>
      </section>
      <!-- Productos Destacados sec -->
      <section id="productos">
        <div class="contenedor">
          <div class="section-header reveal">
            <span class="section-label">Portafolio</span>
            <h2>Casos de éxito</h2>
            <p>
            Aplicaciones reales.
            </p>
          </div>
          <div class="productos-grid">
            <div class="producto-card reveal">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Información dispersa.</span>
                <h3>Sistema de Monitoreo de Proceso en Tiempo Real</h3>
                <p>
                Solución:<br>
                Integración PLC/HMI TURCK + Base de Datos + Dashboard Web.<br>
                Resultado:<br>
                Visibilidad inmediata de producción y reducción en tiempos de análisis.<br>
                </p>
              </div>
            </div>
            <div class="producto-card reveal">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Falta de seguimiento.</span>
                <h3>Sistema de Trazabilidad para Línea de Ensamble</h3>
                <p>
                Solución:<br>
                Captura automática de datos y generación de historial por producto.<br>
                Resultado:<br>
                Trazabilidad completa del proceso productivo.<br>
                </p>
              </div>
            </div>
            <div class="producto-card reveal">
              <div class="producto-imagen"></div>
              <div class="producto-body">
                <span class="producto-badge">Equipos aislados</span>
                <h3>Integración de Equipos para Industria 4.0</h3>
                <p>
                Solución:<br>
                Implementación IIoT y centralización de datos.<br>
                Resultado:<br>
                Monitoreo integral de la operación.<br>
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Propuestas de valor -->
      <section class="valor-section" id="valor">
        <div class="contenedor">
          <div class="section-header reveal">
            <span class="section-label">¿Por qué elegirnos?</span>
            <h2>Propuesta de valor</h2>
            <p>
            La información correcta en el momento adecuado permite tomar mejores decisiones.
            </p>
          </div>
          <div class="valor-grid">
            <div class="valor-item reveal">
              <div class="valor-icono-wrap">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  viewBox="0 0 16 16"
                >
                  <title xmlns="">search-results</title>
                  <path
                    fill="currentColor"
                    fill-rule="evenodd"
                    d="M1.75 1a.75.75 0 0 0 0 1.5h8.5a.75.75 0 0 0 0-1.5zM1 4.75A.75.75 0 0 1 1.75 4H7a.75.75 0 0 1 0 1.5H1.75A.75.75 0 0 1 1 4.75m9 7.75a2.5 2.5 0 1 0 0-5a2.5 2.5 0 0 0 0 5m0 1.5c.834 0 1.607-.255 2.248-.691l1.472 1.471a.75.75 0 1 0 1.06-1.06l-1.471-1.472A4 4 0 1 0 10 14M1.75 7a.75.75 0 0 0 0 1.5H4A.75.75 0 0 0 4 7z"
                    clip-rule="evenodd"
                  />
                </svg>
              </div>
              <div>
                <h3>Enfoque en resultados</h3>
                <p>
                  Cada proyecto arranca con métricas de éxito claramente
                  definidas. Medimos el impacto real en tu operación y ajustamos
                  la solución hasta alcanzar los objetivos acordados.
                </p>
              </div>
            </div>
            <div class="valor-item reveal">
              <div class="valor-icono-wrap">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  viewBox="0 0 24 24"
                >
                  <title xmlns="">arrow-sync-outline</title>
                  <path
                    fill="currentColor"
                    d="M21.5 12.473c0-2.495-.818-4.426-2.653-6.259a3 3 0 0 0-1.073-.682l-.946-.946L13.121.879C12.555.312 11.801 0 11 0S9.445.312 8.879.879A2.98 2.98 0 0 0 8 3q0 .417.11.809a9.5 9.5 0 0 0-2.827 1.974A9.43 9.43 0 0 0 2.5 12.5c0 2.495.818 4.426 2.653 6.259c.299.298.652.521 1.034.669l.985.986l3.707 3.707c.566.567 1.32.879 2.121.879s1.555-.312 2.121-.879c.567-.566.879-1.32.879-2.121q0-.43-.117-.834a9.5 9.5 0 0 0 2.833-1.975a9.43 9.43 0 0 0 2.784-6.718m-9.13 7.484l1.337 1.336a.999.999 0 1 1-1.414 1.414L8.586 19l3.707-3.707a.997.997 0 0 1 1.414 0a1 1 0 0 1 0 1.414l-1.247 1.247c1.351-.091 2.425-.59 3.428-1.593a5.46 5.46 0 0 0 1.611-3.888c0-1.422-.401-2.351-1.48-3.429a1 1 0 1 1 1.415-1.416c1.448 1.447 2.066 2.896 2.066 4.844c0 2.004-.78 3.887-2.197 5.303c-1.39 1.39-3.01 2.1-4.933 2.182m-.766-14.939l-1.311-1.311a.999.999 0 1 1 1.414-1.414L15.414 6l-3.707 3.707a.997.997 0 0 1-1.414 0a1 1 0 0 1 0-1.414l1.275-1.275c-1.365.086-2.448.584-3.456 1.593A5.46 5.46 0 0 0 6.5 12.5c0 1.422.401 2.351 1.48 3.429a1 1 0 1 1-1.415 1.416C5.118 15.897 4.5 14.448 4.5 12.5c0-2.004.78-3.887 2.197-5.303c1.382-1.383 2.993-2.093 4.907-2.179M8.688 15.222C7.8 14.335 7.5 13.648 7.5 12.5c0-1.202.468-2.332 1.318-3.181l.187-.179c.033.481.236.93.581 1.274c.378.378.88.586 1.414.586s1.036-.208 1.414-.586l2.339-2.339a1.99 1.99 0 0 0 .56 1.675c.888.887 1.188 1.574 1.188 2.722a4.47 4.47 0 0 1-1.318 3.181l-.188.181a2 2 0 0 0-.579-1.248C14.036 14.208 13.534 14 13 14s-1.036.208-1.414.586l-2.342 2.342a2 2 0 0 0-.556-1.706"
                  />
                </svg>
              </div>
              <div>
                <h3>Acompañamiento continuo</h3>
                <p>
                  No desaparecemos al entregar el proyecto. Nuestro equipo de
                  Customer Success te acompaña durante toda la vida útil de la
                  solución, con revisiones periódicas y mejoras proactivas.
                </p>
              </div>
            </div>
            <div class="valor-item reveal">
              <div class="valor-icono-wrap">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  viewBox="0 0 24 24"
                >
                  <title xmlns="">flash-line</title>
                  <g fill="none" fill-rule="evenodd">
                    <path
                      d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"
                    />
                    <path
                      fill="currentColor"
                      d="M13.232 1.36c.632-.758 1.863-.24 1.763.742L14.289 9H20a1 1 0 0 1 .768 1.64l-10 12c-.632.758-1.863.24-1.763-.742L9.711 15H4a1 1 0 0 1-.768-1.64zM6.135 13h5.348a.4.4 0 0 1 .398.44l-.553 5.405L17.865 11h-5.348a.4.4 0 0 1-.398-.44l.553-5.404z"
                    />
                  </g>
                </svg>
              </div>
              <div>
                <h3>Implementación ágil</h3>
                <p>
                  Metodologías ágiles con sprints de dos semanas que nos
                  permiten entregar valor de forma incremental. Tus equipos ven
                  resultados en semanas, no en meses.
                </p>
              </div>
            </div>
            <div class="valor-item reveal">
              <div class="valor-icono-wrap">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  viewBox="0 0 24 24"
                >
                  <title xmlns="">lock-outline</title>
                  <path
                    fill="currentColor"
                    d="M6 22q-.825 0-1.412-.587T4 20V10q0-.825.588-1.412T6 8h1V6q0-2.075 1.463-3.537T12 1t3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.587 1.413T18 22zm0-2h12V10H6zm7.413-3.588Q14 15.826 14 15t-.587-1.412T12 13t-1.412.588T10 15t.588 1.413T12 17t1.413-.587M9 8h6V6q0-1.25-.875-2.125T12 3t-2.125.875T9 6zM6 20V10z"
                  />
                </svg>
              </div>
              <div>
                <h3>Seguridad garantizada</h3>
                <p>
                  Todas nuestras soluciones son diseñadas con un enfoque de
                  seguridad desde el primer día. Cumplimos con estándares
                  internacionales y normativas locales vigentes.
                </p>
              </div>
            </div>
            <div class="valor-item reveal">
              <div class="valor-icono-wrap">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  viewBox="0 0 24 24"
                >
                  <title xmlns="">puzzle-outline</title>
                  <path
                    fill="currentColor"
                    d="M22 13.5c0 1.76-1.3 3.22-3 3.46V20a2 2 0 0 1-2 2h-3.8v-.3a2.7 2.7 0 0 0-2.7-2.7c-1.5 0-2.7 1.21-2.7 2.7v.3H4a2 2 0 0 1-2-2v-3.8h.3C3.79 16.2 5 15 5 13.5s-1.21-2.7-2.7-2.7H2V7a2 2 0 0 1 2-2h3.04c.24-1.7 1.7-3 3.46-3s3.22 1.3 3.46 3H17a2 2 0 0 1 2 2v3.04c1.7.24 3 1.7 3 3.46M17 15h1.5a1.5 1.5 0 0 0 1.5-1.5a1.5 1.5 0 0 0-1.5-1.5H17V7h-5V5.5A1.5 1.5 0 0 0 10.5 4A1.5 1.5 0 0 0 9 5.5V7H4v2.12c1.76.68 3 2.38 3 4.38s-1.25 3.7-3 4.38V20h2.12a4.7 4.7 0 0 1 4.38-3c2 0 3.7 1.25 4.38 3H17z"
                  />
                </svg>
              </div>
              <div>
                <h3>Soluciones a la medida</h3>
                <p>
                  No creemos en el modelo "talla única". Escuchamos tus
                  necesidades específicas y construimos o configuramos cada
                  solución para encajar perfectamente en tu contexto.
                </p>
              </div>
            </div>
            <div class="valor-item reveal">
              <div class="valor-icono-wrap">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  viewBox="0 0 24 24"
                >
                  <title xmlns="">light-bulb</title>
                  <path
                    fill="none"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 22h4M5 9a7 7 0 0 1 14 0a6.97 6.97 0 0 1-3 5.734l-.542 2.566a2 2 0 0 1-1.977 1.7h-2.962a2 2 0 0 1-1.977-1.7L8 14.745A6.99 6.99 0 0 1 5 9m3 6h8"
                  />
                </svg>
              </div>
              <div>
                <h3>Innovación constante</h3>
                <p>
                  Estamos en permanente capacitación con las últimas
                  tecnologías. Tú te beneficias de ese conocimiento actualizado
                  sin necesidad de invertir en formación interna.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- clientes prin sec -->
      <section id="clientes">
        <div class="contenedor">
          <div class="section-header reveal">
            <span class="section-label">Lo que dicen de nosotros</span>
            <h2>Clientes principales</h2>
            <p>
              Empresas que confían en SMTEK para impulsar su operación
              tecnológica día a día.
            </p>
          </div>
          <div class="clientes-grid">
            <div class="cliente-card reveal">
              <p class="quote">
                "La integración de sistemas que SMTEK realizó en nuestra planta
                redujo tiempos de reporte en un 60 %. El equipo fue profesional,
                puntual y siempre disponible para resolver dudas. Sin duda
                volveremos a trabajar con ellos."
              </p>
              <div class="cliente-info">
                <div class="cliente-avatar">MR</div>
                <div>
                  <span class="nombre">Manuel Rodríguez</span>
                  <span class="empresa"
                    >Director de Operaciones — Manufactura Noreste</span
                  >
                </div>
              </div>
            </div>
            <div class="cliente-card reveal">
              <p class="quote">
                "Desde que implementamos las soluciones cloud de SMTEK, nuestra
                disponibilidad pasó de 95 % a 99.8 %. El retorno de inversión
                fue visible en menos de seis meses. Totalmente recomendados."
              </p>
              <div class="cliente-info">
                <div class="cliente-avatar">LP</div>
                <div>
                  <span class="nombre">Laura Pérez</span>
                  <span class="empresa">CTO — Distribuidora LogiPlus</span>
                </div>
              </div>
            </div>
            <div class="cliente-card reveal">
              <p class="quote">
                "El proyecto de ciberseguridad superó nuestras expectativas.
                Detectaron vulnerabilidades críticas que otros proveedores
                habían pasado por alto. SMTEK es nuestro aliado de confianza
                para todo lo relacionado con TI."
              </p>
              <div class="cliente-info">
                <div class="cliente-avatar">CG</div>
                <div>
                  <span class="nombre">Carlos Gutiérrez</span>
                  <span class="empresa"
                    >Gerente de TI — Finanzas Regionales</span
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- seccion somos -->
      <section id="quienes-somos">
        <div class="contenedor">
          <div class="section-header reveal">
            <span class="section-label">Acerca de nosotros</span>
            <h2>¿Quiénes somos?</h2>
            <p>
            Somos el socio tecnológico que impulsa la evolución digital de la industria.
            </p>
          </div>
          <div class="quienes-grid">
            <div class="quienes-texto reveal">
                <p>
                    Más que integradores, somos tus socios tecnológicos para la transformación digital industrial.
                </p>
                <p>
                    En SMTEK ayudamos a las empresas manufactureras a conectar sus procesos, máquinas y sistemas para convertir datos en información útil para la operación.
                </p>
                <p>
                Nuestro enfoque combina ingeniería industrial, automatización, tecnologías de Industria 4.0 y experiencia en integración de sistemas para desarrollar soluciones que generan resultados medibles.
              </p>
            </div>
            <div class="quienes-stats">
              <div class="stat-card reveal">
                <span
                  class="numero"
                  data-counter
                  data-target="10"
                  data-suffix="+"
                  >0+</span
                >
                <span class="etiqueta">Años de experiencia</span>
              </div>
              <div class="stat-card reveal">
                <span
                  class="numero"
                  data-counter
                  data-target="500"
                  data-suffix="+"
                  >0+</span
                >
                <span class="etiqueta">Proyectos implementados</span>
              </div>
              <div class="stat-card reveal">
                <span
                  class="numero"
                  data-counter
                  data-target="98"
                  data-suffix="%"
                  >0%</span
                >
                <span class="etiqueta">Clientes industriales</span>
              </div>
              <div class="stat-card reveal">
                <span
                  class="numero"
                  data-counter
                  data-target="1"
                  data-suffix="M+"
                  >0+</span
                >
                <span class="etiqueta">Equipos integrados</span>
              </div>
            </div>
        <div class="video-wrap reveal">
            <iframe
              src="https://www.youtube.com/embed/7U_zJbwyYbQ"
              title="SMTEK Smart Technologies"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              referrerpolicy="strict-origin-when-cross-origin"
              allowfullscreen
              loading="lazy"
            ></iframe>
          </div>
        </div>
      </section>
      <!-- Misión y Visión -->
      <section id="mision-vision">
        <div class="contenedor">
          <div class="section-header reveal">
            <span class="section-label">Nuestra brújula</span>
            <h2>Misión y Visión</h2>
          </div>
          <div class="mision-vision-grid">
            <div class="mv-card reveal">
              <h3>Misión</h3>
              <p>
                Proveer soluciones tecnológicas de automatización y control a la medida de las necesidades de nuestros clientes, asegurando productos de alta calidad competitivos a nivel nacional e internacional. contribuyendo a la innovación tecnológica constante, al desarrollo y eficiencia de la sociedad a través de la capacitación continua de nuestro personal.
              </p>
            </div>
            <div class="mv-card reveal">
              <h3>Visión</h3>
              <p>
            Convertirnos en una empresa líder en la integración de productos y servicios automatizados de procesos industriales, brindando soluciones personalizadas que cumplan y satisfagan los estándares de calidad y confiabilidad de nuestros clientes, destacando nos a nivel nacional por nuestro desarrollo e innovación en el sector.
              </p>
            </div>
          </div>

          <!-- Política de calidad: ancho completo debajo de Misión/Visión -->
          <div class="mv-card mv-card-full reveal">
            <h3>Política de Calidad</h3>
            <p>
              SMTEK es una empresa que ofrece soluciones con tecnologías inteligentes a través de la comercialización y distribución de componentes industriales de marcas líderes en el mercado de la automatización, control, neumática y procesos; la fabricación de maquinados de precisión bajo especificaciones técnicas de nuestros clientes; y la implementación de proyectos de diseño, integración y puesta en marcha de sistemas de automatización, control e ingeniería personalizados.
            </p>
            <p style="margin-top: 1.4rem;">
              SMTEK se compromete a satisfacer las necesidades del cliente brindando productos y servicios que cumplan los estándares de calidad bajo la formación constante a nuestros colaboradores en metodologías de mejora continua de procesos, estipulado en el sistema de gestión de la calidad.
            </p>
            <p style="margin-top: 1.4rem;">
              SMTEK se distingue en el mercado por minimizar tiempos de entrega y maximizar la eficiencia operativa de sus procesos para la satisfacción de sus clientes, además de mantenerse a la vanguardia en tecnología industrial.
            </p>
          </div>
        </div>
      </section>
      <!-- Contacto Redes o Mapa? no se, revisar-->
    <section id="contacto" class="contacto-section">
  <div class="contenedor">
    <div class="section-header reveal">
      <span class="section-label">Hablemos</span>
      <h2>Encuéntranos</h2>
      <p>
    Agenda una reunión con nuestros especialistas y descubre cómo podemos ayudarte a mejorar la productividad, trazabilidad y eficiencia de tus procesos.
      </p>
    </div>
    <div class="contacto-grid">
      <!-- Info de contacto con pestañas por sucursal -->
      <div class="contacto-info reveal">
        <h3>Nuestras sucursales</h3>
        <!-- Pestañas -->
        <div class="sucursal-tabs" role="tablist" aria-label="Sucursales SMTEK">
          <button
            type="button"
            class="sucursal-tab activo"
            role="tab"
            aria-selected="true"
            data-sucursal="qro"
          >
            Querétaro
          </button>
          <button
            type="button"
            class="sucursal-tab"
            role="tab"
            aria-selected="false"
            data-sucursal="silao"
          >
            Silao
          </button>
          <button
            type="button"
            class="sucursal-tab"
            role="tab"
            aria-selected="false"
            data-sucursal="toluca"
          >
            Toluca
          </button>
        </div>
        <!-- Panel: Querétaro -->
        <div class="sucursal-panel activo" data-panel="qro" role="tabpanel">
          <div class="contacto-item">
            <div class="contacto-icono">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <title xmlns="">pin</title>
                <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                  <path d="M16.272 10.272a4 4 0 1 1-8 0a4 4 0 0 1 8 0m-2 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0" />
                  <path d="M5.794 16.518a9 9 0 1 1 12.724-.312l-6.206 6.518zm11.276-1.691l-4.827 5.07l-5.07-4.827a7 7 0 1 1 9.897-.243" />
                </g>
              </svg>
            </div>
            <div>
              <span class="label">Dirección</span>
              <span class="valor">
                Condominio Industrial EUROPARK II, Carretera Estatal 431 km 1.9, Carretera Estatal 431, 76246, Qro.
             </span>
            </div>
          </div>
          <div class="contacto-item">
            <div class="contacto-icono">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <title xmlns="">phone</title>
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2" />
              </svg>
            </div>
            <div>
              <span class="label">Teléfono</span>
              <span class="valor">(442) 730-2331</span>
            </div>
          </div>
          <div class="contacto-item">
            <div class="contacto-icono">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <title xmlns="">mail-outline</title>
                <path fill="currentColor" d="M4 20q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.587 1.413T20 20zm8-7L4 8v10h16V8zm0-2l8-5H4zM4 8V6v12z" />
              </svg>
            </div>
            <div>
              <span class="label">Correo electrónico</span>
              <span class="valor">info@smtek.com.mx</span>
            </div>
          </div>
          <div class="contacto-item">
            <div class="contacto-icono">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <title xmlns="">clock-outline</title>
                <path fill="currentColor" d="M12 20a8 8 0 0 0 8-8a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8m0-18a10 10 0 0 1 10 10a10 10 0 0 1-10 10C6.47 22 2 17.5 2 12A10 10 0 0 1 12 2m.5 5v5.25l4.5 2.67l-.75 1.23L11 13V7z" />
              </svg>
            </div>
            <div>
              <span class="label">Horario de atención</span>
              <span class="valor">Lunes a Viernes, 9:00 — 18:00 hrs</span>
            </div>
          </div>
        </div>
        <!-- Panel: Silao -->
        <div class="sucursal-panel" data-panel="silao" role="tabpanel" hidden>
          <div class="contacto-item">
            <div class="contacto-icono">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <title xmlns="">pin</title>
                <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                  <path d="M16.272 10.272a4 4 0 1 1-8 0a4 4 0 0 1 8 0m-2 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0" />
                  <path d="M5.794 16.518a9 9 0 1 1 12.724-.312l-6.206 6.518zm11.276-1.691l-4.827 5.07l-5.07-4.827a7 7 0 1 1 9.897-.243" />
                </g>
              </svg>
            </div>
            <div>
              <span class="label">Dirección</span>
              <span class="valor">
            El Dorado 7, 36122 Silao de la Victoria, Gto.
              </span>
            </div>
          </div>
          <div class="contacto-item">
            <div class="contacto-icono">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <title xmlns="">phone</title>
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2" />
              </svg>
            </div>
            <div>
              <span class="label">Teléfono</span>
              <span class="valor">(472) 117-0302</span>
            </div>
          </div>
          <div class="contacto-item">
            <div class="contacto-icono">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <title xmlns="">mail-outline</title>
                <path fill="currentColor" d="M4 20q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.587 1.413T20 20zm8-7L4 8v10h16V8zm0-2l8-5H4zM4 8V6v12z" />
              </svg>
            </div>
            <div>
              <span class="label">Correo electrónico</span>
              <span class="valor">info@smtek.com.mx</span>
            </div>
          </div>
          <div class="contacto-item">
            <div class="contacto-icono">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <title xmlns="">clock-outline</title>
                <path fill="currentColor" d="M12 20a8 8 0 0 0 8-8a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8m0-18a10 10 0 0 1 10 10a10 10 0 0 1-10 10C6.47 22 2 17.5 2 12A10 10 0 0 1 12 2m.5 5v5.25l4.5 2.67l-.75 1.23L11 13V7z" />
              </svg>
            </div>
            <div>
              <span class="label">Horario de atención</span>
              <span class="valor">Lunes a Viernes, 9:00 — 18:00 hrs</span>
            </div>
          </div>
        </div>
        <!-- Panel: Toluca -->
        <div class="sucursal-panel" data-panel="toluca" role="tabpanel" hidden>
          <div class="contacto-item">
            <div class="contacto-icono">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <title xmlns="">pin</title>
                <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                  <path d="M16.272 10.272a4 4 0 1 1-8 0a4 4 0 0 1 8 0m-2 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0" />
                  <path d="M5.794 16.518a9 9 0 1 1 12.724-.312l-6.206 6.518zm11.276-1.691l-4.827 5.07l-5.07-4.827a7 7 0 1 1 9.897-.243" />
                </g>
              </svg>
            </div>
            <div>
              <span class="label">Dirección</span>
              <span class="valor">
                Ruta de la Independencia 322, Rancho de la Independencia, 50200 Crespa Floresta, Méx.
              </span>
            </div>
          </div>
          <div class="contacto-item">
            <div class="contacto-icono">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <title xmlns="">phone</title>
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2" />
              </svg>
            </div>
            <div>
              <span class="label">Teléfono</span>
              <span class="valor">(472) 117-0302</span>
            </div>
          </div>
          <div class="contacto-item">
            <div class="contacto-icono">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <title xmlns="">mail-outline</title>
                <path fill="currentColor" d="M4 20q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.587 1.413T20 20zm8-7L4 8v10h16V8zm0-2l8-5H4zM4 8V6v12z" />
              </svg>
            </div>
            <div>
              <span class="label">Correo electrónico</span>
              <span class="valor">info@smtek.com.mx</span>
            </div>
          </div>
          <div class="contacto-item">
            <div class="contacto-icono">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <title xmlns="">clock-outline</title>
                <path fill="currentColor" d="M12 20a8 8 0 0 0 8-8a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8m0-18a10 10 0 0 1 10 10a10 10 0 0 1-10 10C6.47 22 2 17.5 2 12A10 10 0 0 1 12 2m.5 5v5.25l4.5 2.67l-.75 1.23L11 13V7z" />
              </svg>
            </div>
            <div>
              <span class="label">Horario de atención</span>
              <span class="valor">Lunes a Viernes, 9:00 — 18:00 hrs</span>
            </div>
          </div>
        </div>
        <!-- Redes sociales: compartidas para las 3 sucursales -->
        <div class="redes-sociales">
          <a href="#" class="red-social" aria-label="LinkedIn">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
              <title xmlns="">linkedin</title>
              <path fill="currentColor" d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93zM6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37z" />
            </svg>
          </a>
          <a href="#" class="red-social" aria-label="Twitter / X">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
              <title xmlns="">x-solid</title>
              <path fill="currentColor" d="M13.795 10.533L20.68 2h-3.073l-5.255 6.517L7.69 2H1l7.806 10.91L1.47 22h3.074l5.705-7.07L15.31 22H22zm-2.38 2.95L9.97 11.464L4.36 3.627h2.31l4.528 6.317l1.443 2.02l6.018 8.409h-2.31z" />
            </svg>
          </a>
          <a href="#" class="red-social" aria-label="Facebook">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
              <title xmlns="">outline-facebook</title>
              <path fill="currentColor" d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95" />
            </svg>
          </a>
          <a href="#" class="red-social" aria-label="Instagram">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
              <title xmlns="">instagram</title>
              <path fill="currentColor" d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3" />
            </svg>
          </a>
        </div>
      </div>
<!-- Mapa por sucursal -->
<div class="reveal">
  <div class="mapa-wrap">
    <div class="mapa-panel activo" data-mapa="qro">
      <!-- TODO: reemplazar src con el embed real de Google Maps para Querétaro -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14942.9232549984!2d-100.267967!3d20.558192!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d343755c367801%3A0x6e8716af7395ffc!2sEuropark%20II!5e0!3m2!1ses-419!2smx!4v1786517957855!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
    </div>
    <div class="mapa-panel" data-mapa="silao" hidden>
      <!-- TODO: reemplazar src con el embed real de Google Maps para Silao -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3725.9950482749778!2d-101.437034!3d20.952714!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842b9b86deb92ff9%3A0x1a81454ad82e1250!2sEl%20Dorado%207%2C%2036122%20Silao%20de%20la%20Victoria%2C%20Gto.!5e0!3m2!1ses-419!2smx!4v1786518030255!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
    </div>
    <div class="mapa-panel" data-mapa="toluca" hidden>
      <!-- TODO: reemplazar src con el embed real de Google Maps para Toluca -->
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15061.03851806467!2d-99.595417!3d19.314537!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cd8a78adecc251%3A0x2867a79c44f364f9!2sCondominio%20Anzures!5e0!3m2!1ses-419!2smx!4v1786518135670!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
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
    <!-- Script -->
    <script src="assets/js/script.js"></script>
    <script>
    // ── Tabs de sucursales: contacto + mapa sincronizados ──
document.addEventListener('DOMContentLoaded', function () {
  const tabs = document.querySelectorAll('.sucursal-tab');
  const contactoPanels = document.querySelectorAll('.sucursal-panel');
  const mapaPanels = document.querySelectorAll('.mapa-panel');
  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      const target = tab.getAttribute('data-sucursal');
      tabs.forEach(function (t) {
        t.classList.remove('activo');
        t.setAttribute('aria-selected', 'false');
      });
      tab.classList.add('activo');
      tab.setAttribute('aria-selected', 'true');
      contactoPanels.forEach(function (panel) {
        const match = panel.getAttribute('data-panel') === target;
        panel.hidden = !match;
        panel.classList.toggle('activo', match);
      });
      mapaPanels.forEach(function (panel) {
        const match = panel.getAttribute('data-mapa') === target;
        panel.hidden = !match;
        panel.classList.toggle('activo', match);
      });
    });
  });
});
    </script>
  </body>
</html>
