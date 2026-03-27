<?php
require_once '../../includes/database/conexion.php';

header('Content-Type: application/json');

$claveProducto = $_POST['claveProducto'] ?? '';

$stmt = $conexion->prepare("DELETE FROM productos WHERE claveProducto=?");
$stmt->bind_param("s", $claveProducto);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '✅ Producto eliminado exitosamente']);
} else {
    echo json_encode(['success' => false, 'message' => '❌ Error al eliminar: ' . $stmt->error]);
}

?>
