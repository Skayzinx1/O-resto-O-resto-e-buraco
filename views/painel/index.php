<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="page-layout">
    <?php include __DIR__ . '/../layout/nav.php'; ?>

    <div class="content-panel">
        <div class="header-action">
            <h3>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario']['nome']) ?></h3>
        </div>

        <p class="texto-maquina">&gt; Tudo o que você cadastrar aqui aparece automaticamente no site.</p>

        <div class="resumo">
            <a href="/Trabalho_Lp3/locais"><strong><?= $totais['locais'] ?></strong>Locais</a>
            <a href="/Trabalho_Lp3/monstros"><strong><?= $totais['monstros'] ?></strong>Monstros</a>
            <a href="/Trabalho_Lp3/personagens"><strong><?= $totais['personagens'] ?></strong>Personagens</a>
            <a href="/Trabalho_Lp3/desaparecidos"><strong><?= $totais['desaparecidos'] ?></strong>Desaparecidos</a>
            <a href="/Trabalho_Lp3/categorias"><strong><?= $totais['categorias'] ?></strong>Categorias</a>
            <a href="/Trabalho_Lp3/produtos"><strong><?= $totais['produtos'] ?></strong>Produtos</a>
            <a href="/Trabalho_Lp3/usuarios"><strong><?= $totais['usuarios'] ?></strong>Usuários</a>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
