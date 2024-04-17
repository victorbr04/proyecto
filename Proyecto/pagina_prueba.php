<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualización de Cámaras IP</title>
    <link rel="stylesheet" href="styles.css">
    <?php include 'funciones.php'; 
        sesion();
    ?>

</head>
<body>

<header>
    <div class="container">
        <h1>Visualización de Cámaras IP</h1>
        <div class="header-buttons">
            <a href="logout.php" class="btn" id="logout-btn" >Cerrar Sesión</a>
            <a href="usuarios.php" class="btn" id="usuarios-btn" >Usuarios</a>
            <a href="index.php" class="btn" id="inicio-btn" >Inicio</a>

        </div>
    </div>
</header>
<?php
print_r($_SESSION);
ventanapassw();
?>




<script src="script.js">
   
</script>
<footer class="footer">
    <div class="container">
        <p>&copy; 2024 Visualización de Cámaras IP</p>
    </div>
</footer>
</body>
</html>
