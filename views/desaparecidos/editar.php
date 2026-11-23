<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="page-layout">
    <?php include __DIR__ . '/../layout/nav.php'; ?>

    <div class="content-panel">
        <div class="header-action">
            <h3>Editar Desaparecido</h3>
        </div>

        <form action="/Trabalho_Lp3/desaparecidos/editar?id=<?= $dado['id'] ?>" method="POST" enctype="multipart/form-data" class="card-form">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($dado['nome']) ?>" required class="form-control">
            </div>

            <div class="row">
                <div class="col form-group">
                    <label for="idade">Idade:</label>
                    <input type="number" id="idade" name="idade" value="<?= htmlspecialchars($dado['idade'] ?? '') ?>" min="0" class="form-control">
                </div>
                <div class="col form-group">
                    <label for="data_desaparecimento">Data do desaparecimento:</label>
                    <input type="date" id="data_desaparecimento" name="data_desaparecimento" value="<?= htmlspecialchars($dado['data_desaparecimento'] ?? '') ?>" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="situacao">Situação:</label>
                <select id="situacao" name="situacao" class="form-select">
                    <?php foreach ($situacoes as $situacao): ?>
                        <option value="<?= $situacao ?>" <?= ($dado['situacao'] === $situacao) ? 'selected' : '' ?>><?= $situacao ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" class="form-control" rows="4"><?= htmlspecialchars($dado['descricao'] ?? '') ?></textarea>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label for="id_local">Local do desaparecimento:</label>
                    <select id="id_local" name="id_local" class="form-select">
                        <option value="">Selecione um local</option>
                        <?php foreach ($locais as $local): ?>
                            <option value="<?= $local['id'] ?>" <?= ($dado['id_local'] == $local['id']) ? 'selected' : '' ?>><?= htmlspecialchars($local['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col form-group">
                    <label for="id_monstro">Monstro suspeito:</label>
                    <select id="id_monstro" name="id_monstro" class="form-select">
                        <option value="">Nenhum / desconhecido</option>
                        <?php foreach ($monstros as $monstro): ?>
                            <option value="<?= $monstro['id'] ?>" <?= ($dado['id_monstro'] == $monstro['id']) ? 'selected' : '' ?>><?= htmlspecialchars($monstro['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="imagem">Foto:</label>

                <?php if (!empty($dado['imagem'])): ?>
                    <div class="mb-2">
                        <img src="/Trabalho_Lp3/uploads/desaparecidos/<?= htmlspecialchars($dado['imagem']) ?>" alt="Foto atual" style="max-width: 150px; height: auto;">
                    </div>
                <?php endif; ?>

                <input type="file" id="imagem" name="imagem" class="form-control" accept="image/jpeg,image/png,image/gif,image/webp">
                <small class="text-muted">Selecione uma nova foto somente se quiser trocar a atual.</small>
            </div>

            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-warning">Atualizar</button>
                <a href="/Trabalho_Lp3/desaparecidos" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
