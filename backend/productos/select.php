<?php
// Determina la ruta base correcta según cómo se llame el archivo
$base = (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME']))
    ? '../../includes/database/conexion.php'   // llamado directamente como endpoint AJAX
    : 'includes/database/conexion.php';        // incluido desde index.php

require_once $base;

function obtenerProductos($conexion) {
    $query     = "SELECT claveProducto, nombreProducto, precioProducto, descripcion FROM productos";

    $resultado = mysqli_query($conexion, $query);
    $productos = [];

    while ($fila = mysqli_fetch_assoc($resultado)) {
        $productos[] = $fila;
    }
    
    return $productos;
}

// Endpoint AJAX: responde JSON solo si se llama directamente
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'productos' => obtenerProductos($conexion)]);
}

?>
