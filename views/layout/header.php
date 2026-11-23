<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'Início') ?> | Stranger Things</title>
    <link rel="icon" href="/Trabalho_Lp3/views/img/distintivo.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&family=Oswald:wght@400;600&family=Special+Elite&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Trabalho_Lp3/views/css/style.css">
</head>

<body class="<?= $classeBody ?? '' ?>">
    <header class="main-header">
        <div class="container">
            <a href="/Trabalho_Lp3/" class="logo">
                <img src="/Trabalho_Lp3/views/img/distintivo.svg" alt="">
                <span>Stranger Things</span>
            </a>

            <?php if (isset($_SESSION['usuario'])): ?>
                <?php $primeiroNome = explode(' ', $_SESSION['usuario']['nome'])[0]; ?>

                <nav class="menu-site">
                    <a href="/Trabalho_Lp3/">Início</a>
                    <a href="/Trabalho_Lp3/submundo">Mundo Invertido</a>
                    <a href="/Trabalho_Lp3/mapa">Mapa</a>
                    <a href="/Trabalho_Lp3/loja">Loja</a>
                    <a href="/Trabalho_Lp3/sobre">Sobre</a>
                </nav>

                <nav class="menu-usuario">
                    <span class="nome-usuario">Olá, <?= htmlspecialchars($primeiroNome) ?></span>
                    <a href="/Trabalho_Lp3/painel" class="btn btn-outline-danger btn-sm">Painel</a>
                    <a href="/Trabalho_Lp3/sair">Sair</a>
                </nav>
            <?php endif; ?>
        </div>
    </header>
    <main class="container">
