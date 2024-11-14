<?php
// Incluir archivo de conexión
include 'conexion.php';

// Verificar si todos los datos han sido recibidos
if (isset($_POST['nombre_lugar'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['costo_por_persona'], $_POST['descuento'], $_POST['anticipo'], $_POST[>

    // Recibir los valores del formulario
    $nombre_lugar = $_POST['nombre_lugar'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $costo_por_persona = $_POST['costo_por_persona'];
    $descuento = $_POST['descuento'];
    $anticipo = $_POST['anticipo'];
    $guia_especializado = $_POST['guia_especializado'];

    // Preparar la consulta SQL para insertar los datos en la tabla lugares
    $sql = "INSERT INTO lugares (nombre_lugar, fecha_inicio, fecha_fin, costo_por_persona, descuento, anticipo, guia_especializado)
            VALUES ('$nombre_lugar', '$fecha_inicio', '$fecha_fin', '$costo_por_persona', '$descuento', '$anticipo', '$guia_especializado')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Lugar agregado exitosamente";
    } else {
        // Si ocurre un error con la consulta, muestra el mensaje de error
        echo "Error al agregar el lugar: " . $conn->error;
    }

} else {
    echo "Por favor, complete todos los campos del formulario.";
}

// Cerrar la conexión
$conn->close();
?>
