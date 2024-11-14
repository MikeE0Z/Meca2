<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar que todos los campos se hayan enviado
if (isset($_POST['nombre_guia'], $_POST['numero_identificacion'], $_POST['longevidad'], $_POST['salario'], $_POST['id_cliente'])) {

    // Obtener valores del formulario
    $nombre_guia = $_POST['nombre_guia'];
    $numero_identificacion = $_POST['numero_identificacion'];
    $longevidad = $_POST['longevidad'];
    $salario = $_POST['salario'];
    $id_cliente = $_POST['id_cliente'];

    // Consulta de inserción de datos
    $sql = "INSERT INTO guias (nombre_guia, numero_identificacion, longevidad, salario, id_cliente)
            VALUES ('$nombre_guia', '$numero_identificacion', '$longevidad', '$salario', '$id_cliente')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Obtener el último id insertado
        $ultimo_id = $conn->insert_id;
        echo "Guía agregada correctamente con ID: " . $ultimo_id;
             hearder("Location: agregar_guia.html")
    } else {
        // Mostrar el error si la consulta falla
        echo "Error al agregar la guía: " . $conn->error;
    }
} else {
    echo "Por favor completa todos los campos";
}


