<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: /login.html");
    exit();
}
$nombre_usuario = $_SESSION['usuario'];
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : '0';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartParking UACJ - Geolocalización</title>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="Styles/dashboard-style.css"> 
    
    <style>
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


        .geo-layout {
            display: flex;
            width: 100%;
            height: calc(100vh - 120px); 
        }
        #map {
            width: 100%;
            height: 100%;
            min-height: 400px;
        }
    </style>
</head>
<body>

    <div class="overlay-nav" id="nav-overlay"></div>
    <aside class="nav-sidebar" id="nav-sidebar">
        <div style="text-align: center; padding: 20px;">
            <img src="Imagenes/uacj-logo.png" alt="UACJ" style="height: 50px;">
        </div>
        <a href="/dashboard.php">Mapa de Cajones</a>
        <a href="confirmacion.php">Mi Reserva Activa</a>
        <a href="ubicacion.php">Geolocalización</a>
        <a href="ficha.php">lol</a>

        <a href="PHP/logout.php" style="color: #FFD700; margin-top: auto; border-top: 1px solid white;">Cerrar Sesión</a>
    </aside>

    <nav class="navbar">
        <div class="nav-welcome" style="display: flex; align-items: center;">
            <div class="menu-toggle" id="open-menu">
                <span></span><span></span><span></span>
            </div>
            ¡Bienvenido, <strong><?php echo htmlspecialchars($nombre_usuario); ?></strong>!
        </div>
        <div class="nav-logo">
            <img src="Imagenes/uacj-logo.png" alt="Logo UACJ">
        </div>
        <div class="nav-logout">
            <a href="PHP/logout.php" class="logout-link">Cerrar sesión</a>
        </div>
    </nav>

<div class="geo-layout">
    <aside class="geo-sidebar" style="width: 320px; padding: 25px; background: white; box-shadow: 2px 0 10px rgba(0,0,0,0.1); z-index: 10;">
        <h2 style="color: #003366; border-bottom: 2px solid #FFD700; padding-bottom: 10px;">Campus UACJ</h2>
        <p style="font-size: 0.9rem; color: #666;">Selecciona un campus para localizar su área de estacionamiento inteligente.</p>
        
        <select id="campus-selector" class="geo-select" style="width: 100%; padding: 12px; border-radius: 8px; border: 2px solid #003366; font-weight: bold; margin-bottom: 25px;">
            <option value="iit_iada">IIT / IADA</option>
            <option value="icsa">ICSA</option>
            <option value="icb">ICB</option>
            <option value="cu">CU</option>
        </select>

        <div id="info-estacionamiento" style="background: #f9f9f9; padding: 20px; border-radius: 12px; border: 1px solid #ddd;">
    <h3 id="nombre-campus" style="margin-top: 0; color: #003366;">IIT / IADA</h3>
    <p id="detalles-campus" style="font-size: 0.95rem; line-height: 1.5;">Cargando detalles del estacionamiento...</p>
    
    <div style="margin-top: 15px; padding-top: 15px; border-top: 1px dashed #ccc;">
        <span style="display: block; font-size: 0.8rem; color: #888;">Capacidad Estimada:</span>
        <strong id="capacidad-campus">-- cajones</strong>
    </div>
    
    </div>
    </aside>

    <main id="map-container" style="flex: 1; position: relative;">
        <div id="map" style="width: 100%; height: 100%;"></div>
    </main>
</div>

    <footer class="main-footer">
        Este es un trabajo para la clase de Programación Integral - UACJ 2024
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
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


        const USUARIO_ACTUAL_ID = <?php echo $usuario_id; ?>;
    </script>

    <script src="Scripts/scrip.js"></script>
    <script src="Scripts/ubicacion-script.js"></script>
</body>
</html>