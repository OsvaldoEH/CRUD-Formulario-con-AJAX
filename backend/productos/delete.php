<?php
require_once '../../includes/database/conexion.php';

$claveProducto = $_POST['claveProducto'];
$sql = "DELETE FROM productos WHERE claveProducto='$claveProducto'";

if (mysqli_query($conexion, $sql)) {
    echo '<script>
            alert("✅ Fila eliminada exitosamente");
            window.location.href = "../../index.php";
          </script>';
    exit(); // Asegura que no se ejecute más código    
} else {
    echo '<script>
            alert("❌ Error al eliminar la fila");
            window.location.href = "../../index.php?error=1";
          </script>';
    exit();
}

?>