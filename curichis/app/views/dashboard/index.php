<?php $pageTitle = 'Dashboard'; require_once '../app/views/layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Panel de <span>Control</span></h1>
    <span style="color:var(--text-muted);font-size:0.9rem;">👋 Hola, <?= htmlspecialchars($_SESSION['user_name']) ?>!</span>
</div>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">✅ <?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>

<!-- Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon pink">💰</div>
        <div>
            <div class="stat-value"><?= $totalVentas ?></div>
            <div class="stat-label">Ventas totales</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon yellow">📦</div>
        <div>
            <div class="stat-value"><?= $totalProductos ?></div>
            <div class="stat-label">Productos</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">👥</div>
        <div>
            <div class="stat-value"><?= $totalClientes ?></div>
            <div class="stat-label">Clientes</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">💵</div>
        <div>
            <div class="stat-value">S/ <?= number_format($ingresos, 2) ?></div>
            <div class="stat-label">Ingresos totales</div>
        </div>
    </div>
</div>

<!-- Accesos rápidos -->
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;margin-bottom:24px;">
    <div class="card" style="border-top:3px solid var(--primary);">
        <div class="card-header">
            <span class="card-title">💰 Ventas recientes</span>
            <a href="<?= APP_URL ?>/ventas" class="btn btn-sm btn-outline">Ver todas</a>
        </div>
        <?php if (empty($ventasRecientes)): ?>
            <p style="color:var(--text-muted);text-align:center;padding:20px;">Sin ventas aún</p>
        <?php else: ?>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Cliente</th><th>Producto</th><th>Total</th><th>Estado</th></tr></thead>
                    <tbody>
                        <?php foreach ($ventasRecientes as $v): ?>
                        <tr>
                            <td><?= htmlspecialchars($v->cliente_nombre ?? '—') ?></td>
                            <td><?= htmlspecialchars($v->producto_nombre ?? '—') ?></td>
                            <td>S/ <?= number_format($v->total, 2) ?></td>
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
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <div class="card" style="border-top:3px solid var(--secondary);">
        <div class="card-header">
            <span class="card-title">⚡ Accesos rápidos</span>
        </div>
        <div style="display:flex;flex-direction:column;gap:10px;">
            <a href="<?= APP_URL ?>/ventas/create" class="btn btn-primary">💰 Nueva venta</a>
            <a href="<?= APP_URL ?>/productos/create" class="btn btn-secondary">📦 Nuevo producto</a>
            <a href="<?= APP_URL ?>/clientes/create" class="btn btn-success">👥 Nuevo cliente</a>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
