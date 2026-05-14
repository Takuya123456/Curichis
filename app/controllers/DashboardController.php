<?php

class DashboardController extends Controller {
    public function index() {
        $this->requireLogin();
        $ventaModel    = $this->model('Venta');
        $productoModel = $this->model('Producto');
        $clienteModel  = $this->model('Cliente');

        $data = [
            'totalVentas'    => $ventaModel->count(),
            'totalProductos' => $productoModel->count(),
            'totalClientes'  => $clienteModel->count(),
            'ingresos'       => $ventaModel->totalIngresos(),
            'ventasRecientes'=> $ventaModel->getRecientes(5),
        ];

        $this->view('dashboard.index', $data);
    }
}
