<?php // Vista: panel principal despues de iniciar sesion. ?>
<!DOCTYPE html>
<html lang="Es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css?v=<?php echo filemtime(__DIR__ . '/../../../public/css/dashboard.css'); ?>">
</head>
<body>

<?php include __DIR__ . '/../layouts/sidebar-dashboard.php'; ?>

<main>
    <nav class="breadcrumb">
        <span>Inicio</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Dashboard</span>
    </nav>

    <div class="main-content">
        <!-- Tarjetas de acceso rapido a los modulos principales. -->
        <div class="dash-grid">

            <div class="dash-card ventas" onclick="location.href='<?php echo BASE_URL; ?>/ventas'">
                <video class="dash-media" autoplay muted loop playsinline preload="metadata">
                    <source src="<?php echo BASE_URL; ?>/public/video/Ventas1.mp4" type="video/mp4">
                </video>
                <div class="dash-icon"><i class="fa-solid fa-clipboard-list"></i></div>
                <div class="dash-title">Ventas</div>
                <div class="dash-desc">Registra y controla cada transacción de tus curichis.</div>
                <i class="fa-solid fa-arrow-up-right-from-square dash-arrow"></i>
            </div>

            <div class="dash-card productos" onclick="location.href='<?php echo BASE_URL; ?>/productos'">
                <video class="dash-media" autoplay muted loop playsinline preload="metadata">
                    <source src="<?php echo BASE_URL; ?>/public/video/Ventas1.mp4" type="video/mp4">
                </video>
                <div class="dash-icon"><i class="fa-solid fa-box"></i></div>
                <div class="dash-title">Productos</div>
                <div class="dash-desc">Administra tus sabores y presentaciones.</div>
                <i class="fa-solid fa-arrow-up-right-from-square dash-arrow"></i>
            </div>

            <div class="dash-card clientes" onclick="location.href='<?php echo BASE_URL; ?>/clientes'">
                <video class="dash-media" autoplay muted loop playsinline preload="metadata">
                    <source src="<?php echo BASE_URL; ?>/public/video/donde1.mp4" type="video/mp4">
                </video>
                <div class="dash-icon"><i class="fa-solid fa-users"></i></div>
                <div class="dash-title">Clientes</div>
                <div class="dash-desc">Gestiona tu cartera de clientes.</div>
                <i class="fa-solid fa-arrow-up-right-from-square dash-arrow"></i>
            </div>

        </div>
    </div>
</main>

<script src="<?php echo BASE_URL; ?>/public/js/dashboard.js"></script>
</body>
</html>
