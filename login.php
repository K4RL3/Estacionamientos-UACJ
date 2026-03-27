<?php
// Activar reporte de errores
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$host = "fdb1032.awardspace.net";
$user = "4741371_bdestacionamiento";
$password = "MMYgqlSz3CYuk-";
$database = "4741371_bdestacionamiento";
$port = 3306;

// Crear conexión
$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Conexión falló: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // --- CORRECCIÓN AQUÍ: Agregamos "id" a la consulta ---
    $stmt = $conn->prepare("SELECT id, nombre, password FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();
        
        // Verificar la contraseña
        if (password_verify($pass, $user_data['password'])) {
            
            // --- CORRECCIÓN AQUÍ: Guardamos ambos datos en la sesión ---
            $_SESSION['usuario'] = $user_data['nombre']; 
            $_SESSION['usuario_id'] = $user_data['id']; // <--- ESTO ES VITAL
            
            header('Location: dashboard.php');
            exit();
        } else {
            echo "Contraseña incorrecta. <a href='javascript:history.back()'>Volver</a>";
        }
    } else {
        echo "Usuario no encontrado. <a href='javascript:history.back()'>Volver</a>";
    }
    $stmt->close();
}
$conn->close();
?>