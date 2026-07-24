<x-app-layout>
    <style>
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
           PÁGINA: AGREGAR PRODUCTO
        ══════════════════════════════════════════════ */

        /* ── Breadcrumb / toolbar ── */
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

        .prod-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 1.3rem;
            color: var(--text-muted);
        }

        .prod-breadcrumb a {
            color: var(--AzulSmtek);
            text-decoration: none;
            font-weight: 600;
            transition: color var(--transition);
        }

        .prod-breadcrumb a:hover { color: var(--AzulOscuro); }

        /* ── Layout: formulario + preview lateral ── */
        .create-layout {
            display: grid;
            grid-template-columns: 1fr 32rem;
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
            transition: background-color var(--transition);
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

        .panel-body { padding: 2.4rem; }

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

        .form-field.full { grid-column: 1 / -1; }

        .form-field label {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-primary);
            letter-spacing: 0.02em;
        }

        .field-req { color: var(--error); margin-left: 0.2rem; }

        .form-field input,
        .form-field textarea,
        .form-field select {
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
            resize: vertical;
        }

        body.dark-mode .form-field input,
        body.dark-mode .form-field textarea,
        body.dark-mode .form-field select {
            background-color: #1e2d3e;
            color: var(--text-heading);
            border-color: var(--border-color);
        }

        .form-field input:focus,
        .form-field textarea:focus,
        .form-field select:focus {
            border-color: var(--AzulSmtek);
            box-shadow: 0 0 0 3px rgba(33,150,186,0.18);
        }

        /* Prefijo $ en precio */
        .input-prefix-wrap {
            display: flex;
            align-items: center;
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-sm);
            overflow: hidden;
            background-color: var(--blanco);
            transition: border-color var(--transition), box-shadow var(--transition);
        }

        body.dark-mode .input-prefix-wrap { background-color: #1e2d3e; }

        .input-prefix-wrap:focus-within {
            border-color: var(--AzulSmtek);
            box-shadow: 0 0 0 3px rgba(33,150,186,0.18);
        }

        .input-prefix {
            padding: 1.2rem 1.4rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-muted);
            background-color: var(--bg-body);
            border-right: 1.5px solid var(--border-color);
            flex-shrink: 0;
            user-select: none;
        }

        .input-prefix-wrap input {
            border: none !important;
            box-shadow: none !important;
            border-radius: 0 !important;
            flex: 1;
        }

        .input-prefix-wrap input:focus { box-shadow: none !important; }

        /* Error de validación */
        .field-error {
            font-size: 1.2rem;
            color: var(--error);
        }

        /* ── Dropzone imagen ── */
        .img-dropzone {
            position: relative;
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-sm);
            background-color: var(--blanco);
            padding: 3rem 2rem;
            cursor: pointer;
            transition: border-color var(--transition), background-color var(--transition), box-shadow var(--transition);
            text-align: center;
        }

        body.dark-mode .img-dropzone { background-color: #1e2d3e; }

        .img-dropzone:hover,
        .img-dropzone.drag-over {
            border-color: var(--AzulSmtek);
            background-color: var(--AzulClaro);
            box-shadow: 0 0 0 3px rgba(33,150,186,0.18);
        }

        body.dark-mode .img-dropzone:hover,
        body.dark-mode .img-dropzone.drag-over {
            background-color: rgba(33,150,186,0.1);
        }

        .img-input-hidden {
            position: absolute;
            inset: 0;
            width: 100% !important;
            height: 100% !important;
            opacity: 0;
            cursor: pointer;
            padding: 0 !important;
            border: none !important;
            box-shadow: none !important;
            z-index: 2;
        }

        .img-dropzone-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.6rem;
            pointer-events: none;
        }

        .img-dz-icon  { font-size: 3rem; }
        .img-dz-label { font-size: 1.4rem; color: var(--text-primary); font-weight: 500; }
        .img-dz-hint  { font-size: 1.2rem; color: var(--text-muted); }

        /* ── Panel lateral: preview imagen ── */
        .preview-panel {}

        .preview-img-wrap {
            width: 100%;
            aspect-ratio: 1;
            border-radius: var(--radius-sm);
            overflow: hidden;
            border: 1px solid var(--border-color);
            background-color: var(--bg-body);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.6rem;
        }

        .preview-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .preview-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.8rem;
            color: var(--text-muted);
        }

        .preview-placeholder span:first-child { font-size: 4rem; }
        .preview-placeholder span:last-child  { font-size: 1.3rem; }

        /* Info del archivo seleccionado */
        .preview-file-info {
            display: none;
            align-items: center;
            gap: 1rem;
            padding: 1.2rem 1.4rem;
            background-color: var(--bg-body);
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 1.4rem;
        }

        .preview-file-info.visible { display: flex; }

        .preview-file-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-heading);
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .preview-file-size {
            font-size: 1.2rem;
            color: var(--text-muted);
            flex-shrink: 0;
        }

        .btn-quitar-img {
            background: none;
            border: none;
            color: var(--error);
            font-size: 1.5rem;
            cursor: pointer;
            flex-shrink: 0;
            transition: transform var(--transition);
        }

        .btn-quitar-img:hover { transform: scale(1.2); }

        /* ── Botones de acción ── */
        .form-actions {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            flex-wrap: wrap;
            padding-top: 0.4rem;
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

        .btn-cancelar {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            padding: 1.2rem 2.2rem;
            background: none;
            border: 1.5px solid var(--border-color);
            color: var(--text-primary);
            border-radius: var(--radius-sm);
            font-size: 1.5rem;
            font-weight: 600;
            text-decoration: none;
            transition: background-color var(--transition), border-color var(--transition);
        }

        .btn-cancelar:hover {
            background-color: var(--bg-body);
            border-color: var(--text-muted);
        }

        /* ══════════════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════════════ */
        @media (max-width: 1100px) {
            .create-layout {
                grid-template-columns: 1fr;
            }

            .preview-img-wrap {
                max-width: 28rem;
                margin-inline: auto;
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

            .admin-sidebar.abierto { left: 0; }
            .admin-topbar  { padding: 0 2rem; }
            .admin-content { padding: 2rem; }
            .topbar-title  { display: none; }
            .sidebar-toggle-btn { display: flex !important; }
        }

        @media (max-width: 600px) {
            .form-grid { grid-template-columns: 1fr; }
            .form-field.full { grid-column: unset; }
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
        title="Agregar Producto"
        :cotizacionesPendientes="$cotizacionesPendientes">
                {{-- Layout: formulario + preview --}}
        <div class="create-layout">
                {{-- Toolbar: título + breadcrumb --}}
                {{-- Layout: form + preview --}}
                {{-- ── Columna izquierda: formulario ── --}}
                    <form
                        action="{{ route('admin.productos.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        id="formProducto"
                        novalidate
                    >
                        @csrf

                        {{-- Panel: información general --}}
                        <div class="panel" style="margin-bottom:2.4rem;">
                            <div class="panel-header">
                                <div>
                                    <h2 class="panel-title">Información general</h2>
                                    <p class="panel-subtitle">Datos básicos del producto</p>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-grid">

                                    {{-- Nombre --}}
                                    <div class="form-field full">
                                        <label for="nombre">Nombre del producto <span class="field-req">*</span></label>
                                        <input
                                            type="text"
                                            id="nombre"
                                            name="nombre"
                                            value="{{ old('nombre') }}"
                                            placeholder="Ej. Sensor de proximidad Banner"
                                            required
                                            autofocus
                                        />
                                        @error('nombre')
                                            <span class="field-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Clasificación --}}
                                    <div class="form-field">
                                        <label for="clasificacion">Clasificación</label>
                                        <input
                                            type="text"
                                            id="clasificacion"
                                            name="clasificacion"
                                            value="{{ old('clasificacion') }}"
                                            placeholder="Ej. Sensores industriales"
                                        />
                                        @error('clasificacion')
                                            <span class="field-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Precio --}}
                                    <div class="form-field">
                                        <label for="precio">Precio <span class="field-req">*</span></label>
                                        <div class="input-prefix-wrap">
                                            <span class="input-prefix">$</span>
                                            <input
                                                type="number"
                                                id="precio"
                                                name="precio"
                                                step="0.01"
                                                min="0"
                                                value="{{ old('precio') }}"
                                                placeholder="0.00"
                                                required
                                            />
                                        </div>
                                        @error('precio')
                                            <span class="field-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Stock --}}
                                    <div class="form-field">
                                        <label for="stock">Stock <span class="field-req">*</span></label>
                                        <input
                                            type="number"
                                            id="stock"
                                            name="stock"
                                            min="0"
                                            value="{{ old('stock', 0) }}"
                                            placeholder="0"
                                            required
                                        />
                                        @error('stock')
                                            <span class="field-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Descripción --}}
                                    <div class="form-field full">
                                        <label for="descripcion">Descripción</label>
                                        <textarea
                                            id="descripcion"
                                            name="descripcion"
                                            rows="4"
                                            placeholder="Describe el producto: características, aplicaciones, especificaciones técnicas..."
                                        >{{ old('descripcion') }}</textarea>
                                        @error('descripcion')
                                            <span class="field-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>{{-- /.form-grid --}}
                            </div>
                        </div>

                        {{-- Panel: imagen --}}
                        <div class="panel" style="margin-bottom:2.4rem;">
                            <div class="panel-header">
                                <div>
                                    <h2 class="panel-title">Imagen del producto</h2>
                                    <p class="panel-subtitle">JPG, PNG o WEBP · Máx. 2 MB</p>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="img-dropzone" id="imgDropzone">
                                    <input
                                        type="file"
                                        id="imagen"
                                        name="imagen"
                                        accept="image/*"
                                        class="img-input-hidden"
                                    />
                                    <div class="img-dropzone-content" id="imgContent">
                                        <span class="img-dz-icon">🖼️</span>
                                        <span class="img-dz-label">Arrastra la imagen aquí o <u>haz clic para seleccionar</u></span>
                                        <span class="img-dz-hint">JPG, PNG, WEBP · Máx. 2 MB</span>
                                    </div>
                                </div>
                                @error('imagen')
                                    <span class="field-error" style="margin-top:0.6rem;display:block;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Botones --}}
                        <div class="form-actions">
                            <button type="submit" class="btn-guardar">
                                💾 Guardar producto
                            </button>
                            <a href="{{ route('admin.productos.index') }}" class="btn-cancelar">
                                ✕ Cancelar
                            </a>
                        </div>

                    </form>

                    {{-- ── Columna derecha: preview ── --}}
                    <div>
                        <div class="panel preview-panel">
                            <div class="panel-header">
                                <div>
                                    <h2 class="panel-title">Vista previa</h2>
                                    <p class="panel-subtitle">Así se verá la imagen</p>
                                </div>
                            </div>
                            <div class="panel-body">

                                {{-- Info del archivo --}}
                                <div class="preview-file-info" id="previewFileInfo">
                                    <span style="font-size:1.6rem;">🖼️</span>
                                    <span class="preview-file-name" id="previewFileName"></span>
                                    <span class="preview-file-size" id="previewFileSize"></span>
                                    <button type="button" class="btn-quitar-img" id="btnQuitarImg" aria-label="Quitar imagen">✕</button>
                                </div>

                                {{-- Preview de la imagen --}}
                                <div class="preview-img-wrap" id="previewWrap">
                                    <div class="preview-placeholder" id="previewPlaceholder">
                                        <span>📷</span>
                                        <span>Sin imagen seleccionada</span>
                                    </div>
                                    <img id="previewImg" src="" alt="Preview" style="display:none;" />
                                </div>

                                {{-- Resumen del producto --}}
                                <div style="border-top:1px solid var(--border-color);padding-top:1.8rem;margin-top:0.4rem;">
                                    <p style="font-size:1.2rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--text-muted);margin:0 0 1.2rem;">Resumen</p>
                                    <div style="display:flex;flex-direction:column;gap:1rem;">
                                        <div style="display:flex;justify-content:space-between;font-size:1.4rem;">
                                            <span style="color:var(--text-muted);">Nombre</span>
                                            <span id="resNombre" style="font-weight:600;color:var(--text-heading);text-align:right;max-width:16rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">—</span>
                                        </div>
                                        <div style="display:flex;justify-content:space-between;font-size:1.4rem;">
                                            <span style="color:var(--text-muted);">Clasificación</span>
                                            <span id="resClasif" style="font-weight:600;color:var(--text-heading);">—</span>
                                        </div>
                                        <div style="display:flex;justify-content:space-between;font-size:1.4rem;">
                                            <span style="color:var(--text-muted);">Precio</span>
                                            <span id="resPrecio" style="font-weight:700;color:var(--contrastes);">—</span>
                                        </div>
                                        <div style="display:flex;justify-content:space-between;font-size:1.4rem;">
                                            <span style="color:var(--text-muted);">Stock</span>
                                            <span id="resStock" style="font-weight:600;color:var(--text-heading);">—</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                            </div>{{-- /.create-layout --}}
                             </x-admin.layout>
</x-app-layout>
