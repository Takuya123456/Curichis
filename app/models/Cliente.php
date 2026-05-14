<?php

class Cliente {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $this->db->query('SELECT * FROM clientes ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query('SELECT * FROM clientes WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query('INSERT INTO clientes (nombre, email, telefono, direccion) VALUES (:nombre, :email, :telefono, :direccion)');
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telefono', $data['telefono']);
        $this->db->bind(':direccion', $data['direccion']);
        return $this->db->execute();
    }

    public function update($id, $data) {
        $this->db->query('UPDATE clientes SET nombre=:nombre, email=:email, telefono=:telefono, direccion=:direccion WHERE id=:id');
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telefono', $data['telefono']);
        $this->db->bind(':direccion', $data['direccion']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM clientes WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function count() {
        $this->db->query('SELECT COUNT(*) as total FROM clientes');
        $row = $this->db->single();
        return $row->total;
    }
}
