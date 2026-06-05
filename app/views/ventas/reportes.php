<!DOCTYPE html>
<html lang="Es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Reporte de Ventas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css?v=<?php echo filemtime(__DIR__ . '/../../../public/css/dashboard.css'); ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/botones.css?v=<?php echo filemtime(__DIR__ . '/../../../public/css/botones.css'); ?>">
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
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Listado de Ventas</h5></div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover ventas-table align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Cliente</th>
                            <th>Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Hora</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($ventas)): ?>
                            <tr><td colspan="8" class="text-center">No hay ventas registradas</td></tr>
                        <?php else: ?>
                            <?php foreach ($ventas as $venta): ?>
                            <tr>
                                <td class="text-center"><?php echo $venta['id_venta']; ?></td>
                                <td><?php echo htmlspecialchars($venta['cliente_nombre']); ?></td>
                                <td><?php echo htmlspecialchars($venta['nombre_producto'] ?? ''); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($venta['cantidad']); ?></td>
                                <td class="text-center"><?php echo date('d/m/Y', strtotime($venta['fecha_venta'])); ?></td>
                                <td class="text-center"><?php echo date('H:i', strtotime($venta['fecha_venta'])); ?></td>
                                <td class="text-center"><strong>S/ <?php echo number_format($venta['total'], 2); ?></strong></td>
                                <td class="text-center">
                                    <div class="acciones acciones-centradas">
                                        <a href="<?php echo BASE_URL; ?>/ventas/editar/<?php echo $venta['id_venta']; ?>" class="btn-editar" title="Editar">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href="<?php echo BASE_URL; ?>/ventas/eliminar/<?php echo $venta['id_venta']; ?>" class="btn-eliminar" title="Eliminar" onclick="return confirm('Seguro que deseas eliminar esta venta?');">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
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
