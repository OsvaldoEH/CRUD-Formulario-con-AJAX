<?php
require_once 'includes/database/conexion.php';
require_once 'backend/productos/select.php';
$productos = obtenerProductos($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Productos</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="header">
        <h1 class="fw-bold">CRUD de Productos</h1>
        <p class="mb-0">Sistema de gestión de inventario</p>
    </div>

    <div class="container">
        <div class="list">
            <h4>Lista de Tutoriales</h4>
            <ul>
                <li>Tutorial HTML5</li>
                <li>Tutorial CSS3</li>
                <li>Tutorial JavaScript</li>
                <li>Tutorial PHP</li>
            </ul>
        </div>

        <div class="article">
            <button type="button" class="btn btn-primary d-block mb-3" id="modalInsert">
                Insertar Producto
            </button>

            <!-- Tabla con id para actualizarla via JS -->
            <table class="table table-striped" id="tablaProductos" <?php if (count($productos) === 0) echo 'style="display:none"'; ?>>
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Descripción</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['claveProducto']) ?></td>
                            <td><?= htmlspecialchars($p['nombreProducto']) ?></td>
                            <td>$<?= number_format($p['precioProducto'], 2) ?></td>
                            <td><?= htmlspecialchars($p['descripcion']) ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning modalUpdate"
                                    data-clave="<?= htmlspecialchars($p['claveProducto']) ?>"
                                    data-nombre="<?= htmlspecialchars($p['nombreProducto']) ?>"
                                    data-precio="<?= htmlspecialchars($p['precioProducto']) ?>"
                                    data-descripcion="<?= htmlspecialchars($p['descripcion']) ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger btnEliminar"
                                    data-clave="<?= htmlspecialchars($p['claveProducto']) ?>">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div id="sinProductos" class="alert alert-info" <?php if (count($productos) > 0) echo 'style="display:none"'; ?>>
                No hay productos disponibles.
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Copyright &copy; 2026</p>
    </div>


    <div id="modalContainer"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <!-- Archivo JS unificado -->
    <script src="assets/js/crud.js"></script>
</body>

</html>