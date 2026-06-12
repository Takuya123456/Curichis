<?php
require_once __DIR__ . '/../core/Database.php';

// Modelo de VENTAS.
// Maneja las consultas de ventas y la actualizacion del stock de productos.
class Venta {
    private PDO $db;

    public function __construct() {
        // Usa la misma conexion PDO que el resto del sistema.
        $this->db = Database::getConnection();
    }

    // Obtiene todas las ventas con el nombre completo del cliente.
    public function obtenerTodas(): array {
        $stmt = $this->db->query("
            SELECT v.*, CONCAT_WS(' ', c.nombre, c.apellido) as cliente_nombre
            FROM ventas v
            JOIN clientes c ON v.id_cliente = c.id_cliente
            ORDER BY v.fecha_venta DESC
        ");
        return $stmt->fetchAll();
    }

    // Alias para compatibilidad con otros controladores o enlaces antiguos.
    public function obtenerVentas(): array {
        return $this->obtenerTodas();
    }

    // Busca una venta por ID y agrega datos del cliente para mostrar el detalle.
    public function obtenerPorId(int $id): ?array {
        $stmt = $this->db->prepare("
            SELECT v.*, CONCAT_WS(' ', c.nombre, c.apellido) as cliente_nombre, c.celular
            FROM ventas v
            JOIN clientes c ON v.id_cliente = c.id_cliente
            WHERE v.id_venta = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    // Crea una venta y descuenta stock dentro de una transaccion.
    // Si algo falla, rollback deja la base de datos como estaba.
    public function crearVenta(int $cliente_id, int $producto_id, int $cantidad): bool {
        try {
            $this->db->beginTransaction();

            // Validamos que el cliente exista antes de guardar la venta.
            $stmt = $this->db->prepare("SELECT id_cliente FROM clientes WHERE id_cliente = ?");
            $stmt->execute([$cliente_id]);
            if (!$stmt->fetch()) {
                throw new Exception("Cliente no existe");
            }

            // Validamos producto y stock disponible.
            $stmt = $this->db->prepare("SELECT * FROM productos WHERE id_producto = ?");
            $stmt->execute([$producto_id]);
            $producto = $stmt->fetch();

            if (!$producto || (int) $producto['stock'] < $cantidad) {
                throw new Exception("Stock insuficiente");
            }

            $total = (float) $producto['precio'] * $cantidad;

            // Guardamos la venta con nombres copiados para conservar historial legible.
            $stmt = $this->db->prepare("
                INSERT INTO ventas (id_cliente, id_producto, nombre_cliente, nombre_producto, cantidad, total, estado, fecha_venta)
                VALUES (?, ?, (SELECT CONCAT_WS(' ', nombre, apellido) FROM clientes WHERE id_cliente = ?), ?, ?, ?, 'completada', NOW())
            ");
            $stmt->execute([$cliente_id, $producto_id, $cliente_id, $producto['nombre'], $cantidad, $total]);

            // Descontamos el stock despues de insertar la venta.
            $stmt = $this->db->prepare("UPDATE productos SET stock = stock - ? WHERE id_producto = ?");
            $stmt->execute([$cantidad, $producto_id]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            return false;
        }
    }
}
