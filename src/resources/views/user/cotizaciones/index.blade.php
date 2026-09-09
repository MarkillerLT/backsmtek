<x-app-layout>
    <style>
        /* ══════════════════════════════════════════════════
           ESTRUCTURA — sidebar y topbar "sticky", página con
           scroll normal (nada de height:100vh + overflow:hidden)
        ══════════════════════════════════════════════════ */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
            background-color: var(--bg-body);
            align-items: flex-start;
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
            position: sticky;
            top: 0;
            height: 100vh;
            overflow: hidden;
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

        .admin-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }
        .admin-topbar {
            display: flex; align-items: center; justify-content: space-between; padding: 0 3rem;
            height: 7rem; background-color: var(--bg-header); box-shadow: var(--shadow-sm);
            flex-shrink: 0; z-index: 40; gap: 2rem; transition: background-color var(--transition);
            position: sticky;
            top: 0;
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

        .admin-content {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            gap: 2.4rem;
        }

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
        .panel-subtitle { font-size: 1.3rem; color: var(--text-muted); margin: 0.3rem 0 0; }
        .panel-count { font-size: 1.3rem; color: var(--text-muted); margin: 0.3rem 0 0; }
        .panel-body { padding: 2.4rem; }
        /* ── Panel <details> nativo ── */
        #nuevaCotizacionPanel > summary {
            list-style: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 2rem 2.4rem;
            border-bottom: 1px solid var(--border-color);
        }
        #nuevaCotizacionPanel > summary::-webkit-details-marker { display: none; }
        #nuevaCotizacionPanel:not([open]) > summary { border-bottom: none; }
        .panel-summary-chevron {
            font-size: 1.6rem;
            color: var(--AzulSmtek);
            transition: transform 0.25s ease;
            flex-shrink: 0;
        }
        #nuevaCotizacionPanel[open] .panel-summary-chevron { transform: rotate(180deg); }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.8rem; }
        .form-field { display: flex; flex-direction: column; gap: 0.6rem; }
        .form-field.full { grid-column: 1 / -1; }
        .form-field label { font-size: 1.3rem; font-weight: 600; color: var(--text-primary); letter-spacing: 0.02em; }
        .form-field .req { color: var(--error); margin-left: 0.2rem; }
        .form-field input,
        .form-field textarea,
        .form-field select {
            width: 100%; padding: 1.2rem 1.6rem; font-size: 1.5rem; font-family: "Inter", sans-serif;
            color: var(--text-primary); background-color: var(--blanco); border: 1.5px solid var(--border-color);
            border-radius: var(--radius-sm); outline: none;
            transition: border-color var(--transition), box-shadow var(--transition); resize: vertical;
        }
        body.dark-mode .form-field input,
        body.dark-mode .form-field textarea,
        body.dark-mode .form-field select { background-color: #1e2d3e; color: var(--text-heading); border-color: var(--border-color); }
        .form-field input:focus,
        .form-field textarea:focus,
        .form-field select:focus { border-color: var(--AzulSmtek); box-shadow: 0 0 0 3px rgba(33,150,186,0.18); }
        .field-error { font-size: 1.2rem; color: var(--error); }
        .form-field select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%23888' d='M1 1l5 5 5-5'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 1.4rem center; padding-right: 3.6rem; cursor: pointer;
        }
        .form-actions { display: flex; align-items: center; gap: 1.2rem; padding-top: 1.6rem; margin-top: 0.8rem; border-top: 1px solid var(--border-color); }
        .btn-guardar {
            display: inline-flex; align-items: center; gap: 0.8rem; padding: 1.2rem 2.8rem;
            background-color: var(--AzulSmtek); color: var(--blanco); border: none; border-radius: var(--radius-sm);
            font-size: 1.5rem; font-weight: 700; cursor: pointer; font-family: "Inter", sans-serif;
            transition: background-color var(--transition), transform var(--transition), box-shadow var(--transition);
            box-shadow: var(--shadow-sm);
        }
        .btn-guardar:hover { background-color: var(--AzulOscuro); transform: translateY(-2px); box-shadow: var(--shadow-md); }
        /* ── Tabla ── */
        .prod-table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .prod-table { width: 100%; min-width: 60rem; border-collapse: collapse; font-size: 1.4rem; }
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
        .flash-alert {
            display: flex; align-items: center; gap: 1.4rem; background-color: rgba(29,158,117,0.1);
            border-left: 4px solid var(--contrastes); border-radius: var(--radius-sm); padding: 1.4rem 1.8rem; box-shadow: var(--shadow-sm);
        }
        body.dark-mode .flash-alert { background-color: rgba(29,158,117,0.15); }
        .flash-alert p { font-size: 1.45rem; font-weight: 600; color: var(--contrastes); margin: 0; }

        /* ══════════════════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════════════════ */
        @media (max-width: 768px) {
            .admin-sidebar {
                position: fixed;
                left: -26rem;
                top: 0;
                height: 100%;
                z-index: 200;
                transition: left var(--transition);
            }
            .admin-sidebar.abierto { left: 0; }
            .admin-topbar { padding: 0 2rem; }
            .admin-content { padding: 2rem; }
            .topbar-title { display: none; }
            .sidebar-toggle-btn { display: flex !important; }
            .form-grid { grid-template-columns: 1fr; }
            .form-field.full { grid-column: unset; }
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

        {{-- Flash --}}
        @if(session('success'))
            <div class="flash-alert">
                <span style="font-size:2rem;">✅</span>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- Toolbar --}}
        <div class="prod-toolbar">
            <div class="prod-toolbar-left">
                <h1>Mis cotizaciones</h1>
                <p>Solicitudes que has enviado a SMTEK</p>
            </div>
        </div>

        {{-- Panel colapsable: nueva cotización (nativo, sin JS) --}}
        <details class="panel" id="nuevaCotizacionPanel" {{ $errors->any() ? 'open' : '' }}>
            <summary>
                <div>
                    <h2 class="panel-title">➕ Solicitar nueva cotización</h2>
                    <p class="panel-subtitle">Haz clic para {{ $errors->any() ? 'ver' : 'abrir' }} el formulario</p>
                </div>
                <span class="panel-summary-chevron">▾</span>
            </summary>

            <div class="panel-body">
                <form method="POST" action="{{ route('cotizacion.store') }}">
                    @csrf

                    <div class="form-grid">
                        <div class="form-field">
                            <label for="nombre">Nombre <span class="req">*</span></label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', auth()->user()->name) }}" required>
                            @error('nombre') <span class="field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-field">
                            <label for="empresa">Empresa</label>
                            <input type="text" id="empresa" name="empresa" value="{{ old('empresa') }}" placeholder="ACME Industrial S.A.">
                            @error('empresa') <span class="field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-field">
                            <label for="correo">Correo <span class="req">*</span></label>
                            <input type="email" id="correo" name="correo" value="{{ old('correo', auth()->user()->email) }}" required>
                            @error('correo') <span class="field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-field">
                            <label for="telefono">Teléfono</label>
                            <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" placeholder="4420000000">
                            @error('telefono') <span class="field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-field">
                            <label for="localidad">Ciudad más cercana <span class="req">*</span></label>
                            <select id="localidad" name="localidad" required>
                                <option value="" disabled {{ old('localidad') ? '' : 'selected' }}>Selecciona una ciudad</option>
                                <option value="Queretaro" {{ old('localidad') === 'Queretaro' ? 'selected' : '' }}>Querétaro</option>
                                <option value="Silao" {{ old('localidad') === 'Silao' ? 'selected' : '' }}>Silao</option>
                                <option value="Toluca" {{ old('localidad') === 'Toluca' ? 'selected' : '' }}>Toluca</option>
                            </select>
                            @error('localidad') <span class="field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-field">
                            <label for="asunto">Asunto <span class="req">*</span></label>
                            <input type="text" id="asunto" name="asunto" value="{{ old('asunto') }}" placeholder="Ej. Instalación de sensores" required>
                            @error('asunto') <span class="field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-field full">
                            <label for="mensaje">Mensaje / Descripción del proyecto <span class="req">*</span></label>
                            <textarea id="mensaje" name="mensaje" rows="5" placeholder="Describe tu proyecto..." required>{{ old('mensaje') }}</textarea>
                            @error('mensaje') <span class="field-error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-guardar">📩 Enviar cotización</button>
                    </div>
                </form>
            </div>
        </details>

        {{-- Tabla de historial --}}
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
                                    <div class="prod-empty-sub">Usa el botón "➕ Solicitar nueva cotización" para empezar.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </x-user.layout>
</x-app-layout>
