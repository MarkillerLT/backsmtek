<div class="admin-wrapper" id="adminWrapper">

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
<script src="{{ asset('assets/js/cotizaciones.js') }}"></script>

<script>
    (function () {
        const toggle  = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function abrir()  {
            sidebar?.classList.add('abierto');
            overlay?.classList.add('activo');
        }
        function cerrar() {
            sidebar?.classList.remove('abierto');
            overlay?.classList.remove('activo');
        }

        toggle?.addEventListener('click', function () {
            sidebar?.classList.contains('abierto') ? cerrar() : abrir();
        });
        overlay?.addEventListener('click', cerrar);
    })();
</script>
