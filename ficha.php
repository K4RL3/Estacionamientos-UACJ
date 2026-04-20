<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
$nombre_usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creadora del Proyecto | SmartParking UACJ</title>
    <link rel="stylesheet" href="Styles/ficha-style.css">
</head>
<body>

    <div class="overlay-nav" id="nav-overlay"></div>
    <aside class="nav-sidebar" id="nav-sidebar">
        <div class="sidebar-logo-container">
            <img src="Imagenes/uacj-logo.png" alt="UACJ">
        </div>
        <a href="dashboard.php">Mapa de Cajones</a>
        <a href="confirmacion.php">Mi Reserva Activa</a>
        <a href="ubicacion.php">Geolocalización</a>
        <a href="ficha.php">lol</a>
        <a href="PHP/logout.php" style="color: #FFD700; margin-top: auto; border-top: 1px solid rgba(255,255,255,0.1);">Cerrar Sesión</a>
    </aside>

    <nav class="navbar">
        <div class="nav-welcome">
            <div class="menu-toggle" id="open-menu">
                <span></span><span></span><span></span>
            </div>
            ¡Hola, <strong><?php echo htmlspecialchars($nombre_usuario); ?></strong>!
        </div>
        
        <div class="nav-logo">
            <img src="Imagenes/uacj-logo.png" alt="Logo UACJ">
        </div>
        
        <div class="nav-logout">
            <a href="PHP/logout.php" class="logout-link">Cerrar sesión</a>
        </div>
    </nav>

    <div class="main-content">
        <div class="profile-card">
            <div class="card-header"></div>
            <div class="avatar-container">
                <img src="Imagenes/ficha.jpg" alt="Foto identificacion" class="profile-img">
            </div>
            
            <div class="profile-info">
                <h2>Nombre de la Creadora</h2>
                <p class="title">Desarrolladora de Software - UACJ</p>
                <p class="description">
                    Estudiante de DDMI encargada del diseño integral y desarrollo del sistema 
                    <strong>SmartParking UACJ 2026</strong>. Especializada en soluciones tecnológicas 
                    para la movilidad urbana.
                </p>
            </div>

            <div class="projects-grid">
                <a href="dashboard.php" class="project-item">
                    <div class="icon">🚗</div>
                    <span>SmartParking</span>
                </a>
                <a href="https://github.com/" target="_blank" class="project-item">
                    <div class="icon">💻</div>
                    <span>Repositorio</span>
                </a>
                <a href="#" class="project-item">
                    <div class="icon">📄</div>
                    <span>Documentación</span>
                </a>
            </div>

            <div class="social-links">
                <button class="btn-contact">Contactar por LinkedIn</button>
            </div>
        </div>
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
</body>
</html>