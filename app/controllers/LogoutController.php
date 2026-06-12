<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/Controller.php';

// Controlador para cerrar la sesion del usuario.
class LogoutController extends Controller {

    // Se ejecuta cuando el usuario entra a /logout.
    public function index(): void {
        // Borra todos los datos guardados en la sesion actual.
        session_destroy();

        // Redirige a la pagina publica inicial.
        header('Location: ' . BASE_URL . '/');
        exit;
    }
}
