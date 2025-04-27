<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Usuario</title>
    <link rel="stylesheet" href="../css/estilos.css"> <!-- Vincula el archivo CSS -->
</head>
<body>
    <div class="menu-container">
        <div id="menu">
            <a class="create-ticket" href="crear_ticket.php">Crear Ticket</a> |
            <a class="historial" href="historial_tickets.php">Historial de Tickets</a> |
            <a class="logout" href="../php/logout.php">Cerrar sesión</a>
        </div>
    </div>
</body>
</html>
