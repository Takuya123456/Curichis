<!DOCTYPE html>
<html lang="Es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Editar Venta</title>
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
        <span id="breadcrumb-page">Editar</span>
    </nav>
    <div class="main-content">
        <div class="card" style="max-width:600px;">
            <div class="card-header"><h5 class="mb-0">Editar Venta</h5></div>
            <form method="POST" action="<?php echo BASE_URL; ?>/ventas/editar/<?php echo $venta['id_venta']; ?>">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Cliente</label>
                        <select name="cliente_id" class="form-select" required>
                            <?php foreach ($clientes as $cliente): ?>
                                <option value="<?php echo $cliente['id_cliente']; ?>" <?php echo (int) $venta['id_cliente'] === (int) $cliente['id_cliente'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cliente['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <select name="producto_id" class="form-select" required>
                            <?php foreach ($productos as $producto): ?>
                                <option value="<?php echo $producto['id_producto']; ?>" <?php echo (int) $venta['id_producto'] === (int) $producto['id_producto'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($producto['nombre']); ?> - S/ <?php echo $producto['precio']; ?> (Stock: <?php echo $producto['stock']; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" min="1" value="<?php echo htmlspecialchars($venta['cantidad']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select name="estado" class="form-select" required>
                            <?php $estadoActual = $venta['estado'] ?? 'completada'; ?>
                            <?php foreach (['completada', 'pendiente', 'cancelada'] as $estado): ?>
                                <option value="<?php echo $estado; ?>" <?php echo $estadoActual === $estado ? 'selected' : ''; ?>>
                                    <?php echo ucfirst($estado); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="card-footer d-flex gap-2">
                    <button type="submit" class="btn btn-success">Actualizar Venta</button>
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
