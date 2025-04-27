<?php
session_start();
include("../php/db_connection.php");
$id = $_SESSION['usuario']['id'];
$tickets = $conn->query("SELECT * FROM tickets WHERE usuario_id = $id");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Tickets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container-tickets {
            width: 80%;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .volver-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        .volver-link:hover {
            background-color: #2980b9;
        }

        .ticket-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .ticket-item {
            background-color: #f9f9fb;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.1em;
        }

        /* Estado "Abierto" (verde) */
        .ticket-status.abierto {
            color: #2ecc71; /* Verde */
            font-weight: bold;
        }

        /* Estado "Cerrado" (rojo) */
        .ticket-status.cerrado {
            color: #e74c3c; /* Rojo */
            font-weight: bold;
        }

        /* Estado "En Proceso" (azul) */
        .ticket-status.proceso {
            color: #3498db; /* Azul */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container-tickets">
        <a class="volver-link" href="menu.php">Volver</a>
        <h2>Mis Tickets</h2>
        <ul class="ticket-list">
            <?php while($t = $tickets->fetch_assoc()): 
                $estado = strtolower($t['estado']);
                // Determinar la clase según el estado del ticket
                if ($estado === 'abierto') {
                    $clase_estado = 'abierto';
                } elseif ($estado === 'en proceso') {
                    $clase_estado = 'proceso';
                } else {
                    $clase_estado = 'cerrado';
                }
            ?>
                <li class="ticket-item">
                    <?= htmlspecialchars($t['titulo']) ?> - 
                    <span class="ticket-status <?= $clase_estado ?>">
                        <?= ucfirst($estado) ?>
                    </span>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>


