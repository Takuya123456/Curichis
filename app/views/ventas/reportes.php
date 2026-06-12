<?php // Vista: reporte de ventas registradas. ?>
<!DOCTYPE html>
<html lang="Es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Reporte de Ventas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/botones.css">
</head>
<body>

<?php include __DIR__ . '/../layouts/sidebar-dashboard.php'; ?>

<main>
    <nav class="breadcrumb">
        <span>Inicio</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span>Ventas</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Reportes</span>
    </nav>
    <div class="main-content">
        <div class="mb-3">
            <a href="<?php echo BASE_URL; ?>/ventas/registro" class="btn btn-success">
                <i class="fas fa-plus"></i> Nueva Venta
            </a>
        </div>
        <!-- Tabla de ventas con acceso al detalle de cada registro. -->
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Listado de Ventas</h5></div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th><th>Cliente</th><th>Producto</th><th>Cantidad</th><th>Fecha</th><th>Total</th><th>Estado</th><th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($ventas)): ?>
                            <tr><td colspan="8" class="text-center">No hay ventas registradas</td></tr>
                        <?php else: ?>
                            <?php foreach ($ventas as $venta): ?>
                            <tr>
                                <td><?php echo $venta['id_venta']; ?></td>
                                <td><?php echo htmlspecialchars($venta['cliente_nombre']); ?></td>
                                <td><?php echo htmlspecialchars($venta['nombre_producto']); ?></td>
                                <td><?php echo htmlspecialchars($venta['cantidad']); ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($venta['fecha_venta'])); ?></td>
                                <td><strong>S/ <?php echo number_format($venta['total'], 2); ?></strong></td>
                                <td><?php echo htmlspecialchars($venta['estado']); ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>/ventas/detalle/<?php echo $venta['id_venta']; ?>" class="btn btn-info btn-sm">
                                        <i class="fa-solid fa-eye"></i> Ver
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script src="<?php echo BASE_URL; ?>/public/js/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
