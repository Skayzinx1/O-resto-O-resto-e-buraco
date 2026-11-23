<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="page-layout">
    <?php include __DIR__ . '/../layout/nav.php'; ?>

    <div class="content-panel">
        <div class="header-action">
            <h3>Produtos da Loja</h3>
            <a href="/Trabalho_Lp3/produtos/adicionar" class="btn btn-success btn-sm">+ Adicionar</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Produto</th>
                    <th>Valor</th>
                    <th>Categoria</th>
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
                                    <img src="/Trabalho_Lp3/uploads/produtos/<?= rawurlencode($linha['imagem']) ?>" alt="Imagem do produto" class="miniatura">
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($linha['produto']) ?></td>
                            <td>R$ <?= number_format($linha['valor'], 2, ',', '.') ?></td>
                            <td><?= htmlspecialchars($linha['categoria'] ?? '-') ?></td>
                            <td class="text-center">
                                <a href="/Trabalho_Lp3/produtos/editar?id=<?= $linha['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="/Trabalho_Lp3/produtos/excluir?id=<?= $linha['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Nenhum produto cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
