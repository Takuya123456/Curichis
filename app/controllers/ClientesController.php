<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Cliente.php';

// Controlador para el módulo de CLIENTES.
class ClientesController extends Controller {
    
    public function index(): void {
        $this->reporte();
    }

    public function reporte(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Cliente();
        $clientes = $modelo->obtenerTodos();

        $this->view('clientes/reportes', [
            'usuario' => $_SESSION['usuario'],
            'clientes' => $clientes
        ]);
    }

    public function reportes(): void {
        $this->reporte();
    }

    public function registro(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $this->view('clientes/registro', [
            'usuario' => $_SESSION['usuario']
        ]);
    }

    public function registrar(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['usuario'])) {
                header("Location: " . BASE_URL . "/login");
                exit();
            }

            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $telefono = trim($_POST['telefono'] ?? '');
            $direccion = trim($_POST['direccion'] ?? '');

            $clienteModel = new Cliente();
            $resultado = $clienteModel->crear($nombre, $email, $telefono, $direccion);

            if ($resultado) {
                header('Location: ' . BASE_URL . '/clientes?success=1');
            } else {
                header('Location: ' . BASE_URL . '/clientes/registro?error=1');
            }
            exit;
        }
        
        $this->registro();
    }

    public function editar($id = null): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $clienteModel = new Cliente();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $telefono = trim($_POST['telefono'] ?? '');
            $direccion = trim($_POST['direccion'] ?? '');

            $resultado = $clienteModel->actualizar($id, $nombre, $email, $telefono, $direccion);

            if ($resultado) {
                header('Location: ' . BASE_URL . '/clientes?updated=1');
            } else {
                header('Location: ' . BASE_URL . '/clientes/editar/' . $id . '?error=1');
            }
            exit;
        }

        $cliente = $clienteModel->obtenerPorId($id);

        if (!$cliente) {
            header('Location: ' . BASE_URL . '/clientes?error=no_encontrado');
            exit;
        }

        $this->view('clientes/editar', [
            'usuario' => $_SESSION['usuario'],
            'cliente' => $cliente
        ]);
    }

    public function eliminar($id = null): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $clienteModel = new Cliente();
        $resultado = $clienteModel->eliminar($id);

        header('Location: ' . BASE_URL . '/clientes?deleted=' . ($resultado ? 1 : 0));
        exit;
    }
}
?>