<?php
// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Verificar que los datos del formulario estén presentes
if (isset($_POST['id'], $_POST['nombre'], $_POST['identificacion'], $_POST['>
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $identificacion = $_POST['identificacion'];
    $longevidad = $_POST['longevidad'];
    $salario = $_POST['salario'];

    // Realizar la actualización de los datos del guía
    $query = "UPDATE guias SET nombre = ?, identificacion = ?, longevidad = >
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdis", $nombre, $identificacion, $longevidad, $salar>

    if ($stmt->execute()) {
        echo "Guía actualizada con éxito.";
        // Redirige a la lista de guías
        header("Location: listado_guias.php"); // Cambia por la ruta donde s>
        exit;
    } else {
        echo "Hubo un error al actualizar la guía.";
    }
} else {
    echo "Datos no válidos.";
}
?>

