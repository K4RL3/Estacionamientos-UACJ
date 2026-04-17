<?php
header('Content-Type: application/json');

// Configuración MySQL
$mysql_host = '
fdb1032.awardspace.net';
$mysql_user = '4741371_bdestacionamiento';
$mysql_pass = 'MMYgqlSz3CYuk';
$mysql_db = '4741371_bdestacionamiento';

// Configuración Supabase
$supabase_url = 'https://bzgxzktqzgiybvertkkv.supabase.co/rest/v1/estacionamiento';
$supabase_key = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJ6Z3h6a3RxemdpeWJ2ZXJ0a2t2Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzQ0NTEwNjMsImV4cCI6MjA5MDAyNzA2M30.Bw-TtNyQGeTZI6z_17UbT_E4SD9NwEltGu6nN_hejNA';

$action = $_GET['action'] ?? '';

if ($action === 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // 1. Verificar en MySQL
    $conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
    $stmt = $conn->prepare("SELECT id, nombre, password FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($user && password_verify($password, $user['password'])) {
       
        echo json_encode(['success' => true, 'user' => ['id' => $user['id'], 'nombre' => $user['nombre']]]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Credenciales inválidas']);
    }
    $conn->close();
    
} elseif ($action === 'reservar') {
    
    $usuario_id = $_POST['usuario_id'];
    $cajon_id = $_POST['cajon_id']; 
    
    $ch = curl_init("$supabase_url/usuarios_estacionamiento?matricula=eq.$usuario_id");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "apikey: $supabase_key",
        "Authorization: Bearer $supabase_key"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $data = json_decode($response, true);
    
    if (count($data) > 0 && $data[0]['cajon_asignado_id'] !== null) {
        echo json_encode(['success' => false, 'message' => 'Ya tienes un cajón asignado']);
        exit;
    }
    
    curl_setopt($ch, CURLOPT_URL, "$supabase_url/estacionamiento?id=eq.$cajon_id");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['esta_ocupado' => true]));
    curl_exec($ch);
    
    curl_setopt($ch, CURLOPT_URL, "$supabase_url/usuarios_estacionamiento");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'matricula' => $usuario_id,
        'cajon_asignado_id' => $cajon_id
    ]));
    curl_exec($ch);
    
    echo json_encode(['success' => true]);
}
?>