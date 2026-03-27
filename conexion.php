<?php
$host = "fdb1032.awardspace.net";
$user = "4741371_bdestacionamiento";
$password = "MMYgqlSz3CYuk-";
$database = "4741371_bdestacionamiento";
$port = 3306;

// Crear conexión
$conn = new mysqli($host, $user, $password, $database, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Opcional: establecer charset para evitar errores con tildes
$conn->set_charset("utf8");
?>