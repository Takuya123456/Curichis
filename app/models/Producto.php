<?php
require_once __DIR__ . '/../core/Database.php';

class Producto {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function obtenerTodos(): array {
        $stmt = $this->db->query("SELECT * FROM productos ORDER BY id_producto DESC");
        return $stmt->fetchAll();
    }

    // Alias para compatibilidad con el controller
    public function obtenerProductos(): array {
        return $this->obtenerTodos();
    }

    public function obtenerPorId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE id_producto = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function crear(string $nombre, string $descripcion, float $precio, int $stock, string $categoria): bool {
        $stmt = $this->db->prepare("INSERT INTO productos (nombre, descripcion, precio, stock, categoria) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $descripcion, $precio, $stock, $categoria]);
    }

    public function actualizar(int $id, string $nombre, string $descripcion, float $precio, int $stock, string $categoria): bool {
        $stmt = $this->db->prepare("UPDATE productos SET nombre=?, descripcion=?, precio=?, stock=?, categoria=? WHERE id_producto=?");
        return $stmt->execute([$nombre, $descripcion, $precio, $stock, $categoria, $id]);
    }

    public function eliminar(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM productos WHERE id_producto = ?");
        return $stmt->execute([$id]);
    }
}
