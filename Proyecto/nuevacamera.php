<?php
include 'funciones.php';
sesion();
// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conexion = bbdd();
    // Recibir datos del formulario
    $camera_name = $_POST["nombre"];
    $camera_image = $_POST["url"];
    if(isset($_POST["grupo"])){
        $camera_grupo = $_POST["grupo"];
    }else{
        $camera_grupo = $_SESSION["grupo"];
    }
    // Preparar la consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO camaras (nombre, url, grupo) VALUES ('$camera_name', '$camera_image', '$camera_grupo')";

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
