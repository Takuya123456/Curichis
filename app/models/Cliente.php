<?php
require_once __DIR__ . '/../core/Database.php';

// Modelo de CLIENTES.
// Aqui se concentran todas las consultas SQL relacionadas con la tabla clientes.
class Cliente {
    private PDO $db;

    public function __construct() {
        // Reutiliza la conexion unica de Database para no abrir muchas conexiones.
        $this->db = Database::getConnection();
    }

    // Devuelve todos los clientes, mostrando primero los registros mas recientes.
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

    // Guarda un cliente nuevo con la fecha actual de registro.
    public function crear(string $nombre, string $apellido, string $celular): bool {
        $stmt = $this->db->prepare("INSERT INTO clientes (nombre, apellido, celular, fecha_registro) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nombre, $apellido, $celular, date('Y-m-d')]);
    }

    // Actualiza los datos editables de un cliente existente.
    public function actualizar(int $id, string $nombre, string $apellido, string $celular): bool {
        $stmt = $this->db->prepare("UPDATE clientes SET nombre = ?, apellido = ?, celular = ? WHERE id_cliente = ?");
        return $stmt->execute([$nombre, $apellido, $celular, $id]);
    }

    // Cuenta cuantas compras/ventas tiene el cliente.
    // Si el numero es mayor que cero, no se debe borrar porque ventas tiene una clave foranea.
    public function contarVentas(int $id): int {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM ventas WHERE id_cliente = ?");
        $stmt->execute([$id]);

        return (int) $stmt->fetchColumn();
    }

    // Elimina un cliente solo si no tiene compras registradas.
    // Devuelve texto para que el controlador sepa que mensaje mostrar.
    public function eliminar(int $id): string {
        if (!$this->obtenerPorId($id)) {
            return 'no_encontrado';
        }

        if ($this->contarVentas($id) > 0) {
            return 'tiene_ventas';
        }

        try {
            $stmt = $this->db->prepare("DELETE FROM clientes WHERE id_cliente = ?");
            $stmt->execute([$id]);

            return $stmt->rowCount() > 0 ? 'eliminado' : 'error';
        } catch (PDOException $e) {
            return 'error';
        }
    }
}
