<?php $pageTitle = 'Productos'; require_once '../app/views/layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">📦 <span>Productos</span></h1>
    <a href="<?= APP_URL ?>/productos/create" class="btn btn-primary">+ Nuevo producto</a>
</div>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">✅ <?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-error">⚠️ <?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<div class="card">
    <div class="table-wrap">
        <?php if (empty($productos)): ?>
            <p style="text-align:center;color:var(--text-muted);padding:40px;">No hay productos registrados aún.</p>
        <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?= $p->id ?></td>
                    <td>
                        <strong><?= htmlspecialchars($p->nombre) ?></strong>
                        <?php if ($p->descripcion): ?>
                            <br><small style="color:var(--text-muted)"><?= htmlspecialchars(substr($p->descripcion, 0, 50)) ?>...</small>
                        <?php endif; ?>
                    </td>
                    <td><span class="badge badge-warning"><?= htmlspecialchars($p->categoria) ?></span></td>
                    <td><strong style="color:var(--success)">S/ <?= number_format($p->precio, 2) ?></strong></td>
                    <td>
                        <span class="badge <?= $p->stock > 10 ? 'badge-success' : 'badge-danger' ?>">
                            <?= $p->stock ?> uds
                        </span>
                    </td>
                    <td style="display:flex;gap:6px;">
                        <a href="<?= APP_URL ?>/productos/edit/<?= $p->id ?>" class="btn btn-sm btn-secondary">✏️ Editar</a>
                        <a href="<?= APP_URL ?>/productos/delete/<?= $p->id ?>" class="btn btn-sm btn-danger btn-delete">🗑️</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
