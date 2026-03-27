<?php
require_once '../../includes/database/conexion.php';

header('Content-Type: application/json');

$claveProducto = (int) ($_POST['claveProducto'] ?? 0);
$nombreProducto = $_POST['nombreProducto'] ?? '';
$precioProducto = (float) ($_POST['precioProducto'] ?? 0);
$descripcion = $_POST['descripcion']    ?? '';

if ($claveProducto === 0) {
    echo json_encode(['success' => false, 'message' => 'Clave de producto inválida']);
    exit;
}

$stmt = $conexion->prepare(
    "INSERT INTO productos (claveProducto, nombreProducto, precioProducto, descripcion) VALUES (?, ?, ?, ?)"
);
$stmt->bind_param("isds", $claveProducto, $nombreProducto, $precioProducto, $descripcion);

if ($stmt->execute()) {
    $result = $conexion->query("SELECT claveProducto, nombreProducto, precioProducto, descripcion FROM productos");
    $productos = [];
    while ($fila = $result->fetch_assoc()) $productos[] = $fila;
    echo json_encode(['success' => true, 'message' => '✅ Producto creado exitosamente', 'productos' => $productos]);
} else {
    echo json_encode(['success' => false, 'message' => '❌ Error al crear el producto: ' . $stmt->error]);
}

?>
    