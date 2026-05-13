<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: PHP/login.php");
    exit();
}
// Mantenemos consistencia con las variables de tus otros archivos
$cajon = isset($_GET['cajon']) ? $_GET['cajon'] : '---';
$nombre_usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Usuario';
$titulo_pagina = "Site Map";
include 'PHP/navbar.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentación | SmartParking UACJ</title>
    <link rel="stylesheet" href="Styles/sitemap.css"> 
</head>
<body>
    <div class="doc-container">
        
        <section class="doc-section">
            <h2>Mapa del Sitio (Site Map)</h2>
            <div style="margin-top:20px;">
                <img src="Imagenes/Site Map SmartParking UACJ.jpg" alt="Sitemap SmartParking UACJ" class="sitemap-img">
            </div>
            <p style="margin-top:15px; color: #666;">Estructura jerárquica de navegación del sistema SmartParking.</p>
        </section>

        <section class="doc-section">
            <h2>Paleta de Colores Institucional</h2>
            <div class="color-grid">
                <div class="color-item" style="background-color: #003366;">
                    Principal
                    <div class="color-info">HEX: #003366</div>
                </div>
                <div class="color-item" style="background-color: #FFD700;">
                    Acento
                    <div class="color-info">HEX: #FFD700</div>
                </div>
                <div class="color-item" style="background-color: #2ecc71;">
                    Disponible
                    <div class="color-info">HEX: #2ECC71</div>
                </div>
                <div class="color-item" style="background-color: #e74c3c;">
                    Ocupado
                    <div class="color-info">HEX: #E74C3C</div>
                </div>
                <div class="color-item" style="background-color: #95a5a6;">
                    Pasillo
                    <div class="color-info">HEX: #95A5A6</div>
                </div>
            </div>
            <p style="margin-top:20px; color: #666;">Colores usados en el proyecto.</p>
        </section>

    </div>

    <footer style="text-align:center; padding: 20px; color: #666;">
        SmartParking UACJ - Documentación Técnica 2026
    </footer>

    <script>
        // Lógica para que el menú hamburguesa funcione
        const btnOpen = document.getElementById('open-menu');
        if(btnOpen){
            btnOpen.onclick = function() {
                document.getElementById('nav-sidebar').classList.toggle('open');
                document.getElementById('nav-overlay').classList.toggle('show');
            };
        }
        
        // Cerrar al dar click en el overlay
        const overlay = document.getElementById('nav-overlay');
        if(overlay){
            overlay.onclick = function() {
                document.getElementById('nav-sidebar').classList.remove('open');
                overlay.classList.remove('show');
            };
        }
    </script>
</body>
</html>