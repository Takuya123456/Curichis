<?php $pageTitle = 'Clientes'; require_once '../app/views/layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">👥 <span>Clientes</span></h1>
    <a href="<?= APP_URL ?>/clientes/create" class="btn btn-primary">+ Nuevo cliente</a>
</div>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">✅ <?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-error">⚠️ <?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<div class="card">
    <div class="table-wrap">
        <?php if (empty($clientes)): ?>
            <p style="text-align:center;color:var(--text-muted);padding:40px;">No hay clientes registrados aún.</p>
        <?php else: ?>
        <table>
            <thead>
                <tr><th>#</th><th>Nombre</th><th>Email</th><th>Teléfono</th><th>Dirección</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $c): ?>
                <tr>
                    <td><?= $c->id ?></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:8px;">
                            <div class="avatar" style="width:32px;height:32px;font-size:0.8rem;">
                                <?= strtoupper(substr($c->nombre, 0, 1)) ?>
                            </div>
                            <strong><?= htmlspecialchars($c->nombre) ?></strong>
                        </div>
                    </td>
                    <td><?= htmlspecialchars($c->email) ?></td>
                    <td><?= htmlspecialchars($c->telefono) ?></td>
                    <td><?= htmlspecialchars($c->direccion) ?></td>
                    <td style="display:flex;gap:6px;">
                        <a href="<?= APP_URL ?>/clientes/edit/<?= $c->id ?>" class="btn btn-sm btn-secondary">✏️ Editar</a>
                        <a href="<?= APP_URL ?>/clientes/delete/<?= $c->id ?>" class="btn btn-sm btn-danger btn-delete">🗑️</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
