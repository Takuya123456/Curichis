<?php

class VentasController extends Controller {
    private $ventaModel;

    public function __construct() {
        $this->requireLogin();
        $this->ventaModel = $this->model('Venta');
    }

    public function index() {
        $ventas = $this->ventaModel->getAll();
        $this->view('ventas.index', ['ventas' => $ventas]);
    }

    public function create() {
        $clienteModel  = $this->model('Cliente');
        $productoModel = $this->model('Producto');
        $this->view('ventas.create', [
            'clientes'  => $clienteModel->getAll(),
            'productos' => $productoModel->getAll(),
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('ventas');
        }
        $data = [
            'cliente_id'  => intval($_POST['cliente_id']),
            'producto_id' => intval($_POST['producto_id']),
            'cantidad'    => intval($_POST['cantidad']),
            'total'       => floatval($_POST['total']),
            'estado'      => $_POST['estado'] ?? 'completada',
            'notas'       => trim($_POST['notas'] ?? ''),
        ];
        if ($this->ventaModel->create($data)) {
            $_SESSION['success'] = 'Venta registrada correctamente.';
        } else {
            $_SESSION['error'] = 'Error al registrar la venta.';
        }
        $this->redirect('ventas');
    }

    public function edit($id) {
        $clienteModel  = $this->model('Cliente');
        $productoModel = $this->model('Producto');
        $this->view('ventas.edit', [
            'venta'     => $this->ventaModel->getById($id),
            'clientes'  => $clienteModel->getAll(),
            'productos' => $productoModel->getAll(),
        ]);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('ventas');
        }
        $data = [
            'cliente_id'  => intval($_POST['cliente_id']),
            'producto_id' => intval($_POST['producto_id']),
            'cantidad'    => intval($_POST['cantidad']),
            'total'       => floatval($_POST['total']),
            'estado'      => $_POST['estado'],
            'notas'       => trim($_POST['notas'] ?? ''),
        ];
        if ($this->ventaModel->update($id, $data)) {
            $_SESSION['success'] = 'Venta actualizada.';
        } else {
            $_SESSION['error'] = 'Error al actualizar.';
        }
        $this->redirect('ventas');
    }

    public function delete($id) {
        if ($this->ventaModel->delete($id)) {
            $_SESSION['success'] = 'Venta eliminada.';
        } else {
            $_SESSION['error'] = 'Error al eliminar.';
        }
        $this->redirect('ventas');
    }
}
