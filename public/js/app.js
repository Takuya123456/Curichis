// Auto-dismiss alerts
document.addEventListener('DOMContentLoaded', function () {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(a => {
        setTimeout(() => {
            a.style.transition = 'opacity 0.5s';
            a.style.opacity = '0';
            setTimeout(() => a.remove(), 500);
        }, 3500);
    });

    // Confirm delete
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function (e) {
            if (!confirm('¿Estás seguro de eliminar este registro?')) {
                e.preventDefault();
            }
        });
    });

    // Auth tabs
    const tabs = document.querySelectorAll('.auth-tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            const target = this.dataset.target;
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            document.querySelectorAll('.auth-form').forEach(f => f.style.display = 'none');
            document.getElementById(target).style.display = 'block';
        });
    });

    // Ventas: auto-calc total
    const cantidadInput = document.getElementById('cantidad');
    const productoSelect = document.getElementById('producto_id');
    const totalInput = document.getElementById('total');

    if (cantidadInput && productoSelect && totalInput) {
        function calcTotal() {
            const selected = productoSelect.options[productoSelect.selectedIndex];
            const precio = parseFloat(selected?.dataset.precio || 0);
            const cantidad = parseInt(cantidadInput.value || 0);
            totalInput.value = (precio * cantidad).toFixed(2);
        }
        cantidadInput.addEventListener('input', calcTotal);
        productoSelect.addEventListener('change', calcTotal);
    }
});
