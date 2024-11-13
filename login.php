<?php
// Habilitar el reporte de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuración de la base de datos
$servidor = "localhost";
$usuario = "root";
$contraseña = "123";
$base_datos = "MecaYuca";

// Crear conexión
$conn = new mysqli($servidor, $usuario, $contraseña, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta para verificar el nombre de usuario y la contraseña
    $sql = "SELECT rol, contrasena FROM clientes WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $stmt->bind_result($rol, $hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Verificar la contraseña
    if ($hashed_password && password_verify($contrasena, $hashed_password)) {
        // Si la contraseña es correcta, redirigir según el rol
        $_SESSION['nombre_usuario'] = $nombre_usuario; // Guardar el nombre de usuario en la sesión
        $_SESSION['rol'] = $rol; // Guardar el rol del usuario

        if ($rol == 'admin') {
            header("Location: admin.html");
            exit();
        } elseif ($rol == 'usuario' || $rol == 'guia') {
            header("Location: cliente.html");
            exit();
        }
    } else {
        echo "<p class='error'>Usuario o contraseña incorrectos</p>";
    }
}

$conn->close();
?>
