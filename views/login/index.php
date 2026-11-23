<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="caixa-login">
    <img src="/Trabalho_Lp3/views/img/distintivo.svg" alt="" class="login-logo">
    <h1 class="titulo-st glitch">Bem-vindo de volta</h1>
    <p class="login-subtitulo">Entre com sua conta para continuar</p>

    <?php if ($sucesso): ?>
        <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
    <?php endif; ?>

    <?php if ($erro): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form action="/Trabalho_Lp3/login" method="POST">
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="Seu e-mail" required class="form-control">
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Sua senha" required class="form-control">
        </div>

        <button type="submit" class="btn btn-danger w-100 botao-login">Entrar</button>
    </form>

    <p class="login-rodape">Não tem uma conta? <a href="/Trabalho_Lp3/cadastro">Cadastre-se</a></p>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
