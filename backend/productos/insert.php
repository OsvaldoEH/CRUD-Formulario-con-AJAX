<?php
require_once '../../includes/database/conexion.php';

$claveProducto = $_POST['claveProducto'];
$nombreProducto = $_POST['nombreProducto'];
$precioProducto = $_POST['precioProducto'];
$descripcion = $_POST['descripcion'];

$sql = "INSERT INTO productos(claveProducto, nombreProducto, precioProducto, descripcion)
                     VALUES ('$claveProducto' , '$nombreProducto', $precioProducto, '$descripcion')";

if (mysqli_query($conexion, $sql)) {
    echo '<script>
            alert("✅ Nueva Fila creada exitosamente");
            window.location.href = "../../index.php";
          </script>';
    exit(); // Asegura que no se ejecute más código    
} else {
    echo '<script>
            alert("❌ Error al crear la fila");
            window.location.href = "../../index.php?error=1";
          </script>';
    exit();
}

?>
