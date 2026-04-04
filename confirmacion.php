<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
// Mantenemos consistencia con las variables de tus otros archivos
$cajon = isset($_GET['cajon']) ? $_GET['cajon'] : '---';
$nombre_usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Usuario';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación | UACJ</title>
    <link rel="stylesheet" href="confirmacion-style.css">
    <style>
        /* ESTILOS PARA EL MENÚ (Consistentes con Dashboard/Ubicación) */
        .menu-toggle {
            cursor: pointer;
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin-right: 15px;
            vertical-align: middle;
        }
        .menu-toggle span {
            width: 25px; height: 3px;
            background-color: #FFD700;
            border-radius: 2px;
            transition: 0.3s;
        }

        .nav-sidebar {
            position: fixed;
            top: 0; left: -280px;
            width: 280px; height: 100%;
            background-color: #003366;
            z-index: 2000;
            transition: 0.4s ease;
            box-shadow: 5px 0 15px rgba(0,0,0,0.3);
            display: flex; flex-direction: column;
            padding-top: 20px;
        }
        .nav-sidebar.open { left: 0; }

        .nav-sidebar a {
            color: white;
            text-decoration: none;
            padding: 15px 25px;
            font-size: 1.1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            transition: 0.3s;
        }
        .nav-sidebar a:hover {
            background-color: rgba(255, 215, 0, 0.2);
            color: #FFD700;
        }

        .overlay-nav {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            display: none;
            z-index: 1500;
        }
        .overlay-nav.show { display: block; }
        
        /* Ajuste para que el navbar sea igual a los anteriores */
        .navbar {
            background-color: #003366;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            height: 60px;
        }
        .nav-logo img { height: 45px; }
        .logout-link { color: #FFD700; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

    <div class="overlay-nav" id="nav-overlay"></div>
    <aside class="nav-sidebar" id="nav-sidebar">
        <div style="text-align: center; padding: 20px;">
            <img src="uacj-logo.png" alt="UACJ" style="height: 50px;">
        </div>
        <a href="dashboard.php">Mapa de Cajones</a>
        <a href="confirmacion.php">Mi Reserva Activa</a>
        <a href="ubicacion.php">Geolocalización</a>
        <a href="logout.php" style="color: #FFD700; margin-top: auto; border-top: 1px solid white; padding: 20px;">🚪 Cerrar Sesión</a>
    </aside>

    <nav class="navbar">
        <div class="nav-welcome" style="display: flex; align-items: center;">
            <div class="menu-toggle" id="open-menu">
                <span></span><span></span><span></span>
            </div>
            Bienvenido, <strong><?php echo htmlspecialchars($nombre_usuario); ?></strong>
        </div>
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
            <br>
            <a href="dashboard.php" style="color: #003366; font-weight: bold; text-decoration: none;">← Volver al Mapa</a>
        </div>

        <div class="visual-panel">
            <div class="carousel-container">
                <button class="carousel-btn prev" id="prevBtn">&#10094;</button>
                <button class="carousel-btn next" id="nextBtn">&#10095;</button>
                <div class="carousel-track" id="track">
                    <div class="slide"><img src="ESTACIONAMIENTO-1024x498.jpg" alt="Parking 1"></div>
                    <div class="slide"><img src="iada-banner.jpg" alt="IADA"></div>
                    <div class="slide"><img src="image.jpg" alt="UACJ"></div>
                    <div class="slide"><img src="parkin-uacj-iada.jpg" alt="IADA Parking"></div>
                    <div class="slide"><img src="uacj-iit.jpg" alt="IIT"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="lightbox" class="lightbox">
        <span class="close-lightbox">&times;</span>
        <img class="lightbox-content" id="imgFull">
        <div id="caption" class="lightbox-caption"></div>
    </div>

    <div class="mini-footer">Sistema SmartParking UACJ 2024</div>

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

    <script src="confirmacion-script.js"></script>
</body>
</html>