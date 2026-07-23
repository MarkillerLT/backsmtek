<x-app-layout>
    <style>
        body {
            overflow: hidden; /* evita doble scroll */
        }
        .admin-wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
            background-color: var(--bg-body);
        }
       .admin-sidebar {
            width: 26rem;
            flex-shrink: 0;
            background-color: var(--bg-nav);
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow-lg);
            z-index: 50;
            transition: width var(--transition), background-color var(--transition);
            overflow: hidden;
        }

        .sidebar-logo {
            padding: 2.4rem 2rem 2rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-logo .logo-placeholder {
            height: 6rem;
            width: 100%;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.9);
        }

        .sidebar-nav {
            flex: 1;
            padding: 2rem 0;
            overflow-y: auto;
            scrollbar-width: none;
        }

        .sidebar-nav::-webkit-scrollbar { display: none; }

        .sidebar-label {
            font-size: 1.05rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.35);
            padding: 0 2rem 1rem;
            margin-top: 1rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 1.4rem;
            padding: 1.3rem 2rem;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-size: 1.45rem;
            font-weight: 500;
            transition: background-color var(--transition), color var(--transition), padding-left var(--transition);
            border-left: 3px solid transparent;
            position: relative;
        }

        .sidebar-link .s-icon {
            font-size: 1.8rem;
            width: 2.4rem;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-link:hover {
            background-color: rgba(255,255,255,0.07);
            color: var(--blanco);
            padding-left: 2.6rem;
        }

        .sidebar-link.activo {
            background-color: rgba(33, 150, 186, 0.2);
            color: var(--blanco);
            border-left-color: var(--AzulSmtek);
            font-weight: 700;
        }

        .sidebar-link.activo .s-icon {
            color: var(--AzulSmtek);
        }

        .s-badge {
            margin-left: auto;
            background-color: var(--acentos);
            color: #1a2a38;
            font-size: 1.1rem;
            font-weight: 800;
            padding: 0.2rem 0.8rem;
            border-radius: 2rem;
            min-width: 2.2rem;
            text-align: center;
        }

        .sidebar-footer {
            padding: 1.8rem 2rem;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-footer .sidebar-link {
            border-radius: var(--radius-sm);
            padding: 1.2rem 1.6rem;
            border-left: none;
            color: rgba(255,100,100,0.8);
        }

        .sidebar-footer .sidebar-link:hover {
            background-color: rgba(226, 75, 74, 0.12);
            color: #ff7070;
            padding-left: 1.6rem;
        }

        .admin-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .admin-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 3rem;
            height: 7rem;
            background-color: var(--bg-header);
            box-shadow: var(--shadow-sm);
            flex-shrink: 0;
            z-index: 40;
            gap: 2rem;
            transition: background-color var(--transition);
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 1.4rem;
            flex-shrink: 0;
        }

        .topbar-avatar {
            width: 4.2rem;
            height: 4.2rem;
            border-radius: 50%;
            object-fit: cover;
            border: 2.5px solid var(--AzulSmtek);
            box-shadow: var(--shadow-sm);
            background-color: var(--AzulClaro);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: var(--AzulOscuro);
            font-weight: 700;
            overflow: hidden;
            flex-shrink: 0;
        }

        .topbar-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .topbar-username {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-heading);
        }

        .topbar-role {
            font-size: 1.2rem;
            color: var(--text-muted);
            font-weight: 400;
        }

        /* Centro: título de la sección actual */
        .topbar-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-heading);
            letter-spacing: 0.02em;
            text-align: center;
            flex: 1;
        }

        /* Lado derecho: toggle + logout */
        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 1.6rem;
            flex-shrink: 0;
        }

        .topbar-logout {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.9rem 1.8rem;
            background-color: rgba(226, 75, 74, 0.1);
            border: 1px solid rgba(226, 75, 74, 0.25);
            color: var(--error);
            border-radius: var(--radius-sm);
            font-size: 1.4rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background-color var(--transition), transform var(--transition);
            font-family: "Inter", sans-serif;
        }

        .topbar-logout:hover {
            background-color: rgba(226, 75, 74, 0.2);
            transform: translateY(-1px);
        }

        /* ── Área de contenido con scroll ── */
        .admin-content {
            flex: 1;
            overflow-y: auto;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            gap: 2.8rem;
        }

        /* ══════════════════════════════════════════════════
           TARJETAS KPI (fila superior)
        ══════════════════════════════════════════════════ */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
        }

        .kpi-card {
            background-color: var(--bg-section);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            padding: 2.2rem 2.4rem;
            display: flex;
            align-items: center;
            gap: 1.8rem;
            border: 1px solid var(--border-color);
            transition: box-shadow var(--transition), transform var(--transition), background-color var(--transition);
        }

        .kpi-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .kpi-icon {
            width: 5.4rem;
            height: 5.4rem;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            flex-shrink: 0;
        }

        .kpi-icon.azul    { background-color: var(--AzulClaro); }
        .kpi-icon.verde   { background-color: rgba(29,158,117,0.12); }
        .kpi-icon.amarillo{ background-color: rgba(240,165,0,0.12); }
        .kpi-icon.rojo    { background-color: rgba(226,75,74,0.1); }

        body.dark-mode .kpi-icon.azul     { background-color: rgba(33,150,186,0.15); }
        body.dark-mode .kpi-icon.verde    { background-color: rgba(29,158,117,0.18); }
        body.dark-mode .kpi-icon.amarillo { background-color: rgba(240,165,0,0.15); }
        body.dark-mode .kpi-icon.rojo     { background-color: rgba(226,75,74,0.15); }

        .kpi-info {}

        .kpi-valor {
            font-size: 2.6rem;
            font-weight: 800;
            color: var(--text-heading);
            line-height: 1;
            margin-bottom: 0.4rem;
        }

        .kpi-label {
            font-size: 1.3rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .kpi-delta {
            font-size: 1.2rem;
            font-weight: 700;
            margin-top: 0.4rem;
        }

        .kpi-delta.up   { color: var(--contrastes); }
        .kpi-delta.down { color: var(--error); }

        .dashboard-row {
            display: grid;
            grid-template-columns: 1fr 38rem;
            gap: 2.4rem;
            align-items: start;
        }

        /* ── Panel genérico ── */
        .panel {
            background-color: var(--bg-section);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            overflow: hidden;
            transition: background-color var(--transition), box-shadow var(--transition);
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 2rem 2.4rem;
            border-bottom: 1px solid var(--border-color);
        }

        .panel-title {
            font-size: 1.7rem;
            font-weight: 800;
            color: var(--text-heading);
            margin: 0;
        }

        .panel-subtitle {
            font-size: 1.3rem;
            color: var(--text-muted);
            margin: 0.3rem 0 0;
        }

        .panel-badge {
            font-size: 1.2rem;
            font-weight: 700;
            padding: 0.4rem 1.2rem;
            border-radius: 2rem;
            background-color: var(--AzulClaro);
            color: var(--AzulOscuro);
        }

        body.dark-mode .panel-badge {
            background-color: rgba(33,150,186,0.2);
            color: var(--AzulSmtek);
        }

        .panel-body {
            padding: 2.4rem;
        }

        /* ── Gráfica de ventas de servicios ── */
        .chart-wrap {
            position: relative;
            width: 100%;
            height: 28rem;
        }

        /* Barras SVG inline — sin librerías externas */
        .bar-chart {
            width: 100%;
            height: 100%;
        }

        /* ── Leyenda de la gráfica ── */
        .chart-legend {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            margin-top: 1.8rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            font-size: 1.3rem;
            color: var(--text-muted);
        }

        .legend-dot {
            width: 1.2rem;
            height: 1.2rem;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* ── Lista de movimientos ── */
        .mov-list {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .mov-item {
            display: flex;
            align-items: center;
            gap: 1.4rem;
            padding: 1.6rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .mov-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .mov-icon {
            width: 4rem;
            height: 4rem;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            flex-shrink: 0;
        }

        .mov-icon.ingreso { background-color: rgba(29,158,117,0.12); }
        .mov-icon.egreso  { background-color: rgba(226,75,74,0.10); }
        .mov-icon.cotiz   { background-color: rgba(240,165,0,0.12); }
        .mov-icon.usuario { background-color: var(--AzulClaro); }

        body.dark-mode .mov-icon.ingreso { background-color: rgba(29,158,117,0.2); }
        body.dark-mode .mov-icon.egreso  { background-color: rgba(226,75,74,0.18); }
        body.dark-mode .mov-icon.cotiz   { background-color: rgba(240,165,0,0.15); }
        body.dark-mode .mov-icon.usuario { background-color: rgba(33,150,186,0.18); }

        .mov-info {
            flex: 1;
            min-width: 0;
        }

        .mov-desc {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--text-heading);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .mov-fecha {
            font-size: 1.2rem;
            color: var(--text-muted);
            margin-top: 0.2rem;
        }

        .mov-monto {
            font-size: 1.5rem;
            font-weight: 800;
            flex-shrink: 0;
        }

        .mov-monto.pos { color: var(--contrastes); }
        .mov-monto.neg { color: var(--error); }
        .mov-monto.neu { color: var(--AzulSmtek); }

        /* ══════════════════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════════════════ */
        @media (max-width: 1200px) {
            .kpi-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 960px) {
            .dashboard-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                position: fixed;
                left: -26rem;
                height: 100%;
                z-index: 200;
                transition: left var(--transition);
            }

            .admin-sidebar.abierto {
                left: 0;
            }

            .admin-topbar {
                padding: 0 2rem;
            }

            .admin-content {
                padding: 2rem;
            }

            .topbar-title {
                display: none;
            }

            .sidebar-toggle-btn {
                display: flex !important;
            }
        }

        @media (max-width: 480px) {
            .kpi-grid {
                grid-template-columns: 1fr;
            }

            .topbar-logout span {
                display: none;
            }
        }

        /* Botón hamburguesa en mobile */
        .sidebar-toggle-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            flex-direction: column;
            gap: 0.5rem;
            padding: 0.5rem;
        }

        .sidebar-toggle-btn span {
            display: block;
            width: 2.2rem;
            height: 0.2rem;
            background-color: var(--text-heading);
            border-radius: 2px;
            transition: transform var(--transition), opacity var(--transition);
        }

        /* Overlay sidebar en mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 150;
            backdrop-filter: blur(2px);
        }

        .sidebar-overlay.activo {
            display: block;
        }
    </style>

    {{-- ════════════════════════════════════════════════════════════
         WRAPPER PRINCIPAL
    ════════════════════════════════════════════════════════════ --}}
    <div class="admin-wrapper" id="adminWrapper">

        {{-- Overlay mobile --}}
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        {{-- ╔══════════════════════════════════════════════════╗
             ║  SIDEBAR                                        ║
             ╚══════════════════════════════════════════════════╝ --}}
        <aside class="admin-sidebar" id="adminSidebar">

            {{-- Logo --}}
    <a href="/">
        <div class="logo">
            <img
                id="logo-img"
                src="assets/img/1.svg"
                alt="SMTEK Logo"
                onerror="
                this.style.display = 'none';
                document.getElementById('logo-fallback').style.display = 'flex';"
            />
        <div id="logo-fallback" class="logo-placeholder" style="display: none">
            SMTEK
        </div>
      </div>
    </a>

            {{-- Menú principal --}}
            <nav class="sidebar-nav">
                <div class="sidebar-label">Principal</div>

                <a href="{{ route('admin.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.index') ? 'activo' : '' }}">
                    <span class="s-icon">📊</span>
                    Dashboard
                </a>

                <a href="#" class="sidebar-link">
                    <span class="s-icon">👤</span>
                    Perfil
                </a>

                <div class="sidebar-label">Gestión</div>

                <a href="{{ route('admin.productos.index') }}" class="sidebar-link">
                    <span class="s-icon">📦</span>
                    Productos
                </a>

                <a href="{{ route('admin.cotizaciones.index') }}" class="sidebar-link">
                <span class="s-icon">📋</span>
                    Cotizaciones

                @if(isset($cotizacionesPendientes) && $cotizacionesPendientes > 0)
                    <span class="s-badge">
                        {{ $cotizacionesPendientes }}
                    </span>
                @endif
                </a>

                <a href="#" class="sidebar-link">
                    <span class="s-icon">💼</span>
                    Ventas
                </a>

                <a href="#" class="sidebar-link">
                    <span class="s-icon">👥</span>
                    Usuarios
                </a>

            </nav>

            {{-- Logout en el sidebar --}}
            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-link" style="width:100%;background:none;border:none;cursor:pointer;font-family:inherit;">
                        <span class="s-icon">🚪</span>
                        Cerrar sesión
                    </button>
                </form>
            </div>

        </aside>{{-- /.admin-sidebar --}}

        {{-- ╔══════════════════════════════════════════════════╗
             ║  ÁREA PRINCIPAL                                 ║
             ╚══════════════════════════════════════════════════╝ --}}
        <div class="admin-main">

            {{-- ── TOPBAR ── --}}
            <div class="admin-topbar">

                {{-- Izquierda: hamburguesa (mobile) + usuario --}}
                <div style="display:flex;align-items:center;gap:1.4rem;">
                    <button class="sidebar-toggle-btn" id="sidebarToggle" aria-label="Menú">
                        <span></span><span></span><span></span>
                    </button>

                    <div class="topbar-user">
                        {{-- Avatar: si el usuario tiene foto de perfil de Jetstream --}}
                        <div class="topbar-avatar">
                            @if (Auth::user()->profile_photo_url)
                                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                            @else
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            @endif
                        </div>
                        <div>
                            <div class="topbar-username">{{ Auth::user()->name }}</div>
                            <div class="topbar-role">Administrador</div>
                        </div>
                    </div>
                </div>

                {{-- Centro: título --}}
                <div class="topbar-title">Dashboard</div>

                {{-- Derecha: dark mode + logout --}}
                <div class="topbar-actions">
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

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="topbar-logout">
                            <span>🚪</span>
                            <span>Cerrar sesión</span>
                        </button>
                    </form>
                </div>

            </div>{{-- /.admin-topbar --}}

            {{-- ── CONTENIDO CON SCROLL ── --}}
            <div class="admin-content">

                {{-- ── KPI Cards ── --}}
                <div class="kpi-grid">
                    <div class="kpi-card">
                        <div class="kpi-icon azul">📈</div>
                        <div class="kpi-info">
                            <div class="kpi-valor">$284,500</div>
                            <div class="kpi-label">Ventas del mes</div>
                            <div class="kpi-delta up">▲ 12.4% vs mes anterior</div>
                        </div>
                    </div>
                    <div class="kpi-card">
                        <div class="kpi-icon verde">✅</div>
                        <div class="kpi-info">
                            <div class="kpi-valor">38</div>
                            <div class="kpi-label">Servicios completados</div>
                            <div class="kpi-delta up">▲ 5 más que el mes pasado</div>
                        </div>
                    </div>
                    <div class="kpi-card">
                        <div class="kpi-icon amarillo">📋</div>
                        <div class="kpi-info">
                            <div class="kpi-valor">12</div>
                            <div class="kpi-label">Cotizaciones pendientes</div>
                            <div class="kpi-delta down">▼ 3 sin respuesta +7d</div>
                        </div>
                    </div>
                    <div class="kpi-card">
                        <div class="kpi-icon rojo">👥</div>
                        <div class="kpi-info">
                            <div class="kpi-valor">{{$user}}</div>
                            <div class="kpi-label">Usuarios registrados</div>
                            <div class="kpi-delta up">▲ 8 nuevos esta semana</div>
                        </div>
                    </div>
                </div>

                {{-- ── Fila central: gráfica + movimientos ── --}}
                <div class="dashboard-row">

                    {{-- Gráfica de ventas de servicios --}}
                    <div class="panel">
                        <div class="panel-header">
                            <div>
                                <h2 class="panel-title">Ventas de Servicios</h2>
                                <p class="panel-subtitle">Comparativo mensual 2025 — 2026</p>
                            </div>
                            <span class="panel-badge">Anual</span>
                        </div>
                        <div class="panel-body">
                            <div class="chart-wrap">
                                {{-- Gráfica SVG sin librerías externas --}}
                                <svg class="bar-chart" viewBox="0 0 700 250" xmlns="http://www.w3.org/2000/svg" aria-label="Ventas de servicios por mes">
                                    <!-- Líneas guía horizontales -->
                                    <line x1="40" y1="20"  x2="690" y2="20"  stroke="var(--border-color)" stroke-width="1"/>
                                    <line x1="40" y1="73"  x2="690" y2="73"  stroke="var(--border-color)" stroke-width="1"/>
                                    <line x1="40" y1="126" x2="690" y2="126" stroke="var(--border-color)" stroke-width="1"/>
                                    <line x1="40" y1="179" x2="690" y2="179" stroke="var(--border-color)" stroke-width="1"/>
                                    <line x1="40" y1="232" x2="690" y2="232" stroke="var(--border-color)" stroke-width="1"/>

                                    <!-- Etiquetas eje Y -->
                                    <text x="34" y="24"  font-size="11" fill="var(--text-muted)" text-anchor="end">$300k</text>
                                    <text x="34" y="77"  font-size="11" fill="var(--text-muted)" text-anchor="end">$225k</text>
                                    <text x="34" y="130" font-size="11" fill="var(--text-muted)" text-anchor="end">$150k</text>
                                    <text x="34" y="183" font-size="11" fill="var(--text-muted)" text-anchor="end">$75k</text>
                                    <text x="34" y="236" font-size="11" fill="var(--text-muted)" text-anchor="end">$0</text>

                                    <!-- Datos 2025 (barras azul claro) y 2026 (barras azul SMTEK) -->
                                    <!-- Mes Ene -->
                                    <rect x="52"  y="120" width="22" height="112" rx="4" fill="var(--AzulClaro)" opacity="0.9"/>
                                    <rect x="76"  y="95"  width="22" height="137" rx="4" fill="var(--AzulSmtek)" opacity="0.92"/>
                                    <!-- Mes Feb -->
                                    <rect x="108" y="110" width="22" height="122" rx="4" fill="var(--AzulClaro)" opacity="0.9"/>
                                    <rect x="132" y="80"  width="22" height="152" rx="4" fill="var(--AzulSmtek)" opacity="0.92"/>
                                    <!-- Mes Mar -->
                                    <rect x="164" y="90"  width="22" height="142" rx="4" fill="var(--AzulClaro)" opacity="0.9"/>
                                    <rect x="188" y="60"  width="22" height="172" rx="4" fill="var(--AzulSmtek)" opacity="0.92"/>
                                    <!-- Mes Abr -->
                                    <rect x="220" y="100" width="22" height="132" rx="4" fill="var(--AzulClaro)" opacity="0.9"/>
                                    <rect x="244" y="75"  width="22" height="157" rx="4" fill="var(--AzulSmtek)" opacity="0.92"/>
                                    <!-- Mes May -->
                                    <rect x="276" y="85"  width="22" height="147" rx="4" fill="var(--AzulClaro)" opacity="0.9"/>
                                    <rect x="300" y="55"  width="22" height="177" rx="4" fill="var(--AzulSmtek)" opacity="0.92"/>
                                    <!-- Mes Jun -->
                                    <rect x="332" y="130" width="22" height="102" rx="4" fill="var(--AzulClaro)" opacity="0.9"/>
                                    <rect x="356" y="100" width="22" height="132" rx="4" fill="var(--AzulSmtek)" opacity="0.92"/>
                                    <!-- Mes Jul -->
                                    <rect x="388" y="115" width="22" height="117" rx="4" fill="var(--AzulClaro)" opacity="0.9"/>
                                    <rect x="412" y="85"  width="22" height="147" rx="4" fill="var(--AzulSmtek)" opacity="0.92"/>
                                    <!-- Mes Ago -->
                                    <rect x="444" y="105" width="22" height="127" rx="4" fill="var(--AzulClaro)" opacity="0.9"/>
                                    <rect x="468" y="70"  width="22" height="162" rx="4" fill="var(--AzulSmtek)" opacity="0.92"/>
                                    <!-- Mes Sep -->
                                    <rect x="500" y="95"  width="22" height="137" rx="4" fill="var(--AzulClaro)" opacity="0.9"/>
                                    <rect x="524" y="60"  width="22" height="172" rx="4" fill="var(--AzulSmtek)" opacity="0.92"/>
                                    <!-- Mes Oct -->
                                    <rect x="556" y="80"  width="22" height="152" rx="4" fill="var(--AzulClaro)" opacity="0.9"/>
                                    <rect x="580" y="45"  width="22" height="187" rx="4" fill="var(--AzulSmtek)" opacity="0.92"/>
                                    <!-- Mes Nov -->
                                    <rect x="612" y="70"  width="22" height="162" rx="4" fill="var(--AzulClaro)" opacity="0.9"/>
                                    <rect x="636" y="40"  width="22" height="192" rx="4" fill="var(--AzulSmtek)" opacity="0.92"/>
                                    <!-- Mes Dic -->
                                    <rect x="660" y="55"  width="14" height="177" rx="4" fill="var(--AzulClaro)" opacity="0.9"/>
                                    <rect x="676" y="30"  width="14" height="202" rx="4" fill="var(--acentos)"   opacity="0.92"/>

                                    <!-- Etiquetas eje X -->
                                    <text x="75"  y="248" font-size="11" fill="var(--text-muted)" text-anchor="middle">Ene</text>
                                    <text x="131" y="248" font-size="11" fill="var(--text-muted)" text-anchor="middle">Feb</text>
                                    <text x="187" y="248" font-size="11" fill="var(--text-muted)" text-anchor="middle">Mar</text>
                                    <text x="243" y="248" font-size="11" fill="var(--text-muted)" text-anchor="middle">Abr</text>
                                    <text x="299" y="248" font-size="11" fill="var(--text-muted)" text-anchor="middle">May</text>
                                    <text x="355" y="248" font-size="11" fill="var(--text-muted)" text-anchor="middle">Jun</text>
                                    <text x="411" y="248" font-size="11" fill="var(--text-muted)" text-anchor="middle">Jul</text>
                                    <text x="467" y="248" font-size="11" fill="var(--text-muted)" text-anchor="middle">Ago</text>
                                    <text x="523" y="248" font-size="11" fill="var(--text-muted)" text-anchor="middle">Sep</text>
                                    <text x="579" y="248" font-size="11" fill="var(--text-muted)" text-anchor="middle">Oct</text>
                                    <text x="635" y="248" font-size="11" fill="var(--text-muted)" text-anchor="middle">Nov</text>
                                    <text x="683" y="248" font-size="11" fill="var(--text-muted)" text-anchor="middle">Dic</text>
                                </svg>
                            </div>

                            {{-- Leyenda --}}
                            <div class="chart-legend">
                                <div class="legend-item">
                                    <div class="legend-dot" style="background:var(--AzulClaro);border:2px solid var(--AzulSmtek);"></div>
                                    <span>2025</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-dot" style="background:var(--AzulSmtek);"></div>
                                    <span>2026</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-dot" style="background:var(--acentos);"></div>
                                    <span>2026 Dic (proyección)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Resumen de movimientos --}}
                    <div class="panel">
                        <div class="panel-header">
                            <div>
                                <h2 class="panel-title">Movimientos</h2>
                                <p class="panel-subtitle">Últimas transacciones</p>
                            </div>
                            <span class="panel-badge">Hoy</span>
                        </div>
                        <div class="panel-body">
                            <div class="mov-list">

                                <div class="mov-item">
                                    <div class="mov-icon ingreso">💰</div>
                                    <div class="mov-info">
                                        <div class="mov-desc">Pago — Servicio de calibración</div>
                                        <div class="mov-fecha">Hoy, 09:14 am · Cliente: Automex</div>
                                    </div>
                                    <div class="mov-monto pos">+$18,400</div>
                                </div>

                                <div class="mov-item">
                                    <div class="mov-icon cotiz">📋</div>
                                    <div class="mov-info">
                                        <div class="mov-desc">Cotización #COT-0821 enviada</div>
                                        <div class="mov-fecha">Hoy, 08:30 am · Pendiente</div>
                                    </div>
                                    <div class="mov-monto neu">$7,250</div>
                                </div>

                                <div class="mov-item">
                                    <div class="mov-icon ingreso">💰</div>
                                    <div class="mov-info">
                                        <div class="mov-desc">Pago — Instalación sensores</div>
                                        <div class="mov-fecha">Ayer, 05:00 pm · Cliente: BOSH MX</div>
                                    </div>
                                    <div class="mov-monto pos">+$32,000</div>
                                </div>

                                <div class="mov-item">
                                    <div class="mov-icon egreso">📦</div>
                                    <div class="mov-info">
                                        <div class="mov-desc">Compra de insumos — Banner</div>
                                        <div class="mov-fecha">Ayer, 11:20 am · Proveedor</div>
                                    </div>
                                    <div class="mov-monto neg">-$9,800</div>
                                </div>

                                <div class="mov-item">
                                    <div class="mov-icon usuario">👤</div>
                                    <div class="mov-info">
                                        <div class="mov-desc">Nuevo usuario registrado</div>
                                        <div class="mov-fecha">Ayer, 10:05 am · Ana Torres</div>
                                    </div>
                                    <div class="mov-monto neu">—</div>
                                </div>

                                <div class="mov-item">
                                    <div class="mov-icon cotiz">📋</div>
                                    <div class="mov-info">
                                        <div class="mov-desc">Cotización #COT-0820 aprobada</div>
                                        <div class="mov-fecha">Lun 30 Jun · Convertida a venta</div>
                                    </div>
                                    <div class="mov-monto pos">+$14,700</div>
                                </div>

                                <div class="mov-item">
                                    <div class="mov-icon egreso">📦</div>
                                    <div class="mov-info">
                                        <div class="mov-desc">Devolución — Sensor defectuoso</div>
                                        <div class="mov-fecha">Lun 30 Jun · Nota de crédito</div>
                                    </div>
                                    <div class="mov-monto neg">-$3,200</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>{{-- /.dashboard-row --}}

            </div>{{-- /.admin-content --}}
        </div>{{-- /.admin-main --}}
    </div>{{-- /.admin-wrapper --}}
    <script src="assets/js/script.js"></script>

</x-app-layout>

