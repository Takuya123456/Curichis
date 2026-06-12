<?php // Vista: detalle completo de una venta seleccionada. ?>
<!DOCTYPE html>
<html lang="Es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Detalle de Venta</title>
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
        <span id="breadcrumb-page">Detalle</span>
    </nav>
    <div class="main-content">
        <!-- Tabla de solo lectura con los datos principales de la venta. -->
        <div class="card" style="max-width:700px;">
            <div class="card-header"><h5 class="mb-0">Detalle de Venta #<?php echo $venta['id_venta']; ?></h5></div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr><th>Cliente</th><td><?php echo htmlspecialchars($venta['cliente_nombre']); ?></td></tr>
                    <tr><th>Celular</th><td><?php echo htmlspecialchars($venta['celular'] ?? ''); ?></td></tr>
                    <tr><th>Producto</th><td><?php echo htmlspecialchars($venta['nombre_producto']); ?></td></tr>
                    <tr><th>Cantidad</th><td><?php echo htmlspecialchars($venta['cantidad']); ?></td></tr>
                    <tr><th>Total</th><td>S/ <?php echo number_format($venta['total'], 2); ?></td></tr>
                    <tr><th>Estado</th><td><?php echo htmlspecialchars($venta['estado']); ?></td></tr>
                    <tr><th>Fecha</th><td><?php echo date('d/m/Y H:i', strtotime($venta['fecha_venta'])); ?></td></tr>
                </table>
            </div>
            <div class="card-footer">
                <a href="<?php echo BASE_URL; ?>/ventas" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</main>

<script src="<?php echo BASE_URL; ?>/public/js/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
