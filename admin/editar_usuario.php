<?php
session_start();
include("../php/db_connection.php");

// Verificación de acceso y validación de administrador
if (!isset($_SESSION['admin'])) {
    header("Location: login.php"); // Si no es administrador, redirigir al login
    exit();
}

// Comprobamos que el ID del usuario esté presente en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Obtener datos del usuario
    $query = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id); // Vinculamos el ID como entero
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();
    
    // Si no encontramos el usuario, redirigir
    if (!$usuario) {
        echo "Usuario no encontrado";
        exit();
    }
} else {
    echo "ID de usuario no proporcionado";
    exit();
}

// Actualizar datos del usuario cuando se envíe el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $rol = $_POST['rol'];
    
    // Preparar consulta de actualización
    $query = "UPDATE usuarios SET nombre = ?, correo = ?, rol = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $nombre, $correo, $rol, $id);
    
    if ($stmt->execute()) {
        header("Location: ver_usuarios.php"); // Redirigir después de la actualización
        exit();
    } else {
        echo "Error al actualizar los datos del usuario";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <style>
        /* Aquí van tus estilos CSS */
    </style>
</head>
<body>
    <div class="admin-container">
        <h2>Editar Usuario</h2>
        <form method="POST" action="editar_usuario.php?id=<?= $usuario['id'] ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?= $usuario['nombre'] ?>" required><br><br>

            <label for="correo">Correo:</label>
            <input type="email" name="correo" id="correo" value="<?= $usuario['correo'] ?>" required><br><br>

            <label for="rol">Rol:</label>
            <select name="rol" id="rol">
                <option value="usuario" <?= $usuario['rol'] == 'usuario' ? 'selected' : '' ?>>Usuario</option>
                <option value="admin" <?= $usuario['rol'] == 'admin' ? 'selected' : '' ?>>Administrador</option>
            </select><br><br>

            <button type="submit">Actualizar</button>
        </form>
        <br>
        <a href="ver_usuarios.php">Volver al Listado de Usuarios</a>
    </div>
</body>
</html>






