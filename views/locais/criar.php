<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="page-layout">
    <?php include __DIR__ . '/../layout/nav.php'; ?>

    <div class="content-panel">
        <div class="header-action">
            <h3>Cadastrar Local</h3>
        </div>

        <form action="/Trabalho_Lp3/locais/adicionar" method="POST" enctype="multipart/form-data" class="card-form">
            <div class="form-group">
                <label for="nome">Nome do local:</label>
                <input type="text" id="nome" name="nome" required class="form-control">
            </div>

            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo" class="form-select">
                    <?php foreach ($tipos as $tipo): ?>
                        <option value="<?= $tipo ?>"><?= ucfirst($tipo) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" class="form-control" rows="3"></textarea>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label for="pos_x">Posição horizontal no mapa (0 a 100%):</label>
                    <input type="number" id="pos_x" name="pos_x" value="50" min="0" max="100" required class="form-control">
                </div>
                <div class="col form-group">
                    <label for="pos_y">Posição vertical no mapa (0 a 100%):</label>
                    <input type="number" id="pos_y" name="pos_y" value="50" min="0" max="100" required class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="imagem">Imagem:</label>
                <input type="file" id="imagem" name="imagem" class="form-control" accept="image/jpeg,image/png,image/gif,image/webp">
            </div>

            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="/Trabalho_Lp3/locais" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
