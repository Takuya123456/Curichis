<?php // Vista publica: formulario de inicio de sesion. ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/login.css">
</head>

<body>
    <div class="container">
        <div class="left">
            <video autoplay muted loop playsinline>
                <source src="<?php echo BASE_URL; ?>/public/video/donde1.mp4" type="video/mp4">
            </video>
        </div>

        <div class="right">
            <h2>Iniciar Sesi&oacute;n</h2>

            <!-- Envia usuario y clave a LoginController::index(). -->
            <form action="<?php echo BASE_URL; ?>/login" method="POST">
                <label for="user">Usuario:</label>
                <input id="user" type="text" name="user" autocomplete="username" required>

                <label for="pass">Clave:</label>
                <input id="pass" type="password" name="pass" autocomplete="current-password" required>

                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>
</body>

</html>
