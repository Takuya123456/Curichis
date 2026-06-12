<?php // Vista: formulario para registrar productos nuevos. ?>
<!DOCTYPE html>
<html lang="Es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Registrar Producto</title>
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
        <span>Productos</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Registrar</span>
    </nav>
    <div class="main-content">
        <!-- Formulario que envia los datos a ProductosController::registrar(). -->
        <div class="card" style="max-width:600px;">
            <div class="card-header"><h5 class="mb-0">Nuevo Producto</h5></div>
            <form method="POST" action="<?php echo BASE_URL; ?>/productos/registrar">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ej: Curichi de Maracuyá" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="2" placeholder="Descripción del producto..."></textarea>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label">Precio (S/)</label>
                            <input type="number" name="precio" class="form-control" step="0.01" min="0" placeholder="0.50" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Stock</label>
                            <input type="number" name="stock" class="form-control" min="0" placeholder="100" required>
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label class="form-label">Categoría</label>
                        <select name="categoria" class="form-select" required>
                            <option value="">Seleccionar...</option>
                            <option value="Curichi">Curichi</option>
                            <option value="Marciano">Marciano</option>
                            <option value="Paleta">Paleta</option>
                            <option value="Granizado">Granizado</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer d-flex gap-2">
                    <button type="submit" class="btn btn-warning">Guardar Producto</button>
                    <a href="<?php echo BASE_URL; ?>/productos" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="<?php echo BASE_URL; ?>/public/js/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
