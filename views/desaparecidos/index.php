<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="page-layout">
    <?php include __DIR__ . '/../layout/nav.php'; ?>

    <div class="content-panel">
        <div class="header-action">
            <h3>Desaparecidos</h3>
            <a href="/Trabalho_Lp3/desaparecidos/adicionar" class="btn btn-success btn-sm">+ Adicionar</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Data</th>
                    <th>Situação</th>
                    <th>Local</th>
                    <th>Monstro suspeito</th>
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
                                    <img src="/Trabalho_Lp3/uploads/desaparecidos/<?= rawurlencode($linha['imagem']) ?>" alt="Foto" class="miniatura">
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($linha['nome']) ?><?= $linha['idade'] ? ', ' . $linha['idade'] . ' anos' : '' ?></td>
                            <td><?= $linha['data_desaparecimento'] ? date('d/m/Y', strtotime($linha['data_desaparecimento'])) : '-' ?></td>
                            <td><?= htmlspecialchars($linha['situacao']) ?></td>
                            <td><?= htmlspecialchars($linha['local'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($linha['monstro'] ?? '-') ?></td>
                            <td class="text-center">
                                <a href="/Trabalho_Lp3/desaparecidos/editar?id=<?= $linha['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="/Trabalho_Lp3/desaparecidos/excluir?id=<?= $linha['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este registro?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center;">Nenhum desaparecido cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
