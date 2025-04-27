<?php
session_start();
// Aquí puedes agregar la verificación si el usuario es administrador.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
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
        }

        .admin-container h2 {
            margin-bottom: 30px;
            color: #333;
        }

        .admin-container a {
            display: inline-block;
            margin: 10px 15px;
            padding: 12px 25px;
            text-decoration: none;
            font-weight: bold;
            color: white;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .admin-container a[href*="ver_tickets"] {
            background-color: #2ecc71; /* Verde */
        }

        .admin-container a[href*="ver_tickets"]:hover {
            background-color: #27ae60;
        }

        .admin-container a[href*="crear_usuario"] {
            background-color: #3498db; /* Azul */
        }

        .admin-container a[href*="crear_usuario"]:hover {
            background-color: #2980b9;
        }

        .admin-container a[href*="ver_usuarios"] {
            background-color: #f39c12; /* Naranja */
        }

        .admin-container a[href*="ver_usuarios"]:hover {
            background-color: #e67e22;
        }

        .admin-container a[href*="logout"] {
            background-color: #e74c3c; /* Rojo */
        }

        .admin-container a[href*="logout"]:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h2>Panel de Administración</h2>
        <a href="ver_tickets.php">Ver Tickets</a> |
        <a href="crear_usuario.php">Crear Usuario</a> |
        <a href="ver_usuarios.php">Ver Usuarios</a> |
        <a href="../php/logout.php">Cerrar sesión</a>
    </div>
</body>
</html>


