<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="text-center mb-4">
    <h1 class="titulo-st">Mapa de Hawkins</h1>
    <p class="texto-maquina">&gt; Clique em um ponto para ver o que acontece em cada lugar.</p>
    <p>
        <span class="selo selo-seguro">Seguro</span>
        <span class="selo selo-alerta">Alerta</span>
        <span class="selo selo-perigo">Perigo</span>
    </p>
</div>

<div class="mapa">
    <?php foreach ($locais as $local): ?>
        <a href="#local-<?= $local['id'] ?>" class="pino <?= $local['tipo'] ?>" style="left: <?= (int) $local['pos_x'] ?>%; top: <?= (int) $local['pos_y'] ?>%;">
            <span><?= htmlspecialchars($local['nome']) ?></span>
        </a>
    <?php endforeach; ?>
</div>

<?php foreach ($locais as $local): ?>
    <?php
    $monstrosAqui = [];
    foreach ($monstros as $m) {
        if ($m['id_local'] == $local['id']) {
            $monstrosAqui[] = $m;
        }
    }

    $personagensAqui = [];
    foreach ($personagens as $p) {
        if ($p['id_local'] == $local['id']) {
            $personagensAqui[] = $p;
        }
    }

    $desaparecidosAqui = [];
    foreach ($desaparecidos as $d) {
        if ($d['id_local'] == $local['id']) {
            $desaparecidosAqui[] = $d;
        }
    }
    ?>
    <section id="local-<?= $local['id'] ?>" class="local-info content-panel mt-4">
        <div class="row">
            <?php if (!empty($local['imagem'])): ?>
                <div class="col-md-4 mb-3">
                    <img src="/Trabalho_Lp3/uploads/locais/<?= rawurlencode($local['imagem']) ?>" alt="<?= htmlspecialchars($local['nome']) ?>" class="img-fluid rounded">
                </div>
            <?php endif; ?>
            <div class="col">
                <h3 class="text-danger"><?= htmlspecialchars($local['nome']) ?> <span class="selo selo-<?= $local['tipo'] ?>"><?= $local['tipo'] ?></span></h3>
                <p><?= nl2br(htmlspecialchars($local['descricao'] ?? '')) ?></p>

                <div class="row">
                    <div class="col-md-4">
                        <h5>Monstros vistos</h5>
                        <?php foreach ($monstrosAqui as $m): ?><p>• <?= htmlspecialchars($m['nome']) ?></p><?php endforeach; ?>
                        <?php if (!$monstrosAqui): ?><p class="text-muted">Nenhum</p><?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <h5>Quem vive aqui</h5>
                        <?php foreach ($personagensAqui as $p): ?><p>• <?= htmlspecialchars($p['nome']) ?></p><?php endforeach; ?>
                        <?php if (!$personagensAqui): ?><p class="text-muted">Ninguém</p><?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <h5>Desaparecimentos</h5>
                        <?php foreach ($desaparecidosAqui as $d): ?><p>• <?= htmlspecialchars($d['nome']) ?></p><?php endforeach; ?>
                        <?php if (!$desaparecidosAqui): ?><p class="text-muted">Nenhum</p><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endforeach; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>
