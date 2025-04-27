<?php
session_start();
include("db_connection.php");

$usuario_id = $_SESSION['usuario']['id'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];

$sql = "INSERT INTO tickets (usuario_id, titulo, descripcion, categoria) VALUES ('$usuario_id', '$titulo', '$descripcion', '$categoria')";
$conn->query($sql);

header("Location: ../usuario/historial_tickets.php");
?>