<?php
require_once '../../includes/database/conexion.php';

$claveProducto  = $_POST['claveProducto'];
$nombreProducto = $_POST['nombreProducto'];
$precioProducto = $_POST['precioProducto'];
$descripcion    = $_POST['descripcion'];

$stmt = $conexion->prepare(
    "UPDATE productos SET nombreProducto=?, precioProducto=?, descripcion=? WHERE claveProducto=?"
);
$stmt->bind_param("sdss", $nombreProducto, $precioProducto, $descripcion, $claveProducto);

if (!$stmt->execute()) {
    echo '<script>
            alert("❌ Error al actualizar la fila: ' . $stmt->error . '");
            window.location.href = "../../index.php?error=1";
          </script>';
    exit();
} else {
    echo '<script>
            alert("✅ Fila actualizada exitosamente");
            window.location.href = "../../index.php";
          </script>';
    exit();
}
