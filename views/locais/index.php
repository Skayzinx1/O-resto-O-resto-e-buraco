<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="page-layout">
    <?php include __DIR__ . '/../layout/nav.php'; ?>

    <div class="content-panel">
        <div class="header-action">
            <h3>Locais de Hawkins</h3>
            <a href="/Trabalho_Lp3/locais/adicionar" class="btn btn-success btn-sm">+ Adicionar</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Local</th>
                    <th>Tipo</th>
                    <th>Posição no mapa</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dados)): ?>
                    <?php foreach ($dados as $linha): ?>
                        <tr>
                            <td><?= $linha['id'] ?></td>
                            <td>
                                <?php if (!empty($linha['imagem'])): ?>
                                    <img src="/Trabalho_Lp3/uploads/locais/<?= rawurlencode($linha['imagem']) ?>" alt="Imagem do local" class="miniatura">
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($linha['nome']) ?></td>
                            <td><span class="selo selo-<?= $linha['tipo'] ?>"><?= htmlspecialchars($linha['tipo']) ?></span></td>
                            <td><?= $linha['pos_x'] ?>% x <?= $linha['pos_y'] ?>%</td>
                            <td class="text-center">
                                <a href="/Trabalho_Lp3/locais/editar?id=<?= $linha['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="/Trabalho_Lp3/locais/excluir?id=<?= $linha['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este local?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Nenhum local cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
