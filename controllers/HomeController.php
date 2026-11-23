<?php

class HomeController
{
    public function __construct()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /Trabalho_Lp3/login');
            exit;
        }
    }

    public function index()
    {
        $titulo = 'Início';
        $monstros = (new Monstro())->listar();
        $desaparecidos = (new Desaparecido())->listar();
        $personagens = (new Personagem())->listar();

        require __DIR__ . '/../views/home.php';
    }

    public function sobre()
    {
        $titulo = 'Sobre';
        require __DIR__ . '/../views/sobre.php';
    }

    public function submundo()
    {
        $titulo = 'Mundo Invertido';
        $classeBody = 'submundo';
        $monstros = (new Monstro())->listar();
        $desaparecidos = (new Desaparecido())->listar();

        require __DIR__ . '/../views/submundo/index.php';
    }

    public function mapa()
    {
        $titulo = 'Mapa de Hawkins';
        $locais = (new Local())->listar();
        $monstros = (new Monstro())->listar();
        $personagens = (new Personagem())->listar();
        $desaparecidos = (new Desaparecido())->listar();

        require __DIR__ . '/../views/mapa/index.php';
    }

    public function loja()
    {
        $titulo = 'Loja Starcourt';
        $categorias = (new Categoria())->listar();
        $produtos = (new Produto())->listar();

        require __DIR__ . '/../views/loja/index.php';
    }
}
