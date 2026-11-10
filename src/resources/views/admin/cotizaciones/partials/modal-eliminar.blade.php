{{--
    Modal de confirmación para eliminar cotizaciones (mismo estilo que el de productos).
    Uso: cualquier botón con data-eliminar-url="{{ route('admin.cotizaciones.destroy', $c) }}"
         y opcionalmente data-eliminar-desc="Texto descriptivo".
--}}
<style>
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
    .modal-icon {
        width: 6.4rem;
        height: 6.4rem;
        margin: 0 auto 1.4rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: var(--error);
        background-color: rgba(226,75,74,0.1);
    }
    .modal-title { font-size: 2rem; font-weight: 800; color: var(--text-heading); margin: 0 0 0.8rem; }
    .modal-desc  { font-size: 1.45rem; color: var(--text-muted); margin: 0 0 2.8rem; line-height: 1.6; overflow-wrap: anywhere; }
    .modal-actions {
        display: flex;
        gap: 1.2rem;
        justify-content: center;
        flex-wrap: wrap;
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
</style>

<div class="modal-overlay" id="modalEliminarCotizacion" role="dialog" aria-modal="true" aria-labelledby="modalEliminarTitulo">
    <div class="modal-box">
        <div class="modal-icon"><x-icon name="trash-2" /></div>
        <h3 class="modal-title" id="modalEliminarTitulo">¿Eliminar cotización?</h3>
        <p class="modal-desc" id="modalEliminarDesc">Esta acción no se puede deshacer.</p>
        <div class="modal-actions">
            <button type="button" class="btn-modal-cancel" data-eliminar-cancelar>Cancelar</button>
            <form id="formEliminarCotizacion" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-modal-confirm">Sí, eliminar</button>
            </form>
        </div>
    </div>
</div>

<script>
    (function () {
        const modal = document.getElementById('modalEliminarCotizacion');
        const form  = document.getElementById('formEliminarCotizacion');
        const desc  = document.getElementById('modalEliminarDesc');
        if (!modal || !form) return;

        function abrir(url, texto) {
            form.action = url;
            desc.textContent = (texto ? texto + '. ' : '') + 'Esta acción no se puede deshacer.';
            modal.classList.add('activo');
            modal.querySelector('[data-eliminar-cancelar]').focus();
        }

        function cerrar() {
            modal.classList.remove('activo');
            form.action = '';
        }

        document.addEventListener('click', function (e) {
            const btn = e.target.closest('[data-eliminar-url]');
            if (btn) {
                e.preventDefault();
                abrir(btn.dataset.eliminarUrl, btn.dataset.eliminarDesc);
            }
        });

        modal.querySelector('[data-eliminar-cancelar]').addEventListener('click', cerrar);
        modal.addEventListener('click', function (e) { if (e.target === modal) cerrar(); });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && modal.classList.contains('activo')) cerrar();
        });
    })();
</script>
