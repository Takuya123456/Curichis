<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';

// Controlador del modulo USUARIOS.
// Maneja el listado, registro, edicion y eliminacion de cuentas del sistema.
class UsuariosController extends Controller {
    
    public function index(): void {
        // Ruta principal /usuarios: muestra el reporte por defecto.
        $this->reporte();
    }

    // Muestra todos los usuarios registrados.
    public function reporte(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Usuario();
        $usuarios = $modelo->obtenerTodos();

        $this->view('usuarios/reportes', [
            'usuario' => $_SESSION['usuario'],
            'usuarios' => $usuarios
        ]);
    }

    public function reportes(): void {
        // Alias para que /usuarios/reportes funcione igual que /usuarios.
        $this->reporte();
    }

    // Muestra el formulario de registro de usuarios.
    public function registro(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $this->view('usuarios/registro', [
            'usuario' => $_SESSION['usuario']
        ]);
    }

    // Procesa el formulario y crea una cuenta nueva.
    public function registrar(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['usuario'])) {
                header("Location: " . BASE_URL . "/login");
                exit();
            }

            $nombre = trim($_POST['nombre_usuario'] ?? $_POST['nombre'] ?? '');
            $password = $_POST['clave'] ?? $_POST['password'] ?? '';

            if ($nombre === '' || $password === '') {
                header('Location: ' . BASE_URL . '/usuarios/registro?error=campos_vacios');
                exit;
            }

            $usuarioModel = new Usuario();
            $resultado = $usuarioModel->crear($nombre, $password);

            if ($resultado) {
                header('Location: ' . BASE_URL . '/usuarios?success=1');
            } else {
                header('Location: ' . BASE_URL . '/usuarios/registro?error=1');
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

        $usuarioModel = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre_usuario'] ?? $_POST['nombre'] ?? '');
            $password = $_POST['clave'] ?? $_POST['password'] ?? '';

            if ($nombre === '') {
                header('Location: ' . BASE_URL . '/usuarios/editar/' . $id . '?error=campos_vacios');
                exit;
            }

            if ($password === '') {
                $resultado = $usuarioModel->actualizarSinClave((int)$id, $nombre);
            } else {
                $resultado = $usuarioModel->actualizar((int)$id, $nombre, $password);
            }

            if ($resultado) {
                header('Location: ' . BASE_URL . '/usuarios?updated=1');
            } else {
                header('Location: ' . BASE_URL . '/usuarios/editar/' . $id . '?error=1');
            }
            exit;
        }

        $usuario = $usuarioModel->obtenerPorId((int)$id);

        if (!$usuario) {
            header('Location: ' . BASE_URL . '/usuarios?error=no_encontrado');
            exit;
        }

        $this->view('usuarios/editar', [
            'usuario' => $_SESSION['usuario'],
            'usuario_editar' => $usuario
        ]);
    }

    // Elimina una cuenta, excepto la cuenta que esta usando la sesion actual.
    public function eliminar($id = null): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        if ((int)$id === (int)$_SESSION['usuario']['id']) {
            header('Location: ' . BASE_URL . '/usuarios?error=self_delete');
            exit;
        }

        $usuarioModel = new Usuario();
        $resultado = $usuarioModel->eliminar((int)$id);

        header('Location: ' . BASE_URL . '/usuarios?deleted=' . ($resultado ? 1 : 0));
        exit;
    }
}
?>
