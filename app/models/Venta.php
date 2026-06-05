<?php
require_once __DIR__ . '/../core/Database.php';

class Venta {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

// Obtener todas las ventas con nombre del cliente
public function obtenerTodas(): array {
    $stmt = $this->db->query("
        SELECT v.*, COALESCE(c.nombre, v.nombre_cliente) AS cliente_nombre
        FROM ventas v
        LEFT JOIN clientes c ON v.id_cliente = c.id_cliente
        ORDER BY v.id_venta DESC
    ");

    return $stmt->fetchAll();
}

    // Alias para compatibilidad con el controller
    public function obtenerVentas(): array {
        return $this->obtenerTodas();
    }

    // Obtener venta por ID
    public function obtenerPorId(int $id): ?array {
        $stmt = $this->db->prepare("
            SELECT v.*, COALESCE(c.nombre, v.nombre_cliente) as cliente_nombre, c.celular
            FROM ventas v
            LEFT JOIN clientes c ON v.id_cliente = c.id_cliente
            WHERE v.id_venta = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    // Crear nueva venta
    public function crearVenta(int $cliente_id, int $producto_id, int $cantidad): bool {
        try {
            $this->db->beginTransaction();

            // Obtener producto
            $stmt = $this->db->prepare("SELECT * FROM productos WHERE id_producto = ?");
            $stmt->execute([$producto_id]);
            $producto = $stmt->fetch();

            if (!$producto || $producto['stock'] < $cantidad) {
                throw new Exception("Stock insuficiente");
            }

            $total = $producto['precio'] * $cantidad;

            // Insertar venta
            $stmt = $this->db->prepare("
                INSERT INTO ventas (id_cliente, id_producto, nombre_cliente, nombre_producto, cantidad, total, estado, fecha_venta)
                VALUES (?, ?, (SELECT nombre FROM clientes WHERE id_cliente = ?), ?, ?, ?, 'completada', NOW())
            ");
            $stmt->execute([$cliente_id, $producto_id, $cliente_id, $producto['nombre'], $cantidad, $total]);

            // Actualizar stock
            $stmt = $this->db->prepare("UPDATE productos SET stock = stock - ? WHERE id_producto = ?");
            $stmt->execute([$cantidad, $producto_id]);

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function actualizar(int $id, int $cliente_id, int $producto_id, int $cantidad, string $estado): bool {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("SELECT * FROM ventas WHERE id_venta = ?");
            $stmt->execute([$id]);
            $ventaAnterior = $stmt->fetch();

            if (!$ventaAnterior) {
                throw new Exception("Venta no encontrada");
            }

            if (!empty($ventaAnterior['id_producto'])) {
                $stmt = $this->db->prepare("UPDATE productos SET stock = stock + ? WHERE id_producto = ?");
                $stmt->execute([(int) $ventaAnterior['cantidad'], (int) $ventaAnterior['id_producto']]);
            }

            $stmt = $this->db->prepare("SELECT * FROM productos WHERE id_producto = ?");
            $stmt->execute([$producto_id]);
            $producto = $stmt->fetch();

            if (!$producto || $producto['stock'] < $cantidad) {
                throw new Exception("Stock insuficiente");
            }

            $total = $producto['precio'] * $cantidad;

            $stmt = $this->db->prepare("
                UPDATE ventas
                SET id_cliente = ?,
                    id_producto = ?,
                    nombre_cliente = (SELECT nombre FROM clientes WHERE id_cliente = ?),
                    nombre_producto = ?,
                    cantidad = ?,
                    total = ?,
                    estado = ?
                WHERE id_venta = ?
            ");
            $stmt->execute([$cliente_id, $producto_id, $cliente_id, $producto['nombre'], $cantidad, $total, $estado, $id]);

            $stmt = $this->db->prepare("UPDATE productos SET stock = stock - ? WHERE id_producto = ?");
            $stmt->execute([$cantidad, $producto_id]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function eliminar(int $id): bool {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("SELECT * FROM ventas WHERE id_venta = ?");
            $stmt->execute([$id]);
            $venta = $stmt->fetch();

            if ($venta && !empty($venta['id_producto'])) {
                $stmt = $this->db->prepare("UPDATE productos SET stock = stock + ? WHERE id_producto = ?");
                $stmt->execute([(int) $venta['cantidad'], (int) $venta['id_producto']]);
            }

            $stmt = $this->db->prepare("DELETE FROM ventas WHERE id_venta = ?");
            $stmt->execute([$id]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
