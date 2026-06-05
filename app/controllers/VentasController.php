<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Venta.php';
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Producto.php';

class VentasController extends Controller {
    
    public function index(): void {
        $this->reportes();
    }

    // ============================================
    // METODO: reportes() - muestra listado de ventas
    // ============================================
    public function reportes(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Venta();
        $ventas = $modelo->obtenerTodas();

        $this->view('ventas/reportes', [
            'usuario' => $_SESSION['usuario'],
            'ventas' => $ventas
        ]);
    }

    // ============================================
    // METODO: registro() - muestra formulario de nueva venta
    // ============================================
    public function registro(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        // Cargar clientes y productos para los selects
        $clienteModel = new Cliente();
        $productoModel = new Producto();

        $clientes = $clienteModel->obtenerTodos();
        $productos = $productoModel->obtenerTodos();

        $this->view('ventas/registro', [
            'usuario' => $_SESSION['usuario'],
            'clientes' => $clientes,
            'productos' => $productos
        ]);
    }

    // ============================================
    // METODO: registrar() - guarda la venta en la BD
    // ============================================
    public function registrar(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['usuario'])) {
                header("Location: " . BASE_URL . "/login");
                exit();
            }

            $cliente_id = (int) ($_POST['cliente_id'] ?? 0);
            $producto_id = (int) ($_POST['producto_id'] ?? 0);
            $cantidad = (int) ($_POST['cantidad'] ?? 1);

            $ventaModel = new Venta();
            $resultado = $ventaModel->crearVenta($cliente_id, $producto_id, $cantidad);

            if ($resultado) {
                header('Location: ' . BASE_URL . '/ventas?success=1');
            } else {
                header('Location: ' . BASE_URL . '/ventas/registro?error=1');
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

        $ventaModel = new Venta();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente_id = (int) ($_POST['cliente_id'] ?? 0);
            $producto_id = (int) ($_POST['producto_id'] ?? 0);
            $cantidad = (int) ($_POST['cantidad'] ?? 1);
            $estado = trim($_POST['estado'] ?? 'completada');

            $resultado = $ventaModel->actualizar((int) $id, $cliente_id, $producto_id, $cantidad, $estado);

            if ($resultado) {
                header('Location: ' . BASE_URL . '/ventas?updated=1');
            } else {
                header('Location: ' . BASE_URL . '/ventas/editar/' . $id . '?error=1');
            }
            exit;
        }

        $venta = $ventaModel->obtenerPorId((int) $id);

        if (!$venta) {
            header('Location: ' . BASE_URL . '/ventas?error=no_encontrado');
            exit;
        }

        $clienteModel = new Cliente();
        $productoModel = new Producto();

        $this->view('ventas/editar', [
            'usuario' => $_SESSION['usuario'],
            'venta' => $venta,
            'clientes' => $clienteModel->obtenerTodos(),
            'productos' => $productoModel->obtenerTodos()
        ]);
    }

    public function eliminar($id = null): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $ventaModel = new Venta();
        $resultado = $ventaModel->eliminar((int) $id);

        header('Location: ' . BASE_URL . '/ventas?deleted=' . ($resultado ? 1 : 0));
        exit;
    }
}
?>
