<?php
// La vista prepara un mensaje corto segun los parametros enviados por el controlador.
// Esto permite avisar si un cliente se elimino o si no se puede borrar porque tiene compras.
$mensaje = '';
$tipoMensaje = 'info';

if (($_GET['error'] ?? '') === 'tiene_ventas') {
    $mensaje = 'No se puede eliminar el cliente porque tiene compras registradas.';
    $tipoMensaje = 'danger';
} elseif (($_GET['error'] ?? '') === 'no_encontrado') {
    $mensaje = 'El cliente no fue encontrado.';
    $tipoMensaje = 'warning';
} elseif (($_GET['error'] ?? '') === 'eliminar') {
    $mensaje = 'No se pudo eliminar el cliente. Intentalo nuevamente.';
    $tipoMensaje = 'danger';
} elseif (($_GET['success'] ?? '') === '1') {
    $mensaje = 'Cliente registrado con exito.';
    $tipoMensaje = 'success';
} elseif (($_GET['updated'] ?? '') === '1') {
    $mensaje = 'Cliente actualizado con exito.';
    $tipoMensaje = 'success';
} elseif (($_GET['deleted'] ?? '') === '1') {
    $mensaje = 'Cliente eliminado con exito.';
    $tipoMensaje = 'success';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Reporte de Clientes</title>
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
        <span>Clientes</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Reportes</span>
    </nav>

    <div class="main-content">
        <?php if ($mensaje !== ''): ?>
            <!-- Mensaje de resultado despues de registrar, editar o eliminar clientes. -->
            <div class="alert alert-<?php echo $tipoMensaje; ?> alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($mensaje); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>

        <!-- Boton que lleva al formulario de registro de clientes. -->
        <div class="mb-3">
            <a href="<?php echo BASE_URL; ?>/clientes/registro" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Cliente
            </a>
        </div>

        <!-- Tabla principal con todos los clientes registrados. -->
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Listado de Clientes</h5></div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th><th>Nombre</th><th>Apellido</th><th>Celular</th><th>Fecha Registro</th><th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($clientes)): ?>
                            <tr><td colspan="6" class="text-center">No hay clientes registrados</td></tr>
                        <?php else: ?>
                            <?php foreach ($clientes as $cliente): ?>
                            <tr>
                                <td><?php echo $cliente['id_cliente']; ?></td>
                                <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['apellido']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['celular']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['fecha_registro']); ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>/clientes/editar/<?php echo $cliente['id_cliente']; ?>" class="btn-editar"><i class="fa-solid fa-pen"></i></a>
                                    <a href="<?php echo BASE_URL; ?>/clientes/eliminar/<?php echo $cliente['id_cliente']; ?>" class="btn-eliminar" onclick="return confirm('Eliminar cliente?');"><i class="fa-solid fa-trash"></i></a>
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
    // Asi el aviso no vuelve a salir si el usuario recarga la pagina.
    if (window.location.search) {
        window.history.replaceState({}, document.title, window.location.pathname);
    }
</script>
</body>
</html>
