<?php

class Producto {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $this->db->query('SELECT * FROM productos ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query('SELECT * FROM productos WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query('INSERT INTO productos (nombre, descripcion, precio, stock, categoria) VALUES (:nombre, :descripcion, :precio, :stock, :categoria)');
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':precio', $data['precio']);
        $this->db->bind(':stock', $data['stock']);
        $this->db->bind(':categoria', $data['categoria']);
        return $this->db->execute();
    }

    public function update($id, $data) {
        $this->db->query('UPDATE productos SET nombre=:nombre, descripcion=:descripcion, precio=:precio, stock=:stock, categoria=:categoria WHERE id=:id');
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':precio', $data['precio']);
        $this->db->bind(':stock', $data['stock']);
        $this->db->bind(':categoria', $data['categoria']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM productos WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function count() {
        $this->db->query('SELECT COUNT(*) as total FROM productos');
        $row = $this->db->single();
        return $row->total;
    }
}
