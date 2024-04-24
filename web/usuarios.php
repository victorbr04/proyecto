<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualización de Cámaras IP</title>
    <link rel="stylesheet" href="styles.css">
    <?php include 'funciones.php'; 
        sesion();
        admin();
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

<div class="container-u">
    <div class="container-user">
            <h2>Lista de Usuarios</h2>
            <?php
            $conexion = bbdd();
            $grupos =select_grupo();
            // Consulta a la base de datos
            $sql = "SELECT * FROM usuarios";
            $resultado = $conexion->query($sql);

            // Procesar los resultados
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    // $sql2= "SELECT * FROM usuarios where"
                    ?>
                    <div class="usuario">
                        <h3><?php echo $fila['nombre']; ?></h3>
                        
                        <form action="actualizar_usuario.php" method="post">
                            <label for="rol">Rol: </label>
                            <select name="rol" id="rol">
                                <?php  
                                    if($fila['rol']=='admin'){
                                        echo '<option value="admin" selected>Admin</option>';
                                        echo '<option value="viewer">Viewer</option>';
                                    }else{
                                        echo '<option value="admin" >Admin</option>';
                                        echo '<option value="viewer" selected>Viewer</option>';
                                    }
                                ?>
                            </select>
                            <input type="hidden" name="rolusuario" value="<?php echo $fila['nombre']; ?>">
                            <button type="submit" class="mas">Cambiar</button> 
                        </form>
                        <form action="actualizar_usuario.php" method="post">
                            <label for="grupo">Grupo:</label>
                                <select name="grupo" id="grupo">
                                <?php 
                                if (!empty($grupos)) {
                                    foreach ($grupos as $grupo) {
                                        if ($grupo == $fila['grupo']){
                                            echo '<option value="'.$grupo.'" selected><b>'.$grupo.'</b></option>';
                                        }else{
                                            echo '<option value="'.$grupo.'">'.$grupo.'</option>';
                                        }
                                        
                                    }
                                } else {
                                    echo "No se encontraron grupos";
                                }
                                if($fila['grupo']==""){
                                    echo '<option value="" selected><b>Sin grupo</b></option>';
                                }else{
                                    echo '<option value=""><b>Sin grupo</b></option>';
                                }
                                ?>
                                </select>
                            <input type="hidden" name="grupousuario" value="<?php echo $fila['nombre']; ?>">
                            <button type="submit" class="mas">Cambiar</button> 
                        </form>
                        <form action="actualizar_usuario.php" method="post">
                            <label for="contraseña">Restablecer Contraseña:</label>
                            <input type="password" name="contraseña" id="contraseña" placeholder="Nueva contraseña" required>
                            <input type="hidden" name="restablecercontraseña" value="<?php echo $fila['nombre']; ?>">
                            <button type="submit" class="mas" >Cambiar</button>
                        </form>
                        <form action="actualizar_usuario.php" method="post">
                            <input type="hidden" name="borrarusuario" value="<?php echo $fila['nombre']; ?>">
                            <button type="submit" class="menos" id="eliminar">Eliminar Usuario</button>
                        </form>
                    </div>
                    <?php
                }
            } else {
                echo "No se encontraron usuarios.";
            }
            ?>
    </div>

    <div class="sidebar">
        <div class="create-user-form">
            <h2>Crear Nuevo Usuario</h2>
            <form action="actualizar_usuario.php" method="post">
                <label for="nombre">Nombre:</label>     
                <input type="text" id="nombre" name="nombre" required placeholder="usuario"></br>
                <label for="rol">Rol:</label>
                    <select name="rol" id="rol" required>
                        <option value="admin">Admin</option>
                        <option value="viewer">Viewer</option>
                    </select></br>

                <label for="grupo">Grupo:</label>
                <select name="grupo" id="grupo">
                    <?php 
                    if (!empty($grupos)) {
                        foreach ($grupos as $grupo) {
                            echo '<option value="'.$grupo.'">'.$grupo.'</option>';
                        }
                    } else {
                        echo "No se encontraron grupos";
                    }
                    ?>
                    <option value="">sin grupo</option>
                    </select></br>

                <label for="contraseña">Contraseña:</label>     
                <input type="password" id="contraseña" name="contraseña" placeholder="*****" required>
                <input type="hidden" name="nuevousuario" value="">
                <button type="submit" class="mas">Crear Usuario</button> 
            </form>
        </div>
            <div class="create-group-form">
                <h2>Grupos</h2>
                <form action="actualizar_usuario.php" method="post">
                    <label for="nombre_grupo">Nuevo Grupo:</label>
                    <input type="text" id="grupo" name="grupo" placeholder="nombre" required>
                    <input type="hidden" name="nuevogrupo" value="">
                    <button type="submit" class="mas">Crear</button>
                </form><p>
                <form action="actualizar_usuario.php" method="post">
                    <label for="nombre_grupo">Eliminar Grupo:</label>
                        <?php echo select_grupo_cam(); ?>
                    <input type="hidden" name="eliminargrupo" value="">
                    <button type="submit" class="menos">Borrar</button> 
                </form>
            </div>
        </div>
</div>

<?php ventanamensaje(); ?>


<footer class="footer">
        <div class="container">&copy; 2024 Visualización de Cámaras IP</br>
<?php $ip = getHostByName(getHostName());
echo "$ip";?>
</br></div>
</footer>
<script src="script.js"></script>

</body>
</html>
