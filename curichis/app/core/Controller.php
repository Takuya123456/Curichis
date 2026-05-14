<?php

class Controller {
    protected function view($view, $data = []) {
        extract($data);
        $file = '../app/views/' . str_replace('.', '/', $view) . '.php';
        if (file_exists($file)) {
            require_once $file;
        } else {
            die('Vista no encontrada: ' . $file);
        }
    }

    protected function model($model) {
        $file = '../app/models/' . $model . '.php';
        if (file_exists($file)) {
            require_once $file;
            return new $model();
        }
        die('Modelo no encontrado: ' . $model);
    }

    protected function redirect($url) {
        header('Location: ' . APP_URL . '/' . $url);
        exit;
    }

    protected function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    protected function requireLogin() {
        if (!$this->isLoggedIn()) {
            $this->redirect('login');
        }
    }
}
