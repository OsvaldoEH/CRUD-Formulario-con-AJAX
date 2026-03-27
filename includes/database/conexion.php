<?php
    $servidor = "localhost";
    $usuario = "u219080452_osvaldo";
    $clave = "WebHostOsvaldo8=?";
    $base_de_datos = "u219080452_crud_osvaldo";

    $conexion = new mysqli($servidor, $usuario, $clave, $base_de_datos);

    if ($conexion->connect_error) {
        die("ERROR: No se puede conectar al servidor remoto " . $conexion->connect_error);
    }
?>