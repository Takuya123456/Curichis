<?php
// Nombre que se muestra en los titulos de las paginas.
define("TITLE_BUSINESS", "Sistema de Ventas");

// Leemos el archivo .env ubicado en la raiz del proyecto.
// Ahi se guardan datos como host, usuario, clave y nombre de la base de datos.
$envFile = dirname(__DIR__, 2) . '/.env';
if (file_exists($envFile)) {
    // Cada linea valida tiene formato CLAVE=VALOR.
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        // Saltamos comentarios y lineas sin signo igual.
        if (str_starts_with(trim($line), '#')) continue;
        if (!str_contains($line, '=')) continue;

        [$key, $value] = explode("=", $line, 2);
        $_ENV[trim($key)] = trim(trim($value), "\"'");
    }
}

// Constantes de conexion a MySQL. Si falta un valor en .env, se usa el valor por defecto.
define("DB_HOST", $_ENV['DB_HOST']     ?? 'localhost');
define("DB_PORT", $_ENV['DB_PORT']     ?? '3306');
define("DB_NAME", $_ENV['DB_DATABASE'] ?? '');
define("DB_USER", $_ENV['DB_USERNAME'] ?? 'root');
define("DB_PASS", $_ENV['DB_PASSWORD'] ?? '');

// URL base del proyecto. Sirve para links y redirecciones correctas.
define("BASE_URL", $_ENV['APP_URL'] ?? 'http://localhost');
