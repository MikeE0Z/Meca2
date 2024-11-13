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

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'edit' && isset($_GET['nombre_lugar'])) {
        // Editar un lugar
        $nombre_lugar = $_GET['nombre_lugar'];
        $result = $conn->query("SELECT * FROM lugares WHERE nombre_lugar = '$nombre_lugar'");
        $lugar = $result->fetch_assoc();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Actualizar los datos del lugar
            $nuevo_nombre_lugar = $_POST['nombre_lugar'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];
            $costo_por_persona = $_POST['costo_por_persona'];

            $update_query = "UPDATE lugares SET nombre_lugar='$nuevo_nombre_lugar', fecha_inicio='$fecha_inicio', fe>

            if ($conn->query($update_query) === TRUE) {
                echo "Lugar actualizado correctamente.";
                header('Location: ' . $_SERVER['PHP_SELF']); // Redirigir de nuevo al listado
            } else {
                echo "Error al actualizar el lugar: " . $conn->error;
            }
        }

        echo '<h2>Editar Lugar</h2>';
        echo '<form action="?action=edit&nombre_lugar=' . urlencode($nombre_lugar) . '" method="POST">
                <label>Nombre del Lugar:</label>
                <input type="text" name="nombre_lugar" value="' . $lugar['nombre_lugar'] . '" required>
                <label>Fecha de Inicio:</label>
                <input type="date" name="fecha_inicio" value="' . $lugar['fecha_inicio'] . '" required>
                <label>Fecha de Fin:</label>
                <input type="date" name="fecha_fin" value="' . $lugar['fecha_fin'] . '" required>
                <label>Costo por Persona:</label>
                <input type="number" name="costo_por_persona" value="' . $lugar['costo_por_persona'] . '" required>
                <button type="submit">Actualizar Lugar</button>
            </form>';

    } elseif ($_GET['action'] == 'delete' && isset($_GET['nombre_lugar'])) {
        // Eliminar un lugar
        $nombre_lugar = $_GET['nombre_lugar'];
        $delete_query = "DELETE FROM lugares WHERE nombre_lugar = '$nombre_lugar'";


        if ($conn->query($delete_query) === TRUE) {
            echo "Lugar eliminado correctamente.";
        } else {
            echo "Error al eliminar el lugar: " . $conn->error;
        }
    }
}

// Mostrar los lugares
$result = $conn->query("SELECT * FROM lugares");

echo '<h2>Gestión de Lugares</h2>';
echo '<table border="1"><tr><th>Nombre del Lugar</th><th>Fecha de Inicio</th><th>Fecha de Fin</th><th>Costo por Pers>

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['nombre_lugar'] . "</td>
                <td>" . $row['fecha_inicio'] . "</td>
                <td>" . $row['fecha_fin'] . "</td>
                <td>" . $row['costo_por_persona'] . "</td>
                <td>
                    <a href='?action=edit&nombre_lugar=" . urlencode($row['nombre_lugar']) . "'>Editar</a> |
                    <a href='?action=delete&nombre_lugar=" . urlencode($row['nombre_lugar']) . "' onclick='return co>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No hay lugares disponibles.</p>";
}

// Cerrar conexión
$conn->close();
?>