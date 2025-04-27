<?php
session_start();
// Verificación de usuario administrador
include("../php/db_connection.php");

if (isset($_GET['id'])) {
    $usuario_id = $_GET['id'];

    // Eliminar el usuario de la base de datos
    $query = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $usuario_id);

    if ($stmt->execute()) {
        echo "Usuario eliminado con éxito.";
        header("Location: ver_usuarios.php");
        exit();
    } else {
        echo "Error al eliminar el usuario: " . $stmt->error;
    }
} else {
    echo "ID de usuario no proporcionado.";
}
?>





