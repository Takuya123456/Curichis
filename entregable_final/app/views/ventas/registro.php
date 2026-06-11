<?php // Vista: formulario para registrar una venta y descontar stock. ?>
<!DOCTYPE html>
<html lang="Es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Registrar Venta</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
</head>
<body>

<?php include __DIR__ . '/../layouts/sidebar-dashboard.php'; ?>

<main>
    <nav class="breadcrumb">
        <span>Inicio</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span>Ventas</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Registrar</span>
    </nav>
    <div class="main-content">
        <!-- Formulario que envia cliente, producto y cantidad a VentasController::registrar(). -->
        <div class="card" style="max-width:600px;">
            <div class="card-header"><h5 class="mb-0">Nueva Venta</h5></div>
            <form method="POST" action="<?php echo BASE_URL; ?>/ventas/registrar">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Cliente</label>
                        <select name="cliente_id" class="form-select" required>
                            <option value="">Seleccione un cliente</option>
                            <?php if (!empty($clientes)): ?>
                                <?php foreach ($clientes as $cliente): ?>
                                    <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo htmlspecialchars($cliente['nombre'] . ' ' . $cliente['apellido']); ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <select name="producto_id" class="form-select" required>
                            <option value="">Seleccione un producto</option>
                            <?php if (!empty($productos)): ?>
                                <?php foreach ($productos as $producto): ?>
                                    <option value="<?php echo $producto['id_producto']; ?>">
                                        <?php echo htmlspecialchars($producto['nombre']); ?> - S/ <?php echo $producto['precio']; ?> (Stock: <?php echo $producto['stock']; ?>)
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" min="1" value="1" required>
                    </div>
                </div>
                <div class="card-footer d-flex gap-2">
                    <button type="submit" class="btn btn-success">Guardar Venta</button>
                    <a href="<?php echo BASE_URL; ?>/ventas" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="<?php echo BASE_URL; ?>/public/js/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
