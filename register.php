<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (!preg_match('/@alumnos\.uacj\.mx$/', $email)) {
    echo "<script>alert('Solo se permiten correos institucionales'); window.location='login.html';</script>";
    exit();
}

    // Comprobar si el correo ya está registrado
    $sql_check = "SELECT * FROM usuarios WHERE email = '$email'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        // Si el correo ya está registrado
        echo "<script>alert('El correo electrónico ya está registrado.'); window.location='login.html';</script>";
    } else {
        // Si el correo no está registrado, insertamos el nuevo usuario
        $sql = "INSERT INTO usuarios (nombre, email, password) 
                VALUES ('$nombre', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            // Si el registro fue exitoso
            echo "<script>alert('Usuario registrado correctamente'); window.location='login.html';</script>";
        } else {
            // Si hubo un error al insertar en la base de datos
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>