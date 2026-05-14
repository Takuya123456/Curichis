<?php

class ClientesController extends Controller {
    private $clienteModel;

    public function __construct() {
        $this->requireLogin();
        $this->clienteModel = $this->model('Cliente');
    }

    public function index() {
        $clientes = $this->clienteModel->getAll();
        $this->view('clientes.index', ['clientes' => $clientes]);
    }

    public function create() {
        $this->view('clientes.create');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('clientes');
        }
        $data = [
            'nombre'    => trim($_POST['nombre']),
            'email'     => trim($_POST['email']),
            'telefono'  => trim($_POST['telefono']),
            'direccion' => trim($_POST['direccion']),
        ];
        if ($this->clienteModel->create($data)) {
            $_SESSION['success'] = 'Cliente registrado correctamente.';
        } else {
            $_SESSION['error'] = 'Error al registrar el cliente.';
        }
        $this->redirect('clientes');
    }

    public function edit($id) {
        $cliente = $this->clienteModel->getById($id);
        $this->view('clientes.edit', ['cliente' => $cliente]);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('clientes');
        }
        $data = [
            'nombre'    => trim($_POST['nombre']),
            'email'     => trim($_POST['email']),
            'telefono'  => trim($_POST['telefono']),
            'direccion' => trim($_POST['direccion']),
        ];
        if ($this->clienteModel->update($id, $data)) {
            $_SESSION['success'] = 'Cliente actualizado.';
        } else {
            $_SESSION['error'] = 'Error al actualizar.';
        }
        $this->redirect('clientes');
    }

    public function delete($id) {
        if ($this->clienteModel->delete($id)) {
            $_SESSION['success'] = 'Cliente eliminado.';
        } else {
            $_SESSION['error'] = 'Error al eliminar.';
        }
        $this->redirect('clientes');
    }
}
