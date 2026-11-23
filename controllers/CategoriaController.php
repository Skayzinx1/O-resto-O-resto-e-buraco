<?php
class CategoriaController {
    private $model;

    public function __construct()
    {
        if (!isset($_SESSION['usuario']['tipo']) || $_SESSION['usuario']['tipo'] != 'admin') {
            header('Location: /Trabalho_Lp3/');
            exit;
        }
        $this->model = new Categoria();
    }

    public function index() {
        $titulo = 'Categorias';
        $dados = $this->model->listar();
        require __DIR__ . '/../views/categorias/index.php';
    }

    public function adicionar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $categoria = trim(filter_input(INPUT_POST, 'categoria') ?? '');
            $descricao = trim(filter_input(INPUT_POST, 'descricao') ?? '');

            if($categoria) {
                $this->model->salvar($categoria, $descricao ?: null);
                header('Location: /Trabalho_Lp3/categorias');
                exit;
            }
        }

        $titulo = 'Nova categoria';
        require __DIR__ . '/../views/categorias/criar.php';
    }

    public function editar() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if(!$id) {
            header('Location: /Trabalho_Lp3/categorias');
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $categoria = trim(filter_input(INPUT_POST, 'categoria') ?? '');
            $descricao = trim(filter_input(INPUT_POST, 'descricao') ?? '');

            if($categoria) {
                $this->model->atualizar($id, $categoria, $descricao ?: null);
                header('Location: /Trabalho_Lp3/categorias');
                exit;
            }
        }

        $dado = $this->model->buscarPorId($id);

        if(!$dado) {
            header('Location: /Trabalho_Lp3/categorias');
            exit;
        }

        $titulo = 'Editar categoria';
        require __DIR__ . '/../views/categorias/editar.php';
    }

    public function excluir() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if($id) {
            $this->model->excluir($id);
        }

        header('Location: /Trabalho_Lp3/categorias');
        exit;
    }
}
