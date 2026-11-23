<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="text-center mb-4">
    <h1 class="titulo-st">Loja Starcourt</h1>
    <p class="texto-maquina">&gt; Os produtos mais famosos do shopping de Hawkins, direto de 1985.</p>
</div>

<?php foreach ($categorias as $categoria): ?>
    <?php
    $produtosDaCategoria = [];
    foreach ($produtos as $p) {
        if ($p['id_categoria'] == $categoria['id']) {
            $produtosDaCategoria[] = $p;
        }
    }

    if (empty($produtosDaCategoria)) {
        continue;
    }
    ?>
    <section class="secao">
        <h2 class="titulo-st"><?= htmlspecialchars($categoria['categoria']) ?></h2>
        <?php if ($categoria['descricao']): ?><p class="text-muted"><?= htmlspecialchars($categoria['descricao']) ?></p><?php endif; ?>

        <div class="grade">
            <?php foreach ($produtosDaCategoria as $produto): ?>
                <article class="card-st">
                    <img src="<?= !empty($produto['imagem']) ? '/Trabalho_Lp3/uploads/produtos/' . rawurlencode($produto['imagem']) : '/Trabalho_Lp3/views/img/sem-imagem.svg' ?>" alt="<?= htmlspecialchars($produto['produto']) ?>">
                    <div class="corpo">
                        <h4><?= htmlspecialchars($produto['produto']) ?></h4>
                        <p><?= htmlspecialchars($produto['descricao'] ?? '') ?></p>
                        <p class="preco">R$ <?= number_format($produto['valor'], 2, ',', '.') ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
<?php endforeach; ?>

<?php if (empty($produtos)): ?>
    <p class="text-center text-muted">A loja está fechada. Nenhum produto cadastrado.</p>
<?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>
