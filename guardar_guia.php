
<?php
include 'conexion.php';

if (isset($_POST['nombre_guia'], $_POST['numero_identificacion'], $_POST['longevidad'], $_POST['salario'], $_POST['id_cliente'])) {
    $nombre_guia = $_POST['nombre_guia'];
    $numero_identificacion = $_POST['numero_identificacion'];
    $longevidad = $_POST['longevidad'];
    $salario = $_POST['salario'];
    $id_cliente = $_POST['id_cliente'];

    $sql = "INSERT INTO guias (nombre_guia, numero_identificacion, longevidad, salario, id_cliente)
            VALUES ('$nombre_guia', '$numero_identificacion', '$longevidad', '$salario', '$id_cliente')";

    if ($conn->query($sql) === TRUE) {
        echo "Guía agregada correctamente";
    } else {
        echo "Error al agregar la guía: " . $conn->error;
    }
} else {
    echo "Por favor completa todos los campos";
}

$conn->close();
?>

