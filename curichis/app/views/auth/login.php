<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión — Curichis</title>
    <link rel="stylesheet" href="<?= APP_URL ?>/css/style.css">
</head>
<body>
<div class="auth-bg">
    <div class="glow-circle" style="width:400px;height:400px;background:var(--primary);top:-100px;right:-100px;"></div>
    <div class="glow-circle" style="width:300px;height:300px;background:var(--secondary);bottom:-60px;left:-60px;"></div>

    <div class="auth-card">
        <div class="auth-logo">
            <span class="logo-icon">🧊</span>
            <h1>Curichis</h1>
            <p>Venta de Curichis y Marcianos</p>
        </div>

        <!-- Tabs -->
        <div class="auth-tabs">
            <button class="auth-tab active" data-target="form-login">Iniciar sesión</button>
            <button class="auth-tab" data-target="form-register" onclick="location.href='<?= APP_URL ?>/login/register'">Registrarse</button>
        </div>

        <!-- Alerts -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">⚠️ <?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">✅ <?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <!-- Login form -->
        <div id="form-login" class="auth-form">
            <form action="<?= APP_URL ?>/login/store" method="POST">
                <div class="form-group">
                    <label>👤 Usuario</label>
                    <input type="text" name="usuario" class="form-control" placeholder="Ingresa tu usuario" required autocomplete="username">
                </div>
                <div class="form-group">
                    <label>🔒 Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required autocomplete="current-password">
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:12px;">
                    Entrar al sistema →
                </button>
            </form>
        </div>

        <p style="text-align:center;margin-top:20px;font-size:0.85rem;color:var(--text-muted);">
            ¿No tienes cuenta? <a href="<?= APP_URL ?>/login/register" style="color:var(--primary);font-weight:800;">Regístrate aquí</a>
        </p>
    </div>
</div>
<script src="<?= APP_URL ?>/js/app.js"></script>
</body>
</html>
