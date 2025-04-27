<?php
session_start();
include("db_connection.php");

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND contraseña = '$contrasena'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $_SESSION['usuario'] = $user;
    header("Location: ../principal.php");
} else {
    echo "Correo o contraseña incorrectos";
}
?>