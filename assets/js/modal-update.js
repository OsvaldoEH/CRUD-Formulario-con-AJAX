let modalLoadedUpdate = false;

document.querySelectorAll('.modalUpdate').forEach(function (btn) {
    btn.addEventListener('click', function () {
        const clave       = this.getAttribute('data-clave');
        const nombre      = this.getAttribute('data-nombre');
        const precio      = this.getAttribute('data-precio');
        const descripcion = this.getAttribute('data-descripcion');

        const mostrarModal = () => {
            document.getElementById('claveProducto').value    = clave;
            document.getElementById('nombreProducto').value   = nombre;
            document.getElementById('precioProducto').value   = precio;
            document.getElementById('descripcion').value      = descripcion;

            const modal = new bootstrap.Modal(document.getElementById('staticBackdrop2'));
            modal.show();
        };

        if (!modalLoadedUpdate) {
            fetch('includes/modals/modal-update.html')
                .then(response => {
                    if (!response.ok) throw new Error('No se pudo cargar modal-update.html');
                    return response.text();
                })
                .then(data => {
                    document.getElementById('modalContainer').innerHTML = data;
                    modalLoadedUpdate = true;
                    mostrarModal();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al cargar el modal.');
                });
        } else {
            mostrarModal();
        }
    });
});