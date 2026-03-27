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
    <title>SmartParking UACJ - Panel</title>
    <link rel="stylesheet" href="dashboard-style.css"> <!-- Tu CSS con colores UACJ -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        /* Ajustes adicionales para el panel de bienvenida */
        .welcome-message {
            background-color: #f0f8ff;
            border-left: 5px solid #FFD700; /* amarillo UACJ */
            padding: 20px;
            margin: 25px 0;
            border-radius: 8px;
            font-size: 1.2rem;
            color: #003366; /* azul UACJ */
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .welcome-message strong {
            color: #003366;
            font-weight: 700;
        }
        .logout-btn {
            display: inline-block;
            width: 100%;
            padding: 14px;
            background-color: #003366; /* azul UACJ */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin: 10px 0;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-decoration: none;
            box-sizing: border-box;
            text-align: center;
        }
        .logout-btn:hover {
            background-color: #FFD700; /* amarillo UACJ */
            color: #003366;
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4);
            text-decoration: none;
        }
        .footer-note {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
            text-align: center;
        }
        /* Aseguramos que el pseudo-elemento UACJ no tape contenido */
        .auth-box {
            position: relative;
            margin-top: 30px;
            overflow: visible;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-welcome">
            ¡Bienvenido, <strong><?php echo htmlspecialchars($nombre_usuario); ?></strong>!
        </div>
        <div class="nav-logo">
            <img src="uacj-logo.png" alt="Logo UACJ">
        </div>
        <div class="nav-logout">
            <a href="logout.php" class="logout-link">Cerrar sesión</a>
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
        // Usamos PHP para imprimir el ID. 
        // Si por algo no existe, le ponemos 0 para que no truene el JS.
        const USUARIO_ACTUAL_ID = <?php echo isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : '0'; ?>;
        
        // Esto te dirá en la consola (F12) si el ID se cargó o no
        console.log("Sesión activa para ID:", USUARIO_ACTUAL_ID);
    </script>

    <script src="script.js"></script>

    <script>
        window.onload = function() {
            if (typeof cargarCajones === 'function') {
                cargarCajones(1); // Carga el nivel 1 por defecto
            }
        };
    </script>
</body>
</html>