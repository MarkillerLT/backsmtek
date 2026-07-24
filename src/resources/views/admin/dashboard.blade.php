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

    <x-admin.layout
        title="Dashboard"
        :cotizacionesPendientes="$cotizacionesPendientes ?? 0"
    >

        {{-- ── KPI Cards ───────────────────────────────────────── --}}
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
                    <div class="kpi-valor">{{ $user }}</div>
                    <div class="kpi-label">Usuarios registrados</div>
                    <div class="kpi-delta up">▲ 8 nuevos esta semana</div>
                </div>
            </div>
        </div>

        {{-- Dashboard --}}
        <div class="dashboard-row">

            {{-- Panel gráfica --}}
            <div class="panel">
            </div>
            <div class="panel">
            </div>
        </div>

    </x-admin.layout>
</x-app-layout>
