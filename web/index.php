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
                    <a  class="btn" id="add-camera-btn" style="order: -1;">Añadir Cámara</a> 
                    <a  class="btn" id="delete-camera-btn">Eliminar Cámara</a> 
                    <a href="logout.php" class="btn" id="logout-btn" style="order: 1;">Cerrar Sesión</a>
                    <?php if(isset($_SESSION["rol"]) && $_SESSION["rol"]=="admin" ) {
                    echo '<a href="usuarios.php" class="btn" id="usuarios-btn" style="order: 3;">Usuarios</a>';
                }?>
                    <a  class="btn" id="cuenta-btn" style="order: 2;">Cuenta</a> 

                </div>
            </div>
           
        </header>
        <?php camera();?>
            <?php cameradel();?>
            <?php cuenta();?>
            <?php ventanamensaje();?>

<div class="container">
    <div class="camera-grid">
        <?php
        $conexion = bbdd();
        
        // Consulta a la base de datos
        if(isset($_SESSION["rol"]) && $_SESSION["rol"]=="admin" ) {
            $sql = "SELECT * FROM camaras order by grupo "; 
        } else {
            $grupo = $_SESSION["grupo"];
            $sql = "SELECT * FROM proyecto.camaras where grupo = '$grupo'";
        }

        $resultado = $conexion->query($sql);

        // Procesar los resultados
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
        ?>
            <div class="camera">
                <h2>
                    <?php echo $fila['nombre']; ?>
                    <?php if(isset($_SESSION["rol"]) && $_SESSION["rol"]=="admin" ) { ?>
                        <span class="rol"><?php echo '('.$fila['grupo'].')'; ?></span>
                    <?php } ?>
                </h2>
                <img src="camara.jpg" alt="<?php echo $fila['nombre']; ?>" class="portada" onclick="mostrarVideo('<?php echo $fila['url']; ?>')">
            </div>
        <?php
            }
        } else {
            echo "No se encontraron cámaras.";
        }
        ?>
    </div>
</div>
    
    <div class="ventana-video" id="ventanaVideo">
        <span class="cerrar-video" onclick="cerrarVideo()">&#10006;</span>
        <button id="btnFullScreen" onclick="toggleFullScreen()" style="position: absolute; bottom: 10px; right: 10px;">
        <i class="fas fa-expand"></i> Pantalla Completa
        </button>
        <iframe id="video" src="" scrolling="no" width="1024" height="576"></iframe>
    </div>

    
    
    <footer class="footer">
        <div class="container">&copy; 2024 Visualización de Cámaras IP</br>
<?php $ip = getHostByName(getHostName());
echo "$ip";?>
</br></div>
</footer>

    <script src="script.js"></script>

</body>
</html>
