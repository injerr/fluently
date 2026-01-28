<div class="container-fluid">
    <div class="container p-5">
        <?php $titulo = isset($p) ? "Editar Producto" : "Nuevo Producto"; ?>
        <h2><?= $titulo ?></h2>
        <form action="index.php?option=productos&action=guardar" method="POST">
            <input type="hidden" name="id" value="<?= $p['id'] ?? '' ?>">

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Nombre: </label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="nombre" value="<?= htmlspecialchars($p['nombre'] ?? '') ?>" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Precio: </label>
                <div class="col-sm-10">
                    <input class="form-control" type="number" step="0.01" name="precio" value="<?= $p['precio'] ?? '' ?>" required>
                </div>
            </div>

            <?php if (isset($categorias)): ?>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Categorias: </label>
                <div class="col-sm-10">
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        <?php foreach ($categorias as $category): ?>
                            <input type="checkbox" class="btn-check" name="categorias[]" value="<?= $category['id'] ?? '' ?>" id="<?= $category['nombre'] ?? '' ?>" autocomplete="off">
                            <label class="btn btn-outline-primary" for="<?= $category['nombre'] ?? '' ?>"><?= $category['nombre'] ?? '' ?></label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php endif; ?>
            
            <button class="btn btn-success" type="submit">Guardar</button>
            <a class="btn btn-dark" href="index.php?option=productos">Cancelar</a>
        </form>
    </div>
</div>

