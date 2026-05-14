<?php $pageTitle = 'Nuevo Cliente'; require_once '../app/views/layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">👥 Nuevo <span>Cliente</span></h1>
    <a href="<?= APP_URL ?>/clientes" class="btn btn-outline">← Volver</a>
</div>

<div class="card" style="max-width:600px;">
    <form action="<?= APP_URL ?>/clientes/store" method="POST">
        <div class="form-group">
            <label>Nombre completo *</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre del cliente" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="correo@ejemplo.com">
        </div>
        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control" placeholder="999 999 999">
        </div>
        <div class="form-group">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" placeholder="Av. Principal 123">
        </div>
        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary">💾 Guardar cliente</button>
            <a href="<?= APP_URL ?>/clientes" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
