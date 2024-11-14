<?php
// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si el ID de la guía se ha enviado por POST
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Consulta SQL para obtener los datos de la guía con el ID proporcionado
    $query = "SELECT * FROM guias WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id); // Bind el ID de la guía al parámetro de la consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el guía
    if ($result->num_rows > 0) {
        // Obtener los datos de la guía
        $guia = $result->fetch_assoc();
    } else {
        echo "Guía no encontrada.";
        exit;
    }
} else {
    echo "ID no especificado.";
    exit;
}
?>

<!-- Formulario para editar la guía -->
<form action="actualizar_guia.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $guia['id']; ?>">

    <label for="nombre">Nombre del Guía:</label>
    <input type="text" name="nombre" value="<?php echo $guia['nombre']; ?>" required>

    <label for="identificacion">Número de Identificación:</label>
    <input type="text" name="identificacion" value="<?php echo $guia['identificacion']; ?>" required>

    <label for="longevidad">Longevidad (años):</label>
    <input type="number" name="longevidad" value="<?php echo $guia['longevidad']; ?>" required>
     <label for="salario">Salario:</label>
    <input type="number" name="salario" value="<?php echo $guia['salario']; ?>" required>

    <button type="submit">Actualizar</button>
</form>


