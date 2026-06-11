<?php
require_once __DIR__ . '/../core/Database.php';

// Modelo de USUARIOS.
// Administra las cuentas que pueden entrar al sistema.
class Usuario {
    private PDO $db;

    public function __construct() {
        // Conexion compartida con la base de datos.
        $this->db = Database::getConnection();
    }

    // Lista usuarios ordenados por nombre.
    public function obtenerTodos(): array {
        $stmt = $this->db->query("SELECT * FROM usuarios ORDER BY nombre_usuario ASC");
        return $stmt->fetchAll();
    }

    // Busca un usuario especifico por ID.
    public function obtenerPorId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    // Crea un usuario nuevo. La clave se guarda encriptada con password_hash().
    public function crear(string $nombre_usuario, string $clave): bool {
        try {
            $clave = password_hash($clave, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("INSERT INTO usuarios (nombre_usuario, clave) VALUES (?, ?)");
            return $stmt->execute([$nombre_usuario, $clave]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Actualiza nombre y clave cuando el formulario trae una clave nueva.
    public function actualizar(int $id, string $nombre_usuario, string $clave): bool {
        try {
            $clave = password_hash($clave, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("UPDATE usuarios SET nombre_usuario = ?, clave = ? WHERE id = ?");
            return $stmt->execute([$nombre_usuario, $clave, $id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Actualiza solo el nombre cuando el usuario deja la clave vacia en el formulario.
    public function actualizarSinClave(int $id, string $nombre_usuario): bool {
        try {
            $stmt = $this->db->prepare("UPDATE usuarios SET nombre_usuario = ? WHERE id = ?");
            return $stmt->execute([$nombre_usuario, $id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Borra un usuario por ID. El controlador evita que borres tu propia cuenta.
    public function eliminar(int $id): bool {
        try {
            $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
            $stmt->execute([$id]);

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
}
