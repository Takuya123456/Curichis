<?php
require_once __DIR__ . '/../core/Controller.php';

// Controlador de la pagina principal publica.
class HomeController extends Controller {

    // Se ejecuta cuando el usuario entra a la raiz del proyecto.
    public function index(): void {
        $this->view('home/landing');
    }
}
