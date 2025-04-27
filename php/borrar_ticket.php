<?php
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = intval($_POST["id"]);
    $stmt = $conn->prepare("DELETE FROM tickets WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: ../admin/ver_tickets.php");
        exit();
    } else {
        echo "Error al borrar el ticket.";
    }
}
?>
