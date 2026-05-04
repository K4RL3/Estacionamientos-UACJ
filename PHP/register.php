<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (!preg_match('/@alumnos\.uacj\.mx$/', $email)) {
    echo "<script>alert('Solo se permiten correos institucionales'); window.location='/login.html';</script>";
    exit();
}

    $sql_check = "SELECT * FROM usuarios WHERE email = '$email'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo "<script>alert('El correo electrónico ya está registrado.'); window.location='/login.html';</script>";
    } else {
        $sql = "INSERT INTO usuarios (nombre, email, password) 
                VALUES ('$nombre', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Usuario registrado correctamente'); window.location='/login.html';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>