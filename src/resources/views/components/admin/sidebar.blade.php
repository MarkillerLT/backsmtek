{{-- Overlay mobile --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="admin-sidebar" id="adminSidebar">

    <a href="/">
        <div class="logo">
            <img
                id="logo-img"
                src="{{ asset('assets/img/1.svg') }}"
                alt="SMTEK Logo"
                onerror="
                this.style.display='none';
                document.getElementById('logo-fallback').style.display='flex';"
            >

            <div id="logo-fallback"
                class="logo-placeholder"
                style="display:none;">
                SMTEK
            </div>
        </div>
    </a>

    <nav class="sidebar-nav">

        <div class="sidebar-label">
            Principal
        </div>

        <a href="{{ route('admin.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.index') ? 'activo' : '' }}">
            <span class="s-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><title xmlns="">dashboard-outline</title><path fill="currentColor" d="M13.5 9V4H20v5zM4 12V4h6.5v8zm9.5 8v-8H20v8zM4 20v-5h6.5v5zm1-9h4.5V5H5zm9.5 8H19v-6h-4.5zm0-11H19V5h-4.5zM5 19h4.5v-3H5zm4.5-3"/>
                </svg>
            </span>
            Dashboard
        </a>

        <a href="#" class="sidebar-link">
            <span class="s-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><title xmlns="">user</title><path fill="currentColor" d="M15.71 12.71a6 6 0 1 0-7.42 0a10 10 0 0 0-6.22 8.18a1 1 0 0 0 2 .22a8 8 0 0 1 15.9 0a1 1 0 0 0 1 .89h.11a1 1 0 0 0 .88-1.1a10 10 0 0 0-6.25-8.19M12 12a4 4 0 1 1 4-4a4 4 0 0 1-4 4"/>
                </svg>
            </span>
            Perfil
        </a>

        <div class="sidebar-label">
            Gestión
        </div>

        <a href="{{ route('admin.productos.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.productos.*') ? 'activo' : '' }}">
            <span class="s-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><title xmlns="">box-broken</title><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5" d="M21.984 10c-.037-1.311-.161-2.147-.581-2.86c-.598-1.015-1.674-1.58-3.825-2.708l-2-1.05C13.822 2.461 12.944 2 12 2s-1.822.46-3.578 1.382l-2 1.05C4.271 5.56 3.195 6.125 2.597 7.14C2 8.154 2 9.417 2 11.942v.117c0 2.524 0 3.787.597 4.801c.598 1.015 1.674 1.58 3.825 2.709l2 1.049C10.178 21.539 11.056 22 12 22s1.822-.46 3.578-1.382l2-1.05c2.151-1.129 3.227-1.693 3.825-2.708c.42-.713.544-1.549.581-2.86M21 7.5l-4 2M12 12L3 7.5m9 4.5v9.5m0-9.5l4.5-2.25l.5-.25m0 0V13m0-3.5l-9.5-5"/>
                </svg>
            </span>
            Productos
        </a>

        <a href="{{ route('admin.cotizaciones.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.cotizaciones.*') ? 'activo' : '' }}">

            <span class="s-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 2048 2048"><title xmlns="">company-directory</title><path fill="currentColor" d="M1920 0v2048H256v-254H128v-128h128v-257H128v-128h128V769H128V641h128V385H128V257h128V0zm-128 128H384v1792h1408zm-128 384h-640V384h640zm0 256h-640V640h640zm-960 892q-39 0-73-14t-60-40t-40-60t-15-74q0-39 14-73t40-59t60-41t74-15q39 0 73 15t59 40t41 60t15 73q0 39-15 73t-40 60t-60 40t-73 15m0-256q-29 0-48 19t-20 49q0 29 19 48t49 20q29 0 48-19t20-49q0-29-19-48t-49-20m0-640q-39 0-73-14t-60-40t-40-60t-15-74q0-39 14-73t40-59t60-41t74-15q39 0 73 15t59 40t41 60t15 73q0 39-15 73t-40 60t-60 40t-73 15m0-256q-29 0-48 19t-20 49q0 29 19 48t49 20q29 0 48-19t20-49q0-29-19-48t-49-20m960 900h-640v-128h640zm0 256h-640v-128h640z"/>
                </svg>
            </span>

            Cotizaciones

            @if(($cotizacionesPendientes ?? 0) > 0)
                <span class="s-badge">
                    {{ $cotizacionesPendientes }}
                </span>
            @endif

        </a>

        <a href="#" class="sidebar-link">
            <span class="s-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><title xmlns="">user-search</title><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0-8 0M6 21v-2a4 4 0 0 1 4-4h1.5m3.5 3a3 3 0 1 0 6 0a3 3 0 1 0-6 0m5.2 2.2L22 22"/>
                </svg>
            </span>
            Prospectos
        </a>

        <a href="#" class="sidebar-link">
            <span class="s-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><title xmlns="">users</title><path fill="currentColor" d="M10 4a4 4 0 1 0 0 8a4 4 0 0 0 0-8M4 8a6 6 0 1 1 12 0A6 6 0 0 1 4 8m12.828-4.243a1 1 0 0 1 1.415 0a6 6 0 0 1 0 8.486a1 1 0 1 1-1.415-1.415a4 4 0 0 0 0-5.656a1 1 0 0 1 0-1.415m.702 13a1 1 0 0 1 1.212-.727c1.328.332 2.169 1.18 2.652 2.148c.468.935.606 1.98.606 2.822a1 1 0 1 1-2 0c0-.657-.112-1.363-.394-1.928c-.267-.533-.677-.934-1.349-1.102a1 1 0 0 1-.727-1.212zM6.5 18C5.24 18 4 19.213 4 21a1 1 0 1 1-2 0c0-2.632 1.893-5 4.5-5h7c2.607 0 4.5 2.368 4.5 5a1 1 0 1 1-2 0c0-1.787-1.24-3-2.5-3z"/>
                </svg>
            </span>
            Usuarios
        </a>

    </nav>

    <div class="sidebar-footer">

        <form method="POST"
            action="{{ route('logout') }}">

            @csrf

            <button
                type="submit"
                class="sidebar-link"
                style="width:100%;background:none;border:none;cursor:pointer;font-family:inherit;">

                <span class="s-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><title xmlns="">logout</title><path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z"/>
                    </svg>
                </span>

                Cerrar sesión

            </button>

        </form>

    </div>

</aside>
