<?php
require_once __DIR__ . '/../core/Database.php';

class Login {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function login(string $usuario, string $clave): array|false {
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$usuario]);
        $usuarioEncontrado = $stmt->fetch();

        if (!$usuarioEncontrado) {
            return false;
        }

        $claveGuardada = (string) $usuarioEncontrado['clave'];

        if (password_get_info($claveGuardada)['algo'] !== 0 && password_verify($clave, $claveGuardada)) {
            return $usuarioEncontrado;
        }

        if (hash_equals($claveGuardada, $clave)) {
            return $usuarioEncontrado;
        }

        return false;
    }
}
