/*
|--------------------------------------------------------------------------
| Productos.js
|--------------------------------------------------------------------------
| Funciones del CRUD de productos
| Compatible con:
| - index.blade.php
| - create.blade.php
| - edit.blade.php
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', () => {

    initBusquedaProductos();
    initModalEliminar();
    initPreviewImagen();
    initResumenProducto();

});

/* ==========================================================================
   BUSCADOR DE PRODUCTOS (INDEX)
   ========================================================================== */

function initBusquedaProductos() {

    const buscar = document.getElementById('buscarProducto');
    const tabla = document.querySelector('#tablaProductos tbody');

    if (!buscar || !tabla) return;

    buscar.addEventListener('input', function () {

        const q = this.value.toLowerCase();

        tabla.querySelectorAll('tr').forEach(row => {

            if (row.querySelector('.prod-empty')) return;

            row.style.display =
                row.textContent.toLowerCase().includes(q)
                    ? ''
                    : 'none';

        });

    });

}

/* ==========================================================================
   MODAL ELIMINAR (INDEX)
   ========================================================================== */

function initModalEliminar() {

    const modal = document.getElementById('modalEliminar');

    if (!modal) return;

    window.abrirModal = function (id, nombre) {

        document.getElementById('formEliminar').action =
            '/admin/productos/' + id;

        document.getElementById('modalDesc').textContent =
            `Vas a eliminar "${nombre}". Esta acción no se puede deshacer.`;

        modal.classList.add('activo');

    };

    window.cerrarModal = function () {
        modal.classList.remove('activo');
    };

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') cerrarModal();
    });

    modal.addEventListener('click', e => {
        if (e.target === modal) cerrarModal();
    });

}

/* ==========================================================================
   PREVIEW + DRAG & DROP (CREATE / EDIT)
   ========================================================================== */

function initPreviewImagen() {

    const input = document.getElementById('imagen');
    const dropzone = document.getElementById('imgDropzone');
    const content = document.getElementById('imgContent');
    const preview = document.getElementById('previewImg');
    const placeholder = document.getElementById('previewPlaceholder');
    const info = document.getElementById('previewFileInfo');
    const nombre = document.getElementById('previewFileName');
    const size = document.getElementById('previewFileSize');
    const quitar = document.getElementById('btnQuitarImg');

    if (
        !input ||
        !dropzone ||
        !content ||
        !preview ||
        !placeholder ||
        !info ||
        !nombre ||
        !size
    ) return;

    function formatSize(bytes) {

        if (bytes < 1024) return bytes + ' B';

        if (bytes < 1048576)
            return (bytes / 1024).toFixed(1) + ' KB';

        return (bytes / 1048576).toFixed(1) + ' MB';

    }

    function mostrar(file) {

        const reader = new FileReader();

        reader.onload = e => {

            preview.src = e.target.result;

            preview.style.display = 'block';

            placeholder.style.display = 'none';

        };

        reader.readAsDataURL(file);

        nombre.textContent = file.name;
        size.textContent = formatSize(file.size);

        info.classList.add('visible');

        content.querySelector('.img-dz-label').innerHTML =
            '✅ <u>Cambiar imagen</u>';

        dropzone.style.borderStyle = 'solid';
        dropzone.style.borderColor = 'var(--contrastes)';

    }

    function limpiar() {

        input.value = '';

        preview.src = '';

        preview.style.display = 'none';

        placeholder.style.display = 'flex';

        info.classList.remove('visible');

        content.querySelector('.img-dz-label').innerHTML =
            'Arrastra la imagen aquí o <u>haz clic para seleccionar</u>';

        dropzone.style.borderStyle = 'dashed';
        dropzone.style.borderColor = 'var(--border-color)';

    }

    input.addEventListener('change', function () {

        if (this.files.length)
            mostrar(this.files[0]);

    });

    dropzone.addEventListener('dragover', e => {

        e.preventDefault();

        dropzone.classList.add('drag-over');

    });

    dropzone.addEventListener('dragleave', () =>
        dropzone.classList.remove('drag-over')
    );

    dropzone.addEventListener('drop', e => {

        e.preventDefault();

        dropzone.classList.remove('drag-over');

        const file = e.dataTransfer.files[0];

        if (!file || !file.type.startsWith('image/')) return;

        const dt = new DataTransfer();

        dt.items.add(file);

        input.files = dt.files;

        mostrar(file);

    });

    quitar?.addEventListener('click', limpiar);

}

/* ==========================================================================
   RESUMEN LATERAL (CREATE / EDIT)
   ========================================================================== */

function initResumenProducto() {

    const campos = {

        nombre: {
            salida: 'resNombre',
            format: v => v || '—'
        },

        clasificacion: {
            salida: 'resClasif',
            format: v => v || '—'
        },

        precio: {
            salida: 'resPrecio',
            format: v =>
                v
                    ? '$' + Number(v).toLocaleString(
                        'es-MX',
                        { minimumFractionDigits: 2 }
                    )
                    : '—'
        },

        stock: {
            salida: 'resStock',
            format: v => v ? `${v} uds.` : '—'
        }

    };

    Object.entries(campos).forEach(([id, cfg]) => {

        const input = document.getElementById(id);
        const salida = document.getElementById(cfg.salida);

        if (!input || !salida) return;

        const actualizar = () =>
            salida.textContent = cfg.format(input.value);

        input.addEventListener('input', actualizar);

        actualizar();

    });

}
