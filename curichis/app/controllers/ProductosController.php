<?php

class ProductosController extends Controller {
    private $productoModel;

    public function __construct() {
        $this->requireLogin();
        $this->productoModel = $this->model('Producto');
    }

    public function index() {
        $productos = $this->productoModel->getAll();
        $this->view('productos.index', ['productos' => $productos]);
    }

    public function create() {
        $this->view('productos.create');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('productos');
        }
        $data = [
            'nombre'      => trim($_POST['nombre']),
            'descripcion' => trim($_POST['descripcion']),
            'precio'      => floatval($_POST['precio']),
            'stock'       => intval($_POST['stock']),
            'categoria'   => trim($_POST['categoria']),
        ];
        if ($this->productoModel->create($data)) {
            $_SESSION['success'] = 'Producto creado correctamente.';
        } else {
            $_SESSION['error'] = 'Error al crear el producto.';
        }
        $this->redirect('productos');
    }

    public function edit($id) {
        $producto = $this->productoModel->getById($id);
        $this->view('productos.edit', ['producto' => $producto]);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('productos');
        }
        $data = [
            'nombre'      => trim($_POST['nombre']),
            'descripcion' => trim($_POST['descripcion']),
            'precio'      => floatval($_POST['precio']),
            'stock'       => intval($_POST['stock']),
            'categoria'   => trim($_POST['categoria']),
        ];
        if ($this->productoModel->update($id, $data)) {
            $_SESSION['success'] = 'Producto actualizado.';
        } else {
            $_SESSION['error'] = 'Error al actualizar.';
        }
        $this->redirect('productos');
    }

    public function delete($id) {
        if ($this->productoModel->delete($id)) {
            $_SESSION['success'] = 'Producto eliminado.';
        } else {
            $_SESSION['error'] = 'Error al eliminar.';
        }
        $this->redirect('productos');
    }
}
