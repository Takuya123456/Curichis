<?php

class Venta {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $this->db->query('
            SELECT v.*, c.nombre as cliente_nombre, p.nombre as producto_nombre
            FROM ventas v
            LEFT JOIN clientes c ON v.cliente_id = c.id
            LEFT JOIN productos p ON v.producto_id = p.id
            ORDER BY v.created_at DESC
        ');
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query('
            SELECT v.*, c.nombre as cliente_nombre, p.nombre as producto_nombre, p.precio as precio_unitario
            FROM ventas v
            LEFT JOIN clientes c ON v.cliente_id = c.id
            LEFT JOIN productos p ON v.producto_id = p.id
            WHERE v.id = :id
        ');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query('INSERT INTO ventas (cliente_id, producto_id, cantidad, total, estado, notas) VALUES (:cliente_id, :producto_id, :cantidad, :total, :estado, :notas)');
        $this->db->bind(':cliente_id', $data['cliente_id']);
        $this->db->bind(':producto_id', $data['producto_id']);
        $this->db->bind(':cantidad', $data['cantidad']);
        $this->db->bind(':total', $data['total']);
        $this->db->bind(':estado', $data['estado'] ?? 'completada');
        $this->db->bind(':notas', $data['notas'] ?? '');
        return $this->db->execute();
    }

    public function update($id, $data) {
        $this->db->query('UPDATE ventas SET cliente_id=:cliente_id, producto_id=:producto_id, cantidad=:cantidad, total=:total, estado=:estado, notas=:notas WHERE id=:id');
        $this->db->bind(':cliente_id', $data['cliente_id']);
        $this->db->bind(':producto_id', $data['producto_id']);
        $this->db->bind(':cantidad', $data['cantidad']);
        $this->db->bind(':total', $data['total']);
        $this->db->bind(':estado', $data['estado']);
        $this->db->bind(':notas', $data['notas']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM ventas WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function count() {
        $this->db->query('SELECT COUNT(*) as total FROM ventas');
        $row = $this->db->single();
        return $row->total;
    }

    public function totalIngresos() {
        $this->db->query('SELECT SUM(total) as suma FROM ventas WHERE estado = "completada"');
        $row = $this->db->single();
        return $row->suma ?? 0;
    }

    public function getRecientes($limit = 5) {
        $this->db->query('
            SELECT v.*, c.nombre as cliente_nombre, p.nombre as producto_nombre
            FROM ventas v
            LEFT JOIN clientes c ON v.cliente_id = c.id
            LEFT JOIN productos p ON v.producto_id = p.id
            ORDER BY v.created_at DESC
            LIMIT :limit
        ');
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }
}
