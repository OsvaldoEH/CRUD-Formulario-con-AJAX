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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="header">
        <h1 class="fw-bold">CRUD de Productos</h1>
        <p class="mb-0">Sistema de gestion de inventario</p>
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
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary d-block mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="modalInsert">
                Insertar Producto
            </button>
            <?php if (count($productos) > 0): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Clave del Producto</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Descripción</th>
                            <th>Actualizar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td><?php echo $producto['claveProducto']; ?></td>
                                <td><?php echo $producto['nombreProducto']; ?></td>
                                <td><?php echo $producto['precioProducto']; ?></td>
                                <td><?php echo $producto['descripcion']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning modalUpdate"
                                        data-clave="<?php echo htmlspecialchars($producto['claveProducto']); ?>"
                                        data-nombre="<?php echo htmlspecialchars($producto['nombreProducto']); ?>"
                                        data-precio="<?php echo htmlspecialchars($producto['precioProducto']); ?>"
                                        data-descripcion="<?php echo htmlspecialchars($producto['descripcion']); ?>">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </td>
                                <td>
                                    <form action="backend/productos/delete.php" method="post" style="display:inline;">
                                        <input type="hidden" name="claveProducto" value="<?php echo htmlspecialchars($producto['claveProducto']); ?>">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este producto?');">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info" role="alert"> No hay productos disponibles.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer">
        <p>Copyright &copy; 2026</p>
    </div>

    <div id="modalContainer"></div>
    <script src="assets/js/modal-insert.js"></script>
    <script src="assets/js/modal-update.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>