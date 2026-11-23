<?php include __DIR__ . '/layout/header.php'; ?>

<section class="banner">
    <img src="/Trabalho_Lp3/views/img/banner-hawkins.jpg" alt="Bem-vindo a Hawkins">
    <div class="banner-acoes">
        <a href="/Trabalho_Lp3/submundo" class="btn btn-danger">Entrar no Mundo Invertido →</a>
        <a href="/Trabalho_Lp3/mapa" class="btn btn-outline-light">Explorar o mapa</a>
    </div>
</section>

<p class="texto-maquina text-center mt-4">
    &gt; Hawkins, Indiana. Pessoas estão desaparecendo e criaturas foram vistas na floresta.<br>
    &gt; Este portal reúne tudo o que os investigadores descobriram até agora.
</p>

<section class="secao">
    <div class="header-action">
        <h2 class="titulo-st glitch">Ameaças</h2>
        <a href="/Trabalho_Lp3/submundo">Ver todos →</a>
    </div>
    <div class="grade">
        <?php $contador = 0; ?>
        <?php foreach ($monstros as $monstro): ?>
            <?php
            $contador++;
            if ($contador > 3) {
                break;
            }
            ?>
            <article class="card-st">
                <img src="<?= !empty($monstro['imagem']) ? '/Trabalho_Lp3/uploads/monstros/' . rawurlencode($monstro['imagem']) : '/Trabalho_Lp3/views/img/criatura.svg' ?>" alt="<?= htmlspecialchars($monstro['nome']) ?>">
                <div class="corpo">
                    <h4><?= htmlspecialchars($monstro['nome']) ?></h4>
                    <p class="perigo">Perigo: <?= str_repeat('■', $monstro['perigo']) ?></p>
                    <p>Visto em: <?= htmlspecialchars($monstro['local'] ?? 'local desconhecido') ?></p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="secao">
    <h2 class="titulo-st">Desaparecidos</h2>
    <div class="grade">
        <?php foreach ($desaparecidos as $pessoa): ?>
            <article class="card-st">
                <img src="<?= !empty($pessoa['imagem']) ? '/Trabalho_Lp3/uploads/desaparecidos/' . rawurlencode($pessoa['imagem']) : '/Trabalho_Lp3/views/img/silhueta.svg' ?>" alt="<?= htmlspecialchars($pessoa['nome']) ?>">
                <div class="corpo">
                    <h4><?= htmlspecialchars($pessoa['nome']) ?></h4>
                    <p><span class="selo selo-<?= $pessoa['situacao'] === 'Encontrado' ? 'seguro' : 'perigo' ?>"><?= htmlspecialchars($pessoa['situacao']) ?></span></p>
                    <p>Sumiu em <?= $pessoa['data_desaparecimento'] ? date('d/m/Y', strtotime($pessoa['data_desaparecimento'])) : '?' ?><?= $pessoa['local'] ? ' – ' . htmlspecialchars($pessoa['local']) : '' ?></p>
                    <?php if ($pessoa['monstro']): ?>
                        <p>Suspeito: <strong><?= htmlspecialchars($pessoa['monstro']) ?></strong></p>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
    <?php if (empty($desaparecidos)): ?><p class="text-muted">Nenhum desaparecimento registrado.</p><?php endif; ?>
</section>

<section class="secao">
    <h2 class="titulo-st">Moradores de Hawkins</h2>
    <div class="grade">
        <?php foreach ($personagens as $personagem): ?>
            <article class="card-st">
                <img src="<?= !empty($personagem['imagem']) ? '/Trabalho_Lp3/uploads/personagens/' . rawurlencode($personagem['imagem']) : '/Trabalho_Lp3/views/img/silhueta.svg' ?>" alt="<?= htmlspecialchars($personagem['nome']) ?>">
                <div class="corpo">
                    <h4><?= htmlspecialchars($personagem['nome']) ?></h4>
                    <p><?= htmlspecialchars($personagem['descricao'] ?? '') ?></p>
                    <p><small><?= $personagem['idade'] ? $personagem['idade'] . ' anos · ' : '' ?><?= htmlspecialchars($personagem['local'] ?? '') ?></small></p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php include __DIR__ . '/layout/footer.php'; ?>
