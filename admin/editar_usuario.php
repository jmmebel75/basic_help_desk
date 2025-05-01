<?php
session_start();
include("../php/db_connection.php");

// Verificación de acceso y validación de administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Comprobamos que el ID del usuario esté presente y sea válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de usuario no proporcionado o inválido");
}

$id = intval($_GET['id']); // Forzamos conversión a entero

// Obtener datos del usuario
$query = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

// Si no encontramos el usuario, mostrar error
if (!$usuario) {
    die("Usuario no encontrado");
}

// Actualizar datos del usuario cuando se envíe el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $rol = $_POST['rol'];
    
    // Validación básica
    if (empty($nombre) || empty($correo)) {
        die("Nombre y correo son campos obligatorios");
    }

    // Preparar consulta de actualización
    $query = "UPDATE usuarios SET nombre = ?, correo = ?, rol = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    
    $stmt->bind_param("sssi", $nombre, $correo, $rol, $id);
    
    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Usuario actualizado correctamente";
        header("Location: ver_usuarios.php");
        exit();
    } else {
        die("Error al actualizar los datos del usuario: " . $stmt->error);
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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }
        .admin-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h2>Editar Usuario</h2>
        <form method="POST" action="">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>

            <label for="correo">Correo:</label>
            <input type="email" name="correo" id="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required>

            <label for="rol">Rol:</label>
            <select name="rol" id="rol" required>
                <option value="usuario" <?= $usuario['rol'] == 'usuario' ? 'selected' : '' ?>>Usuario</option>
                <option value="admin" <?= $usuario['rol'] == 'admin' ? 'selected' : '' ?>>Administrador</option>
            </select>

            <button type="submit">Actualizar</button>
        </form>
        <a href="ver_usuarios.php">← Volver al Listado de Usuarios</a>
    </div>
</body>
</html>






