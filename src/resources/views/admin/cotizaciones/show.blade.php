<x-app-layout>
<x-admin.layout
    title="Detalle de Cotización"
    :cotizacionesPendientes="$cotizacionesPendientes">

    @php
        $estadoSlug = match(strtolower($cotizacion->estado)) {
            'pendiente'          => 'pendiente',
            'en_proceso',
            'en proceso'         => 'en_proceso',
            'respondida'         => 'respondida',
            'cancelada'          => 'cancelada',
            default              => 'pendiente',
        };

        $estadoIcon = match($estadoSlug) {
            'pendiente'  => '⏳',
            'en_proceso' => '🔍',
            'respondida' => '✅',
            'cancelada'  => '❌',
        };

        $estadoLabel = match($estadoSlug) {
            'pendiente'  => 'Pendiente',
            'en_proceso' => 'En proceso',
            'respondida' => 'Respondida',
            'cancelada'  => 'Cancelada',
        };
    @endphp

    {{-- ── Estilos específicos de esta vista ── --}}
    <style>
        /* Reutiliza: .create-layout, .panel, .panel-header, .panel-body,
           .panel-title, .panel-subtitle, .form-grid, .form-field, .form-field.full,
           .form-actions, .btn-guardar, .btn-cancelar, .prod-toolbar,
           .prod-toolbar-left, .prod-breadcrumb — todos ya definidos en el dashboard/productos */

        /* ── Inputs deshabilitados con apariencia de solo lectura ── */
        .form-field input:disabled,
        .form-field textarea:disabled {
            background-color: var(--bg-body);
            color: var(--text-primary);
            border-color: var(--border-color);
            cursor: default;
            opacity: 1;
        }

        body.dark-mode .form-field input:disabled,
        body.dark-mode .form-field textarea:disabled {
            background-color: rgba(255,255,255,0.04);
        }

        /* ── Badge de estado (mismos colores que cotizaciones/index) ── */
        .estado-badge {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.5rem 1.3rem; border-radius: 2rem;
            font-size: 1.3rem; font-weight: 700; white-space: nowrap;
        }

        .estado-badge.pendiente  { background-color: rgba(240,165,0,0.12);  color: #b87a00; }
        .estado-badge.en_proceso { background-color: var(--AzulClaro);       color: var(--AzulOscuro); }
        .estado-badge.respondida { background-color: rgba(29,158,117,0.12);  color: #1a7a5c; }
        .estado-badge.cancelada  { background-color: rgba(226,75,74,0.1);    color: var(--error); }

        body.dark-mode .estado-badge.pendiente  { background-color: rgba(240,165,0,0.18);  color: var(--acentos); }
        body.dark-mode .estado-badge.en_proceso { background-color: rgba(33,150,186,0.18); color: var(--AzulSmtek); }
        body.dark-mode .estado-badge.respondida { background-color: rgba(29,158,117,0.2);  color: #2ecc9a; }
        body.dark-mode .estado-badge.cancelada  { background-color: rgba(226,75,74,0.18);  color: #ff7070; }

        /* ── Preview de estado en el panel lateral ── */
        .estado-preview {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.2rem 1.4rem;
            background-color: var(--bg-body);
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }

        .estado-preview-label {
            font-size: 1.3rem; color: var(--text-muted); font-weight: 500;
        }

        /* ── Filas de info (panel timestamps) ── */
        .info-row {
            display: flex; flex-direction: column; gap: 0.3rem;
            padding: 1.4rem 0;
            border-bottom: 1px solid var(--border-color);
            font-size: 1.4rem;
        }

        .info-row:first-child { padding-top: 0; }
        .info-row:last-child  { border-bottom: none; padding-bottom: 0; }

        .info-row strong {
            font-size: 1.2rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.06em;
            color: var(--text-muted);
        }

        .info-row span { color: var(--text-heading); font-weight: 500; }

        /* ── Flash de éxito ── */
        .flash-alert {
            display: flex; align-items: center; gap: 1.4rem;
            background-color: rgba(29,158,117,0.1);
            border-left: 4px solid var(--contrastes);
            border-radius: var(--radius-sm);
            padding: 1.4rem 1.8rem;
            box-shadow: var(--shadow-sm);
            margin-bottom: 0.4rem;
        }

        body.dark-mode .flash-alert { background-color: rgba(29,158,117,0.15); }

        .flash-alert p {
            font-size: 1.45rem; font-weight: 600;
            color: var(--contrastes); margin: 0;
        }

        /* ── Select con flecha custom ── */
        .form-field select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%23888' d='M1 1l5 5 5-5'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1.4rem center;
            padding-right: 3.6rem;
            cursor: pointer;
        }
    </style>

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
            <h1>Cotización #{{ $cotizacion->id }}</h1>
            <div class="prod-breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <span>›</span>
                <a href="{{ route('admin.cotizaciones.index') }}">Cotizaciones</a>
                <span>›</span>
                <span>Detalle</span>
            </div>
        </div>
        {{-- Badge del estado actual en el toolbar --}}
        <span class="estado-badge {{ $estadoSlug }}" id="badgeToolbar">
            {{ $estadoIcon }} {{ $estadoLabel }}
        </span>
    </div>

    {{-- Layout igual al de productos --}}
    <div class="create-layout">

        {{-- ── Columna izquierda: información ── --}}
        <div>
            <div class="panel">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Información del cliente</h2>
                        <p class="panel-subtitle">Datos enviados desde el formulario web</p>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-grid">

                        <div class="form-field">
                            <label>Nombre</label>
                            <input type="text" value="{{ $cotizacion->nombre }}" disabled>
                        </div>

                        <div class="form-field">
                            <label>Empresa</label>
                            <input type="text" value="{{ $cotizacion->empresa ?? '—' }}" disabled>
                        </div>

                        <div class="form-field">
                            <label>Correo</label>
                            <input type="text" value="{{ $cotizacion->correo }}" disabled>
                        </div>

                        <div class="form-field">
                            <label>Teléfono</label>
                            <input type="text" value="{{ $cotizacion->telefono ?? '—' }}" disabled>
                        </div>

                        <div class="form-field full">
                            <label>Asunto</label>
                            <input type="text" value="{{ $cotizacion->asunto }}" disabled>
                        </div>

                        <div class="form-field full">
                            <label>Mensaje</label>
                            <textarea rows="8" disabled>{{ $cotizacion->mensaje }}</textarea>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- ── Columna derecha: estado + timestamps ── --}}
        <div>

            {{-- Panel: actualizar estado --}}
            <div class="panel">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Estado</h2>
                        <p class="panel-subtitle">Actualiza el seguimiento de la solicitud</p>
                    </div>
                </div>
                <div class="panel-body">

                    {{-- Preview del badge en tiempo real --}}
                    <div class="estado-preview">
                        <span class="estado-badge {{ $estadoSlug }}" id="badgePreview">
                            {{ $estadoIcon }} {{ $estadoLabel }}
                        </span>
                        <span class="estado-preview-label">Estado actual</span>
                    </div>

                    <form
                        method="POST"
                        action="{{ route('admin.cotizaciones.update', $cotizacion) }}"
                    >
                        @csrf
                        @method('PUT')

                        <div class="form-field">
                            <label>Estado</label>
                            <select name="estado" id="selectEstado">
                                <option value="pendiente"
                                    @selected($cotizacion->estado === 'pendiente')>
                                    ⏳ Pendiente
                                </option>
                                <option value="en_proceso"
                                    @selected($cotizacion->estado === 'en_proceso')>
                                    🔍 En proceso
                                </option>
                                <option value="respondida"
                                    @selected($cotizacion->estado === 'respondida')>
                                    ✅ Respondida
                                </option>
                                <option value="cancelada"
                                    @selected($cotizacion->estado === 'cancelada')>
                                    ❌ Cancelada
                                </option>
                            </select>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-guardar">
                                💾 Guardar estado
                            </button>
                            <a href="{{ route('admin.cotizaciones.index') }}" class="btn-cancelar">
                                Volver
                            </a>
                        </div>

                    </form>
                </div>
            </div>

            {{-- Panel: timestamps --}}
            <div class="panel" style="margin-top:2rem;">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Información</h2>
                        <p class="panel-subtitle">Datos de registro</p>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="info-row">
                        <strong>ID</strong>
                        <span>#{{ $cotizacion->id }}</span>
                    </div>
                    <div class="info-row">
                        <strong>Fecha de recepción</strong>
                        <span>{{ $cotizacion->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="info-row">
                        <strong>Última actualización</strong>
                        <span>{{ $cotizacion->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>

        </div>{{-- /columna derecha --}}

    </div>{{-- /.create-layout --}}

    {{-- ── JS: solo el preview del badge, el dark mode y sidebar ya están en el layout ── --}}
    <script>
        (function () {
            const select  = document.getElementById('selectEstado');
            const badges  = [
                document.getElementById('badgePreview'),
                document.getElementById('badgeToolbar'),
            ];

            const config = {
                pendiente:  { icon: '⏳', label: 'Pendiente',  cls: 'pendiente'  },
                en_proceso: { icon: '🔍', label: 'En proceso', cls: 'en_proceso' },
                respondida: { icon: '✅', label: 'Respondida', cls: 'respondida' },
                cancelada:  { icon: '❌', label: 'Cancelada',  cls: 'cancelada'  },
            };

            const clases = Object.values(config).map(c => c.cls);

            select?.addEventListener('change', function () {
                const c = config[this.value];
                if (!c) return;

                badges.forEach(badge => {
                    if (!badge) return;
                    badge.classList.remove(...clases);
                    badge.classList.add(c.cls);
                    badge.textContent = c.icon + ' ' + c.label;
                });
            });
        })();
    </script>

</x-admin.layout>
</x-app-layout>
