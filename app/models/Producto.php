<?php
require_once __DIR__ . '/../core/Database.php';

// Modelo de PRODUCTOS.
// Aqui estan las consultas SQL para listar, crear, editar y eliminar productos.
class Producto {
    private PDO $db;

    public function __construct() {
        // Usa la conexion compartida de la aplicacion.
        $this->db = Database::getConnection();
    }

    // Obtiene todos los productos, dejando primero los mas recientes.
    public function obtenerTodos(): array {
        $stmt = $this->db->query("SELECT * FROM productos ORDER BY id_producto DESC");
        return $stmt->fetchAll();
    }

    // Alias para compatibilidad con el controller
    public function obtenerProductos(): array {
        return $this->obtenerTodos();
    }

    // Busca un producto por su ID. Devuelve null si no existe.
    public function obtenerPorId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE id_producto = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    // Inserta un producto nuevo en la tabla productos.
    public function crear(string $nombre, string $descripcion, float $precio, int $stock, string $categoria): bool {
        $stmt = $this->db->prepare("INSERT INTO productos (nombre, descripcion, precio, stock, categoria) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $descripcion, $precio, $stock, $categoria]);
    }

    // Actualiza los datos principales de un producto.
    public function actualizar(int $id, string $nombre, string $descripcion, float $precio, int $stock, string $categoria): bool {
        $stmt = $this->db->prepare("UPDATE productos SET nombre=?, descripcion=?, precio=?, stock=?, categoria=? WHERE id_producto=?");
        return $stmt->execute([$nombre, $descripcion, $precio, $stock, $categoria, $id]);
    }

    // Cuenta cuantas ventas usan este producto.
    public function contarVentas(int $id): int {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM ventas WHERE id_producto = ?");
        $stmt->execute([$id]);

        return (int) $stmt->fetchColumn();
    }

    // Elimina un producto solo si no esta asociado a ventas.
    public function eliminar(int $id): string {
        if (!$this->obtenerPorId($id)) {
            return 'no_encontrado';
        }

        if ($this->contarVentas($id) > 0) {
            return 'tiene_ventas';
        }

        try {
            $stmt = $this->db->prepare("DELETE FROM productos WHERE id_producto = ?");
            $stmt->execute([$id]);

            return $stmt->rowCount() > 0 ? 'eliminado' : 'error';
        } catch (PDOException $e) {
            return 'error';
        }
    }
}
