<?php // Vista publica: pagina inicial con videos y acceso al login. ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RaspaLocos - Sistema de Ventas</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Los assets usan rutas absolutas con BASE_URL para que funcionen sin importar la URL actual -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/landing.css">
    <style>
        /* Estilos adicionales para que los videos se vean bien */
        .project-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
        }
        .project-img-wrap {
            position: relative;
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            aspect-ratio: 16 / 9;
            background-color: #1a1a2e;
        }
        video.project-img {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Fade overlay para transición de botón Ver demo -->
    <div id="fadeOverlay"></div>

    <!-- Menú móvil (overlay) fuera del nav para que position:fixed funcione siempre -->
    <?php include __DIR__ . '/../layouts/header-home.php'; ?>

    <!-- Sección principal con video de fondo -->
    <section class="stage">

        <video class="hero-video" autoplay muted loop playsinline>
            <source src="<?php echo BASE_URL; ?>/public/video/donde1.mp4" type="video/mp4">
        </video>

        <!-- Navbar -->
        <nav class="navbar" id="navbar">
            <a class="brand" href="#">RaspaLocos</a>

            <button class="menu-btn" id="menuBtn" aria-label="Abrir menú">
                <i class="bi bi-list"></i>
            </button>
        </nav>

        <!-- Contenido hero -->
        <div class="hero-content">
            <button class="cta-btn demo-trigger" id="verDemo">Ver demo</button>
        </div>

        <!-- Scroll indicator -->
        <div class="scroll-indicator" id="scrollIndicator">
            <span>Scroll</span>
            <div class="scroll-line"></div>
        </div>

    </section>

    <!-- Sección proyectos -->
    <!-- Si funciona no tocarlo -->
    <section class="projects-section">

        <!-- Video 1: Registro de ventas -->
        <div class="project-card">
            <div class="project-img-wrap">
                <video class="project-img" controls loop muted poster="<?php echo BASE_URL; ?>/public/image/poster1.jpg">
                    <source src="<?php echo BASE_URL; ?>/public/video/Ventas.mp4" type="video/mp4">
                </video>
            </div>
            <h3 class="project-title">Registro de ventas</h3>
            <p class="project-desc">Registro rápido y sencillo de ventas de Curichis y Raspadillas. Sistema intuitivo para gestionar tus productos.</p>
            <a href="<?php echo BASE_URL; ?>/ventas/registro" class="project-link">Ver demo <i class="bi bi-arrow-right"></i></a>
        </div>

        <!-- Video 2: Panel de Productos -->
        <div class="project-card">
            <div class="project-img-wrap">
                <video class="project-img" controls loop muted poster="<?php echo BASE_URL; ?>/public/image/poster2.jpg">
                    <source src="<?php echo BASE_URL; ?>/public/video/Panel.mp4" type="video/mp4">
                </video>
            </div>
            <h3 class="project-title">Panel de Productos</h3>
            <p class="project-desc">Gestiona tus Curichis y Raspadillas: precios, stock, sabores. Todo desde un panel administrador.</p>
            <a href="<?php echo BASE_URL; ?>/productos" class="project-link">Ver demo <i class="bi bi-arrow-right"></i></a>
        </div>

    </section>

    <!-- Footer -->
    <?php include __DIR__ . '/../layouts/footer-home.php'; ?>
    <script src="<?php echo BASE_URL; ?>/public/js/landing.js"></script>
</body>
</html>
