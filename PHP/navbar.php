<!-- header.php -->
<?php
session_start();
$nombre_usuario = $_SESSION['usuario'];
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : '0';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina; ?> | SmartParking</title>
    <link rel="stylesheet" href="Styles/navbar-style.css">
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
        <a href="ficha.php">Ficha de Creadora</a>
        <a href="sitemap.php">Site Map</a>

        <a href="PHP/logout.php" style="color: #FFD700; margin-top: auto; border-top: 1px solid white;">Cerrar Sesión</a>
    </aside>

    <nav class="navbar">
        <div class="nav-welcome" style="display: flex; align-items: center;">
            <div class="menu-toggle" id="open-menu">
                <span></span><span></span><span></span>
            </div>
            ¡Bienvenido, <strong><?php echo htmlspecialchars($nombre_usuario); ?></strong>!
        </div>
        <div class="nav-logo"><img src="Imagenes/uacj-logo.png" alt="Logo UACJ"></div>
        <div class="nav-logout"><a href="PHP/logout.php" class="logout-link">Cerrar sesión</a></div>
    </nav>