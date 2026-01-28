<div class="container py-5">
    <h1>Lista de Productos</h1>
    <a class="btn btn-outline-success mb-3" href="index.php?option=productos&action=nuevo">➕ Nuevo Producto</a>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['nombre']) ?></td>
                <td><?= number_format($p['precio'], 2) ?>€</td>
                <td>
                    <a href="index.php?option=productos&action=editar&id=<?= $p['id'] ?>">✏️</a>
                    <a href="index.php?option=productos&action=eliminar&id=<?= $p['id'] ?>" onclick="return confirm('¿Borrar?')">🗑️</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>