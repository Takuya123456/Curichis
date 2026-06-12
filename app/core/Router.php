<?php

// Router lee la URL y decide que controlador/metodo ejecutar.
// Ejemplo: /clientes/editar/5 -> ClientesController::editar(5)
class Router {

    // Procesa una peticion del navegador.
    public function run(): void {
        // .htaccess envia la ruta en ?url=. Si no existe, usamos la raiz.
        $url = $_GET['url'] ?? '';

        // Limpia barras y caracteres no deseados.
        $url = filter_var(trim($url, '/'), FILTER_SANITIZE_URL);

        // Divide la ruta por partes: controlador, metodo y parametros.
        $partes = explode('/', $url);

        // Primer segmento: nombre del controlador.
        $nombreController = !empty($partes[0])
            ? ucfirst(strtolower($partes[0])) . 'Controller'
            : 'HomeController';

        // Segundo segmento: metodo del controlador.
        $metodo = !empty($partes[1]) ? $partes[1] : 'index';

        // Permite que enlaces antiguos con .php no rompan la ruta.
        $metodo = preg_replace('/\.php$/i', '', $metodo);

        // Segmentos restantes: parametros para el metodo.
        $params = array_slice($partes, 2);

        $archivo = __DIR__ . '/../controllers/' . $nombreController . '.php';

        if (!file_exists($archivo)) {
            $this->abortar(404);
            return;
        }

        require_once $archivo;

        if (!class_exists($nombreController)) {
            $this->abortar(404);
            return;
        }

        $controller = new $nombreController();

        if (!method_exists($controller, $metodo)) {
            $this->abortar(404);
            return;
        }

        // Ejecuta el metodo y envia los parametros de la URL.
        $controller->$metodo(...$params);
    }

    // Respuesta simple para rutas no encontradas.
    private function abortar(int $codigo): void {
        http_response_code($codigo);
        echo "<h1>Error $codigo - Pagina no encontrada</h1>";
    }
}
