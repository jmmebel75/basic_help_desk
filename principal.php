<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
if ($_SESSION['usuario']['rol'] === 'admin') {
    header("Location: admin/panel_admin.php");
} else {
    header("Location: usuario/menu.php");
}
?>