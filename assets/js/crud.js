function mostrarToast(mensaje, exito = true) {
    let toast = document.getElementById('crudToast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'crudToast';
        toast.style.cssText = 
            `position: fixed; 
            bottom: 30px; right: 
            30px; z-index: 9999;
            padding: 14px 22px; 
            border-radius: 10px; 
            font-weight: 600;
            font-size: 0.95rem; 
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            transition: opacity 0.4s ease; 
            opacity: 0; 
            pointer-events: none;`
        ;
        document.body.appendChild(toast);
    }
    toast.textContent = mensaje;
    toast.style.background = exito ? '#16a34a' : '#dc2626';
    toast.style.color = '#fff';
    toast.style.opacity = '1';
    clearTimeout(toast._timeout);
    toast._timeout = setTimeout(() => { toast.style.opacity = '0'; }, 3000);
}

// Renderizar tabla
function renderizarTabla(productos) {
    const tbody = document.querySelector('#tablaProductos tbody');
    if (!tbody) return;

    if (productos.length === 0) {
        document.getElementById('tablaProductos').style.display = 'none';
        document.getElementById('sinProductos').style.display = 'block';
        return;
    }

    document.getElementById('tablaProductos').style.display = '';
    document.getElementById('sinProductos').style.display = 'none';

    tbody.innerHTML = productos.map(p => `
        <tr>
            <td>${escHtml(p.claveProducto)}</td>
            <td>${escHtml(p.nombreProducto)}</td>
            <td>$${parseFloat(p.precioProducto).toFixed(2)}</td>
            <td>${escHtml(p.descripcion)}</td>
            <td>
                <button type="button" class="btn btn-sm btn-warning modalUpdate"
                    data-clave="${escHtml(p.claveProducto)}"
                    data-nombre="${escHtml(p.nombreProducto)}"
                    data-precio="${escHtml(p.precioProducto)}"
                    data-descripcion="${escHtml(p.descripcion)}">
                    <i class="bi bi-pencil"></i>
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-danger btnEliminar"
                    data-clave="${escHtml(p.claveProducto)}">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
    `).join('');
}

function escHtml(str) {
    return String(str ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}

// Recargar tabla con AJAX después de cada operación
function recargarTabla() {
    fetch('backend/productos/select.php')
        .then(r => r.json())
        .then(data => {
            if (data.success) renderizarTabla(data.productos);
        })
        .catch(() => mostrarToast('❌ Error al recargar la tabla', false));
}

// INSERT
let modalInsertLoaded = false;

document.getElementById('modalInsert').addEventListener('click', function () {
    const abrir = () => {
        const modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
        modal.show();
    };

    if (!modalInsertLoaded) {
        fetch('includes/modals/modal-insert.html')
            .then(r => r.text())
            .then(html => {
                document.getElementById('modalContainer').insertAdjacentHTML('beforeend', html);
                modalInsertLoaded = true;

                // Interceptar submit del form de insertar
                document.getElementById('formInsert').addEventListener('submit', function (e) {
                    e.preventDefault();
                    const formData = new FormData(this);

                    fetch('backend/productos/insert.php', { method: 'POST', body: formData })
                        .then(r => r.json())
                        .then(data => {
                            mostrarToast(data.message, data.success);
                            if (data.success) {
                                bootstrap.Modal.getInstance(document.getElementById('staticBackdrop')).hide();
                                this.reset();
                                recargarTabla();
                            }
                        })
                        .catch(() => mostrarToast('❌ Error de conexión', false));
                });

                abrir();
            })
            .catch(() => mostrarToast('❌ Error al cargar el modal', false));
    } else {
        abrir();
    }
});

// UPDATE
let modalUpdateLoaded = false;

document.addEventListener('click', function (e) {
    const btn = e.target.closest('.modalUpdate');
    if (!btn) return;

    const clave       = btn.getAttribute('data-clave');
    const nombre      = btn.getAttribute('data-nombre');
    const precio      = btn.getAttribute('data-precio');
    const descripcion = btn.getAttribute('data-descripcion');

    const rellenarYAbrir = () => {
        document.getElementById('claveProducto').value    = clave;
        document.getElementById('nombreProducto').value   = nombre;
        document.getElementById('precioProducto').value   = precio;
        document.getElementById('descripcion').value      = descripcion;

        const modal = new bootstrap.Modal(document.getElementById('staticBackdrop2'));
        modal.show();
    };

    if (!modalUpdateLoaded) {
        fetch('includes/modals/modal-update.html')
            .then(r => r.text())
            .then(html => {
                document.getElementById('modalContainer').insertAdjacentHTML('beforeend', html);
                modalUpdateLoaded = true;

                // Interceptar submit del form de actualizar
                document.getElementById('formUpdate').addEventListener('submit', function (e) {
                    e.preventDefault();
                    const formData = new FormData(this);

                    fetch('backend/productos/update.php', { method: 'POST', body: formData })
                        .then(r => r.json())
                        .then(data => {
                            mostrarToast(data.message, data.success);
                            if (data.success) {
                                bootstrap.Modal.getInstance(document.getElementById('staticBackdrop2')).hide();
                                recargarTabla();
                            }
                        })
                        .catch(() => mostrarToast('❌ Error de conexión', false));
                });

                rellenarYAbrir();
            })
            .catch(() => mostrarToast('❌ Error al cargar el modal', false));
    } else {
        rellenarYAbrir();
    }
});

// DELETE
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.btnEliminar');
    if (!btn) return;

    const clave = btn.getAttribute('data-clave');
    if (!confirm(`¿Eliminar el producto "${clave}"?`)) return;

    const formData = new FormData();
    formData.append('claveProducto', clave);

    fetch('backend/productos/delete.php', { method: 'POST', body: formData })
        .then(r => r.json())
        .then(data => {
            mostrarToast(data.message, data.success);
            if (data.success) recargarTabla();
        })
        .catch(() => mostrarToast('❌ Error de conexión', false));
});
