<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Cliente.php';

// Controlador del modulo CLIENTES.
// Recibe las peticiones del navegador, valida datos basicos y llama al modelo Cliente.
class ClientesController extends Controller {
    
    public function index(): void {
        // Ruta principal /clientes: muestra el reporte por defecto.
        $this->reporte();
    }

    // Muestra la lista de clientes registrados.
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
        // Alias para que /clientes/reportes funcione igual que /clientes.
        $this->reporte();
    }

    // Muestra el formulario para registrar un cliente.
    public function registro(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $this->view('clientes/registro', [
            'usuario' => $_SESSION['usuario']
        ]);
    }

    // Procesa el formulario de registro y guarda el cliente en la base de datos.
    public function registrar(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['usuario'])) {
                header("Location: " . BASE_URL . "/login");
                exit();
            }

            $nombre = trim($_POST['nombre'] ?? '');
            $apellido = trim($_POST['apellido'] ?? '');
            $celular = trim($_POST['celular'] ?? '');

            if ($nombre === '' || $apellido === '') {
                header('Location: ' . BASE_URL . '/clientes/registro?error=campos_vacios');
                exit;
            }

            $clienteModel = new Cliente();
            $resultado = $clienteModel->crear($nombre, $apellido, $celular);

            if ($resultado) {
                header('Location: ' . BASE_URL . '/clientes?success=1');
            } else {
                header('Location: ' . BASE_URL . '/clientes/registro?error=1');
            }
            exit;
        }
        
        $this->registro();
    }

    // Muestra el formulario de edicion y tambien procesa la actualizacion.
    public function editar($id = null): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $clienteModel = new Cliente();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $apellido = trim($_POST['apellido'] ?? '');
            $celular = trim($_POST['celular'] ?? '');

            if ($nombre === '' || $apellido === '') {
                header('Location: ' . BASE_URL . '/clientes/editar/' . $id . '?error=campos_vacios');
                exit;
            }

            $resultado = $clienteModel->actualizar((int)$id, $nombre, $apellido, $celular);

            if ($resultado) {
                header('Location: ' . BASE_URL . '/clientes?updated=1');
            } else {
                header('Location: ' . BASE_URL . '/clientes/editar/' . $id . '?error=1');
            }
            exit;
        }

        $cliente = $clienteModel->obtenerPorId((int)$id);

        if (!$cliente) {
            header('Location: ' . BASE_URL . '/clientes?error=no_encontrado');
            exit;
        }

        $this->view('clientes/editar', [
            'usuario' => $_SESSION['usuario'],
            'cliente' => $cliente
        ]);
    }

    // Intenta eliminar un cliente.
    // Si tiene compras/ventas, no se borra y se muestra un mensaje en la lista.
    public function eliminar($id = null): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $clienteModel = new Cliente();
        $estado = $clienteModel->eliminar((int)$id);

        if ($estado === 'eliminado') {
            header('Location: ' . BASE_URL . '/clientes?deleted=1');
        } elseif ($estado === 'tiene_ventas') {
            header('Location: ' . BASE_URL . '/clientes?error=tiene_ventas');
        } elseif ($estado === 'no_encontrado') {
            header('Location: ' . BASE_URL . '/clientes?error=no_encontrado');
        } else {
            header('Location: ' . BASE_URL . '/clientes?error=eliminar');
        }
        exit;
    }
}
?>
