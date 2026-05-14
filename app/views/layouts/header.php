<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle . ' — Curichis' : 'Curichis' ?></title>
    <link rel="stylesheet" href="<?= APP_URL ?>/css/style.css">
</head>
<body>
<div class="layout">
    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <span>🛍️</span> Curichis
        </div>
        <div class="sidebar-user">
            <div class="avatar"><?= strtoupper(substr($_SESSION['user_name'] ?? 'U', 0, 1)) ?></div>
            <div class="sidebar-user-info">
                <div class="name"><?= htmlspecialchars($_SESSION['user_name'] ?? '') ?></div>
                <div class="role"><?= ucfirst($_SESSION['user_rol'] ?? 'usuario') ?></div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-label">Principal</div>
            <a href="<?= APP_URL ?>/dashboard" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/dashboard') !== false ? 'active' : '' ?>">
                <span class="icon">📊</span> Dashboard
            </a>
            <div class="nav-label">Gestión</div>
            <a href="<?= APP_URL ?>/ventas" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/ventas') !== false ? 'active' : '' ?>">
                <span class="icon">💰</span> Ventas
            </a>
            <a href="<?= APP_URL ?>/productos" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/productos') !== false ? 'active' : '' ?>">
                <span class="icon">📦</span> Productos
            </a>
            <a href="<?= APP_URL ?>/clientes" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/clientes') !== false ? 'active' : '' ?>">
                <span class="icon">👥</span> Clientes
            </a>
        </nav>
        <div class="sidebar-footer">
            <a href="<?= APP_URL ?>/logout" class="nav-link">
                <span class="icon">🚪</span> Cerrar sesión
            </a>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="main-content">
