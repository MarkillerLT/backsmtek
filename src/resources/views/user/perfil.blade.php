<x-app-layout>
    <style>
        /* ══════════════════════════════════════════════════
           ESTRUCTURA BASE — sidebar + topbar + contenido
        ══════════════════════════════════════════════════ */
        body { overflow: hidden; }
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
        /* ── Dark mode toggle (topbar) ── */
        .dark-toggle {
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 2rem;
            background-color: var(--bg-section-alt, var(--bg-body));
            box-shadow: var(--shadow-sm);
            transition: background-color var(--transition), box-shadow var(--transition);
        }
        .dark-toggle:hover { box-shadow: var(--shadow-md); }
        .toggle-label {
            font-size: 1.3rem;
            font-weight: 500;
            color: var(--text-primary);
        }
        .toggle-track {
            width: 4rem;
            height: 2.2rem;
            background-color: var(--border-color);
            border-radius: 1.1rem;
            position: relative;
            transition: background-color var(--transition);
        }
        body.dark-mode .toggle-track { background-color: var(--AzulSmtek); }
        .toggle-thumb {
            width: 1.6rem;
            height: 1.6rem;
            background: var(--blanco);
            border-radius: 50%;
            position: absolute;
            top: 0.3rem;
            left: 0.3rem;
            transition: transform var(--transition);
            box-shadow: 0 1px 4px rgba(0,0,0,0.2);
        }
        body.dark-mode .toggle-thumb { transform: translateX(1.8rem); }
        .toggle-icon { font-size: 1.6rem; line-height: 1; }

        /* ══════════════════════════════════════════════════
           MI PERFIL — contenido
        ══════════════════════════════════════════════════ */
        .perfil-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1.6rem;
        }
        .perfil-toolbar h1 {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text-heading);
            margin: 0 0 0.3rem;
        }
        .perfil-toolbar p {
            font-size: 1.3rem;
            color: var(--text-muted);
            margin: 0;
        }

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
        .panel-body {
            padding: 2.8rem 2.4rem;
        }

        /* ── Flash de éxito ── */
        .flash-alert {
            display: flex;
            align-items: center;
            gap: 1.4rem;
            background-color: rgba(29,158,117,0.1);
            border-left: 4px solid var(--contrastes);
            border-radius: var(--radius-sm);
            padding: 1.4rem 1.8rem;
            box-shadow: var(--shadow-sm);
            margin-bottom: 2.4rem;
        }
        body.dark-mode .flash-alert { background-color: rgba(29,158,117,0.15); }
        .flash-alert p {
            font-size: 1.45rem;
            font-weight: 600;
            color: var(--contrastes);
            margin: 0;
        }

        /* ── Errores de validación ── */
        .error-block {
            background-color: rgba(226,75,74,0.08);
            border-left: 4px solid var(--error);
            border-radius: var(--radius-sm);
            padding: 1.8rem 2.2rem;
            margin-bottom: 2.4rem;
        }
        .error-block ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }
        .error-block li {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-size: 1.35rem;
            color: var(--error);
        }
        .error-block li::before {
            content: "⚠";
            flex-shrink: 0;
        }

        /* ── Sección de foto de perfil ── */
        .foto-perfil-row {
            display: flex;
            align-items: center;
            gap: 2.4rem;
            padding-bottom: 2.8rem;
            margin-bottom: 2.8rem;
            border-bottom: 1px solid var(--border-color);
            flex-wrap: wrap;
        }
        .foto-perfil-preview {
            width: 9rem;
            height: 9rem;
            border-radius: 50%;
            border: 3px solid var(--AzulSmtek);
            box-shadow: var(--shadow-md);
            background-color: var(--AzulClaro);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 800;
            color: var(--AzulOscuro);
            overflow: hidden;
            flex-shrink: 0;
        }
        .foto-perfil-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .foto-perfil-info {
            flex: 1;
            min-width: 22rem;
        }
        .foto-perfil-info label {
            display: block;
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.8rem;
            letter-spacing: 0.02em;
        }
        .file-input-wrap {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 1rem;
        }
        .file-input-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            padding: 1rem 2rem;
            background-color: var(--bg-body);
            border: 1.5px dashed var(--border-color);
            color: var(--text-primary);
            border-radius: var(--radius-sm);
            font-size: 1.35rem;
            font-weight: 600;
            cursor: pointer;
            transition: border-color var(--transition), background-color var(--transition), color var(--transition);
        }
        .file-input-btn:hover {
            border-color: var(--AzulSmtek);
            color: var(--AzulSmtek);
        }
        .foto-perfil-info input[type="file"] {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        .foto-perfil-hint {
            font-size: 1.2rem;
            color: var(--text-muted);
            margin-top: 0.8rem;
        }
        .foto-perfil-filename {
            font-size: 1.3rem;
            color: var(--AzulSmtek);
            font-weight: 600;
            margin-top: 0.8rem;
            display: none;
        }
        .foto-perfil-filename.activo { display: block; }

        /* ── Campos del formulario ── */
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
            letter-spacing: 0.02em;
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
        body.dark-mode .form-field input {
            background-color: #1e2d3e;
            color: var(--text-heading);
            border-color: var(--border-color);
        }
        .form-field input:focus {
            border-color: var(--AzulSmtek);
            box-shadow: 0 0 0 3px rgba(33,150,186,0.18);
        }

        .form-actions {
            display: flex;
            align-items: center;
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

        /* ══════════════════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════════════════ */
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
            .foto-perfil-row { flex-direction: column; align-items: flex-start; }
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

    <x-user.layout title="Mi perfil">

        <div class="perfil-toolbar">
            <div>
                <h1>Mi perfil</h1>
                <p>Actualiza tu información personal y foto de perfil</p>
            </div>
        </div>

        @if (session('success'))
            <div class="flash-alert">
                <span style="font-size:2rem;">✅</span>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="error-block">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="panel">
            <div class="panel-header">
                <h2 class="panel-title">Información de la cuenta</h2>
                <p class="panel-subtitle">Estos datos son visibles en tu perfil</p>
            </div>

            <div class="panel-body">
                <form
                    method="POST"
                    action="{{ route('profile.update') }}"
                    enctype="multipart/form-data"
                    id="perfilForm"
                >
                    @csrf
                    @method('PATCH')

                    {{-- Foto de perfil --}}
                    <div class="foto-perfil-row">
                        <div class="foto-perfil-preview" id="fotoPreview">
                            @if (Auth::user()->profile_photo_url)
                                <img
                                    src="{{ Auth::user()->profile_photo_url }}"
                                    alt="{{ Auth::user()->name }}"
                                    id="fotoPreviewImg"
                                >
                            @else
                                <span id="fotoPreviewInicial">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            @endif
                        </div>

                        <div class="foto-perfil-info">
                            <label for="photo">Foto de perfil</label>
                            <div class="file-input-wrap">
                                <span class="file-input-btn">📷 Cambiar foto</span>
                                <input
                                    type="file"
                                    id="photo"
                                    name="photo"
                                    accept="image/jpeg,image/png,image/webp"
                                >
                            </div>
                            <p class="foto-perfil-hint">JPG, PNG o WEBP.</p>
                            <p class="foto-perfil-filename" id="fotoFilename"></p>
                        </div>
                    </div>

                    {{-- Datos --}}
                    <div class="form-grid">
                        <div class="form-field">
                            <label for="name">Nombre</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', Auth::user()->name) }}"
                                required
                            >
                        </div>

                        <div class="form-field">
                            <label for="email">Correo electrónico</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', Auth::user()->email) }}"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-guardar">💾 Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const input = document.getElementById('photo');
                const preview = document.getElementById('fotoPreview');
                const filename = document.getElementById('fotoFilename');

                input.addEventListener('change', function () {
                    const file = this.files[0];
                    if (!file) return;

                    filename.textContent = file.name;
                    filename.classList.add('activo');

                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.innerHTML = '<img src="' + e.target.result + '" alt="Vista previa">';
                    };
                    reader.readAsDataURL(file);
                });
            });
        </script>

    </x-user.layout>
</x-app-layout>
