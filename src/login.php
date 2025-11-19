<?php

/**
 * Single blank line
 */

require 'db.php';
session_start();

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: home.php");
        exit;
    } else {
        $message = "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h2>Inicio de sesión</h2>
    <p><?= $message ?></p>
    <form method="POST">
        <input type="text" name="username" placeholder="Usuario" required><br>
        <input type="password" name="password" placeholder="Contraseña" required><br>
        <button type="submit">Ingresar</button>
    </form>
    <a href="register.php">¿No tienes cuenta? Regístrate</a>
</body>

</html>