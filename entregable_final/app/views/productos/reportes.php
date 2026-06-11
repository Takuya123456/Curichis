<?php
// Mensajes que vienen del controlador de productos despues de una accion.
$mensaje = '';
$tipoMensaje = 'info';

if (($_GET['error'] ?? '') === 'tiene_ventas') {
    $mensaje = 'No se puede eliminar el producto porque tiene ventas registradas.';
    $tipoMensaje = 'danger';
} elseif (($_GET['error'] ?? '') === 'no_encontrado') {
    $mensaje = 'El producto no fue encontrado.';
    $tipoMensaje = 'warning';
} elseif (($_GET['error'] ?? '') === 'eliminar') {
    $mensaje = 'No se pudo eliminar el producto. Intentalo nuevamente.';
    $tipoMensaje = 'danger';
} elseif (($_GET['success'] ?? '') === '1') {
    $mensaje = 'Producto registrado con exito.';
    $tipoMensaje = 'success';
} elseif (($_GET['updated'] ?? '') === '1') {
    $mensaje = 'Producto actualizado con exito.';
    $tipoMensaje = 'success';
} elseif (($_GET['deleted'] ?? '') === '1') {
    $mensaje = 'Producto eliminado con exito.';
    $tipoMensaje = 'success';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Reporte de Productos</title>
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
        <span>Productos</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Reportes</span>
    </nav>

    <div class="main-content">
        <?php if ($mensaje !== ''): ?>
            <!-- Mensaje de resultado despues de registrar, editar o eliminar productos. -->
            <div class="alert alert-<?php echo $tipoMensaje; ?> alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($mensaje); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>

        <!-- Boton que lleva al formulario de registro de productos. -->
        <div class="mb-3">
            <a href="<?php echo BASE_URL; ?>/productos/registro" class="btn btn-warning">
                <i class="fas fa-plus"></i> Nuevo Producto
            </a>
        </div>

        <!-- Tabla principal con todos los productos registrados. -->
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Listado de Productos</h5></div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th><th>Nombre</th><th>Descripcion</th><th>Precio</th><th>Stock</th><th>Categoria</th><th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($productos)): ?>
                            <tr><td colspan="7" class="text-center">No hay productos registrados</td></tr>
                        <?php else: ?>
                            <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td><?php echo $producto['id_producto']; ?></td>
                                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                                <td>S/ <?php echo htmlspecialchars($producto['precio']); ?></td>
                                <td><?php echo htmlspecialchars($producto['stock']); ?></td>
                                <td><?php echo htmlspecialchars($producto['categoria']); ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>/productos/editar/<?php echo $producto['id_producto']; ?>" class="btn-editar"><i class="fa-solid fa-pen"></i></a>
                                    <a href="<?php echo BASE_URL; ?>/productos/eliminar/<?php echo $producto['id_producto']; ?>" class="btn-eliminar" onclick="return confirm('Eliminar producto?');"><i class="fa-solid fa-trash"></i></a>
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
<script>
    // Limpia los parametros de la URL despues de mostrar el mensaje.
    if (window.location.search) {
        window.history.replaceState({}, document.title, window.location.pathname);
    }
</script>
</body>
</html>
