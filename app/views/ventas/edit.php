<?php $pageTitle = 'Editar Venta'; require_once '../app/views/layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">✏️ Editar <span>Venta</span></h1>
    <a href="<?= APP_URL ?>/ventas" class="btn btn-outline">← Volver</a>
</div>

<div class="card" style="max-width:620px;">
    <form action="<?= APP_URL ?>/ventas/update/<?= $venta->id ?>" method="POST">
        <div class="form-group">
            <label>Cliente *</label>
            <select name="cliente_id" class="form-control" required>
                <?php foreach ($clientes as $c): ?>
                    <option value="<?= $c->id ?>" <?= $c->id == $venta->cliente_id ? 'selected' : '' ?>>
                        <?= htmlspecialchars($c->nombre) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Producto *</label>
            <select name="producto_id" id="producto_id" class="form-control" required>
                <?php foreach ($productos as $p): ?>
                    <option value="<?= $p->id ?>" data-precio="<?= $p->precio ?>" <?= $p->id == $venta->producto_id ? 'selected' : '' ?>>
                        <?= htmlspecialchars($p->nombre) ?> — S/ <?= number_format($p->precio, 2) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div class="form-group">
                <label>Cantidad *</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" value="<?= $venta->cantidad ?>" required>
            </div>
            <div class="form-group">
                <label>Total (S/) *</label>
                <input type="number" name="total" id="total" class="form-control" step="0.01" min="0" value="<?= $venta->total ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label>Estado</label>
            <select name="estado" class="form-control">
                <option value="completada" <?= $venta->estado === 'completada' ? 'selected' : '' ?>>✅ Completada</option>
                <option value="pendiente"  <?= $venta->estado === 'pendiente'  ? 'selected' : '' ?>>⏳ Pendiente</option>
                <option value="cancelada"  <?= $venta->estado === 'cancelada'  ? 'selected' : '' ?>>❌ Cancelada</option>
            </select>
        </div>
        <div class="form-group">
            <label>Notas</label>
            <textarea name="notas" class="form-control" rows="2"><?= htmlspecialchars($venta->notas ?? '') ?></textarea>
        </div>
        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary">💾 Actualizar</button>
            <a href="<?= APP_URL ?>/ventas" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
