<?php

// Clase base de todos los controladores.
// Evita repetir la misma logica para cargar vistas.
class Controller {

    // Carga una vista de app/views y le pasa variables.
    protected function view(string $vista, array $datos = []): void {
        // Convierte ['usuario' => $u] en una variable $usuario disponible en la vista.
        extract($datos);

        // Incluye el archivo PHP de la vista solicitada.
        require_once __DIR__ . '/../views/' . $vista . '.php';
    }
}
