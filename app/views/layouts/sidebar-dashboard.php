<?php
// Sidebar reutilizable del dashboard.
// Detecta la ruta actual para marcar como activo el modulo correspondiente.
$rutaActual = explode('/', trim($_GET['url'] ?? 'dashboard', '/'))[0] ?: 'dashboard';
?>

<!-- Barra superior visible en pantallas pequenas. -->
<div class="topbar">
    <div class="title-business">
        <span><?php echo htmlspecialchars($usuario['nombre_usuario'] ?? 'Usuario'); ?></span>
    </div>
    <div class="btn-menu">
        <button class="hamburger" aria-label="Abrir menu">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
</div>

<!-- Capa oscura que aparece cuando el sidebar movil esta abierto. -->
<div class="overlay"></div>

<!-- Menu lateral principal del sistema. -->
<aside class="sidebar">
    <div class="sidebar-logo"><?php echo htmlspecialchars($usuario['nombre_usuario'] ?? 'Usuario'); ?></div>
    <ul>
        <li>
            <a href="<?php echo BASE_URL; ?>/dashboard"
                class="<?php echo $rutaActual === 'dashboard' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-house"></i>
                <span>Inicio</span>
            </a>
        </li>

        <!-- Modulo ventas: reporte y registro. -->
        <li class="<?php echo $rutaActual === 'ventas' ? 'dropdown show' : 'dropdown'; ?>">
            <a href="#" class="dropbtn <?php echo $rutaActual === 'ventas' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-clipboard-list"></i>
                <span>Ventas</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <div class="dropdown-content">
                <a href="<?php echo BASE_URL; ?>/ventas"
                    class="<?php echo $rutaActual === 'ventas' ? 'activo' : ''; ?>">
                    <i class="fa-solid fa-chart-line"></i>
                    Reporte
                </a>
                <a href="<?php echo BASE_URL; ?>/ventas/registro">
                    <i class="fa-solid fa-cart-plus"></i>
                    Registrar
                </a>
            </div>
        </li>

        <!-- Modulo productos: catalogo y registro. -->
        <li class="<?php echo $rutaActual === 'productos' ? 'dropdown show' : 'dropdown'; ?>">
            <a href="#" class="dropbtn <?php echo $rutaActual === 'productos' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-box"></i>
                <span>Productos</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <div class="dropdown-content">
                <a href="<?php echo BASE_URL; ?>/productos"
                    class="<?php echo $rutaActual === 'productos' ? 'activo' : ''; ?>">
                    <i class="fa-solid fa-clipboard-list"></i>
                    Reporte
                </a>
                <a href="<?php echo BASE_URL; ?>/productos/registro">
                    <i class="fa-solid fa-box-open"></i>
                    Registrar
                </a>
            </div>
        </li>

        <!-- Modulo clientes: reporte y registro. -->
        <li class="<?php echo $rutaActual === 'clientes' ? 'dropdown show' : 'dropdown'; ?>">
            <a href="#" class="dropbtn <?php echo $rutaActual === 'clientes' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-users"></i>
                <span>Clientes</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <div class="dropdown-content">
                <a href="<?php echo BASE_URL; ?>/clientes"
                    class="<?php echo $rutaActual === 'clientes' ? 'activo' : ''; ?>">
                    <i class="fa-solid fa-address-book"></i>
                    Reporte
                </a>
                <a href="<?php echo BASE_URL; ?>/clientes/registro">
                    <i class="fa-solid fa-user-plus"></i>
                    Registrar
                </a>
            </div>
        </li>

        <!-- Modulo usuarios: administracion de cuentas. -->
        <li>
            <a href="<?php echo BASE_URL; ?>/usuarios"
                class="<?php echo $rutaActual === 'usuarios' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-user-cog"></i>
                <span>Usuarios</span>
            </a>
        </li>

        <!-- Cerrar sesion del usuario actual. -->
        <li class="nav-logout">
            <a href="<?php echo BASE_URL; ?>/logout" id="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Cerrar sesion</span>
            </a>
        </li>
    </ul>
</aside>

<script src="<?php echo BASE_URL; ?>/public/js/dropdown.js"></script>
