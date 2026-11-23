<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

spl_autoload_register(function ($class_name) {
    if (file_exists(__DIR__ . '/controllers/' . $class_name . '.php')) {
        require_once __DIR__ . '/controllers/' . $class_name . '.php';
    } elseif (file_exists(__DIR__ . '/models/' . $class_name . '.php')) {
        require_once __DIR__ . '/models/' . $class_name . '.php';
    }
});

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$basePath = '/Trabalho_Lp3';
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

if (empty($uri)) {
    $uri = '/';
}

$rotas = [
    '/'           => ['controller' => 'HomeController', 'metodo' => 'index'],
    '/sobre'      => ['controller' => 'HomeController', 'metodo' => 'sobre'],
    '/submundo'   => ['controller' => 'HomeController', 'metodo' => 'submundo'],
    '/mapa'       => ['controller' => 'HomeController', 'metodo' => 'mapa'],
    '/loja'       => ['controller' => 'HomeController', 'metodo' => 'loja'],

    '/login'      => ['controller' => 'LoginController', 'metodo' => 'index'],
    '/cadastro'   => ['controller' => 'LoginController', 'metodo' => 'cadastro'],
    '/sair'       => ['controller' => 'LoginController', 'metodo' => 'sair'],

    '/painel'     => ['controller' => 'PainelController', 'metodo' => 'index'],

    '/usuarios'           => ['controller' => 'UsuarioController', 'metodo' => 'index'],
    '/usuarios/adicionar' => ['controller' => 'UsuarioController', 'metodo' => 'adicionar'],
    '/usuarios/editar'    => ['controller' => 'UsuarioController', 'metodo' => 'editar'],
    '/usuarios/excluir'   => ['controller' => 'UsuarioController', 'metodo' => 'excluir'],

    '/locais'           => ['controller' => 'LocalController', 'metodo' => 'index'],
    '/locais/adicionar' => ['controller' => 'LocalController', 'metodo' => 'adicionar'],
    '/locais/editar'    => ['controller' => 'LocalController', 'metodo' => 'editar'],
    '/locais/excluir'   => ['controller' => 'LocalController', 'metodo' => 'excluir'],

    '/monstros'           => ['controller' => 'MonstroController', 'metodo' => 'index'],
    '/monstros/adicionar' => ['controller' => 'MonstroController', 'metodo' => 'adicionar'],
    '/monstros/editar'    => ['controller' => 'MonstroController', 'metodo' => 'editar'],
    '/monstros/excluir'   => ['controller' => 'MonstroController', 'metodo' => 'excluir'],

    '/personagens'           => ['controller' => 'PersonagemController', 'metodo' => 'index'],
    '/personagens/adicionar' => ['controller' => 'PersonagemController', 'metodo' => 'adicionar'],
    '/personagens/editar'    => ['controller' => 'PersonagemController', 'metodo' => 'editar'],
    '/personagens/excluir'   => ['controller' => 'PersonagemController', 'metodo' => 'excluir'],

    '/desaparecidos'           => ['controller' => 'DesaparecidoController', 'metodo' => 'index'],
    '/desaparecidos/adicionar' => ['controller' => 'DesaparecidoController', 'metodo' => 'adicionar'],
    '/desaparecidos/editar'    => ['controller' => 'DesaparecidoController', 'metodo' => 'editar'],
    '/desaparecidos/excluir'   => ['controller' => 'DesaparecidoController', 'metodo' => 'excluir'],

    '/categorias'           => ['controller' => 'CategoriaController', 'metodo' => 'index'],
    '/categorias/adicionar' => ['controller' => 'CategoriaController', 'metodo' => 'adicionar'],
    '/categorias/editar'    => ['controller' => 'CategoriaController', 'metodo' => 'editar'],
    '/categorias/excluir'   => ['controller' => 'CategoriaController', 'metodo' => 'excluir'],

    '/produtos'           => ['controller' => 'ProdutoController', 'metodo' => 'index'],
    '/produtos/adicionar' => ['controller' => 'ProdutoController', 'metodo' => 'adicionar'],
    '/produtos/editar'    => ['controller' => 'ProdutoController', 'metodo' => 'editar'],
    '/produtos/excluir'   => ['controller' => 'ProdutoController', 'metodo' => 'excluir'],
];

if (array_key_exists($uri, $rotas)) {
    $controllerName = $rotas[$uri]['controller'];
    $metodo = $rotas[$uri]['metodo'];

    $controller = new $controllerName();
    $controller->$metodo();
} else {
    http_response_code(404);
    require __DIR__ . '/views/404.php';
}
