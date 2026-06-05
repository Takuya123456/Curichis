<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';

// Controlador para el módulo de USUARIOS del sistema.
class UsuariosController extends Controller {
    
    public function index(): void {
        $this->reporte();
    }

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
        $this->reporte();
    }

    public function registro(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $this->view('usuarios/registro', [
            'usuario' => $_SESSION['usuario']
        ]);
    }

    public function registrar(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['usuario'])) {
                header("Location: " . BASE_URL . "/login");
                exit();
            }

            $nombre = trim($_POST['nombre_usuario'] ?? $_POST['nombre'] ?? '');
            $password = $_POST['clave'] ?? $_POST['password'] ?? '';

            if (empty($nombre) || empty($password)) {
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

    public function editar($id = null): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $usuarioModel = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre_usuario'] ?? $_POST['nombre'] ?? '');
            $password = $_POST['clave'] ?? $_POST['password'] ?? '';

            if (empty($password)) {
                $resultado = $usuarioModel->actualizarSinClave($id, $nombre);
            } else {
                $resultado = $usuarioModel->actualizar($id, $nombre, $password);
            }

            if ($resultado) {
                header('Location: ' . BASE_URL . '/usuarios?updated=1');
            } else {
                header('Location: ' . BASE_URL . '/usuarios/editar/' . $id . '?error=1');
            }
            exit;
        }

        $usuario = $usuarioModel->obtenerPorId($id);

        if (!$usuario) {
            header('Location: ' . BASE_URL . '/usuarios?error=no_encontrado');
            exit;
        }

        $this->view('usuarios/editar', [
            'usuario' => $_SESSION['usuario'],
            'usuario_editar' => $usuario
        ]);
    }

    public function eliminar($id = null): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        // No permitir eliminar el propio usuario
        if ($id == $_SESSION['usuario']['id']) {
            header('Location: ' . BASE_URL . '/usuarios?error=self_delete');
            exit;
        }

        $usuarioModel = new Usuario();
        $resultado = $usuarioModel->eliminar($id);

        header('Location: ' . BASE_URL . '/usuarios?deleted=' . ($resultado ? 1 : 0));
        exit;
    }
}
?>
