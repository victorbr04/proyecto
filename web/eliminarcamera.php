<?php
include 'funciones.php';
sesion();
// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = bbdd();
    // Recibir datos del formulario
    $camera = $_POST["camara"];

    // Preparar la consulta SQL para insertar los datos en la base de datos
    $sql = "DELETE FROM camaras WHERE (`id` = '$camera')";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
        exit();    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
