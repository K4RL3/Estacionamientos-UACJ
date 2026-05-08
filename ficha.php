<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: /login.html");
    exit();
}
// Asegúrate de definir $usuario_id si lo usas abajo, 
// si no, lo inicializamos para evitar errores de PHP
$usuario_id = $_SESSION['usuario_id'] ?? 0; 
$nombre_usuario = $_SESSION['usuario'];
$titulo_pagina = "Perfil de Creadora";
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
            
            <div class="panel-qr-escondido" id="panel-qr">
                <h3>Mi Acceso Digital en QR</h3>
                <div class="qr-container">
                    <img src="Imagenes/Repositorio.jpg" alt="QR Personal" class="img-qr">
                    <p>Escanea para ver el repositorio</p>
                </div>
                <button type="button" id="btn-cerrar-qr" class="btn-cancelar-minimal">✕ Cerrar</button>
            </div>

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

                <div class="social-icons-grid">
                    <a href="https://github.com/K4RL3" target="_blank" title="GitHub" class="social-icon-item gh">
                        <img src="https://cdn-icons-png.flaticon.com/512/25/25231.png" alt="GitHub">
                    </a>
                    <a href="https://www.facebook.com/K4RL3" target="_blank" title="Facebook" class="social-icon-item fb">
                        <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook">
                    </a>
                    <a href="https://www.instagram.com/karkarle_" target="_blank" title="Instagram" class="social-icon-item ig">
                        <img src="https://cdn-icons-png.flaticon.com/512/174/174855.png" alt="Instagram">
                    </a>
                    <button type="button" id="trigger-qr" title="Ver mi QR" class="social-icon-item btn-qr">
                        <img src="https://cdn-icons-png.flaticon.com/512/241/241528.png" alt="QR">
                    </button>
                </div>

                <div class="social-links">
                    <button class="btn-contact" id="trigger-contacto">Contactar por correo</button>
                </div>
            </div>

            <div class="form-contacto-escondido" id="form-queja">
                <form id="contact-form">
                    <h3>Enviar Comentario</h3>
                    <input type="text" name="subject" placeholder="Asunto" required>
                    <input type="hidden" name="user_name" value="<?php echo htmlspecialchars($nombre_usuario); ?>">
                    <textarea name="message" placeholder="Escribe tu queja o sugerencia aquí..." required></textarea>
                    <button type="submit" class="btn-enviar">Enviar Mensaje</button>
                    <button type="button" id="btn-cerrar" class="btn-cancelar-minimal">✕ Cancelar</button>
                </form>
            </div>
        </div>
    </div>

    <footer class="creadora-footer">
        Programación Integral - Universidad Autónoma de Ciudad Juárez
    </footer>

    <script>
        // Seleccionamos todos los elementos una sola vez
        const wrapper = document.getElementById('wrapper');
        const btnQr = document.getElementById('trigger-qr');
        const btnContacto = document.getElementById('trigger-contacto');
        const closeQr = document.getElementById('btn-cerrar-qr');
        const closeForm = document.getElementById('btn-cerrar');

        // Función para abrir/cerrar QR (Izquierda)
        btnQr.onclick = function() {
            wrapper.classList.remove('active'); // Cerramos el otro por si acaso
            wrapper.classList.toggle('active-qr');
        };

        // Función para abrir/cerrar Contacto (Derecha)
        btnContacto.onclick = function() {
            wrapper.classList.remove('active-qr'); // Cerramos el otro por si acaso
            wrapper.classList.toggle('active');
        };

        // Botones de cerrar (X)
        closeQr.onclick = function() { wrapper.classList.remove('active-qr'); };
        closeForm.onclick = function() { wrapper.classList.remove('active'); };

        // Lógica del menú hamburguesa (Navbar)
        const btnOpen = document.getElementById('open-menu');
        if(btnOpen){
            btnOpen.onclick = function() {
                document.getElementById('nav-sidebar').classList.toggle('open');
                document.getElementById('nav-overlay').classList.toggle('show');
            };
        }
    </script>

    <script src="Scripts/script.js"></script>
    <script src="Scripts/quejas.js"></script>
</body>
</html>