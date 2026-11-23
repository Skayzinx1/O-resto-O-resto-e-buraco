<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="caixa-login">
    <img src="/Trabalho_Lp3/views/img/distintivo.svg" alt="" class="login-logo">
    <h1 class="titulo-st glitch">Criar conta</h1>
    <p class="login-subtitulo">Vire um investigador de Hawkins</p>

    <?php if ($erro): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form action="/Trabalho_Lp3/cadastro" method="POST">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($nome) ?>" placeholder="Seu nome completo" required class="form-control">
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="Seu e-mail" required class="form-control">
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Mínimo de 8 caracteres" minlength="8" required class="form-control">
        </div>

        <div class="form-group">
            <label for="confirmar_senha">Confirmar senha</label>
            <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Digite a senha de novo" minlength="8" required class="form-control">
        </div>

        <button type="submit" class="btn btn-danger w-100 botao-login">Cadastrar</button>
    </form>

    <p class="login-rodape">Já tem uma conta? <a href="/Trabalho_Lp3/login">Fazer login</a></p>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
