<?php
require 'db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $username, $password);

  if ($stmt->execute()) {
    $message = "Usuario registrado correctamente.";
  } else {
    $message = "Error: " . $stmt->error;
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Registro</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <h2>Registro de usuario</h2>
  <p><?= $message ?></p>
  <form method="POST">
    <input type="text" name="username" placeholder="Usuario" required><br>
    <input type="password" name="password" placeholder="Contraseña" required><br>
    <button type="submit">Registrar</button>
  </form>
  <a href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
</body>

</html>