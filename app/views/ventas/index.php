<?php $pageTitle = 'Ventas'; require_once '../app/views/layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">💰 <span>Ventas</span></h1>
    <a href="<?= APP_URL ?>/ventas/create" class="btn btn-primary">+ Nueva venta</a>
</div>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">✅ <?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-error">⚠️ <?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<div class="card">
    <div class="table-wrap">
        <?php if (empty($ventas)): ?>
            <p style="text-align:center;color:var(--text-muted);padding:40px;">No hay ventas registradas aún.</p>
        <?php else: ?>
        <table>
            <thead>
                <tr><th>#</th><th>Cliente</th><th>Producto</th><th>Cantidad</th><th>Total</th><th>Estado</th><th>Fecha</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                <?php foreach ($ventas as $v): ?>
                <tr>
                    <td><?= $v->id ?></td>
                    <td><?= htmlspecialchars($v->cliente_nombre ?? '—') ?></td>
                    <td><?= htmlspecialchars($v->producto_nombre ?? '—') ?></td>
                    <td><?= $v->cantidad ?></td>
                    <td><strong style="color:var(--success)">S/ <?= number_format($v->total, 2) ?></strong></td>
                    <td>
                        <?php
                        $cls = match($v->estado) {
                            'completada' => 'badge-success',
                            'pendiente'  => 'badge-warning',
                            default      => 'badge-danger'
                        };
                        ?>
                        <span class="badge <?= $cls ?>"><?= ucfirst($v->estado) ?></span>
                    </td>
                    <td style="color:var(--text-muted);font-size:0.8rem;"><?= date('d/m/Y', strtotime($v->created_at)) ?></td>
                    <td style="display:flex;gap:6px;">
                        <a href="<?= APP_URL ?>/ventas/edit/<?= $v->id ?>" class="btn btn-sm btn-secondary">✏️ Editar</a>
                        <a href="<?= APP_URL ?>/ventas/delete/<?= $v->id ?>" class="btn btn-sm btn-danger btn-delete">🗑️</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
