<x-guest-layout>
{{--
|--------------------------------------------------------------------------
| Vista: productos/index.blade.php — Catálogo público de productos SMTEK
| Requiere: assets/css/styles.css en layouts/guest.blade.php
|--------------------------------------------------------------------------
--}}

    <style>
        /* ══════════════════════════════════════════════════════
           HERO adaptado — sin min-height forzado, deja crecer
        ══════════════════════════════════════════════════════ */
        .catalogo-page {
            min-height: calc(100vh - 11rem);
            background-image: var(--FondoHero);  /* usa la misma capa que el hero */
            position: relative;
        }

        /* ══════════════════════════════════════════════════════
           SECCIÓN CATÁLOGO
        ══════════════════════════════════════════════════════ */
        .catalogo {
            padding: 6rem 2rem;
            max-width: 130rem;
            margin-inline: auto;
        }

        /* ── Encabezado de sección ── */
        .catalogo-header {
            text-align: center;
            margin-bottom: 5rem;
        }

        .catalogo-badge {
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
            margin-bottom: 1.6rem;
        }

        .catalogo-header h1 {
            font-size: clamp(3rem, 5vw, 5rem);
            font-weight: 800;
            color: var(--text-heading);
            margin: 0 0 1.2rem;
        }

        .catalogo-header p {
            font-size: 1.7rem;
            color: var(--text-muted);
            max-width: 54rem;
            margin-inline: auto;
            line-height: 1.7;
        }

        /* ── Barra de búsqueda + filtro ── */
        .catalogo-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1.6rem;
            margin-bottom: 3.6rem;
            padding: 0 0.4rem;
        }

        .catalogo-search {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            background-color: var(--bg-section);
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-sm);
            padding: 1rem 1.6rem;
            transition: border-color var(--transition), box-shadow var(--transition);
            flex: 1;
            max-width: 40rem;
        }

        .catalogo-search:focus-within {
            border-color: var(--AzulSmtek);
            box-shadow: 0 0 0 3px rgba(33,150,186,0.15);
        }

        .catalogo-search span { font-size: 1.6rem; color: var(--text-muted); flex-shrink: 0; }

        .catalogo-search input {
            border: none;
            outline: none;
            background: none;
            font-size: 1.5rem;
            font-family: "Inter", sans-serif;
            color: var(--text-primary);
            width: 100%;
        }

        .catalogo-count {
            font-size: 1.4rem;
            color: var(--text-muted);
            font-weight: 500;
            white-space: nowrap;
        }

        .catalogo-count strong {
            color: var(--text-heading);
            font-weight: 700;
        }

        /* ══════════════════════════════════════════════════════
           GRID DE PRODUCTOS
        ══════════════════════════════════════════════════════ */
        .productos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(28rem, 1fr));
            gap: 2.8rem;
        }

        /* ── Card de producto ── */
        .producto-card {
            background-color: var(--bg-section);
            border-radius: var(--radius);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
        }

        .producto-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--AzulSmtek);
        }

        /* Imagen */
        .producto-card__img {
            width: 100%;
            aspect-ratio: 4 / 3;
            overflow: hidden;
            background-color: var(--bg-body);
            position: relative;
            flex-shrink: 0;
        }

        .producto-card__img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .producto-card:hover .producto-card__img img {
            transform: scale(1.05);
        }

        /* Badge de clasificación sobre la imagen */
        .producto-card__clasif {
            position: absolute;
            top: 1.2rem;
            left: 1.2rem;
            background-color: rgba(26,35,48,0.78);
            color: #fff;
            font-size: 1.15rem;
            font-weight: 700;
            padding: 0.35rem 1rem;
            border-radius: 2rem;
            backdrop-filter: blur(4px);
            letter-spacing: 0.04em;
        }

        /* Placeholder sin imagen */
        .producto-card__no-img {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            color: var(--text-muted);
        }

        .producto-card__no-img span:first-child { font-size: 4rem; }
        .producto-card__no-img span:last-child  { font-size: 1.3rem; }

        /* Cuerpo de la card */
        .producto-card__body {
            padding: 2.2rem;
            display: flex;
            flex-direction: column;
            flex: 1;
            gap: 0.8rem;
        }

        .producto-card__nombre {
            font-size: 1.7rem;
            font-weight: 800;
            color: var(--text-heading);
            line-height: 1.3;
            margin: 0;
        }

        .producto-card__desc {
            font-size: 1.4rem;
            color: var(--text-muted);
            line-height: 1.65;
            margin: 0;
            flex: 1;
        }

        /* Footer de la card: precio + botón */
        .producto-card__footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.2rem;
            margin-top: 1.6rem;
            flex-wrap: wrap;
        }

        .producto-card__precio {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--contrastes);
            line-height: 1;
        }

        .producto-card__precio small {
            font-size: 1.3rem;
            font-weight: 500;
            color: var(--text-muted);
            display: block;
            margin-top: 0.2rem;
        }

        /* Reutiliza .btn-primary del styles.css */
        .producto-card .btn-primary {
            font-size: 1.4rem;
            padding: 0.9rem 1.8rem;
            white-space: nowrap;
            text-decoration: none;
        }

        /* ── Estado vacío ── */
        .catalogo-empty {
            grid-column: 1 / -1;
            text-align: center;
            padding: 8rem 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.2rem;
        }

        .catalogo-empty-icon { font-size: 5rem; }
        .catalogo-empty-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-heading);
        }

        .catalogo-empty-sub {
            font-size: 1.5rem;
            color: var(--text-muted);
            max-width: 36rem;
            line-height: 1.6;
        }

        /* ── Fila "sin resultados" de búsqueda (oculta por JS) ── */
        .no-results {
            display: none;
            grid-column: 1 / -1;
            text-align: center;
            padding: 5rem 2rem;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .no-results.visible { display: flex; }

        .no-results-icon  { font-size: 4rem; }
        .no-results-title { font-size: 1.8rem; font-weight: 700; color: var(--text-heading); }
        .no-results-sub   { font-size: 1.4rem; color: var(--text-muted); }

        /* ══════════════════════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════════════════════ */
        @media (max-width: 768px) {
            .catalogo { padding: 4rem 1.6rem; }
            .catalogo-header { margin-bottom: 3.6rem; }
            .catalogo-toolbar { flex-direction: column; align-items: stretch; }
            .catalogo-search  { max-width: 100%; }
        }

        @media (max-width: 480px) {
            .productos-grid { grid-template-columns: 1fr; }
            .producto-card__footer { flex-direction: column; align-items: flex-start; }
            .producto-card .btn-primary { width: 100%; text-align: center; }
        }
    </style>

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
         ║  NAVEGACIÓN                                             ║
         ╚══════════════════════════════════════════════════════════╝ --}}
    <div class="nav-bg">
        <div class="contenedor">
            <nav id="nav-principal" class="navegacion-principal" style="flex:1">
                <a href="{{ url('/') }}">Inicio</a>
                <a href="#" class="activo">Productos</a>
                <a href="#">Servicios</a>
                <a href="#">Contacto</a>
                <a href="#" class="cta-nav">Cotizar</a>
                <a href="#" style="font-weight:bold">Trabaja con nosotros</a>
            </nav>
        </div>
    </div>

    {{-- ╔══════════════════════════════════════════════════════════╗
         ║  CATÁLOGO                                               ║
         ╚══════════════════════════════════════════════════════════╝ --}}
    <div class="catalogo-page">
        <section class="catalogo">

            {{-- Encabezado --}}
            <div class="catalogo-header">
                <div class="catalogo-badge">Catálogo industrial</div>
                <h1>Nuestros productos</h1>
                <p>Explora nuestra selección de componentes y soluciones industriales de alta precisión.</p>
            </div>

            {{-- Toolbar: búsqueda + conteo --}}
            <div class="catalogo-toolbar">
                <div class="catalogo-search">
                    <span>🔍</span>
                    <input
                        type="text"
                        id="buscarProducto"
                        placeholder="Buscar por nombre, clasificación..."
                        autocomplete="off"
                    />
                </div>
                <p class="catalogo-count">
                    <strong id="conteoVisible">{{ $productos->count() }}</strong>
                    {{ $productos->count() === 1 ? 'producto' : 'productos' }}
                </p>
            </div>

            {{-- Grid --}}
            <div class="productos-grid" id="productosGrid">

                @forelse($productos as $producto)
                    <div
                        class="producto-card"
                        data-nombre="{{ strtolower($producto->nombre) }}"
                        data-clasif="{{ strtolower($producto->clasificacion ?? '') }}"
                        data-desc="{{ strtolower(Str::limit($producto->descripcion, 200)) }}"
                    >
                        {{-- Imagen --}}
                        <div class="producto-card__img">
                            @if($producto->imagen)
                                <img
                                    src="{{ asset('storage/' . $producto->imagen) }}"
                                    alt="{{ $producto->nombre }}"
                                    loading="lazy"
                                />
                            @else
                                <div class="producto-card__no-img">
                                    <span>📦</span>
                                    <span>Sin imagen</span>
                                </div>
                            @endif

                            @if($producto->clasificacion)
                                <span class="producto-card__clasif">
                                    {{ $producto->clasificacion }}
                                </span>
                            @endif
                        </div>

                        {{-- Cuerpo --}}
                        <div class="producto-card__body">
                            <h3 class="producto-card__nombre">{{ $producto->nombre }}</h3>
                            <p class="producto-card__desc">
                                {{ Str::limit($producto->descripcion, 90) }}
                            </p>

                            <div class="producto-card__footer">
                                <div class="producto-card__precio">
                                    ${{ number_format($producto->precio, 2) }}
                                    <small>MXN + IVA</small>
                                </div>
                                <a
                                    href="{{ route('productos.show', $producto) }}"
                                    class="btn-primary"
                                >
                                    Ver producto →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="catalogo-empty">
                        <span class="catalogo-empty-icon">📭</span>
                        <p class="catalogo-empty-title">No hay productos disponibles</p>
                        <p class="catalogo-empty-sub">
                            Estamos actualizando nuestro catálogo. Vuelve pronto o
                            <a href="{{ route('cotizacion.create') }}" style="color:var(--AzulSmtek);font-weight:700;">
                                solicita una cotización personalizada
                            </a>.
                        </p>
                    </div>
                @endforelse

                {{-- Fila vacía por búsqueda --}}
                <div class="no-results" id="noResults">
                    <span class="no-results-icon">🔎</span>
                    <p class="no-results-title">Sin resultados</p>
                    <p class="no-results-sub">No encontramos productos que coincidan con tu búsqueda.</p>
                </div>

            </div>{{-- /.productos-grid --}}

        </section>
    </div>{{-- /.catalogo-page --}}

    {{-- ── Scripts ── --}}
    <script>
        // ── Búsqueda en cliente ──
        (function () {
            const input    = document.getElementById('buscarProducto');
            const noRes    = document.getElementById('noResults');
            const conteo   = document.getElementById('conteoVisible');
            const cards    = document.querySelectorAll('.producto-card');
            const total    = cards.length;

            input?.addEventListener('input', function () {
                const q = this.value.toLowerCase().trim();
                let visibles = 0;

                cards.forEach(card => {
                    const texto = (card.dataset.nombre + ' ' + card.dataset.clasif + ' ' + card.dataset.desc);
                    const match = !q || texto.includes(q);
                    card.style.display = match ? '' : 'none';
                    if (match) visibles++;
                });

                // Mostrar/ocultar fila vacía por búsqueda
                noRes?.classList.toggle('visible', visibles === 0 && total > 0);

                // Actualizar conteo
                if (conteo) conteo.textContent = visibles;
            });
        })();
    </script>
        <script src="assets/js/script.js"></script>


</x-guest-layout>
