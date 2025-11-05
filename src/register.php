<?php
require 'db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  
  if (!empty($username) && !empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
      $stmt->bind_param("ss", $username, $hashedPassword);
      try {
        $stmt->execute();
        $message = "✅ Usuario registrado correctamente.";
      } catch (mysqli_sql_exception $e) {
        // Código 1062 = entrada duplicada
        if ($e->getCode() === 1062) {
          $message = "⚠️ El usuario ya existe. Por favor elige otro nombre.";
        } else {
          $message = "⚠️ Error al registrar: " . $e->getMessage();
        }
      }
      $stmt->close();
    } else {
      $message = "⚠️ Error al preparar la consulta: " . $conn->error;
    }
  } else {
    $message = "Por favor completa todos los campos.";
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