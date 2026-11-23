<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="page-layout">
    <?php include __DIR__ . '/../layout/nav.php'; ?>

    <div class="content-panel">
        <div class="header-action">
            <h3>Editar Usuário</h3>
        </div>

        <?php if ($erro): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form action="/Trabalho_Lp3/usuarios/editar?id=<?= $usuario['id'] ?>" method="POST" class="card-form">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="senha">Nova senha:</label>
                <input type="password" id="senha" name="senha" minlength="4" class="form-control">
                <small class="text-muted">Deixe em branco para manter a senha atual.</small>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo de usuário:</label>
                <?php if ($usuario['id'] == $_SESSION['usuario']['id']): ?>
                    <input type="hidden" name="tipo" value="admin">
                    <input type="text" value="Administrador (você não pode tirar o seu próprio acesso)" class="form-control" disabled>
                <?php else: ?>
                    <select id="tipo" name="tipo" class="form-select">
                        <option value="investigador" <?= $usuario['tipo'] == 'investigador' ? 'selected' : '' ?>>Investigador (só vê o site)</option>
                        <option value="admin" <?= $usuario['tipo'] == 'admin' ? 'selected' : '' ?>>Administrador (acessa o painel)</option>
                    </select>
                <?php endif; ?>
            </div>

            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-warning">Atualizar</button>
                <a href="/Trabalho_Lp3/usuarios" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
