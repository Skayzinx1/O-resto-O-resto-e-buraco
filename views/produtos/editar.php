<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="page-layout">
    <?php include __DIR__ . '/../layout/nav.php'; ?>

    <div class="content-panel">
        <div class="header-action">
            <h3>Editar Produto</h3>
        </div>

        <form action="/Trabalho_Lp3/produtos/editar?id=<?= $dado['id'] ?>" method="POST" enctype="multipart/form-data" class="card-form">
            <div class="form-group">
                <label for="produto">Produto:</label>
                <input type="text" id="produto" name="produto" value="<?= htmlspecialchars($dado['produto']) ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="valor">Valor (R$):</label>
                <input type="number" id="valor" name="valor" value="<?= htmlspecialchars($dado['valor']) ?>" step="0.01" min="0" required class="form-control">
            </div>

            <div class="form-group">
                <label for="id_categoria">Categoria:</label>
                <select id="id_categoria" name="id_categoria" class="form-select">
                    <option value="">Selecione uma categoria</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id'] ?>" <?= ($dado['id_categoria'] == $categoria['id']) ? 'selected' : '' ?>><?= htmlspecialchars($categoria['categoria']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" class="form-control" rows="3"><?= htmlspecialchars($dado['descricao'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="imagem">Imagem:</label>

                <?php if (!empty($dado['imagem'])): ?>
                    <div class="mb-2">
                        <img src="/Trabalho_Lp3/uploads/produtos/<?= htmlspecialchars($dado['imagem']) ?>" alt="Imagem atual" style="max-width: 150px; height: auto;">
                    </div>
                <?php endif; ?>

                <input type="file" id="imagem" name="imagem" class="form-control" accept="image/jpeg,image/png,image/gif,image/webp">
                <small class="text-muted">Selecione uma nova imagem somente se quiser trocar a atual.</small>
            </div>

            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-warning">Atualizar</button>
                <a href="/Trabalho_Lp3/produtos" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
