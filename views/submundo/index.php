<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="esporos"></div>

<section class="portal" id="portal">
    <h1 class="titulo-st glitch display-4">O Mundo Invertido</h1>
    <p class="texto-maquina">
        &gt; Uma versão escura e podre de Hawkins, presa no tempo.<br>
        &gt; O ar é tóxico, o céu é vermelho e as criaturas caçam no escuro.<br>
        &gt; Você tem certeza que quer atravessar?
    </p>
    <button type="button" class="botao-portal" onclick="entrarNoPortal()">Entrar no portal</button>
</section>

<section class="mundo-invertido" id="mundo-invertido">
    <div class="text-center mb-4">
        <h1 class="titulo-st glitch display-5">Criaturas do Mundo Invertido</h1>
        <p class="texto-maquina">&gt; Registro oficial dos investigadores de Hawkins. Ordenado pelo nível de perigo.</p>
    </div>

    <?php foreach ($monstros as $monstro): ?>
        <article class="monstro">
            <?php if (!empty($monstro['imagem'])): ?>
                <img src="/Trabalho_Lp3/uploads/monstros/<?= $monstro['imagem'] ?>" alt="<?= htmlspecialchars($monstro['nome']) ?>">
            <?php else: ?>
                <img src="/Trabalho_Lp3/views/img/criatura.svg" alt="Sem imagem">
            <?php endif; ?>

            <div class="corpo">
                <h3><?= htmlspecialchars($monstro['nome']) ?></h3>
                <p class="perigo">Perigo: <?= str_repeat('■', $monstro['perigo']) ?></p>
                <p><?= htmlspecialchars($monstro['descricao'] ?? '') ?></p>
                <p><strong>Fraqueza:</strong> <?= htmlspecialchars($monstro['fraqueza'] ?? 'desconhecida') ?></p>
                <p><strong>Visto em:</strong> <?= htmlspecialchars($monstro['local'] ?? 'local desconhecido') ?></p>

                <?php
                $vitimas = '';
                foreach ($desaparecidos as $pessoa) {
                    if ($pessoa['id_monstro'] == $monstro['id']) {
                        $vitimas .= $pessoa['nome'] . '. ';
                    }
                }
                ?>
                <?php if ($vitimas != ''): ?>
                    <p class="vitimas"><strong>Ligado ao sumiço de:</strong> <?= htmlspecialchars($vitimas) ?></p>
                <?php endif; ?>
            </div>
        </article>
    <?php endforeach; ?>

    <?php if (empty($monstros)): ?>
        <p class="text-center text-muted">Nenhuma criatura registrada... ainda.</p>
    <?php endif; ?>

    <p class="text-center mt-4"><a href="/Trabalho_Lp3/submundo" class="btn btn-outline-danger">Voltar para Hawkins</a></p>
</section>

<script>
    function entrarNoPortal() {
        document.getElementById('portal').style.display = 'none';
        document.getElementById('mundo-invertido').classList.add('aberto');
    }
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>
