<div class="admin-wrapper" id="adminWrapper">

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <x-admin.sidebar
        :cotizacionesPendientes="$cotizacionesPendientes"
    />

    <div class="admin-main">

        <x-admin.topbar :title="$title" />

        <div class="admin-content">

            {{ $slot }}

        </div>

    </div>

</div>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/productos.js') }}"></script>
    <script src="{{ asset('assets/js/cotizaciones.js')}}"></script>
