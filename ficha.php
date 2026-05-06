<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: /login.html");
    exit();
}
$nombre_usuario = $_SESSION['usuario'];
$titulo_pagina = "Mi Reserva";
include 'PHP/navbar.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creadora del Proyecto | SmartParking UACJ</title>
    <link rel="stylesheet" href="Styles/ficha-style.css">
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
</head>

<body>
    <div class="main-content">
        <div class="container-revelacion" id="wrapper">

            <!-- FICHA DE PRESENTACIÓN -->
            <div class="profile-card">
                <div class="card-header"></div>
                <div class="avatar-container">
                    <img src="Imagenes/mii_shot.jpeg" alt="Foto" class="profile-img">
                </div>

                <div class="profile-info">
                    <h2>Karla Romero</h2>
                    <p class="title">Desarrolladora de Software - UACJ</p>
                    <p class="description">
                        Estudiante de DDMI encargada del diseño integral y desarrollo del sistema
                        <strong>SmartParking UACJ 2026</strong>.
                    </p>
                </div>

                <div class="projects-grid">
                    <a href="/dashboard.php" class="project-item">
                        <div class="icon">🚗</div><span>SmartParking</span>
                    </a>
                    <a href="https://github.com/K4RL3" target="_blank" class="project-item">
                        <div class="icon">💻</div><span>Repositorio</span>
                    </a>
                    <a href="#" class="project-item">
                        <div class="icon">📄</div><span>Documentación</span>
                    </a>
                </div>

                <div class="social-links">
                    <!-- Cambiamos el link por un botón con ID para el trigger -->
                    <button class="btn-contact" id="trigger-contacto">Contactar por correo</button>
                </div>
            </div>

            <!-- FORMULARIO OCULTO DETRÁS -->
            <div class="form-contacto-escondido" id="form-queja">
                <form id="contact-form">
                    <!-- El usuario ve estos -->
                    <h3>Enviar Comentario</h3>
                    <!-- El usuario ve estos -->
                    <input type="text" name="subject" placeholder="Asunto" required>

                    <!-- Cambia tus inputs ocultos por estos -->
                    <input type="hidden" name="user_name" value="<?php echo htmlspecialchars($_SESSION['usuario'] ?? 'Usuario'); ?>">
                    <input type="hidden" name="user_email" value="<?php echo htmlspecialchars($_SESSION['usuario_email'] ?? ''); ?>">
                    <textarea name="message" placeholder="Escribe tu queja o sugerencia aquí..." required></textarea>
                    <button type="submit" class="btn-enviar">Enviar Mensaje</button>
                    <button type="button" id="btn-cerrar" style="background:none; color:gray; font-size:0.8rem; margin-top:10px; border:none; cursor:pointer;">✕ Cancelar</button>
                </form>
            </div>

        </div>
    </div>


    <footer class="creadora-footer">
        Programación Integral - Universidad Autónoma de Ciudad Juárez
    </footer>
    <script>
        const trigger = document.getElementById('trigger-contacto');
        const contenedor = document.getElementById('wrapper');
        const btnCerrar = document.getElementById('btn-cerrar');

        // Al hacer clic, añadimos la clase que mueve la ficha y muestra el form
        trigger.addEventListener('click', () => {
            contenedor.classList.add('active');
        });

        // Para cerrar el formulario
        btnCerrar.addEventListener('click', () => {
            contenedor.classList.remove('active');
        });
    </script>

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

    <script src="Scripts/quejas.js"></script>
</body>

</html>