<?php
// Iniciar la sesión
session_start();

// Actualizar la contraseña aquí...

// Establecer la sesión para indicar que la contraseña se ha actualizado correctamente
$_SESSION['contraseña'] = "contraseña_actualizada";

// Redirigir a la página de prueba
header("Location: pagina_prueba.php");
exit(); // Asegúrate de detener la ejecución del script después de redirigir
?>
