<?php
require_once __DIR__ . '/Router.php';

// App es el punto de arranque interno de la aplicacion.
// Prepara la sesion y delega la peticion al Router.
class App {

    // Se llama una sola vez desde app/index.php.
    public function run(): void {
        // La sesion permite recordar al usuario logueado entre paginas.
        session_start();

        // El Router decide que controlador y que metodo ejecutar segun la URL.
        $router = new Router();
        $router->run();
    }
}
