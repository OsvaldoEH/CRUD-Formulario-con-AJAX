let modalLoadedUpdate = false;
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.btn-edit');
    if (btn) {

        const clave = btn.getAttribute('data-clave');
        const nombre = btn.getAttribute('data-nombre');
        const precio = btn.getAttribute('data-precio');
        const desc = btn.getAttribute('data-descripcion');

        fetch('includes/modals/modal-update.html')
            .then(response => {
                if (!response.ok) {
                    throw new Error('No se pudo cargar modal-update.html');
                }
                return response.text();
            })
            .then(data => {

                document.getElementById('modalContainer').innerHTML = data;

                document.querySelector('#modalContainer input[name="claveProducto"]').value = clave;
                document.querySelector('#modalContainer input[name="nombreProducto"]').value = nombre;
                document.querySelector('#modalContainer input[name="precioProducto"]').value = precio;
                document.querySelector('#modalContainer textarea[name="descripcion"]').value = desc;

                const modal = new bootstrap.Modal(document.getElementById('staticBackdrop2'));
                modal.show();
            })
            .catch(error => {
                console.error(error);
                alert('Error al cargar el modal-update.html');
            });
    }
});