<?php

class LoginController extends Controller {
    private $loginModel;

    public function __construct() {
        $this->loginModel = $this->model('Login');
    }

    public function index() {
        if ($this->isLoggedIn()) {
            $this->redirect('dashboard');
        }
        $this->view('auth.login');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('login');
        }

        $usuario  = trim($_POST['usuario'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($usuario) || empty($password)) {
            $_SESSION['error'] = 'Por favor completa todos los campos.';
            $this->redirect('login');
        }

        $user = $this->loginModel->findUserByUsername($usuario);

        if ($user && password_verify($password, $user->password)) {
            $_SESSION['user_id']   = $user->id;
            $_SESSION['user_name'] = $user->nombre;
            $_SESSION['user_rol']  = $user->rol;
            $this->redirect('dashboard');
        } else {
            $_SESSION['error'] = 'Usuario o contraseña incorrectos.';
            $this->redirect('login');
        }
    }

    public function register() {
        if ($this->isLoggedIn()) {
            $this->redirect('dashboard');
        }
        $this->view('auth.register');
    }

    public function storeRegister() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('login/register');
        }

        $usuario  = trim($_POST['usuario'] ?? '');
        $password = $_POST['password'] ?? '';
        $nombre   = trim($_POST['nombre'] ?? '');

        if (empty($usuario) || empty($password) || empty($nombre)) {
            $_SESSION['error'] = 'Por favor completa todos los campos.';
            $this->redirect('login/register');
        }

        if ($this->loginModel->usernameExists($usuario)) {
            $_SESSION['error'] = 'El usuario ya existe.';
            $this->redirect('login/register');
        }

        $data = ['usuario' => $usuario, 'password' => $password, 'nombre' => $nombre];

        if ($this->loginModel->createUser($data)) {
            $_SESSION['success'] = '¡Cuenta creada! Ahora inicia sesión.';
            $this->redirect('login');
        } else {
            $_SESSION['error'] = 'Error al crear la cuenta.';
            $this->redirect('login/register');
        }
    }
}
