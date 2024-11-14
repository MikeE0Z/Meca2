<?php
// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si el parámetro 'id' está presente en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta SQL para eliminar la guía con el ID
    $query = "DELETE FROM guias WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Guía eliminada con éxito.";
        // Redirigir a la lista de guías
        header("Location: listado_guias.php"); // Cambia por la ruta de tu listado
        exit;
    } else {
        echo "Hubo un error al eliminar la guía.";
    }
} else {
    echo "ID no especificado.";
    exit;
}

$conn->close();
?>

