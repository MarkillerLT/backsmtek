<x-app-layout>
    <style>
        body { overflow: hidden; }

        /* ══════════════════════════════════════════════
           ESTRUCTURA — copiada del dashboard
        ══════════════════════════════════════════════ */
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

        /* ── Área principal ── */
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

        .topbar-username {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-heading);
        }

        .topbar-role {
            font-size: 1.2rem;
            color: var(--text-muted);
        }

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
           PÁGINA: PRODUCTOS
        ══════════════════════════════════════════════ */

        /* ── Barra superior: título + botón agregar ── */
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

        .btn-agregar {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            padding: 1.1rem 2.2rem;
            background-color: var(--AzulSmtek);
            color: var(--blanco);
            border-radius: var(--radius-sm);
            font-size: 1.45rem;
            font-weight: 700;
            text-decoration: none;
            transition: background-color var(--transition), transform var(--transition), box-shadow var(--transition);
            box-shadow: var(--shadow-sm);
            white-space: nowrap;
        }

        .btn-agregar:hover {
            background-color: var(--AzulOscuro);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* ── Panel tabla ── */
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

        /* ── Búsqueda rápida ── */
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

        body.dark-mode .prod-search {
            background-color: #1e2d3e;
        }

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
        .prod-table-wrap {
            overflow-x: auto;
        }

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

        /* ID */
        .prod-id {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-muted);
            font-family: monospace;
        }

        /* Imagen del producto */
        .prod-img-wrap {
            width: 6.4rem;
            height: 6.4rem;
            border-radius: var(--radius-sm);
            overflow: hidden;
            border: 1px solid var(--border-color);
            background-color: var(--bg-body);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .prod-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .prod-img-empty {
            font-size: 1.1rem;
            color: var(--text-muted);
            text-align: center;
            padding: 0.4rem;
            line-height: 1.3;
        }

        /* Nombre */
        .prod-nombre {
            font-weight: 700;
            color: var(--text-heading);
        }

        /* Clasificación badge */
        .prod-clasif {
            display: inline-block;
            padding: 0.35rem 1rem;
            border-radius: 2rem;
            font-size: 1.2rem;
            font-weight: 600;
            background-color: var(--AzulClaro);
            color: var(--AzulOscuro);
            white-space: nowrap;
        }

        body.dark-mode .prod-clasif {
            background-color: rgba(33,150,186,0.18);
            color: var(--AzulSmtek);
        }

        /* Precio */
        .prod-precio {
            font-weight: 700;
            color: var(--contrastes);
            white-space: nowrap;
        }

        /* Stock */
        .prod-stock {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
        }

        .prod-stock.ok   { color: var(--contrastes); }
        .prod-stock.bajo { color: var(--acentos); }
        .prod-stock.cero { color: var(--error); }

        /* Acciones */
        .prod-acciones {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .btn-editar {
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

        .btn-editar:hover {
            background-color: rgba(33,150,186,0.2);
            transform: translateY(-1px);
        }

        .btn-eliminar {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.7rem 1.4rem;
            background-color: rgba(226,75,74,0.08);
            border: 1px solid rgba(226,75,74,0.25);
            color: var(--error);
            border-radius: var(--radius-sm);
            font-size: 1.3rem;
            font-weight: 600;
            cursor: pointer;
            font-family: "Inter", sans-serif;
            transition: background-color var(--transition), transform var(--transition);
            white-space: nowrap;
        }

        .btn-eliminar:hover {
            background-color: rgba(226,75,74,0.18);
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

        /* ══════════════════════════════════════════════
           MODAL DE CONFIRMACIÓN DE ELIMINAR
        ══════════════════════════════════════════════ */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(3px);
            z-index: 999;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.activo { display: flex; }

        .modal-box {
            background-color: var(--bg-section);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            padding: 3.6rem;
            width: min(44rem, 90vw);
            border: 1px solid var(--border-color);
            text-align: center;
            animation: modalIn 0.2s ease;
        }

        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.95) translateY(8px); }
            to   { opacity: 1; transform: scale(1)    translateY(0); }
        }

        .modal-icon  { font-size: 4rem; margin-bottom: 1.4rem; }
        .modal-title { font-size: 2rem; font-weight: 800; color: var(--text-heading); margin: 0 0 0.8rem; }
        .modal-desc  { font-size: 1.45rem; color: var(--text-muted); margin: 0 0 2.8rem; line-height: 1.6; }

        .modal-actions {
            display: flex;
            gap: 1.2rem;
            justify-content: center;
        }

        .btn-modal-cancel {
            padding: 1rem 2.4rem;
            border-radius: var(--radius-sm);
            border: 1.5px solid var(--border-color);
            background: none;
            color: var(--text-primary);
            font-size: 1.45rem;
            font-weight: 600;
            cursor: pointer;
            font-family: "Inter", sans-serif;
            transition: background-color var(--transition);
        }

        .btn-modal-cancel:hover { background-color: var(--bg-body); }

        .btn-modal-confirm {
            padding: 1rem 2.4rem;
            border-radius: var(--radius-sm);
            border: none;
            background-color: var(--error);
            color: #fff;
            font-size: 1.45rem;
            font-weight: 700;
            cursor: pointer;
            font-family: "Inter", sans-serif;
            transition: background-color var(--transition), transform var(--transition);
        }

        .btn-modal-confirm:hover {
            background-color: #c0392b;
            transform: translateY(-1px);
        }

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

            .admin-topbar { padding: 0 2rem; }
            .admin-content { padding: 2rem; }
            .topbar-title  { display: none; }
            .sidebar-toggle-btn { display: flex !important; }
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
        title="Productos"
        :cotizacionesPendientes="$cotizacionesPendientes">

        {{-- ── Toolbar: título + botón agregar ── --}}
        <div class="prod-toolbar">
            <div class="prod-toolbar-left">
                <h1>Productos</h1>
                <p>Gestiona el catálogo de productos de SMTEK</p>
            </div>

            <a href="{{ route('admin.productos.create') }}" class="btn-agregar">
                ＋ Agregar producto
            </a>
        </div>

        {{-- Panel --}}
        <div class="panel">

            <div class="panel-header">

                <div>
                    <h2 class="panel-title">Catálogo</h2>

                    <p class="panel-count">
                        {{ $productos->count() }}
                        {{ $productos->count() == 1 ? 'producto registrado' : 'productos registrados' }}
                    </p>
                </div>

                <div class="prod-search">
                    <span>🔍</span>

                    <input
                        type="text"
                        id="buscarProducto"
                        placeholder="Buscar producto..."
                        autocomplete="off">
                </div>

            </div>

            <div class="prod-table-wrap">

                <table class="prod-table" id="tablaProductos">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Clasificación</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($productos as $producto)

                            <tr>

                                <td>
                                    <span class="prod-id">
                                        #{{ $producto->id }}
                                    </span>
                                </td>

                                <td>
                                    <div class="prod-img-wrap">

                                        @if($producto->imagen)

                                            <img
                                                src="{{ asset('storage/'.$producto->imagen) }}"
                                                alt="{{ $producto->nombre }}">

                                        @else

                                            <span class="prod-img-empty">
                                                Sin imagen
                                            </span>

                                        @endif

                                    </div>
                                </td>

                                <td>
                                    <span class="prod-nombre">
                                        {{ $producto->nombre }}
                                    </span>
                                </td>

                                <td>
                                    <span class="prod-clasif">
                                        {{ $producto->clasificacion }}
                                    </span>
                                </td>

                                <td>
                                    <span class="prod-precio">
                                        ${{ number_format($producto->precio,2) }}
                                    </span>
                                </td>

                                <td>

                                    @if($producto->stock <= 0)

                                        <span class="prod-stock cero">
                                            🔴 Agotado
                                        </span>

                                    @elseif($producto->stock <=5)

                                        <span class="prod-stock bajo">
                                            🟡 {{ $producto->stock }}
                                        </span>

                                    @else

                                        <span class="prod-stock ok">
                                            🟢 {{ $producto->stock }}
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="prod-acciones">

                                        <a
                                            href="{{ route('admin.productos.edit',$producto) }}"
                                            class="btn-editar">

                                            ✏️ Editar

                                        </a>

                                        <button
                                            type="button"
                                            class="btn-eliminar"
                                            onclick="abrirModal('{{ $producto->id }}','{{ addslashes($producto->nombre) }}')">

                                            🗑 Eliminar

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="prod-empty">

                                    <span class="prod-empty-icon">
                                        📭
                                    </span>

                                    <div class="prod-empty-msg">
                                        No hay productos registrados
                                    </div>

                                    <div class="prod-empty-sub">

                                        <a
                                            href="{{ route('admin.productos.create') }}"
                                            style="color:var(--AzulSmtek);font-weight:700;">

                                            Agrega el primero aquí

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- Modal --}}
        <div class="modal-overlay" id="modalEliminar">

            <div class="modal-box">

                <div class="modal-icon">
                    🗑️
                </div>

                <h3 class="modal-title">
                    ¿Eliminar producto?
                </h3>

                <p class="modal-desc" id="modalDesc">
                    Esta acción no se puede deshacer.
                </p>

                <div class="modal-actions">

                    <button
                        type="button"
                        class="btn-modal-cancel"
                        onclick="cerrarModal()">

                        Cancelar

                    </button>

                    <form
                        id="formEliminar"
                        method="POST">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn-modal-confirm">

                            Sí, eliminar

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </x-admin.layout>
</x-app-layout>
