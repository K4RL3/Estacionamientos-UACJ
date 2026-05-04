<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
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
    <title>SmartParking UACJ - Panel</title>
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
            width: 25px;
            height: 3px;
            background-color: #FFD700;
            border-radius: 2px;
            transition: 0.3s;
        }

        .nav-sidebar {
            position: fixed;
            top: 0;
            left: -280px;
            /* Escondido */
            width: 280px;
            height: 100%;
            background-color: #003366;
            z-index: 2000;
            transition: 0.4s ease;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            padding-top: 20px;
        }

        .nav-sidebar.open {
            left: 0;
        }

        .nav-sidebar a {
            color: white;
            text-decoration: none;
            padding: 15px 25px;
            font-size: 1.1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: 0.3s;
        }

        .nav-sidebar a:hover {
            background-color: rgba(255, 215, 0, 0.2);
            color: #FFD700;
        }

        .overlay-nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1500;
        }

        .overlay-nav.show {
            display: block;
        }
    </style>
</head>

<body>

    <div class="overlay-nav" id="nav-overlay"></div>
    <aside class="nav-sidebar" id="nav-sidebar">
        <div style="text-align: center; padding: 20px;">
            <img src="Imagenes/uacj-logo.png" alt="UACJ" style="height: 50px;">
        </div>
        <a href="dashboard.php">Mapa de Cajones</a>
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