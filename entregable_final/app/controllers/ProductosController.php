<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Producto.php';

// Controlador para el modulo PRODUCTOS.
// Valida datos que vienen del formulario y llama al modelo Producto.
class ProductosController extends Controller {
    
    public function index(): void {
        // Ruta principal /productos: muestra el reporte por defecto.
        $this->reporte();
    }

    // Muestra la lista de productos registrados.
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
        // Alias para que /productos/reportes funcione igual que /productos.
        $this->reporte();
    }

    // Muestra el formulario para crear productos.
    public function registro(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $this->view('productos/registro', [
            'usuario' => $_SESSION['usuario']
        ]);
    }

    // Procesa el formulario y guarda un producto nuevo.
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

            if ($nombre === '') {
                header('Location: ' . BASE_URL . '/productos/registro?error=nombre_vacio');
                exit;
            }

            if ($precio <= 0) {
                header('Location: ' . BASE_URL . '/productos/registro?error=precio_invalido');
                exit;
            }

            if ($categoria === '') {
                header('Location: ' . BASE_URL . '/productos/registro?error=categoria_vacia');
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

    // Muestra el formulario de edicion y procesa la actualizacion.
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

            if ($nombre === '' || $precio <= 0 || $categoria === '') {
                header('Location: ' . BASE_URL . '/productos/editar/' . $id . '?error=datos_invalidos');
                exit;
            }

            $resultado = $productoModel->actualizar((int)$id, $nombre, $descripcion, $precio, $stock, $categoria);

            if ($resultado) {
                header('Location: ' . BASE_URL . '/productos?updated=1');
            } else {
                header('Location: ' . BASE_URL . '/productos/editar/' . $id . '?error=1');
            }
            exit;
        }

        $producto = $productoModel->obtenerPorId((int)$id);

        if (!$producto) {
            header('Location: ' . BASE_URL . '/productos?error=no_encontrado');
            exit;
        }

        $this->view('productos/editar', [
            'usuario' => $_SESSION['usuario'],
            'producto' => $producto
        ]);
    }

    // Intenta eliminar un producto.
    // Si ya fue vendido, no se borra para conservar el historial de ventas.
    public function eliminar($id = null): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $productoModel = new Producto();
        $estado = $productoModel->eliminar((int)$id);

        if ($estado === 'eliminado') {
            header('Location: ' . BASE_URL . '/productos?deleted=1');
        } elseif ($estado === 'tiene_ventas') {
            header('Location: ' . BASE_URL . '/productos?error=tiene_ventas');
        } elseif ($estado === 'no_encontrado') {
            header('Location: ' . BASE_URL . '/productos?error=no_encontrado');
        } else {
            header('Location: ' . BASE_URL . '/productos?error=eliminar');
        }
        exit;
    }
}
?>
