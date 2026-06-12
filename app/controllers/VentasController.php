<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Venta.php';
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Producto.php';

// Controlador del modulo VENTAS.
// Coordina formularios, reportes y detalle de las ventas.
class VentasController extends Controller {
    
    public function index(): void {
        // Ruta principal /ventas: muestra el reporte por defecto.
        $this->reportes();
    }

    // Muestra el listado de ventas.
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

    // Muestra el formulario para registrar una venta.
    public function registro(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        // Se cargan clientes y productos para llenar los select del formulario.
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

    // Procesa el formulario de venta y guarda la transaccion.
    public function registrar(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['usuario'])) {
                header("Location: " . BASE_URL . "/login");
                exit();
            }

            $cliente_id = (int)($_POST['cliente_id'] ?? 0);
            $producto_id = (int)($_POST['producto_id'] ?? 0);
            $cantidad = (int)($_POST['cantidad'] ?? 1);

            if ($cliente_id <= 0 || $producto_id <= 0 || $cantidad <= 0) {
                header('Location: ' . BASE_URL . '/ventas/registro?error=datos_invalidos');
                exit;
            }

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

    // Muestra una venta puntual con datos de cliente, producto, total y fecha.
    public function detalle($id = null): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $venta = (new Venta())->obtenerPorId((int)$id);

        if (!$venta) {
            header('Location: ' . BASE_URL . '/ventas?error=no_encontrado');
            exit;
        }

        $this->view('ventas/detalle', [
            'usuario' => $_SESSION['usuario'],
            'venta' => $venta
        ]);
    }
}
?>
