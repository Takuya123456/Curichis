<?php $pageTitle = 'Editar Cliente'; require_once '../app/views/layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">✏️ Editar <span>Cliente</span></h1>
    <a href="<?= APP_URL ?>/clientes" class="btn btn-outline">← Volver</a>
</div>

<div class="card" style="max-width:600px;">
    <form action="<?= APP_URL ?>/clientes/update/<?= $cliente->id ?>" method="POST">
        <div class="form-group">
            <label>Nombre completo *</label>
            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($cliente->nombre) ?>" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($cliente->email) ?>">
        </div>
        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="<?= htmlspecialchars($cliente->telefono) ?>">
        </div>
        <div class="form-group">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" value="<?= htmlspecialchars($cliente->direccion) ?>">
        </div>
        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary">💾 Actualizar</button>
            <a href="<?= APP_URL ?>/clientes" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
