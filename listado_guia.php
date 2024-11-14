<?php
// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Consultar todas las guías de la base de datos
$query = "SELECT * FROM guias";
$result = $conn->query($query);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Mostrar las guías en una tabla
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Identificación</th>
                <th>Longevidad</th>
                <th>Salario</th>
                <th>Acciones</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td> <!-- Muestra el ID -->
                <td>" . $row['nombre'] . "</td>
                <td>" . $row['identificacion'] . "</td>
                <td>" . $row['longevidad'] . "</td>
                <td>" . $row['salario'] . "</td>
                <td>
                    <a href='editar_guia.php?id=" . $row['id'] . "' class='button'>Editar</a> |
                    <a href='eliminar_guia.php?id=" . $row['id'] . "' class='button' onclick='return confirmarEliminar()'>Eliminar</a>
                </td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron guías.";
}

$conn->close();
?>
