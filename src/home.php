<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Bienvenido, <?= htmlspecialchars($_SESSION['username']) ?></h2>
<a href="logout.php">Cerrar sesión</a>
</body>
</html>
