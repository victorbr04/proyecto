<?php
$error_message = "";

if (isset($_POST["username"])) {
    include 'funciones.php';
    $conexion = bbdd();

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM usuarios WHERE nombre = '$username'";

    $resultado = $conexion->query($sql);
    if ($resultado->num_rows == 1) {
        $fila = $resultado->fetch_assoc();
        if (password_verify($password, $fila['contraseña'])) {
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["rol"] = $fila['rol'];
            $_SESSION["username"] = $fila['nombre'];
            $_SESSION["grupo"] = $fila['grupo'];
            header("location: index.php");
            exit;
        } else {
            $error_message = "Usuario o contraseña incorrectos";
        }
    } else {
        $error_message = "Usuario o contraseña incorrectos";
    }
}

if (isset($_SESSION["loggedin"])&& $_SESSION["loggedin"] = true) {
    header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualización de Cámaras IP</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Visualización de Cámaras IP</h1>
        </div>
    </header>

    <div id="login-modal" class="modal" style="<?php if (isset($_GET['show_login_modal']) && $_GET['show_login_modal'] === 'true' || $error_message !== "") { echo "display: block;"; } ?>">
        <div class="modal-content">
            <div class="login-container">
                <h2>Iniciar sesión</h2>
                <?php if ($error_message !== "") { echo '<p class="error">' . $error_message . '</p>'; } ?>
                <form action="login.php" method="post">
                    <input type="text" name="username" placeholder="Usuario" required>
                    <input type="password" name="password" placeholder="Contraseña" required><p>
                    <button type="submit">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>

<footer class="footer">
        <div class="container">&copy; 2024 Visualizaci  n de C  maras IP</br>
<?php $ip = getHostByName(getHostName());
echo "$ip";?>
</br></div>
</footer>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("close-login-modal").addEventListener("click", function() {
                document.getElementById("login-modal").style.display = "none";
            });
        });
    </script>
</body>
</html>
