<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="page-layout">
    <?php include __DIR__ . '/../layout/nav.php'; ?>

    <div class="content-panel">
        <div class="header-action">
            <h3>Cadastrar Monstro</h3>
        </div>

        <form action="/Trabalho_Lp3/monstros/adicionar" method="POST" enctype="multipart/form-data" class="card-form">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required class="form-control">
            </div>

            <div class="form-group">
                <label for="perigo">Nível de perigo:</label>
                <select id="perigo" name="perigo" class="form-select">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <option value="<?= $i ?>" <?= $i === 3 ? 'selected' : '' ?>><?= $i ?> <?= str_repeat('■', $i) ?></option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" class="form-control" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="fraqueza">Fraqueza:</label>
                <input type="text" id="fraqueza" name="fraqueza" class="form-control">
            </div>

            <div class="form-group">
                <label for="id_local">Onde aparece:</label>
                <select id="id_local" name="id_local" class="form-select">
                    <option value="">Selecione um local</option>
                    <?php foreach ($locais as $local): ?>
                        <option value="<?= $local['id'] ?>"><?= htmlspecialchars($local['nome']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="imagem">Imagem:</label>
                <input type="file" id="imagem" name="imagem" class="form-control" accept="image/jpeg,image/png,image/gif,image/webp">
            </div>

            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="/Trabalho_Lp3/monstros" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
