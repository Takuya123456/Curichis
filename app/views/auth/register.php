<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse — Curichis</title>
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
            <p>Crea tu cuenta</p>
        </div>

        <div class="auth-tabs">
            <button class="auth-tab" onclick="location.href='<?= APP_URL ?>/login'">Iniciar sesión</button>
            <button class="auth-tab active" data-target="form-register">Registrarse</button>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">⚠️ <?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form action="<?= APP_URL ?>/login/storeRegister" method="POST">
            <div class="form-group">
                <label>✨ Nombre completo</label>
                <input type="text" name="nombre" class="form-control" placeholder="Tu nombre" required>
            </div>
            <div class="form-group">
                <label>👤 Usuario</label>
                <input type="text" name="usuario" class="form-control" placeholder="Elige un usuario" required autocomplete="username">
            </div>
            <div class="form-group">
                <label>🔒 Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="Mínimo 6 caracteres" required autocomplete="new-password">
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:12px;">
                Crear cuenta 🎉
            </button>
        </form>

        <p style="text-align:center;margin-top:20px;font-size:0.85rem;color:var(--text-muted);">
            ¿Ya tienes cuenta? <a href="<?= APP_URL ?>/login" style="color:var(--primary);font-weight:800;">Inicia sesión</a>
        </p>
    </div>
</div>
<script src="<?= APP_URL ?>/js/app.js"></script>
</body>
</html>
