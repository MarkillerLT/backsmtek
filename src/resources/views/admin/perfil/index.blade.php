<x-app-layout>
{{--
|--------------------------------------------------------------------------
| Vista: admin/perfil.blade.php — Mi perfil SMTEK
| Misma estructura del dashboard y cotizaciones/index
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
           PÁGINA: MI PERFIL
        ══════════════════════════════════════════════ */
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
        .panel-body { padding: 2.4rem; }

        /* ── Sección de foto de perfil ── */
        .perfil-foto-section {
            display: flex;
            align-items: center;
            gap: 2rem;
            padding-bottom: 2.4rem;
            margin-bottom: 2.4rem;
            border-bottom: 1px solid var(--border-color);
            flex-wrap: wrap;
        }
        .perfil-foto {
            width: 9rem;
            height: 9rem;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--AzulSmtek);
            box-shadow: var(--shadow-sm);
            flex-shrink: 0;
        }
        .perfil-foto-info label {
            display: block;
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.6rem;
        }
        .perfil-foto-info input[type="file"] {
            font-size: 1.3rem;
            color: var(--text-muted);
            font-family: "Inter", sans-serif;
        }
        .perfil-foto-info input[type="file"]::file-selector-button {
            padding: 0.8rem 1.6rem;
            margin-right: 1.2rem;
            border-radius: var(--radius-sm);
            border: 1.5px solid var(--border-color);
            background-color: var(--bg-body);
            color: var(--text-primary);
            font-size: 1.3rem;
            font-weight: 600;
            font-family: "Inter", sans-serif;
            cursor: pointer;
            transition: background-color var(--transition), border-color var(--transition);
        }
        .perfil-foto-info input[type="file"]::file-selector-button:hover {
            background-color: var(--AzulClaro);
            border-color: var(--AzulSmtek);
        }

        /* ── Form grid ── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.8rem;
        }
        .form-field {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }
        .form-field label {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-primary);
        }
        .form-field input {
            width: 100%;
            padding: 1.2rem 1.6rem;
            font-size: 1.5rem;
            font-family: "Inter", sans-serif;
            color: var(--text-primary);
            background-color: var(--blanco);
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-sm);
            outline: none;
            transition: border-color var(--transition), box-shadow var(--transition);
        }
        body.dark-mode .form-field input { background-color: #1e2d3e; color: var(--text-heading); }
        .form-field input:focus {
            border-color: var(--AzulSmtek);
            box-shadow: 0 0 0 3px rgba(33,150,186,0.18);
        }
        .field-error {
            font-size: 1.2rem;
            color: var(--error);
        }

        /* ── Botones ── */
        .form-actions {
            display: flex;
            gap: 1.2rem;
            padding-top: 2.4rem;
            margin-top: 2.4rem;
            border-top: 1px solid var(--border-color);
        }
        .btn-guardar {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            padding: 1.2rem 2.8rem;
            background-color: var(--AzulSmtek);
            color: var(--blanco);
            border: none;
            border-radius: var(--radius-sm);
            font-size: 1.5rem;
            font-weight: 700;
            cursor: pointer;
            font-family: "Inter", sans-serif;
            transition: background-color var(--transition), transform var(--transition), box-shadow var(--transition);
            box-shadow: var(--shadow-sm);
        }
        .btn-guardar:hover {
            background-color: var(--AzulOscuro);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* ── Alertas ── */
        .alert {
            padding: 1.2rem 1.6rem;
            border-radius: var(--radius-sm);
            font-size: 1.4rem;
            font-weight: 600;
        }
        .alert-success {
            background-color: rgba(29,158,117,0.1);
            border: 1px solid rgba(29,158,117,0.3);
            color: #1a7a5c;
        }
        body.dark-mode .alert-success { color: #2ecc9a; }

        /* ══════════════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════════════ */
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
            .form-grid { grid-template-columns: 1fr; }
            .perfil-foto-section { flex-direction: column; align-items: flex-start; }
        }
        @media (max-width: 480px) {
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
        title="Mi perfil"
        :cotizacionesPendientes="$cotizacionesPendientes">

        <div class="prod-toolbar-left">
            <h1>Mi perfil</h1>
            <p>Actualiza tu información personal.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="panel">
            <div class="panel-header">
                <h2 class="panel-title">Información de la cuenta</h2>
                <p class="panel-subtitle">Estos datos son visibles en tu sesión de administrador</p>
            </div>

            <div class="panel-body">
                <form
                    action="{{ route('admin.perfil.update') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PATCH')

                    <div class="perfil-foto-section">
                        <img
                            src="{{ auth()->user()->profile_photo_url }}"
                            alt="Foto de perfil"
                            class="perfil-foto"
                        >
                        <div class="perfil-foto-info">
                            <label for="photo">Foto de perfil</label>
                            <input
                                type="file"
                                id="photo"
                                name="photo"
                                accept="image/jpeg,image/png,image/webp"
                            >
                            @error('photo')
                                <div class="field-error" style="margin-top: 0.6rem;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-field">
                            <label for="name">Nombre</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', auth()->user()->name) }}"
                                required
                            >
                            @error('name')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-field">
                            <label for="email">Correo electrónico</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', auth()->user()->email) }}"
                                required
                            >
                            @error('email')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-guardar">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-admin.layout>
</x-app-layout>
