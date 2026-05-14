<?php $pageTitle = 'Nueva Venta'; require_once '../app/views/layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">💰 Nueva <span>Venta</span></h1>
    <a href="<?= APP_URL ?>/ventas" class="btn btn-outline">← Volver</a>
</div>

<div class="card" style="max-width:620px;">
    <form action="<?= APP_URL ?>/ventas/store" method="POST">
        <div class="form-group">
            <label>Cliente *</label>
            <select name="cliente_id" class="form-control" required>
                <option value="">— Seleccionar cliente —</option>
                <?php foreach ($clientes as $c): ?>
                    <option value="<?= $c->id ?>"><?= htmlspecialchars($c->nombre) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Producto *</label>
            <select name="producto_id" id="producto_id" class="form-control" required>
                <option value="">— Seleccionar producto —</option>
                <?php foreach ($productos as $p): ?>
                    <option value="<?= $p->id ?>" data-precio="<?= $p->precio ?>">
                        <?= htmlspecialchars($p->nombre) ?> — S/ <?= number_format($p->precio, 2) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div class="form-group">
                <label>Cantidad *</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" value="1" required>
            </div>
            <div class="form-group">
                <label>Total (S/) *</label>
                <input type="number" name="total" id="total" class="form-control" step="0.01" min="0" placeholder="0.00" required>
            </div>
        </div>
        <div class="form-group">
            <label>Estado</label>
            <select name="estado" class="form-control">
                <option value="completada">✅ Completada</option>
                <option value="pendiente">⏳ Pendiente</option>
                <option value="cancelada">❌ Cancelada</option>
            </select>
        </div>
        <div class="form-group">
            <label>Notas</label>
            <textarea name="notas" class="form-control" rows="2" placeholder="Observaciones adicionales..."></textarea>
        </div>
        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary">💾 Registrar venta</button>
            <a href="<?= APP_URL ?>/ventas" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
