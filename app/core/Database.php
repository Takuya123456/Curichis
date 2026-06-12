<?php

// Clase encargada de crear y reutilizar la conexion PDO con MySQL.
class Database {
    // Guarda una unica conexion para toda la peticion.
    private static ?PDO $connection = null;

    // Devuelve la conexion activa. Si todavia no existe, la crea.
    public static function getConnection(): PDO {
        if (self::$connection === null) {
            // DSN: cadena que le dice a PDO a que servidor y base conectarse.
            $dns = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";

            self::$connection = new PDO($dns, DB_USER, DB_PASS, [
                // Convierte errores SQL en excepciones para poder controlarlos.
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                // Los resultados llegan como array asociativo: $fila['nombre'].
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }

        return self::$connection;
    }
}
