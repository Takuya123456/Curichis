<?php
require_once __DIR__ . '/../core/Database.php';

class Cliente {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function obtenerTodos(): array {
        $stmt = $this->db->query("SELECT * FROM clientes ORDER BY id_cliente DESC");
        return $stmt->fetchAll();
    }

    // Alias para compatibilidad con el controller
    public function obtenerClientes(): array {
        return $this->obtenerTodos();
    }

    public function obtenerPorId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function crear(string $nombre, string $apellido, string $celular): bool {
        $stmt = $this->db->prepare("INSERT INTO clientes (nombre, apellido, celular, fecha_registro) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nombre, $apellido, $celular, date('Y-m-d')]);
    }

    public function actualizar(int $id, string $nombre, string $apellido, string $celular): bool {
        $stmt = $this->db->prepare("UPDATE clientes SET nombre = ?, apellido = ?, celular = ? WHERE id_cliente = ?");
        return $stmt->execute([$nombre, $apellido, $celular, $id]);
    }

    public function eliminar(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM clientes WHERE id_cliente = ?");
        return $stmt->execute([$id]);
    }
}
