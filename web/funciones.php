<?php
function sesion(){
        // Iniciar la sesión
    session_start();

    // Verificar si el usuario está logueado
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        // Si no está logueado, redirigirlo a la página de inicio de sesión
        header("Location: login.php?show_login_modal=true");
        exit;
    }
    }

    function admin(){
        if($_SESSION["rol"]!="admin"){
            header("Location: index.php");
        }
}

function bbdd(){
    // Configuración de la base de datos
    $host = '172.18.0.1'; // Cambia esto al host de tu base de datos
    $usuario = 'root'; // Cambia esto a tu nombre de usuario de la base de datos
    $contrasena = '12345'; // Cambia esto a tu contraseña de la base de datos
    $base_datos = 'proyecto'; // Cambia esto al nombre de tu base de datos

    // Conexión a la base de datos
    $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Devolver la conexión
    return $conexion;
}


function camera(){?>
    <div id="add-camera-form" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Agregar Nueva Cámara</h2>
        <form id="add-camera-form" action="nuevacamera.php" method="post">
            <input type="text" name="nombre" placeholder="Nombre de la cámara" required>
            <input type="text" name="url" placeholder="URL" required><p>
            <?php if(isset($_SESSION["rol"]) && $_SESSION["rol"]=="admin" ) {
                    echo select_grupo_cam();

        }?></p>
            <button type="submit">Agregar Cámara</button>
        </form>
    </div>
</div><?php
}

function cameradel(){?>
    <div id="delete-camera-form" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Eliminar Cámara</h2>
        <form id="delete-camera-form" action="eliminarcamera.php" method="post">
            <select name="camara" id="camara" required>
                <?php
                // Conexión a la base de datos
                $conexion = bbdd();

                // Verificar la conexión
                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }

                // Consulta a la base de datos
                if(isset($_SESSION["rol"]) && $_SESSION["rol"]=="admin" ) {
                    $sql = "SELECT * FROM camaras  order by grupo";
                }else {
                    $grupo = $_SESSION["grupo"];
                    $sql = "SELECT * FROM camaras where grupo = '$grupo'";
                }

                $resultado = $conexion->query($sql);

                if(isset($_SESSION["rol"]) && $_SESSION["rol"]=="admin" ) {
                // Procesar los resultados
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        echo '<option value="' . $fila['id'] .'">' . $fila['nombre'] .' - ('.$fila['grupo'].')</option>';
                    }
                }
            }else{
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        echo '<option value="' . $fila['id'] .'">' . $fila['nombre'] .'</option>';
                    }
                }
            }
                ?>
            </select></p>
            <button type="submit">Eliminar Cámara</button>
        </form>
    </div>
</div><?php
}

function cuenta(){?>
<div id="cuenta-form" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarCuenta()">&times;</span>
        <h2>Información de la Cuenta</h2>
        <p>Usuario: <b><?php echo $_SESSION["username"]; ?></b></p>
        <!-- <p>Rol: <b><?php echo $_SESSION["rol"]; ?></b></p> -->
        <?php if($_SESSION["grupo"]!=""){
        echo '<p>Grupo: <b>'.$_SESSION["grupo"].'</b></p>';
        }?>

        <form id="new-password" action="actualizar_usuario.php" method="post">
                Nueva contraseña: 
                <input type="password" name="passw1" placeholder="*****" required><P>
                Confirmar contraseña: 
                <input type="password" name="passw2" placeholder="*****" required><p>
                <input type="hidden" name="cambiarcontraseña" value="<?php echo $_SESSION['username']; ?>">
                <button type="submit">Cambiar contraseña</button>
            </form>
            
    </div>
</div><?php
}

function select_grupo(){
    $conexion=bbdd();
    $sql = "SELECT nombre FROM grupo";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $grupos = array();
        while ($fila = $resultado->fetch_assoc()) {
            $grupos[] = $fila['nombre'];
        }

    } else {
        echo "No se encontraron grupos.";
    }
    return $grupos;
}

function select_grupo_cam(){
    $conexion=bbdd();
    $sql = "SELECT * FROM grupo";
    $resultado = $conexion->query($sql);
    echo '<select name="grupo" id="grupo">';
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo '<option value='.$fila['nombre'].'>'.$fila['nombre'].'</option>';
            }
        } else {
            echo "No se encontraron grupos";
        }
    echo '</select>';
}

function ventanamensaje(){
    
    if (isset($_SESSION['mensaje'])) {
        echo '<div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>'.$_SESSION['mensaje'].'</p>
            </div>
        </div>';
         unset($_SESSION['mensaje']);
    }
}
?>
