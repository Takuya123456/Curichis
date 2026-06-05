<?php
require_once __DIR__ . '/../core/Database.php';

class Usuario {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function obtenerTodos(): array {
        $stmt = $this->db->query("SELECT * FROM usuarios ORDER BY nombre_usuario ASC");
        return $stmt->fetchAll();
    }

    public function obtenerPorId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function crear(string $nombre_usuario, string $clave): bool {
        $stmt = $this->db->prepare("INSERT INTO usuarios (nombre_usuario, clave) VALUES (?, ?)");
        return $stmt->execute([$nombre_usuario, $clave]);
    }

    public function actualizar(int $id, string $nombre_usuario, string $clave): bool {
        $stmt = $this->db->prepare("UPDATE usuarios SET nombre_usuario = ?, clave = ? WHERE id = ?");
        return $stmt->execute([$nombre_usuario, $clave, $id]);
    }

    public function actualizarSinClave(int $id, string $nombre_usuario): bool {
        $stmt = $this->db->prepare("UPDATE usuarios SET nombre_usuario = ? WHERE id = ?");
        return $stmt->execute([$nombre_usuario, $id]);
    }

    public function eliminar(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
