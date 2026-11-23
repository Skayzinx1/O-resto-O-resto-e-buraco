<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="page-layout">
    <?php include __DIR__ . '/../layout/nav.php'; ?>

    <div class="content-panel">
        <div class="header-action">
            <h3>Editar Local</h3>
        </div>

        <form action="/Trabalho_Lp3/locais/editar?id=<?= $dado['id'] ?>" method="POST" enctype="multipart/form-data" class="card-form">
            <div class="form-group">
                <label for="nome">Nome do local:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($dado['nome']) ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo" class="form-select">
                    <?php foreach ($tipos as $tipo): ?>
                        <option value="<?= $tipo ?>" <?= ($dado['tipo'] === $tipo) ? 'selected' : '' ?>><?= ucfirst($tipo) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" class="form-control" rows="3"><?= htmlspecialchars($dado['descricao'] ?? '') ?></textarea>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label for="pos_x">Posição horizontal no mapa (0 a 100%):</label>
                    <input type="number" id="pos_x" name="pos_x" value="<?= $dado['pos_x'] ?>" min="0" max="100" required class="form-control">
                </div>
                <div class="col form-group">
                    <label for="pos_y">Posição vertical no mapa (0 a 100%):</label>
                    <input type="number" id="pos_y" name="pos_y" value="<?= $dado['pos_y'] ?>" min="0" max="100" required class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="imagem">Imagem:</label>

                <?php if (!empty($dado['imagem'])): ?>
                    <div class="mb-2">
                        <img src="/Trabalho_Lp3/uploads/locais/<?= htmlspecialchars($dado['imagem']) ?>" alt="Imagem atual" style="max-width: 150px; height: auto;">
                    </div>
                <?php endif; ?>

                <input type="file" id="imagem" name="imagem" class="form-control" accept="image/jpeg,image/png,image/gif,image/webp">
                <small class="text-muted">Selecione uma nova imagem somente se quiser trocar a atual.</small>
            </div>

            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-warning">Atualizar</button>
                <a href="/Trabalho_Lp3/locais" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
