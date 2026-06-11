<?php // Vista: reporte de usuarios registrados. ?>
<!DOCTYPE html>
<html lang="Es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Reporte de Usuarios</title>
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
        <span>Usuarios</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Reportes</span>
    </nav>
    <div class="main-content">
        <div class="mb-3">
            <a href="<?php echo BASE_URL; ?>/usuarios/registro" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Usuario
            </a>
        </div>
        <!-- Tabla de usuarios con opciones para editar o eliminar cuentas. -->
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Listado de Usuarios</h5></div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th><th>Usuario</th><th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($usuarios)): ?>
                            <tr><td colspan="3" class="text-center">No hay usuarios registrados</td></tr>
                        <?php else: ?>
                            <?php foreach ($usuarios as $item): ?>
                            <tr>
                                <td><?php echo $item['id']; ?></td>
                                <td><?php echo htmlspecialchars($item['nombre_usuario']); ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>/usuarios/editar/<?php echo $item['id']; ?>" class="btn-editar"><i class="fa-solid fa-pen"></i></a>
                                    <?php if ($item['id'] != $usuario['id']): ?>
                                        <a href="<?php echo BASE_URL; ?>/usuarios/eliminar/<?php echo $item['id']; ?>" class="btn-eliminar" onclick="return confirm('Eliminar usuario?');"><i class="fa-solid fa-trash"></i></a>
                                    <?php endif; ?>
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
