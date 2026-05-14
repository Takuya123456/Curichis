<?php

class Login {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function findUserByUsername($username) {
        $this->db->query('SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1');
        $this->db->bind(':usuario', $username);
        return $this->db->single();
    }

    public function createUser($data) {
        $this->db->query('INSERT INTO usuarios (usuario, password, nombre, rol) VALUES (:usuario, :password, :nombre, :rol)');
        $this->db->bind(':usuario', $data['usuario']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':rol', 'usuario');
        return $this->db->execute();
    }

    public function usernameExists($username) {
        $this->db->query('SELECT id FROM usuarios WHERE usuario = :usuario');
        $this->db->bind(':usuario', $username);
        $this->db->single();
        return $this->db->rowCount() > 0;
    }
}
