<?php
// Punto de entrada de la aplicacion.
// Todas las rutas llegan aqui gracias a las reglas de .htaccess.

// Carga configuracion general: base de datos, BASE_URL y titulo del sistema.
require_once __DIR__ . '/config/config.php';

// Carga App, que inicia sesion y ejecuta el Router.
require_once __DIR__ . '/core/App.php';

// Arranca la aplicacion.
(new App())->run();
