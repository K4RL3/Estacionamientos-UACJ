<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
$nombre_usuario = $_SESSION['usuario'];
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : '0';
$titulo_pagina = "Cajones";
include 'PHP/navbar.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartParking UACJ - Panel</title>
    <link rel="stylesheet" href="Styles/dashboard-style.css">
</head>

<body>
    <main class="dashboard-container">

        <aside class="sidebar">
            <h3>Seleccionar Piso</h3>
            <div class="status-bar">
                <button onclick="cargarCajones(1)" class="btn-nivel">Nivel 1</button>
                <button onclick="cargarCajones(2)" class="btn-nivel">Nivel 2</button>
                <button onclick="cargarCajones(3)" class="btn-nivel">Nivel 3</button>
            </div>

            <div class="legend">
                <h4>Leyenda</h4>
                <div class="item"><span class="box libre"></span> Disponible</div>
                <div class="item"><span class="box ocupado"></span> Ocupado</div>
                <div class="item"><span class="box pasillo-ref"></span> Pasillo</div>
            </div>
        </aside>

        <section class="map-area">
            <h1>Mapa de Lugares: IIT-IADA</h1>
            <div class="map-wrapper">
                <div id="mapa-interactivo" class="parking-grid"></div>
            </div>
            <p id="stats">Cargando datos del servidor...</p>
        </section>
    </main>

    <footer class="main-footer">
        Este es un trabajo para la clase de Programación Integral - UACJ 2024
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

    <script>
        const USUARIO_ACTUAL_ID = <?php echo $usuario_id; ?>;
        console.log("Sesión activa para ID:", USUARIO_ACTUAL_ID);
    </script>

    <script src="Scripts/script.js"></script>

    <script>
        window.onload = function() {
            if (typeof cargarCajones === 'function') {
                cargarCajones(1);
            }
        };
    </script>
</body>

</html>