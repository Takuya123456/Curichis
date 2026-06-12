<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Login.php';

// Controlador de LOGIN.
// Muestra el formulario y valida las credenciales enviadas por POST.
class LoginController extends Controller {

    // El Router ejecuta index() cuando la URL es /login.
    public function index(): void {
        // Guarda el mensaje de error que se muestra en la vista.
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Limpia usuario y clave recibidos desde el formulario.
            $usuario = trim($_POST['user'] ?? '');
            $clave   = trim($_POST['pass'] ?? '');

            if ($usuario === '' || $clave === '') {
                $error = "Completa todos los campos, por favor.";
            } else {
                // El modelo devuelve datos del usuario si la clave es correcta.
                $resultado = (new Login())->login($usuario, $clave);

                if ($resultado) {
                    // Guardamos al usuario en sesion para permitir acceso al dashboard.
                    $_SESSION['usuario'] = $resultado;

                    header('Location: ' . BASE_URL . '/dashboard');
                    exit;
                }

                $error = "Usuario o contrasena incorrectos.";
            }
        }

        // Si no hubo POST o hubo error, se muestra el formulario de login.
        $this->view('auth/login', ['error' => $error]);
    }
}
