<?php $pageTitle = 'Nuevo Producto'; require_once '../app/views/layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">📦 Nuevo <span>Producto</span></h1>
    <a href="<?= APP_URL ?>/productos" class="btn btn-outline">← Volver</a>
</div>

<div class="card" style="max-width:600px;">
    <form action="<?= APP_URL ?>/productos/store" method="POST">
        <div class="form-group">
            <label>Nombre del producto *</label>
            <input type="text" name="nombre" class="form-control" placeholder="Ej: Camiseta anime" required>
        </div>
        <div class="form-group">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3" placeholder="Descripción del producto..."></textarea>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div class="form-group">
                <label>Precio (S/) *</label>
                <input type="number" name="precio" class="form-control" step="0.01" min="0" placeholder="0.00" required>
            </div>
            <div class="form-group">
                <label>Stock *</label>
                <input type="number" name="stock" class="form-control" min="0" placeholder="0" required>
            </div>
        </div>
        <div class="form-group">
            <label>Categoría *</label>
            <input type="text" name="categoria" class="form-control" placeholder="Ej: Ropa, Electrónica, Comida..." required>
        </div>
        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary">💾 Guardar producto</button>
            <a href="<?= APP_URL ?>/productos" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
