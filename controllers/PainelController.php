<?php
class PainelController
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
        $titulo = 'Painel';
        $totais = [
            'locais' => count((new Local())->listar()),
            'monstros' => count((new Monstro())->listar()),
            'personagens' => count((new Personagem())->listar()),
            'desaparecidos' => count((new Desaparecido())->listar()),
            'categorias' => count((new Categoria())->listar()),
            'produtos' => count((new Produto())->listar()),
            'usuarios' => count((new Usuario())->listar()),
        ];

        require __DIR__ . '/../views/painel/index.php';
    }
}
