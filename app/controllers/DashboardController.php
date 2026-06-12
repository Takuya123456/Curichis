<?php
require_once __DIR__ . '/../core/Controller.php';

// Controlador del panel principal del sistema.
// Solo deja entrar a usuarios que hayan iniciado sesion.
class DashboardController extends Controller {

    // Se ejecuta cuando el usuario entra a /dashboard.
    public function index(): void {
        // Si no existe la sesion, el usuario vuelve al login.
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        // Enviamos los datos del usuario para mostrarlos en el sidebar.
        $this->view('dashboard/index', [
            'usuario' => $_SESSION['usuario']
        ]);
    }
}
