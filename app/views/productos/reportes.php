<!DOCTYPE html>
<html lang="Es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Reporte de Productos</title>
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
        <span>Productos</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Reportes</span>
    </nav>
    <div class="main-content">
        <div class="mb-3">
            <a href="<?php echo BASE_URL; ?>/productos/registro" class="btn btn-warning">
                <i class="fas fa-plus"></i> Nuevo Producto
            </a>
        </div>
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Listado de Productos</h5></div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Stock</th>
                            <th>Categoria</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($productos)): ?>
                            <tr><td colspan="7" class="text-center">No hay productos registrados</td></tr>
                        <?php else: ?>
                            <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td class="text-center"><?php echo $producto['id_producto']; ?></td>
                                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                                <td class="text-center">S/ <?php echo htmlspecialchars($producto['precio']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($producto['stock']); ?></td>
                                <td><?php echo htmlspecialchars($producto['categoria']); ?></td>
                                <td class="text-center">
                                    <div class="acciones acciones-centradas">
                                        <a href="<?php echo BASE_URL; ?>/productos/editar/<?php echo $producto['id_producto']; ?>" class="btn-editar" title="Editar">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href="<?php echo BASE_URL; ?>/productos/eliminar/<?php echo $producto['id_producto']; ?>" class="btn-eliminar" title="Eliminar" onclick="return confirm('Seguro que deseas eliminar este producto?');">
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
