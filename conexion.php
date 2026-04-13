<?php
$host = "fdb1032.awardspace.net";
$user = "4741371_bdestacionamiento";
$password = "MMYgqlSz3CYuk-";
$database = "4741371_bdestacionamiento";
$port = 3306;

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>