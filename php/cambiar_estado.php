<?php
include("db_connection.php");

$id = $_POST['id'];
$estado = $_POST['estado'];
$solucion = $_POST['solucion'];

$sql = "UPDATE tickets SET estado = '$estado', solucion = '$solucion' WHERE id = $id";
$conn->query($sql);

header("Location: ../admin/ver_tickets.php");
?>