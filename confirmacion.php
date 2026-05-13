<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: PHP/login.php");
    exit();
}
// Mantenemos consistencia con las variables de tus otros archivos
$cajon = isset($_GET['cajon']) ? $_GET['cajon'] : '---';
$nombre_usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Usuario';
$titulo_pagina = "Mi Reserva";
include 'PHP/navbar.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación | UACJ</title>
    <link rel="stylesheet" href="Styles/confirmacion-style.css">
</head>

<body>
    <div class="split-container">
        <div class="info-panel">
            <div class="status-badge">✓ RESERVA ACTIVA</div>
            <h1>Confirmación</h1>
            <p>Tu lugar asignado es:</p>
            <div class="cajon-display"><?php echo htmlspecialchars($cajon); ?></div>
            <div class="warning">
                ⚠️ Tienes 24 horas para ocupar el lugar o se liberará automáticamente.
            </div>
            <br>
            <a href="dashboard.php" style="color: #003366; font-weight: bold; text-decoration: none;">← Volver al Mapa</a>
        </div>
        <div class="visual-panel">
            <div class="carousel-container">
                <button class="carousel-btn prev" id="prevBtn">&#10094;</button>
                <button class="carousel-btn next" id="nextBtn">&#10095;</button>
                <div class="carousel-track" id="track">
                    <div class="slide"><img src="Imagenes/ESTACIONAMIENTO-1024x498.jpg" alt="Parking 1"></div>
                    <div class="slide"><img src="Imagenes/iada-banner.jpg" alt="IADA"></div>
                    <div class="slide"><img src="Imagenes/image.jpg" alt="UACJ"></div>
                    <div class="slide"><img src="Imagenes/parkin-uacj-iada.jpg" alt="IADA Parking"></div>
                    <div class="slide"><img src="Imagenes/uacj-iit.jpg" alt="IIT"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="lightbox" class="lightbox">

        <span class="close-lightbox">&times;</span>

        <img class="lightbox-content" id="imgFull">

        <div id="caption" class="lightbox-caption"></div>
    </div>
        <footer class="creadora-footer">
        Programación Integral - Universidad Autónoma de Ciudad Juárez
    </footer>
    <script>
        const btnOpen = document.getElementById('open-menu');
        const sideNav = document.getElementById('nav-sidebar');
        const overlay = document.getElementById('nav-overlay');
        function toggleNav() {
            sideNav.classList.toggle('open');
            overlay.classList.toggle('show');
        }
        btnOpen.addEventListener('click', toggleNav);
        overlay.addEventListener('click', toggleNav);
    </script>
    <script src="Scripts/confirmacion-script.js"></script>
</body>

</html>