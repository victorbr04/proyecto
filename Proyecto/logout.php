<?php
// Iniciar la sesión
session_start();

// Desconfigurar todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redireccionar al usuario a la página de inicio de sesión
header("Location: login.php?show_login_modal=true");
exit;
?>
