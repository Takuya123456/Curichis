<?php
require_once __DIR__ . '/../core/Database.php';

// Modelo de LOGIN.
// Se encarga de buscar el usuario y validar la clave ingresada.
class Login {
    private PDO $db;

    public function __construct() {
        // Conexion compartida para consultar la tabla usuarios.
        $this->db = Database::getConnection();
    }

    // Devuelve los datos del usuario si las credenciales son correctas.
    // Devuelve false si el usuario no existe o la clave no coincide.
    public function login(string $usuario, string $clave): array|false {
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$usuario]);
        $usuarioEncontrado = $stmt->fetch();

        if (!$usuarioEncontrado) {
            return false;
        }

        $claveGuardada = (string) $usuarioEncontrado['clave'];

        // Soporta claves seguras creadas con password_hash().
        if (password_get_info($claveGuardada)['algo'] !== 0 && password_verify($clave, $claveGuardada)) {
            return $usuarioEncontrado;
        }

        // Compatibilidad con la clave de ejemplo del database.sql, que esta en texto plano.
        if (hash_equals($claveGuardada, $clave)) {
            return $usuarioEncontrado;
        }

        return false;
    }
}
