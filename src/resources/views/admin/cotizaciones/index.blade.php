<x-app-layout>
{{--
|--------------------------------------------------------------------------
| Vista: admin/cotizaciones/index.blade.php — Cotizaciones recibidas SMTEK
| Misma estructura del dashboard y productos/index
|--------------------------------------------------------------------------
--}}

    <style>
        body { overflow: hidden; }

        .admin-wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
            background-color: var(--bg-body);
        }

        /* ── Sidebar ── */
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
            background-color: rgba(33,150,186,0.2);
            color: var(--blanco);
            border-left-color: var(--AzulSmtek);
            font-weight: 700;
        }

        .sidebar-link.activo .s-icon { color: var(--AzulSmtek); }

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
            background-color: rgba(226,75,74,0.12);
            color: #ff7070;
            padding-left: 1.6rem;
        }

        /* ── Main ── */
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

        .topbar-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .topbar-username { font-size: 1.5rem; font-weight: 700; color: var(--text-heading); }
        .topbar-role     { font-size: 1.2rem; color: var(--text-muted); }

        .topbar-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-heading);
            letter-spacing: 0.02em;
            text-align: center;
            flex: 1;
        }

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
            background-color: rgba(226,75,74,0.1);
            border: 1px solid rgba(226,75,74,0.25);
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
            background-color: rgba(226,75,74,0.2);
            transform: translateY(-1px);
        }

        .admin-content {
            flex: 1;
            overflow-y: auto;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            gap: 2.4rem;
        }

        /* ══════════════════════════════════════════════
           PÁGINA: COTIZACIONES
        ══════════════════════════════════════════════ */

        .prod-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1.6rem;
        }

        .prod-toolbar-left h1 {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text-heading);
            margin: 0 0 0.3rem;
        }

        .prod-toolbar-left p {
            font-size: 1.3rem;
            color: var(--text-muted);
            margin: 0;
        }

        /* ── Filtros de estado ── */
        .cotiz-filtros {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .filtro-btn {
            padding: 0.6rem 1.4rem;
            border-radius: 2rem;
            border: 1.5px solid var(--border-color);
            background: none;
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            font-family: "Inter", sans-serif;
            transition: all var(--transition);
        }

        .filtro-btn:hover {
            border-color: var(--AzulSmtek);
            color: var(--AzulSmtek);
        }

        .filtro-btn.activo {
            background-color: var(--AzulSmtek);
            border-color: var(--AzulSmtek);
            color: var(--blanco);
        }

        /* ── Panel ── */
        .panel {
            background-color: var(--bg-section);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            overflow: hidden;
            transition: background-color var(--transition);
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 2rem 2.4rem;
            border-bottom: 1px solid var(--border-color);
            flex-wrap: wrap;
            gap: 1.2rem;
        }

        .panel-title {
            font-size: 1.7rem;
            font-weight: 800;
            color: var(--text-heading);
            margin: 0;
        }

        .panel-count {
            font-size: 1.3rem;
            color: var(--text-muted);
            margin: 0.3rem 0 0;
        }

        /* ── Búsqueda ── */
        .prod-search {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            background-color: var(--blanco);
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-sm);
            padding: 0.7rem 1.4rem;
            transition: border-color var(--transition), box-shadow var(--transition);
        }

        body.dark-mode .prod-search { background-color: #1e2d3e; }

        .prod-search:focus-within {
            border-color: var(--AzulSmtek);
            box-shadow: 0 0 0 3px rgba(33,150,186,0.15);
        }

        .prod-search span { font-size: 1.5rem; color: var(--text-muted); }

        .prod-search input {
            border: none;
            outline: none;
            background: none;
            font-size: 1.4rem;
            font-family: "Inter", sans-serif;
            color: var(--text-primary);
            width: 20rem;
        }

        /* ── Tabla ── */
        .prod-table-wrap { overflow-x: auto; }

        .prod-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 1.4rem;
        }

        .prod-table thead tr {
            background-color: var(--bg-body);
            border-bottom: 2px solid var(--border-color);
        }

        .prod-table th {
            padding: 1.4rem 1.8rem;
            text-align: left;
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--text-muted);
            white-space: nowrap;
        }

        .prod-table tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: background-color var(--transition);
        }

        .prod-table tbody tr:last-child { border-bottom: none; }

        .prod-table tbody tr:hover {
            background-color: rgba(33,150,186,0.04);
        }

        body.dark-mode .prod-table tbody tr:hover {
            background-color: rgba(33,150,186,0.08);
        }

        .prod-table td {
            padding: 1.4rem 1.8rem;
            color: var(--text-primary);
            vertical-align: middle;
        }

        /* ── Celdas específicas ── */
        .prod-id {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-muted);
            font-family: monospace;
        }

        .cotiz-nombre { font-weight: 700; color: var(--text-heading); }

        .cotiz-empresa {
            font-size: 1.3rem;
            color: var(--text-muted);
        }

        .cotiz-correo {
            font-size: 1.35rem;
            color: var(--AzulSmtek);
        }

        .cotiz-fecha {
            font-size: 1.3rem;
            color: var(--text-muted);
            white-space: nowrap;
        }

        /* ── Badge de estado ── */
        .estado-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 1.1rem;
            border-radius: 2rem;
            font-size: 1.25rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .estado-badge.pendiente {
            background-color: rgba(240,165,0,0.12);
            color: #b87a00;
        }

        .estado-badge.revision {
            background-color: var(--AzulClaro);
            color: var(--AzulOscuro);
        }

        .estado-badge.aprobada {
            background-color: rgba(29,158,117,0.12);
            color: #1a7a5c;
        }

        .estado-badge.rechazada {
            background-color: rgba(226,75,74,0.1);
            color: var(--error);
        }

        body.dark-mode .estado-badge.pendiente  { background-color: rgba(240,165,0,0.18);     color: var(--acentos); }
        body.dark-mode .estado-badge.revision   { background-color: rgba(33,150,186,0.18);    color: var(--AzulSmtek); }
        body.dark-mode .estado-badge.aprobada   { background-color: rgba(29,158,117,0.2);     color: #2ecc9a; }
        body.dark-mode .estado-badge.rechazada  { background-color: rgba(226,75,74,0.18);     color: #ff7070; }

        /* ── Botón ver ── */
        .btn-ver {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.7rem 1.4rem;
            background-color: rgba(33,150,186,0.1);
            border: 1px solid rgba(33,150,186,0.3);
            color: var(--AzulSmtek);
            border-radius: var(--radius-sm);
            font-size: 1.3rem;
            font-weight: 600;
            text-decoration: none;
            transition: background-color var(--transition), transform var(--transition);
            white-space: nowrap;
        }

        .btn-ver:hover {
            background-color: rgba(33,150,186,0.2);
            transform: translateY(-1px);
        }

        /* ── Fila vacía ── */
        .prod-empty {
            text-align: center;
            padding: 6rem 2rem !important;
            color: var(--text-muted);
        }

        .prod-empty-icon { font-size: 4rem; display: block; margin-bottom: 1.2rem; }
        .prod-empty-msg  { font-size: 1.6rem; font-weight: 600; color: var(--text-heading); }
        .prod-empty-sub  { font-size: 1.4rem; margin-top: 0.4rem; }

        /* ── KPIs rápidos encima de la tabla ── */
        .cotiz-kpis {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.6rem;
        }

        .kpi-mini {
            background-color: var(--bg-section);
            border-radius: var(--radius);
            border: 1px solid var(--border-color);
            padding: 1.8rem 2rem;
            display: flex;
            align-items: center;
            gap: 1.4rem;
            transition: box-shadow var(--transition), transform var(--transition);
        }

        .kpi-mini:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .kpi-mini-icon {
            font-size: 2.2rem;
            width: 4.4rem;
            height: 4.4rem;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .kpi-mini-icon.total    { background-color: var(--AzulClaro); }
        .kpi-mini-icon.pend     { background-color: rgba(240,165,0,0.12); }
        .kpi-mini-icon.aprob    { background-color: rgba(29,158,117,0.12); }
        .kpi-mini-icon.rech     { background-color: rgba(226,75,74,0.1); }

        body.dark-mode .kpi-mini-icon.total { background-color: rgba(33,150,186,0.18); }
        body.dark-mode .kpi-mini-icon.pend  { background-color: rgba(240,165,0,0.18); }
        body.dark-mode .kpi-mini-icon.aprob { background-color: rgba(29,158,117,0.2); }
        body.dark-mode .kpi-mini-icon.rech  { background-color: rgba(226,75,74,0.18); }

        .kpi-mini-valor {
            font-size: 2.4rem;
            font-weight: 800;
            color: var(--text-heading);
            line-height: 1;
        }

        .kpi-mini-label {
            font-size: 1.25rem;
            color: var(--text-muted);
            margin-top: 0.3rem;
        }

        /* ══════════════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════════════ */
        @media (max-width: 1100px) {
            .cotiz-kpis { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                position: fixed;
                left: -26rem;
                height: 100%;
                z-index: 200;
                transition: left var(--transition);
            }

            .admin-sidebar.abierto { left: 0; }
            .admin-topbar  { padding: 0 2rem; }
            .admin-content { padding: 2rem; }
            .topbar-title  { display: none; }
            .sidebar-toggle-btn { display: flex !important; }
        }

        @media (max-width: 480px) {
            .cotiz-kpis { grid-template-columns: 1fr 1fr; }
            .topbar-logout span:last-child { display: none; }
        }

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
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 150;
            backdrop-filter: blur(2px);
        }

        .sidebar-overlay.activo { display: block; }
    </style>
    <x-admin.layout
        title="Cotizaciones"
        :cotizacionesPendientes="$cotizacionesPendientes">

        {{-- Toolbar --}}
        <div class="prod-toolbar">
            <div class="prod-toolbar-left">
                <h1>Cotizaciones</h1>
                <p>Solicitudes recibidas desde el sitio web</p>
            </div>

            <div class="cotiz-filtros">
                <button class="filtro-btn activo" data-filtro="todos">Todas</button>
                <button class="filtro-btn" data-filtro="pendiente">Pendiente</button>
                <button class="filtro-btn" data-filtro="en_proceso">En proceso</button>
                <button class="filtro-btn" data-filtro="respondida">Respondida</button>
                <button class="filtro-btn" data-filtro="cancelada">Cancelada</button>
            </div>
        </div>

        {{-- KPIs --}}
        <div class="cotiz-kpis">

            <div class="kpi-mini">
                <div class="kpi-mini-icon total">📋</div>
                <div>
                    <div class="kpi-mini-valor">{{ $cotizaciones->count() }}</div>
                    <div class="kpi-mini-label">Total</div>
                </div>
            </div>

            <div class="kpi-mini">
                <div class="kpi-mini-icon pend">⏳</div>
                <div>
                    <div class="kpi-mini-valor">
                        {{ $cotizaciones->where('estado','pendiente')->count() }}
                    </div>
                    <div class="kpi-mini-label">Pendientes</div>
                </div>
            </div>

            <div class="kpi-mini">
                <div class="kpi-mini-icon proc">🔄</div>
                <div>
                    <div class="kpi-mini-valor">
                        {{ $cotizaciones->where('estado','en_proceso')->count() }}
                    </div>
                    <div class="kpi-mini-label">En proceso</div>
                </div>
            </div>

            <div class="kpi-mini">
                <div class="kpi-mini-icon resp">✅</div>
                <div>
                    <div class="kpi-mini-valor">
                        {{ $cotizaciones->where('estado','respondida')->count() }}
                    </div>
                    <div class="kpi-mini-label">Respondidas</div>
                </div>
            </div>

        </div>

        {{-- Tabla --}}
        <div class="panel">

            <div class="panel-header">

                <div>
                    <h2 class="panel-title">Solicitudes</h2>

                    <p class="panel-count">
                        {{ $cotizaciones->count() }}
                        {{ $cotizaciones->count() == 1 ? 'cotización registrada' : 'cotizaciones registradas' }}
                    </p>
                </div>

                <div class="prod-search">
                    <span>🔍</span>

                    <input
                        type="text"
                        id="buscarCotiz"
                        placeholder="Buscar..."
                        autocomplete="off">
                </div>

            </div>

            <div class="prod-table-wrap">

                <table class="prod-table" id="tablaCotizaciones">

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Empresa</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th></th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($cotizaciones as $cotizacion)

                            <tr data-estado="{{ $cotizacion->estado }}">

                                <td>#{{ $cotizacion->id }}</td>

                                <td>{{ $cotizacion->nombre }}</td>

                                <td>{{ $cotizacion->empresa ?: '—' }}</td>

                                <td>{{ $cotizacion->correo }}</td>

                                <td>

                                    <span class="estado-badge {{ $cotizacion->estado }}">
                                        {{ ucfirst(str_replace('_',' ', $cotizacion->estado)) }}
                                    </span>

                                </td>

                                <td>

                                    {{ $cotizacion->created_at->format('d/m/Y') }}

                                </td>

                                <td>

                                    <a
                                        href="{{ route('admin.cotizaciones.show',$cotizacion) }}"
                                        class="btn-ver">

                                        Ver detalle

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="prod-empty">

                                    No hay cotizaciones registradas.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </x-admin.layout>

</x-app-layout>
