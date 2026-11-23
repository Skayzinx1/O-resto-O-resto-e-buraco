<?php
class LoginController {
    private $model;

    public function __construct()
    {
        $this->model = new Usuario();
    }

    public function index() {
        if (isset($_SESSION['usuario'])) {
            header('Location: /Trabalho_Lp3/');
            exit;
        }

        $erro = '';
        $sucesso = '';
        $email = '';

        if (isset($_GET['cadastro'])) {
            $sucesso = 'Cadastro realizado com sucesso! Agora é só entrar.';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $senha = $_POST['senha'];

            $usuario = $this->model->buscarPorEmail($email);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'nome' => $usuario['nome']
                ];
                header('Location: /Trabalho_Lp3/');
                exit;
            } else {
                $erro = 'E-mail ou senha incorretos.';
            }
        }

        $titulo = 'Entrar';
        $classeBody = 'pagina-login';
        require __DIR__ . '/../views/login/index.php';
    }

    public function cadastro() {
        if (isset($_SESSION['usuario'])) {
            header('Location: /Trabalho_Lp3/');
            exit;
        }

        $erro = '';
        $nome = '';
        $email = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome']);
            $email = trim($_POST['email']);
            $senha = $_POST['senha'];
            $confirmar = $_POST['confirmar_senha'];

            if ($nome == '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($senha) < 8) {
                $erro = 'Preencha os dados corretamente. A senha deve ter pelo menos 8 caracteres.';
            } elseif ($senha != $confirmar) {
                $erro = 'As senhas não são iguais.';
            } elseif ($this->model->buscarPorEmail($email)) {
                $erro = 'Esse e-mail já está cadastrado.';
            } else {
                $this->model->salvar($nome, $email, $senha);
                header('Location: /Trabalho_Lp3/login?cadastro=ok');
                exit;
            }
        }

        $titulo = 'Criar conta';
        $classeBody = 'pagina-login';
        require __DIR__ . '/../views/login/criar.php';
    }

    public function sair() {
        session_destroy();
        header('Location: /Trabalho_Lp3/login');
        exit;
    }
}
