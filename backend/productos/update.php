<?php
require_once '../../includes/database/conexion.php';

header('Content-Type: application/json');

$claveProducto  = $_POST['claveProducto']  ?? '';
$nombreProducto = $_POST['nombreProducto'] ?? '';
$precioProducto = $_POST['precioProducto'] ?? 0;
$descripcion    = $_POST['descripcion']    ?? '';

$stmt = $conexion->prepare(
    "UPDATE productos SET nombreProducto=?, precioProducto=?, descripcion=? WHERE claveProducto=?"
);
$stmt->bind_param("sdss", $nombreProducto, $precioProducto, $descripcion, $claveProducto);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '✅ Producto actualizado exitosamente']);
} else {
    echo json_encode(['success' => false, 'message' => '❌ Error al actualizar: ' . $stmt->error]);
}

?>
