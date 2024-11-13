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



// Verificar si se ha solicitado editar o eliminar una guía
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'edit' && isset($_GET['nombre_guia'])) {
        // Editar una guía
        $nombre_guia = $_GET['nombre_guia'];
        $result = $conn->query("SELECT * FROM guias WHERE nombre_guia = '$nombre_guia'");
        $guia = $result->fetch_assoc();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Actualizar los datos de la guía
            $nuevo_nombre_guia = $_POST['nombre_guia'];
            $numero_identificacion = $_POST['numero_identificacion'];
            $longevidad = $_POST['longevidad'];
            $salario = $_POST['salario'];

            $update_query = "UPDATE guias SET nombre_guia='$nuevo_nombre_guia', numero_identificacion='$numero_ident>

            if ($conn->query($update_query) === TRUE) {
                echo "<p class='success'>Guía actualizada correctamente.</p>";
                header('Location: ' . $_SERVER['PHP_SELF']); // Redirigir de nuevo al listado
            } else {
                echo "<p class='error'>Error al actualizar la guía: " . $conn->error . "</p>";
            }
        }

        echo '<h2 class="title">Editar Guía</h2>';
        echo '<form action="?action=edit&nombre_guia=' . urlencode($nombre_guia) . '" method="POST" class="form-cont>
                <label>Nombre del Guía:</label>
                <input type="text" name="nombre_guia" value="' . $guia['nombre_guia'] . '" required>
                <label>Número de Identificación:</label>
                <input type="text" name="numero_identificacion" value="' . $guia['numero_identificacion'] . '" requi>
                <label>Longevidad (años):</label>
                <input type="number" name="longevidad" value="' . $guia['longevidad'] . '" required>
                <label>Salario:</label>
                <input type="number" name="salario" value="' . $guia['salario'] . '" required>
                <button type="submit" class="btn-submit">Actualizar Guía</button>
            </form>';

    } elseif ($_GET['action'] == 'delete' && isset($_GET['nombre_guia'])) {
        // Eliminar una guía
        $nombre_guia = $_GET['nombre_guia'];
        $delete_query = "DELETE FROM guias WHERE nombre_guia = '$nombre_guia'";

        if ($conn->query($delete_query) === TRUE) {
            echo "<p class='success'>Guía eliminada correctamente.</p>";
        } else {
            echo "<p class='error'>Error al eliminar la guía: " . $conn->error . "</p>";
        }
    }
}

// Mostrar las guías
$result = $conn->query("SELECT * FROM guias");

echo '<h2 class="title">Gestión de Guías</h2>';
echo '<table class="table">
        <tr>
            <th>Nombre del Guía</th>
            <th>Número de Identificación</th>
            <th>Longevidad (años)</th>
            <th>Salario</th>
            <th>Acciones</th>
        </tr>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['nombre_guia'] . "</td>
                <td>" . $row['numero_identificacion'] . "</td>
                <td>" . $row['longevidad'] . "</td>
                <td>" . $row['salario'] . "</td>
                <td>
                    <a href='?action=edit&nombre_guia=" . urlencode($row['nombre_guia']) . "' class='btn-edit'>Edita>
                    <a href='?action=delete&nombre_guia=" . urlencode($row['nombre_guia']) . "' class='btn-delete' o>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No hay guías disponibles.</p>";
}

// Cerrar la conexión
$conn->close();
?>