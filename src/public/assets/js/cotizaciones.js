(function () {
    const toggle  = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function open()  { sidebar.classList.add('abierto');    overlay.classList.add('activo'); }
    function close() { sidebar.classList.remove('abierto'); overlay.classList.remove('activo'); }

    toggle?.addEventListener('click', () => sidebar.classList.contains('abierto') ? close() : open());
    overlay?.addEventListener('click', close);
})();

        // ── Búsqueda en tabla ──
        document.getElementById('buscarCotiz')?.addEventListener('input', function () {
            const q    = this.value.toLowerCase();
            const rows = document.querySelectorAll('#tablaCotizaciones tbody tr:not(.no-filter)');

            rows.forEach(row => {
                if (row.querySelector('.prod-empty')) return;
                row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
            });
        });

        // ── Filtros por estado ──
        (function () {
            const btns = document.querySelectorAll('.filtro-btn');

            btns.forEach(btn => {
                btn.addEventListener('click', function () {
                    btns.forEach(b => b.classList.remove('activo'));
                    this.classList.add('activo');

                    const filtro = this.dataset.filtro;
                    const rows   = document.querySelectorAll('#tablaCotizaciones tbody tr');

                    rows.forEach(row => {
                        if (row.querySelector('.prod-empty')) return;
                        if (filtro === 'todos') {
                            row.style.display = '';
                        } else {
                            row.style.display = row.dataset.estado === filtro ? '' : 'none';
                        }
                    });

                    // Limpiar búsqueda al cambiar filtro
                    document.getElementById('buscarCotiz').value = '';
                });
            });
        })();
        (function () {
            const toggle  = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');

            function open()  { sidebar.classList.add('abierto');    overlay.classList.add('activo'); }
            function close() { sidebar.classList.remove('abierto'); overlay.classList.remove('activo'); }

            toggle?.addEventListener('click', () => sidebar.classList.contains('abierto') ? close() : open());
            overlay?.addEventListener('click', close);
        })();

        // ── Preview del badge al cambiar el select ──
        (function () {
            const select = document.getElementById('estado');
            const badge  = document.getElementById('badgePreview');

            const config = {
                pendiente:  { icon: '⏳', label: 'Pendiente',   cls: 'pendiente'  },
                en_proceso: { icon: '🔍', label: 'En proceso',  cls: 'en_proceso' },
                respondida: { icon: '✅', label: 'Respondida',  cls: 'respondida' },
                cancelada:  { icon: '❌', label: 'Cancelada',   cls: 'cancelada'  },
            };

            select?.addEventListener('change', function () {
                const c = config[this.value];
                if (!c || !badge) return;

                // Quitar clases anteriores
                Object.values(config).forEach(v => badge.classList.remove(v.cls));
                badge.classList.add(c.cls);
                badge.textContent = c.icon + ' ' + c.label;
            });
        })();
