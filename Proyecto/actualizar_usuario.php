<?php
include 'funciones.php';
sesion();
// cambiar contraseña desde menu cuenta
if(isset($_POST["cambiarcontraseña"])){
    if ($_POST["passw1"] === $_POST["passw2"]) {

            $nueva_contraseña = $_POST["passw1"];
            $hash_nueva_contraseña = password_hash($nueva_contraseña, PASSWORD_DEFAULT);
            $usuario = $_SESSION['username']; 
            $update = "UPDATE `proyecto`.`usuarios` SET `contraseña` = '$hash_nueva_contraseña' WHERE (`nombre` = '$usuario')";
            
            $conexion=bbdd();
            // Ejecutar la consulta
            if ($conexion->query($update) === TRUE) {
                $_SESSION['contraseña'] = "Contraseña modificada con exito";
                header("Location: index.php");
                exit();    
            } else {
                echo "Error: " . $update . "<br>" . $conexion->error;
                $_SESSION['contraseña'] = "<b>Error en la base de datos</b>";
                header("Location: index.php");
                exit();    
            }
    }else{
        $_SESSION['contraseña'] = "<b>Error</b></p> Las contraseñas no coinciden";
            header("Location: index.php");
                exit(); 
    }   

}

// cambiar contraseña desde usuarios
if(isset($_POST["restablecercontraseña"])){
    $nueva_contraseña = $_POST["contraseña"];
            $hash_nueva_contraseña = password_hash($nueva_contraseña, PASSWORD_DEFAULT);
            $usuario = $_POST["restablecercontraseña"]; 

            $update = "UPDATE `proyecto`.`usuarios` SET `contraseña` = '$hash_nueva_contraseña' WHERE (`nombre` = '$usuario')";
            
            $conexion=bbdd();

            // Ejecutar la consulta
            if ($conexion->query($update) === TRUE) {

                $_SESSION['contraseña']="Contraseña restablecida con exito";

                header("Location: usuarios.php");
                exit();    
            } else {
                $_SESSION['contraseña'] = "<b>Error en la base de datos</b>";
                 header("Location: usuarios.php");
                exit();
                 echo "Error: " . $update . "<br>" . $conexion->error;
            }
}

// cambiar rol desde usuarios
if(isset($_POST["rolusuario"])){
    $usuario = $_POST["rolusuario"]; 
    $rol = $_POST["rol"];
    $update = "UPDATE `proyecto`.`usuarios` SET `rol` = '$rol' WHERE (`nombre` = '$usuario')";
    
    $conexion=bbdd();
    // Ejecutar la consulta
    if ($conexion->query($update) === TRUE) {
        header("Location: usuarios.php");
        exit();    } else {
        echo "Error: " . $update . "<br>" . $conexion->error;
    }
    // Cerrar la conexión
    $conexion->close();
}

// cambiar grupo desde usuarios
if(isset($_POST["grupousuario"])){
    $usuario = $_POST["grupousuario"]; 
    $grupo = $_POST["grupo"];
    $update = "UPDATE `proyecto`.`usuarios` SET `grupo` = '$grupo' WHERE (`nombre` = '$usuario')";
    
    $conexion=bbdd();
    // Ejecutar la consulta
    if ($conexion->query($update) === TRUE) {
        header("Location: usuarios.php");
        exit();    } else {
        echo "Error: " . $update . "<br>" . $conexion->error;
    }
    // Cerrar la conexión
    $conexion->close();
}

// añadir nuevo grupo
if(isset($_POST["nuevogrupo"])){
    $grupo = $_POST["grupo"];
    $sql ="INSERT INTO `proyecto`.`grupo` (`nombre`) VALUES ('$grupo')";
    $conexion=bbdd();
    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        header("Location: usuarios.php");
        exit();    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
    // Cerrar la conexión
    $conexion->close();
}

// borrar un grupo
if(isset($_POST["eliminargrupo"])){
    $grupo = $_POST["grupo"];
    $delete = "DELETE FROM `grupo` WHERE (`nombre` = '$grupo')";

    $conexion=bbdd();
    // Ejecutar la consulta
    if ($conexion->query($delete) === TRUE) {
        header("Location: usuarios.php");
        exit();    } else {
        echo "Error: " . $delete . "<br>" . $conexion->error;
    }
    // Cerrar la conexión
    $conexion->close();
}

// añadir nuevo usuario
if(isset($_POST["nuevousuario"])){
    $nombre = $_POST["nombre"];
    $contraseña = $_POST["contraseña"];
    $hash_contraseña = password_hash($contraseña, PASSWORD_DEFAULT);

    $rol = $_POST["rol"];
    $grupo = $_POST["grupo"];

    if($_POST["grupo"] == ""){
        $insert ="INSERT INTO `proyecto`.`usuarios` (`nombre`, `contraseña`, `rol`) VALUES ('$nombre', '$hash_contraseña', '$rol')";

    }else{
        $insert ="INSERT INTO `proyecto`.`usuarios` (`nombre`, `contraseña`, `rol`, `grupo`) VALUES ('$nombre', '$hash_contraseña', '$rol', '$grupo')";
    }

    $conexion=bbdd();
    // Ejecutar la consulta
    if ($conexion->query($insert) === TRUE) {
        header("Location: usuarios.php");
        exit();    } else {
        echo "Error: " . $insert . "<br>" . $conexion->error;
    }
    // Cerrar la conexión
    $conexion->close();
}

// borrar un usuario
if(isset($_POST["borrarusuario"])){
    $user = $_POST["borrarusuario"];
    $delete = "DELETE FROM `proyecto`.`usuarios` WHERE (`nombre` = '$user')";

    $conexion=bbdd();
    // Ejecutar la consulta
    if ($conexion->query($delete) === TRUE) {
        header("Location: usuarios.php");
        exit();    } else {
        echo "Error: " . $delete . "<br>" . $conexion->error;
    }
    // Cerrar la conexión
    $conexion->close();
}

?>