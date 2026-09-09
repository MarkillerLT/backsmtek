<x-app-layout>
    <style>
        body { overflow: hidden; }
        .admin-wrapper { display: flex; height: 100vh; overflow: hidden; background-color: var(--bg-body); }
        .admin-sidebar {
            width: 26rem; flex-shrink: 0; background-color: var(--bg-nav);
            display: flex; flex-direction: column; box-shadow: var(--shadow-lg);
            z-index: 50; transition: width var(--transition), background-color var(--transition); overflow: hidden;
        }
        .sidebar-nav { flex: 1; padding: 2rem 0; overflow-y: auto; scrollbar-width: none; }
        .sidebar-nav::-webkit-scrollbar { display: none; }
        .sidebar-label {
            font-size: 1.05rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase;
            color: rgba(255,255,255,0.35); padding: 0 2rem 1rem; margin-top: 1rem;
        }
        .sidebar-link {
            display: flex; align-items: center; gap: 1.4rem; padding: 1.3rem 2rem;
            color: rgba(255,255,255,0.75); text-decoration: none; font-size: 1.45rem; font-weight: 500;
            transition: background-color var(--transition), color var(--transition), padding-left var(--transition);
            border-left: 3px solid transparent;
        }
        .sidebar-link .s-icon { font-size: 1.8rem; width: 2.4rem; text-align: center; flex-shrink: 0; }
        .sidebar-link:hover { background-color: rgba(255,255,255,0.07); color: var(--blanco); padding-left: 2.6rem; }
        .sidebar-link.activo {
            background-color: rgba(33, 150, 186, 0.2); color: var(--blanco);
            border-left-color: var(--AzulSmtek); font-weight: 700;
        }
        .sidebar-link.activo .s-icon { color: var(--AzulSmtek); }
        .sidebar-footer { padding: 1.8rem 2rem; border-top: 1px solid rgba(255,255,255,0.08); }
        .sidebar-footer .sidebar-link { border-radius: var(--radius-sm); padding: 1.2rem 1.6rem; border-left: none; color: rgba(255,100,100,0.8); }
        .sidebar-footer .sidebar-link:hover { background-color: rgba(226, 75, 74, 0.12); color: #ff7070; padding-left: 1.6rem; }
        .admin-main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .admin-topbar {
            display: flex; align-items: center; justify-content: space-between; padding: 0 3rem;
            height: 7rem; background-color: var(--bg-header); box-shadow: var(--shadow-sm);
            flex-shrink: 0; z-index: 40; gap: 2rem; transition: background-color var(--transition);
        }
        .topbar-user { display: flex; align-items: center; gap: 1.4rem; flex-shrink: 0; }
        .topbar-avatar {
            width: 4.2rem; height: 4.2rem; border-radius: 50%; object-fit: cover;
            border: 2.5px solid var(--AzulSmtek); box-shadow: var(--shadow-sm); background-color: var(--AzulClaro);
            display: flex; align-items: center; justify-content: center; font-size: 1.6rem;
            color: var(--AzulOscuro); font-weight: 700; overflow: hidden; flex-shrink: 0;
        }
        .topbar-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .topbar-username { font-size: 1.5rem; font-weight: 700; color: var(--text-heading); }
        .topbar-role { font-size: 1.2rem; color: var(--text-muted); font-weight: 400; }
        .topbar-title { font-size: 1.8rem; font-weight: 800; color: var(--text-heading); letter-spacing: 0.02em; text-align: center; flex: 1; }
        .topbar-actions { display: flex; align-items: center; gap: 1.6rem; flex-shrink: 0; }
        .topbar-logout {
            display: flex; align-items: center; gap: 0.8rem; padding: 0.9rem 1.8rem;
            background-color: rgba(226, 75, 74, 0.1); border: 1px solid rgba(226, 75, 74, 0.25);
            color: var(--error); border-radius: var(--radius-sm); font-size: 1.4rem; font-weight: 600;
            cursor: pointer; text-decoration: none; transition: background-color var(--transition), transform var(--transition);
            font-family: "Inter", sans-serif;
        }
        .topbar-logout:hover { background-color: rgba(226, 75, 74, 0.2); transform: translateY(-1px); }
        .admin-content { flex: 1; overflow-y: auto; padding: 3rem; display: flex; flex-direction: column; gap: 2.4rem; }

        /* ══════════════════════════════════════════════════
           MIS COTIZACIONES
        ══════════════════════════════════════════════════ */
        .prod-toolbar { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1.6rem; }
        .prod-toolbar-left h1 { font-size: 2.2rem; font-weight: 800; color: var(--text-heading); margin: 0 0 0.3rem; }
        .prod-toolbar-left p { font-size: 1.3rem; color: var(--text-muted); margin: 0; }

        .panel {
            background-color: var(--bg-section); border-radius: var(--radius); box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color); overflow: hidden; transition: background-color var(--transition);
        }
        .panel-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 2rem 2.4rem; border-bottom: 1px solid var(--border-color); flex-wrap: wrap; gap: 1rem;
        }
        .panel-title { font-size: 1.7rem; font-weight: 800; color: var(--text-heading); margin: 0; }
        .panel-count { font-size: 1.3rem; color: var(--text-muted); margin: 0.3rem 0 0; }

        .prod-table-wrap { overflow-x: auto; }
        .prod-table { width: 100%; border-collapse: collapse; font-size: 1.4rem; }
        .prod-table thead tr { background-color: var(--bg-body); border-bottom: 2px solid var(--border-color); }
        .prod-table th {
            padding: 1.4rem 1.8rem; text-align: left; font-size: 1.2rem; font-weight: 700;
            letter-spacing: 0.06em; text-transform: uppercase; color: var(--text-muted); white-space: nowrap;
        }
        .prod-table tbody tr { border-bottom: 1px solid var(--border-color); transition: background-color var(--transition); }
        .prod-table tbody tr:last-child { border-bottom: none; }
        .prod-table tbody tr:hover { background-color: rgba(33,150,186,0.04); }
        body.dark-mode .prod-table tbody tr:hover { background-color: rgba(33,150,186,0.08); }
        .prod-table td { padding: 1.4rem 1.8rem; color: var(--text-primary); vertical-align: middle; }

        .cotiz-numcontrol {
            font-size: 1.25rem; font-weight: 700; color: var(--AzulOscuro); font-family: monospace;
            background-color: var(--AzulClaro); padding: 0.3rem 0.8rem; border-radius: 0.5rem; display: inline-block;
        }
        body.dark-mode .cotiz-numcontrol { background-color: rgba(33,150,186,0.18); color: var(--AzulSmtek); }

        .localidad-badge {
            display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.3rem 1rem;
            border-radius: 2rem; font-size: 1.2rem; font-weight: 600; white-space: nowrap;
            background-color: var(--bg-body); color: var(--text-primary); border: 1px solid var(--border-color);
        }

        .estado-badge {
            display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.4rem 1.1rem;
            border-radius: 2rem; font-size: 1.25rem; font-weight: 700; white-space: nowrap;
        }
        .estado-badge.pendiente { background-color: rgba(240,165,0,0.12); color: #b87a00; }
        .estado-badge.en_proceso { background-color: var(--AzulClaro); color: var(--AzulOscuro); }
        .estado-badge.respondida { background-color: rgba(29,158,117,0.12); color: #1a7a5c; }
        body.dark-mode .estado-badge.pendiente { background-color: rgba(240,165,0,0.18); color: var(--acentos); }
        body.dark-mode .estado-badge.en_proceso { background-color: rgba(33,150,186,0.18); color: var(--AzulSmtek); }
        body.dark-mode .estado-badge.respondida { background-color: rgba(29,158,117,0.2); color: #2ecc9a; }

        .prod-empty { text-align: center; padding: 6rem 2rem !important; color: var(--text-muted); }
        .prod-empty-icon { font-size: 4rem; display: block; margin-bottom: 1.2rem; }
        .prod-empty-msg { font-size: 1.6rem; font-weight: 600; color: var(--text-heading); }
        .prod-empty-sub { font-size: 1.4rem; margin-top: 0.4rem; }

        @media (max-width: 768px) {
            .admin-sidebar { position: fixed; left: -26rem; height: 100%; z-index: 200; transition: left var(--transition); }
            .admin-sidebar.abierto { left: 0; }
            .admin-topbar { padding: 0 2rem; }
            .admin-content { padding: 2rem; }
            .topbar-title { display: none; }
            .sidebar-toggle-btn { display: flex !important; }
        }
        .sidebar-toggle-btn {
            display: none; background: none; border: none; cursor: pointer;
            flex-direction: column; gap: 0.5rem; padding: 0.5rem;
        }
        .sidebar-toggle-btn span { display: block; width: 2.2rem; height: 0.2rem; background-color: var(--text-heading); border-radius: 2px; }
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 150; backdrop-filter: blur(2px); }
        .sidebar-overlay.activo { display: block; }
    </style>

    <x-user.layout title="Mis cotizaciones">

        <div class="prod-toolbar">
            <div class="prod-toolbar-left">
                <h1>Mis cotizaciones</h1>
                <p>Solicitudes que has enviado a SMTEK</p>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Historial</h2>
                    <p class="panel-count">
                        {{ $cotizaciones->count() }}
                        {{ $cotizaciones->count() == 1 ? 'cotización enviada' : 'cotizaciones enviadas' }}
                    </p>
                </div>
            </div>
            <div class="prod-table-wrap">
                <table class="prod-table">
                    <thead>
                        <tr>
                            <th>Núm. Control</th>
                            <th>Asunto</th>
                            <th>Ciudad</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cotizaciones as $cotizacion)
                            <tr>
                                <td>
                                    @if($cotizacion->numcontrol)
                                        <span class="cotiz-numcontrol">{{ $cotizacion->numcontrol }}</span>
                                    @else
                                        <span style="color: var(--text-muted);">Sin asignar</span>
                                    @endif
                                </td>
                                <td>{{ $cotizacion->asunto }}</td>
                                <td><span class="localidad-badge">📍 {{ $cotizacion->localidad }}</span></td>
                                <td>
                                    <span class="estado-badge {{ $cotizacion->estado }}">
                                        {{ ucfirst(str_replace('_',' ', $cotizacion->estado)) }}
                                    </span>
                                </td>
                                <td>{{ $cotizacion->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="prod-empty">
                                    <span class="prod-empty-icon">📭</span>
                                    <div class="prod-empty-msg">Aún no has enviado ninguna cotización.</div>
                                    <div class="prod-empty-sub">
                                        <a href="{{ route('cotizacion.create') }}" style="color: var(--AzulSmtek); font-weight: 700;">Solicitar una cotización →</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </x-user.layout>
</x-app-layout>
