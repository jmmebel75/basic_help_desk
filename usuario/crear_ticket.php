<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="../css/estilos.css"></head>
<body>
<div class="container-crear-ticket">
<form method="POST" action="../php/guardar_ticket.php">
  <input name="titulo" placeholder="Título">
  <textarea name="descripcion" placeholder="Descripción"></textarea>
  <select name="categoria">
    <option>Departamento de redes</option>
    <option>Departamento de Software</option>
    <option>Departamento de Hardware</option>
  </select>
  <button type="submit">Crear</button>
</form>
</div>
</body>
</html>