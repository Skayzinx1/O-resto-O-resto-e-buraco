<?php
class UsuarioController {
    private $model;

    public function __construct()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /Trabalho_Lp3/login');
            exit;
        }
        $this->model = new Usuario();
    }

    public function index() {
        $titulo = 'Usuários';
        $usuarios = $this->model->listar();
        require __DIR__ . '/../views/usuarios/index.php';
    }

    public function adicionar() {
        $erro = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nome = trim(filter_input(INPUT_POST, 'nome') ?? '');
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha') ?? '';

            if($nome && $email && strlen($senha) >= 6) {
                if ($this->model->buscarPorEmail($email)) {
                    $erro = 'Esse e-mail já está cadastrado.';
                } else {
                    $this->model->salvar($nome, $email, $senha);
                    header('Location: /Trabalho_Lp3/usuarios');
                    exit;
                }
            } else {
                $erro = 'Preencha nome, e-mail válido e senha com pelo menos 6 caracteres.';
            }
        }

        $titulo = 'Novo usuário';
        require __DIR__ . '/../views/usuarios/criar.php';
    }

    public function editar() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $erro = null;

        if(!$id) {
            header('Location: /Trabalho_Lp3/usuarios');
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nome = trim(filter_input(INPUT_POST, 'nome') ?? '');
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha') ?? '';

            if($nome && $email && ($senha === '' || strlen($senha) >= 6)) {
                $this->model->atualizar($id, $nome, $email, $senha ?: null);
                header('Location: /Trabalho_Lp3/usuarios');
                exit;
            }
            $erro = 'Preencha nome e e-mail válido. A nova senha, se informada, precisa ter 6 caracteres.';
        }

        $usuario = $this->model->buscarPorId($id);

        if(!$usuario) {
            header('Location: /Trabalho_Lp3/usuarios');
            exit;
        }

        $titulo = 'Editar usuário';
        require __DIR__ . '/../views/usuarios/editar.php';
    }

    public function excluir() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if($id && $id != $_SESSION['usuario']['id']) {
            $this->model->excluir($id);
        }

        header('Location: /Trabalho_Lp3/usuarios');
        exit;
    }
}
