<?php
include("../php/db_connection.php");

// Suponiendo que la tabla "tickets" tiene un campo "usuario_id" que hace referencia a la tabla "usuarios"
$tickets = $conn->query("SELECT tickets.*, usuarios.nombre AS usuario_nombre FROM tickets JOIN usuarios ON tickets.usuario_id = usuarios.id");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ver Tickets</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f4f8;
      padding: 40px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h2 {
      color: #333;
      margin-bottom: 20px;
    }

    a {
      text-decoration: none;
      color: white;
      background-color: #3498db;
      padding: 10px 20px;
      border-radius: 5px;
      margin-bottom: 20px;
      display: inline-block;
    }

    a:hover {
      background-color: #2980b9;
    }

    form {
      background-color: #ffffff;
      border: 1px solid #ccc;
      padding: 15px;
      margin-bottom: 15px;
      width: 100%;
      max-width: 600px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    form input[type="text"],
    form select {
      width: 100%;
      padding: 12px;
      margin-top: 10px;
      margin-bottom: 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    .button-group {
      display: flex;
      justify-content: flex-start;
      gap: 10px;
    }

    form button {
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
    }

    .btn-actualizar {
      background-color: #2ecc71;
      color: white;
    }

    .btn-actualizar:hover {
      background-color: #27ae60;
    }

    .btn-borrar {
      background-color: #e74c3c;
      color: white;
    }

    .btn-borrar:hover {
      background-color: #c0392b;
    }
  </style>
</head>
<body>

<a href="panel_admin.php">Volver</a>
<h2>Todos los Tickets</h2>

<?php while($t = $tickets->fetch_assoc()): ?>
<form method="POST" action="../php/cambiar_estado.php">
  <input type="hidden" name="id" value="<?= $t['id'] ?>">
  <strong><?= $t['titulo'] ?></strong> - <?= $t['estado'] ?>
  
  <!-- Mostrar el nombre del usuario que abrió el ticket -->
  <p><strong>Usuario que abrió el ticket:</strong> <?= htmlspecialchars($t['usuario_nombre']) ?></p>
  
  <select name="estado">
    <option <?= $t['estado'] == 'abierto' ? 'selected' : '' ?>>abierto</option>
    <option <?= $t['estado'] == 'en proceso' ? 'selected' : '' ?>>en proceso</option>
    <option <?= $t['estado'] == 'cerrado' ? 'selected' : '' ?>>cerrado</option>
  </select>
  <input type="text" name="solucion" placeholder="Solución" value="<?= $t['solucion'] ?>">

  <div class="button-group">
    <button type="submit" class="btn-actualizar">Actualizar</button>
    <button type="submit" class="btn-borrar" formaction="../php/borrar_ticket.php" onclick="return confirm('¿Seguro que deseas borrar este ticket?');">Borrar</button>
  </div>
</form>
<?php endwhile; ?>

</body>
</html>




