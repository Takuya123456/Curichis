<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Producto.php';

// Controlador para el módulo de PRODUCTOS.
class ProductosController extends Controller {
    
    public function index(): void {
        $this->reporte();
    }

    public function reporte(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Producto();
        $productos = $modelo->obtenerTodos();

        $this->view('productos/reportes', [
            'usuario' => $_SESSION['usuario'],
            'productos' => $productos
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

        $this->view('productos/registro', [
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
            $precio = floatval($_POST['precio'] ?? 0);
            $stock = intval($_POST['stock'] ?? 0);
            $descripcion = trim($_POST['descripcion'] ?? '');
            $categoria = trim($_POST['categoria'] ?? '');

            if (empty($nombre)) {
                header('Location: ' . BASE_URL . '/productos/registro?error=nombre_vacio');
                exit;
            }

            if ($precio <= 0) {
                header('Location: ' . BASE_URL . '/productos/registro?error=precio_invalido');
                exit;
            }

            $productoModel = new Producto();
            $resultado = $productoModel->crear($nombre, $descripcion, $precio, $stock, $categoria);

            if ($resultado) {
                header('Location: ' . BASE_URL . '/productos?success=1');
            } else {
                header('Location: ' . BASE_URL . '/productos/registro?error=1');
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

        $productoModel = new Producto();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $precio = floatval($_POST['precio'] ?? 0);
            $stock = intval($_POST['stock'] ?? 0);
            $descripcion = trim($_POST['descripcion'] ?? '');
            $categoria = trim($_POST['categoria'] ?? '');

            $resultado = $productoModel->actualizar($id, $nombre, $descripcion, $precio, $stock, $categoria);

            if ($resultado) {
                header('Location: ' . BASE_URL . '/productos?updated=1');
            } else {
                header('Location: ' . BASE_URL . '/productos/editar/' . $id . '?error=1');
            }
            exit;
        }

        $producto = $productoModel->obtenerPorId($id);

        if (!$producto) {
            header('Location: ' . BASE_URL . '/productos?error=no_encontrado');
            exit;
        }

        $this->view('productos/editar', [
            'usuario' => $_SESSION['usuario'],
            'producto' => $producto
        ]);
    }

    public function eliminar($id = null): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $productoModel = new Producto();
        $resultado = $productoModel->eliminar($id);

        header('Location: ' . BASE_URL . '/productos?deleted=' . ($resultado ? 1 : 0));
        exit;
    }
}
?>
