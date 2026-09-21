<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aviso de Privacidad | SMTEK Smart Technologies</title>

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

    <style>
      .reveal {
        opacity: 0;
        transform: translateY(2.4rem);
        transition: opacity 0.55s ease, transform 0.55s ease;
      }
      .reveal.visible { opacity: 1; transform: none; }
      @media (prefers-reduced-motion: reduce) { .reveal { opacity: 1; transform: none; } }

      /* ══════════════════════════════════════════════
         AVISO DE PRIVACIDAD — índice tipo acordeón
      ══════════════════════════════════════════════ */
      .privacidad-intro {
        max-width: 80rem;
        margin: 0 auto 3rem;
        text-align: center;
      }
      .privacidad-fecha {
        font-size: 1.3rem;
        color: var(--text-muted, #7a8390);
        margin-top: 0.6rem;
      }

      .privacidad-index {
        max-width: 90rem;
        margin: 0 auto;
        background-color: var(--bg-section, #fff);
        border: 1px solid var(--border-color, #d8e2e8);
        border-radius: 1.2rem;
        overflow: hidden;
      }

      .privacidad-item { border-bottom: 1px solid var(--border-color, #d8e2e8); }
      .privacidad-item:last-child { border-bottom: none; }

      .privacidad-item-btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.6rem;
        padding: 1.8rem 2.4rem;
        background: none;
        border: none;
        cursor: pointer;
        font-family: "Inter", sans-serif;
        text-align: left;
        transition: background-color 0.2s ease;
      }
      .privacidad-item-btn:hover { background-color: var(--bg-body, #f5f5f5); }

      /* 👇 FIX del bug de dark mode: --AzulClaro es un color de marca fijo
         que NO cambia entre modos, así que al usarlo como fondo del ítem
         abierto, el texto (que sí cambia a claro en dark mode via
         --text-heading) se vuelve invisible sobre ese fondo claro fijo.
         Se agrega un override específico para dark mode con un tono
         oscuro con tinte azul, consistente con el resto del sitio. */
      .privacidad-item.abierto .privacidad-item-btn {
        background-color: var(--AzulClaro, #e8f4f8);
      }
      body.dark-mode .privacidad-item.abierto .privacidad-item-btn {
        background-color: rgba(33, 150, 186, 0.18);
      }

      .privacidad-item-titulo {
        display: flex;
        align-items: center;
        gap: 1.4rem;
      }

      .privacidad-item-num {
        flex-shrink: 0;
        width: 3.4rem;
        height: 3.4rem;
        border-radius: 50%;
        background-color: var(--AzulSmtek, #2196ba);
        color: #fff;
        font-size: 1.4rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .privacidad-item-nombre {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-heading, #1a2a38);
      }

      .privacidad-item-btn .chevron {
        flex-shrink: 0;
        font-size: 1.4rem;
        color: var(--AzulSmtek, #2196ba);
        transition: transform 0.25s ease;
      }
      .privacidad-item.abierto .privacidad-item-btn .chevron { transform: rotate(90deg); }

      .privacidad-item-body {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease;
      }
      .privacidad-item.abierto .privacidad-item-body { max-height: 200rem; }

      .privacidad-item-content {
        padding: 0 2.4rem 2.4rem 8rem;
        font-size: 1.42rem;
        color: var(--text-primary, #4e5358);
        line-height: 1.7;
      }
      .privacidad-item-content p { margin: 0 0 1.2rem; }
      .privacidad-item-content p:last-child { margin-bottom: 0; }

      .privacidad-item-content ul {
        margin: 0 0 1.2rem;
        padding-left: 2rem;
      }
      .privacidad-item-content li { margin-bottom: 0.6rem; }

      .privacidad-item-content strong { color: var(--text-heading, #1a2a38); }

      .privacidad-item-content a {
        color: var(--AzulSmtek, #2196ba);
        font-weight: 600;
        text-decoration: none;
      }
      .privacidad-item-content a:hover { text-decoration: underline; }

      /* ── Tabla de contacto (sección 14) ── */
      .privacidad-tabla-contacto {
        width: 100%;
        border-collapse: collapse;
        margin-top: 0.4rem;
      }
      .privacidad-tabla-contacto td {
        padding: 0.9rem 0;
        border-bottom: 1px solid var(--border-color, #d8e2e8);
        font-size: 1.4rem;
        vertical-align: top;
      }
      .privacidad-tabla-contacto tr:last-child td { border-bottom: none; }
      .privacidad-tabla-contacto td:first-child {
        font-weight: 700;
        color: var(--text-heading, #1a2a38);
        width: 40%;
        padding-right: 1.6rem;
      }

      @media (max-width: 640px) {
        .privacidad-item-content { padding-left: 2.4rem; }
        .privacidad-item-btn { padding: 1.5rem 1.8rem; }
        .privacidad-item-nombre { font-size: 1.35rem; }
        .privacidad-tabla-contacto td:first-child { width: 50%; }
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
                <a href="{{ route('register') }}" class="cta-nav">Registrarse</a>
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

    <main>
      <section id="aviso-privacidad" style="padding-top: 5rem;">
        <div class="contenedor">
          <div class="section-header reveal">
            <span class="section-label">Legal</span>
            <h2>Aviso de Privacidad</h2>
          </div>

          <div class="privacidad-intro reveal">
            <p>
              <strong>PROVEEDORA DE TECNOLOGÍAS INTELIGENTES DEL BAJÍO, S.A. DE C.V.</strong>,
              sociedad mercantil constituida conforme a las leyes mexicanas
              (en lo sucesivo, "SMTEK" o "la Empresa"), con domicilio en
              Condominio Industrial EUROPARK II, Carretera Estatal 431 km
              1.9, C.P. 76246, Santiago de Querétaro, Querétaro, México, es
              responsable del tratamiento de los datos personales que
              recabe de sus clientes, prospectos, proveedores, visitantes,
              candidatos, personal y demás titulares, conforme a la Ley
              Federal de Protección de Datos Personales en Posesión de los
              Particulares, su Reglamento y demás disposiciones aplicables.
            </p>
            <p>
              El presente aviso tiene por objeto informar, de manera clara
              y formal, la forma en que SMTEK obtiene, usa, almacena,
              protege y, en su caso, transfiere datos personales, así como
              los medios que tienen las personas titulares para ejercer
              sus derechos de acceso, rectificación, cancelación y
              oposición ("derechos ARCO"), revocar su consentimiento y
              limitar el uso o divulgación de su información.
            </p>
            <p class="privacidad-fecha">
              Última actualización: <!-- TODO: fecha de publicación --> 13 de agosto de 2026
            </p>
          </div>

          <div class="privacidad-index reveal" id="privacidadIndex">

            <div class="privacidad-item abierto" data-item="1">
              <button type="button" class="privacidad-item-btn">
                <span class="privacidad-item-titulo">
                  <span class="privacidad-item-num">1</span>
                  <span class="privacidad-item-nombre">Datos personales que podrán recabarse</span>
                </span>
                <span class="chevron">›</span>
              </button>
              <div class="privacidad-item-body">
                <div class="privacidad-item-content">
                  <p>
                    SMTEK podrá recabar, según la naturaleza de la relación
                    jurídica o comercial, datos de identificación, contacto,
                    laborales, patrimoniales o financieros, así como
                    información relacionada con navegación en su sitio web
                    y uso de formularios electrónicos.
                  </p>
                  <p>
                    De manera enunciativa mas no limitativa, podrán
                    recabarse los siguientes datos: nombre, domicilio,
                    teléfono, correo electrónico, empresa de procedencia,
                    puesto, firma, Registro Federal de Contribuyentes,
                    datos de facturación, datos bancarios para pagos o
                    devoluciones, historial de relación comercial,
                    información laboral y documentos soporte necesarios
                    para contratación, compra, prestación de servicios o
                    cumplimiento regulatorio.
                  </p>
                  <p>
                    Cuando el tratamiento involucre datos personales
                    sensibles, SMTEK lo informará expresamente y recabará,
                    en su caso, el consentimiento expreso correspondiente,
                    salvo las excepciones previstas por la legislación
                    aplicable.
                  </p>
                </div>
              </div>
            </div>

            <div class="privacidad-item" data-item="2">
              <button type="button" class="privacidad-item-btn">
                <span class="privacidad-item-titulo">
                  <span class="privacidad-item-num">2</span>
                  <span class="privacidad-item-nombre">Formas de obtención de los datos personales</span>
                </span>
                <span class="chevron">›</span>
              </button>
              <div class="privacidad-item-body">
                <div class="privacidad-item-content">
                  <p>
                    Los datos personales podrán obtenerse directamente de la
                    persona titular, por conducto de su representante, o a
                    través de terceros autorizados, mediante formularios
                    del sitio web, correo electrónico, llamadas
                    telefónicas, mensajería, cotizaciones, propuestas,
                    contratos, órdenes de compra, plataformas tecnológicas,
                    visitas presenciales, registros de acceso y cualquier
                    otro medio permitido por la ley.
                  </p>
                  <p>
                    Tratándose del sitio web, SMTEK podrá recabar
                    información técnica y de navegación a través de
                    cookies, web beacons u otras tecnologías análogas,
                    conforme a lo previsto en el apartado correspondiente
                    del presente aviso.
                  </p>
                </div>
              </div>
            </div>

            <div class="privacidad-item" data-item="3">
              <button type="button" class="privacidad-item-btn">
                <span class="privacidad-item-titulo">
                  <span class="privacidad-item-num">3</span>
                  <span class="privacidad-item-nombre">Finalidades primarias del tratamiento</span>
                </span>
                <span class="chevron">›</span>
              </button>
              <div class="privacidad-item-body">
                <div class="privacidad-item-content">
                  <p>
                    Los datos personales serán tratados para fines
                    directamente vinculados con la operación y objeto
                    social de SMTEK, incluyendo la atención de solicitudes
                    de información, integración de expedientes, elaboración
                    de propuestas, administración de relaciones
                    contractuales, alta de clientes y proveedores,
                    validación documental, facturación, cobranza, pagos,
                    soporte técnico, atención postventa, cumplimiento de
                    obligaciones legales, atención de auditorías y gestión
                    administrativa, financiera y comercial.
                  </p>
                  <p>
                    Asimismo, los datos podrán utilizarse para procesos de
                    reclutamiento, selección, contratación, administración
                    laboral, control de acceso, seguridad de instalaciones,
                    cumplimiento de requisitos de clientes, seguridad
                    industrial y asignación de personal a proyectos o
                    servicios, cuando ello resulte aplicable.
                  </p>
                </div>
              </div>
            </div>

            <div class="privacidad-item" data-item="4">
              <button type="button" class="privacidad-item-btn">
                <span class="privacidad-item-titulo">
                  <span class="privacidad-item-num">4</span>
                  <span class="privacidad-item-nombre">Finalidades secundarias</span>
                </span>
                <span class="chevron">›</span>
              </button>
              <div class="privacidad-item-body">
                <div class="privacidad-item-content">
                  <p>
                    De manera adicional, y siempre que la persona titular
                    no manifieste su negativa, SMTEK podrá tratar datos
                    personales para finalidades no necesarias para la
                    relación jurídica, tales como el envío de información
                    comercial, invitaciones a eventos, difusión de
                    contenidos técnicos, encuestas de satisfacción,
                    evaluación de la calidad de los servicios y generación
                    de estadísticas internas.
                  </p>
                  <p>
                    La negativa para el tratamiento de datos con
                    finalidades secundarias no podrá ser motivo para negar
                    productos, servicios o cualquier relación principal con
                    SMTEK.
                  </p>
                </div>
              </div>
            </div>

            <div class="privacidad-item" data-item="5">
              <button type="button" class="privacidad-item-btn">
                <span class="privacidad-item-titulo">
                  <span class="privacidad-item-num">5</span>
                  <span class="privacidad-item-nombre">Negativa respecto de finalidades secundarias</span>
                </span>
                <span class="chevron">›</span>
              </button>
              <div class="privacidad-item-body">
                <div class="privacidad-item-content">
                  <p>
                    La persona titular podrá manifestar, en cualquier
                    momento, su negativa para que sus datos personales sean
                    tratados para finalidades secundarias, enviando una
                    solicitud al correo
                    <a href="mailto:info@smtek.com.mx">info@smtek.com.mx</a>,
                    indicando su nombre completo, medio de contacto y la
                    leyenda "Negativa para finalidades secundarias".
                  </p>
                  <p>
                    SMTEK registrará dicha solicitud y dará trámite en un
                    plazo razonable conforme a sus procedimientos internos
                    y a la normatividad aplicable.
                  </p>
                </div>
              </div>
            </div>

            <div class="privacidad-item" data-item="6">
              <button type="button" class="privacidad-item-btn">
                <span class="privacidad-item-titulo">
                  <span class="privacidad-item-num">6</span>
                  <span class="privacidad-item-nombre">Transferencia de datos personales</span>
                </span>
                <span class="chevron">›</span>
              </button>
              <div class="privacidad-item-body">
                <div class="privacidad-item-content">
                  <p>
                    SMTEK podrá transferir datos personales, dentro o fuera
                    del territorio nacional, a autoridades competentes,
                    clientes, proveedores de servicios especializados,
                    sociedades controladoras, subsidiarias, afiliadas o
                    terceros con los que mantenga relaciones jurídicas,
                    exclusivamente cuando ello sea necesario para el
                    cumplimiento de obligaciones legales o contractuales,
                    la prestación de servicios, la ejecución de proyectos,
                    la administración interna o cualquiera de las
                    finalidades informadas en el presente aviso.
                  </p>
                  <p>
                    En los casos en que la legislación exija consentimiento
                    para una transferencia específica, este será recabado
                    previamente por SMTEK a través de los mecanismos
                    correspondientes.
                  </p>
                  <p>
                    En todos los supuestos, SMTEK procurará que los
                    terceros receptores asuman obligaciones de
                    confidencialidad, seguridad y tratamiento congruentes
                    con la naturaleza de los datos transferidos.
                  </p>
                </div>
              </div>
            </div>

            <div class="privacidad-item" data-item="7">
              <button type="button" class="privacidad-item-btn">
                <span class="privacidad-item-titulo">
                  <span class="privacidad-item-num">7</span>
                  <span class="privacidad-item-nombre">Medios para ejercer derechos ARCO</span>
                </span>
                <span class="chevron">›</span>
              </button>
              <div class="privacidad-item-body">
                <div class="privacidad-item-content">
                  <p>
                    La persona titular, por sí o mediante representante
                    legal debidamente acreditado, podrá ejercer sus
                    derechos de acceso, rectificación, cancelación u
                    oposición respecto de sus datos personales.
                  </p>
                  <p>
                    Para ello, deberá presentar una solicitud al correo
                    <a href="mailto:info@smtek.com.mx">info@smtek.com.mx</a>
                    o en el domicilio de SMTEK, dirigida a la Dirección
                    Administrativa, señalando:
                  </p>
                  <ul>
                    <li>Nombre completo de la persona titular</li>
                    <li>Documentos que acrediten identidad o representación</li>
                    <li>Descripción clara y precisa de los datos personales respecto de los cuales se busca ejercer algún derecho</li>
                    <li>Cualquier elemento que facilite su localización</li>
                    <li>Medio para comunicar la respuesta</li>
                  </ul>
                  <p>
                    SMTEK atenderá la solicitud dentro de los plazos
                    legales y comunicará la determinación adoptada por el
                    medio señalado por la persona solicitante.
                  </p>
                </div>
              </div>
            </div>

            <div class="privacidad-item" data-item="8">
              <button type="button" class="privacidad-item-btn">
                <span class="privacidad-item-titulo">
                  <span class="privacidad-item-num">8</span>
                  <span class="privacidad-item-nombre">Revocación del consentimiento</span>
                </span>
                <span class="chevron">›</span>
              </button>
              <div class="privacidad-item-body">
                <div class="privacidad-item-content">
                  <p>
                    La persona titular podrá revocar, en cualquier momento,
                    el consentimiento que haya otorgado para el tratamiento
                    de sus datos personales, siempre que no exista
                    impedimento legal o contractual para ello.
                  </p>
                  <p>
                    La revocación deberá solicitarse por los mismos medios
                    previstos para el ejercicio de derechos ARCO, debiendo
                    SMTEK analizar el alcance de la petición y comunicar lo
                    conducente.
                  </p>
                </div>
              </div>
            </div>

            <div class="privacidad-item" data-item="9">
              <button type="button" class="privacidad-item-btn">
                <span class="privacidad-item-titulo">
                  <span class="privacidad-item-num">9</span>
                  <span class="privacidad-item-nombre">Opciones y medios para limitar el uso o divulgación</span>
                </span>
                <span class="chevron">›</span>
              </button>
              <div class="privacidad-item-body">
                <div class="privacidad-item-content">
                  <p>
                    La persona titular podrá solicitar la limitación del
                    uso o divulgación de sus datos personales mediante
                    escrito libre o correo dirigido a
                    <a href="mailto:info@smtek.com.mx">info@smtek.com.mx</a>.
                  </p>
                  <p>
                    SMTEK podrá mantener listados internos de exclusión
                    para impedir el tratamiento de determinados datos para
                    fines secundarios, sin perjuicio del derecho de la
                    persona titular de acudir a mecanismos adicionales
                    previstos por la normativa de consumo o protección de
                    datos.
                  </p>
                </div>
              </div>
            </div>

            <div class="privacidad-item" data-item="10">
              <button type="button" class="privacidad-item-btn">
                <span class="privacidad-item-titulo">
                  <span class="privacidad-item-num">10</span>
                  <span class="privacidad-item-nombre">Uso de cookies y tecnologías similares</span>
                </span>
                <span class="chevron">›</span>
              </button>
              <div class="privacidad-item-body">
                <div class="privacidad-item-content">
                  <p>
                    El sitio web de SMTEK podrá utilizar cookies, web
                    beacons y tecnologías equivalentes que permitan recabar
                    información técnica, preferencias de navegación,
                    idioma, tipo de navegador, páginas visitadas, tiempo de
                    permanencia, dirección IP, identificadores de sesión y
                    patrones de interacción.
                  </p>
                  <p>
                    Dicha información se empleará para fines de
                    funcionamiento del sitio, seguridad, mejora de la
                    experiencia de navegación, medición de tráfico y
                    generación de métricas internas.
                  </p>
                  <p>
                    La mayoría de los navegadores permiten deshabilitar
                    estas tecnologías; sin embargo, ello podría afectar
                    ciertas funcionalidades del sitio web.
                  </p>
                  <p>
                    <!-- TODO: si usan Google Analytics, Meta Pixel u otras herramientas de terceros, especificarlo aquí -->
                  </p>
                </div>
              </div>
            </div>

            <div class="privacidad-item" data-item="11">
              <button type="button" class="privacidad-item-btn">
                <span class="privacidad-item-titulo">
                  <span class="privacidad-item-num">11</span>
                  <span class="privacidad-item-nombre">Medidas de seguridad</span>
                </span>
                <span class="chevron">›</span>
              </button>
              <div class="privacidad-item-body">
                <div class="privacidad-item-content">
                  <p>
                    SMTEK implementa medidas administrativas, técnicas y
                    físicas razonables para proteger los datos personales
                    contra daño, pérdida, alteración, destrucción o uso,
                    acceso o tratamiento no autorizado, de conformidad con
                    la naturaleza de la información y los riesgos asociados
                    a su tratamiento.
                  </p>
                  <p>
                    El acceso a los datos personales se limitará al
                    personal autorizado y a terceros que requieran
                    conocerlos para el cumplimiento de sus funciones, bajo
                    deberes de confidencialidad y control interno.
                  </p>
                </div>
              </div>
            </div>

            <div class="privacidad-item" data-item="12">
              <button type="button" class="privacidad-item-btn">
                <span class="privacidad-item-titulo">
                  <span class="privacidad-item-num">12</span>
                  <span class="privacidad-item-nombre">Conservación de la información</span>
                </span>
                <span class="chevron">›</span>
              </button>
              <div class="privacidad-item-body">
                <div class="privacidad-item-content">
                  <p>
                    Los datos personales se conservarán únicamente durante
                    el tiempo necesario para cumplir con las finalidades
                    informadas, así como para atender obligaciones
                    legales, regulatorias, contractuales, fiscales, de
                    seguridad, archivo o defensa de derechos de SMTEK.
                  </p>
                </div>
              </div>
            </div>

            <div class="privacidad-item" data-item="13">
              <button type="button" class="privacidad-item-btn">
                <span class="privacidad-item-titulo">
                  <span class="privacidad-item-num">13</span>
                  <span class="privacidad-item-nombre">Cambios al Aviso de Privacidad</span>
                </span>
                <span class="chevron">›</span>
              </button>
              <div class="privacidad-item-body">
                <div class="privacidad-item-content">
                  <p>
                    SMTEK se reserva el derecho de modificar o actualizar
                    el presente Aviso de Privacidad en cualquier momento,
                    derivado de reformas normativas, cambios en sus
                    procesos internos, nuevos requerimientos operativos o
                    modificaciones a su modelo de negocio.
                  </p>
                  <p>
                    Cualquier modificación sustancial será dada a conocer a
                    través de esta misma sección del sitio web, indicando
                    la fecha de su última actualización, o por cualquier
                    otro medio que resulte legalmente procedente.
                  </p>
                </div>
              </div>
            </div>

            <div class="privacidad-item" data-item="14">
              <button type="button" class="privacidad-item-btn">
                <span class="privacidad-item-titulo">
                  <span class="privacidad-item-num">14</span>
                  <span class="privacidad-item-nombre">Datos de contacto del responsable</span>
                </span>
                <span class="chevron">›</span>
              </button>
              <div class="privacidad-item-body">
                <div class="privacidad-item-content">
                  <p>
                    Para cualquier duda, aclaración o solicitud relacionada
                    con el tratamiento de datos personales, la persona
                    titular podrá contactar a SMTEK a través de los
                    siguientes medios:
                  </p>
                  <table class="privacidad-tabla-contacto">
                    <tr>
                      <td>Responsable</td>
                      <td>Proveedora de Tecnologías Inteligentes del Bajío, S.A. de C.V.</td>
                    </tr>
                    <tr>
                      <td>Área responsable</td>
                      <td>Dirección Administrativa</td>
                    </tr>
                    <tr>
                      <td>Correo electrónico</td>
                      <td><a href="mailto:info@smtek.com.mx">info@smtek.com.mx</a></td>
                    </tr>
                    <tr>
                      <td>Domicilio y teléfono</td>
                      <td>Condominio Industrial EUROPARK II, Carretera Estatal 431 km 1.9, C.P. 76246, Santiago de Querétaro, Qro. / (442) 730-2331</td>
                    </tr>
                  </table>
                </div>
              </div>
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
            document.getElementById('footer-logo-fallback').style.display = 'flex';
          "
        />
        <div id="footer-logo-fallback" class="footer-logo-placeholder" style="display: none">SMTEK</div>
        <p>© 2025 SMTEK Smart Technologies. Todos los derechos reservados.</p>
        <div style="display: flex; gap: 2rem">
          <a href="{{ url('/avisoprivacidad') }}">Aviso de privacidad</a>
          <a href="{{ route('tyc') }}">Términos de uso</a>
        </div>
      </div>
    </footer>

    <script src="assets/js/script.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const items = document.querySelectorAll('.privacidad-item');

        items.forEach(function (item) {
          const btn = item.querySelector('.privacidad-item-btn');

          btn.addEventListener('click', function () {
            item.classList.toggle('abierto');
          });
        });
      });
    </script>
  </body>
</html>
