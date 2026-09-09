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

        <a href="{{ route('dashboard') }}"
            class="sidebar-link {{ request()->routeIs('dashboard') ? 'activo' : '' }}">
            <span class="s-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><title xmlns="">dashboard-outline</title><path fill="currentColor" d="M13.5 9V4H20v5zM4 12V4h6.5v8zm9.5 8v-8H20v8zM4 20v-5h6.5v5zm1-9h4.5V5H5zm9.5 8H19v-6h-4.5zm0-11H19V5h-4.5zM5 19h4.5v-3H5zm4.5-3"/>
                </svg>
            </span>
            Dashboard
        </a>

        <a href="{{ route('profile') }}"
            class="sidebar-link {{ request()->routeIs('profile') ? 'activo' : '' }}">
            <span class="s-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><title xmlns="">user</title><path fill="currentColor" d="M15.71 12.71a6 6 0 1 0-7.42 0a10 10 0 0 0-6.22 8.18a1 1 0 0 0 2 .22a8 8 0 0 1 15.9 0a1 1 0 0 0 1 .89h.11a1 1 0 0 0 .88-1.1a10 10 0 0 0-6.25-8.19M12 12a4 4 0 1 1 4-4a4 4 0 0 1-4 4"/>
                </svg>
            </span>
            Perfil
        </a>

        <div class="sidebar-label">
            Mis solicitudes
        </div>

        <a href="{{ route('cotizaciones.mias') }}"
            class="sidebar-link {{ request()->routeIs('cotizaciones.mias') ? 'activo' : '' }}">
            <span class="s-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 2048 2048"><title xmlns="">company-directory</title><path fill="currentColor" d="M1920 0v2048H256v-254H128v-128h128v-257H128v-128h128V769H128V641h128V385H128V257h128V0zm-128 128H384v1792h1408zm-128 384h-640V384h640zm0 256h-640V640h640zm-960 892q-39 0-73-14t-60-40t-40-60t-15-74q0-39 14-73t40-59t60-41t74-15q39 0 73 15t59 40t41 60t15 73q0 39-15 73t-40 60t-60 40t-73 15m0-256q-29 0-48 19t-20 49q0 29 19 48t49 20q29 0 48-19t20-49q0-29-19-48t-49-20m0-640q-39 0-73-14t-60-40t-40-60t-15-74q0-39 14-73t40-59t60-41t74-15q39 0 73 15t59 40t41 60t15 73q0 39-15 73t-40 60t-60 40t-73 15m0-256q-29 0-48 19t-20 49q0 29 19 48t49 20q29 0 48-19t20-49q0-29-19-48t-49-20m960 900h-640v-128h640zm0 256h-640v-128h640z"/>
                </svg>
            </span>
            Cotizaciones
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
