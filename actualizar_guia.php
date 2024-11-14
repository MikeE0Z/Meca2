// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Verificar que los datos del formulario estén presentes
if (isset($_POST['id'], $_POST['nombre'], $_POST['identificacion'], $_POST['longevidad'], $_POST['salario'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $identificacion = $_POST['identificacion'];
    $longevidad = $_POST['longevidad'];
    $salario = $_POST['salario'];

    // Realizar la actualización de los datos del guía
    $query = "UPDATE guias SET nombre = ?, identificacion = ?, longevidad = ?, salario = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdis", $nombre, $identificacion, $longevidad, $salario, $id); // 'd' para número y 's' para string

    if ($stmt->execute()) {
        echo "Guía actualizada con éxito.";
        // Redirige a la lista de guías
        header("Location: listado_guias.php"); // Cambia por la ruta donde se listan las guías
        exit;
    } else {
        echo "Hubo un error al actualizar la guía.";
    }
} else {
    echo "Datos no válidos.";
}
?>






