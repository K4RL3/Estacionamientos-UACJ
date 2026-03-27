<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
$cajon = isset($_GET['cajon']) ? $_GET['cajon'] : '---';
$usuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación | UACJ</title>
    <link rel="stylesheet" href="confirmacion-style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-welcome">Bienvenido, <?php echo htmlspecialchars($usuario); ?></div>
        <div class="nav-logo"><img src="uacj-logo.png" alt="UACJ"></div>
        <div class="nav-logout"><a href="logout.php" class="logout-link">Cerrar Sesión</a></div>
    </nav>

    <div class="split-container">
        <div class="info-panel">
            <div class="status-badge">✓ RESERVA ACTIVA</div>
            <h1>Confirmación</h1>
            <p>Tu lugar asignado es:</p>
            <div class="cajon-display"><?php echo htmlspecialchars($cajon); ?></div>
            <div class="warning">
                ⚠️ Tienes 24 horas para ocupar el lugar o se liberará automáticamente.
            </div>
            
        </div>

        <div class="visual-panel">
            <div class="carousel-container">
                <button class="carousel-btn prev" id="prevBtn">&#10094;</button>
                <button class="carousel-btn next" id="nextBtn">&#10095;</button>
                <div class="carousel-track" id="track">
                    <div class="slide"><img src="ESTACIONAMIENTO-1024x498.jpg" data-caption=""></div>
                    <div class="slide"><img src="iada-banner.jpg" data-caption=""></div>
                    <div class="slide"><img src="image.jpg" data-caption=""></div>
                    <div class="slide"><img src="parkin-uacj-iada.jpg" data-caption=""></div>
                    <div class="slide"><img src="uacj-iit.jpg" data-caption=""></div>
                    <div class="slide"><img src="ESTACIONAMIENTO-1024x498.jpg" data-caption=""></div>
                    <div class="slide"><img src="iada-banner.jpgjpg" data-caption=""></div>
                </div>
            </div>
        </div>
    </div>

    <div id="lightbox" class="lightbox">
        <span class="close-lightbox">&times;</span>
        <img class="lightbox-content" id="imgFull">
        <div id="caption" class="lightbox-caption"></div>
    </div>
<div class="mini-footer">Sistema UACJ </div>
    <script src="confirmacion-script.js"></script>
</body>
</html>