<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
$nombre_usuario = $_SESSION['usuario'];
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : '0';
$titulo_pagina = "Ubicaciones";
include 'PHP/navbar.php';
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