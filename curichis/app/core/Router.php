<?php

class Router {
    public function route() {
        $url = isset($_GET['url']) ? $_GET['url'] : '';
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        $controller = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
        $method     = isset($url[1]) && !empty($url[1]) ? $url[1] : 'index';
        $params     = array_slice($url, 2);

        $file = '../app/controllers/' . $controller . '.php';

        if (file_exists($file)) {
            require_once $file;
            $controllerObj = new $controller();
            if (method_exists($controllerObj, $method)) {
                call_user_func_array([$controllerObj, $method], $params);
            } else {
                $this->notFound();
            }
        } else {
            $this->notFound();
        }
    }

    private function notFound() {
        http_response_code(404);
        echo '<h1>404 - Página no encontrada</h1>';
    }
}
