<?php
$servername = getenv('MYSQL_HOST') ?: 'db';
$username   = getenv('MYSQL_USER') ?: 'root';
$password   = getenv('MYSQL_PASSWORD') ?: 'secret';
$database   = getenv('MYSQL_DATABASE') ?: 'users_db';

// Conexión a MySQL
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// SQL para crear la tabla
$sql = "
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
  "Tabla 'users' creada correctamente.";
} else {
  echo "Error al crear la tabla: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
