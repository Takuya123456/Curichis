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
            <img src="https://giffiles.alphacoders.com/220/220125.gif" alt="Login">
        </div>

        <div class="right">
            <h2>Iniciar Sesi&oacute;n</h2>

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
