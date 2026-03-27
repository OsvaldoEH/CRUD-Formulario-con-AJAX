<?php
require_once '../../includes/database/conexion.php';

header('Content-Type: application/json');

$claveProducto  = $_POST['claveProducto']  ?? '';
$nombreProducto = $_POST['nombreProducto'] ?? '';
$precioProducto = $_POST['precioProducto'] ?? 0;
$descripcion    = $_POST['descripcion']    ?? '';

$stmt = $conexion->prepare(
    "INSERT INTO productos (claveProducto, nombreProducto, precioProducto, descripcion) VALUES (?, ?, ?, ?)"
);
$stmt->bind_param("ssds", $claveProducto, $nombreProducto, $precioProducto, $descripcion);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '✅ Producto creado exitosamente']);
} else {
    echo json_encode(['success' => false, 'message' => '❌ Error al crear el producto: ' . $stmt->error]);
}

?>
    