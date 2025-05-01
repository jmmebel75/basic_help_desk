<?php
session_start();
include("db_connection.php");

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Buscar usuario solo por el correo
$sql = "SELECT * FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verificar la contraseña hasheada
    if (password_verify($contrasena, $user['contraseña'])) {
        $_SESSION['usuario'] = $user;
        header("Location: ../principal.php");
        exit;
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Correo no encontrado.";
}
?>