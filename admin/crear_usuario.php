<?php
session_start();
include("../php/db_connection.php");

if (isset($_POST['crear_usuario'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $rol = $_POST['rol'];

    // Cifrar la contraseña
    $contraseña_cifrada = password_hash($contraseña, PASSWORD_DEFAULT);

    // Insertar el usuario en la base de datos
    $query = "INSERT INTO usuarios (nombre, correo, contraseña, rol) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $nombre, $correo, $contraseña_cifrada, $rol);

    if ($stmt->execute()) {
        $mensaje = "Usuario creado con éxito";
    } else {
        $mensaje = "Error al crear el usuario. Intenta de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <style>
        /* Estilos para el formulario */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 30px; /* Añadido espacio extra */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 320px;
            box-sizing: border-box;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container input, .form-container select {
            width: 100%;
            padding: 12px; /* Aumentar el padding para mayor comodidad */
            margin-bottom: 15px; /* Aumentar el espacio entre los campos */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Evitar que el padding afecte el tamaño */
        }
        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 10px;
        }
        .form-container button:hover {
            background-color: #2980b9;
        }
        .mensaje {
            text-align: center;
            margin-top: 15px;
            color: green;
            font-size: 16px;
        }
        .volver-btn {
        width: 100%;
        padding: 12px;
        background-color: #95a5a6;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        display: block;
        font-size: 14px;
        margin-top: 10px;
        box-sizing: border-box;
        }

        .volver-btn:hover {
            background-color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Crear Nuevo Usuario</h2>
        <form method="POST" action="">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="email" name="correo" placeholder="Correo" required>
            <input type="password" name="contraseña" placeholder="Contraseña" required>
            <select name="rol" required>
                <option value="usuario">Usuario</option>
                <option value="admin">Administrador</option>
            </select>
            <button type="submit" name="crear_usuario">Crear Usuario</button>
        </form>
        <?php if (isset($mensaje)): ?>
            <div class="mensaje"><?= $mensaje; ?></div>
        <?php endif; ?>
        <a href="panel_admin.php" class="volver-btn">Volver al Panel</a>
    </div>
</body>
</html>









