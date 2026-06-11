<?php // Vista: formulario para editar una cuenta de usuario. ?>
<!DOCTYPE html>
<html lang="Es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Editar Usuario</title>
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
        <span>Usuarios</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Editar</span>
    </nav>
    <div class="main-content">
        <!-- Si la clave queda vacia, el controlador mantiene la clave anterior. -->
        <div class="card" style="max-width:600px;">
            <div class="card-header"><h5 class="mb-0">Editar Usuario</h5></div>
            <form method="POST" action="<?php echo BASE_URL; ?>/usuarios/editar/<?php echo $usuario_editar['id']; ?>">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <input type="text" name="nombre_usuario" class="form-control" value="<?php echo htmlspecialchars($usuario_editar['nombre_usuario']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nueva clave</label>
                        <input type="password" name="clave" class="form-control" placeholder="Dejar vacio para mantener la actual">
                    </div>
                </div>
                <div class="card-footer d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <a href="<?php echo BASE_URL; ?>/usuarios" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="<?php echo BASE_URL; ?>/public/js/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
