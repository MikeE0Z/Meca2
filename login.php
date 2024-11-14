<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta para verificar el nombre de usuario y la contraseña
    $sql = "SELECT rol, contrasena FROM clientes WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $stmt->bind_result($rol, $stored_password);
    $stmt->fetch();
    $stmt->close();

    // Verificar si la contraseña ingresada coincide con la almacenada (sin encriptación)
    if ($stored_password && $contrasena == $stored_password) {
        // Guardar nombre de usuario y rol en la sesión
        $_SESSION['nombre_usuario'] = $nombre_usuario;
        $_SESSION['rol'] = $rol;

        // Verificar el rol y redirigir
        if ($rol == 'admin') {
            header("Location: admin.html");  // Redirigir a admin.html para el administrador
            exit();
        } elseif ($rol == 'usuario' || $rol == 'guia') {
            header("Location: clientes.html");  // Redirigir a cliente.html para usuarios normales o guías
            exit();
        }
    } else {
        echo "<p class='error'>Usuario o contraseña incorrectos</p>";
       header("Location: index.html");
    }
}

$conn->close();
?>
