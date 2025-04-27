<?php
session_start();
// Verificación de usuario administrador
include("../php/db_connection.php");

$usuarios = $conn->query("SELECT * FROM usuarios");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Usuarios</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .admin-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%;
        }

        .admin-container h2 {
            margin-bottom: 30px;
            color: #333;
        }

        .admin-container table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .admin-container table, th, td {
            border: 1px solid #ddd;
        }

        .admin-container th, td {
            padding: 12px;
            text-align: left;
        }

        .admin-container th {
            background-color: #3498db;
            color: white;
        }

        .admin-container td {
            background-color: #f9f9f9;
        }

        .admin-container a {
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .admin-container a.edit {
            background-color: #f39c12; /* Naranja */
        }

        .admin-container a.delete {
            background-color: #e74c3c; /* Rojo */
        }

        .admin-container a:hover {
            opacity: 0.8;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #3498db; /* Azul */
            color: white;
            font-weight: bold;
            border-radius: 6px;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h2>Listado de Usuarios</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($usuario = $usuarios->fetch_assoc()): ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= $usuario['nombre'] ?></td>
                    <td><?= $usuario['correo'] ?></td>
                    <td><?= $usuario['rol'] ?></td>
                    <td>
                        <a href="editar_usuario.php?id=<?= $usuario['id'] ?>" class="edit">Editar</a>
                        <a href="eliminar_usuario.php?id=<?= $usuario['id'] ?>" class="delete" onclick="return confirm('¿Seguro que quieres eliminar este usuario?');">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <br>
        <a href="panel_admin.php" class="back-button">Volver al Panel de Administración</a>
    </div>
</body>
</html>





