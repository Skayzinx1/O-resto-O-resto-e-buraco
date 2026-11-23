<?php
class MonstroController {

    private $model;
    private $localModel;

    public function __construct()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /Trabalho_Lp3/login');
            exit;
        }
        $this->model = new Monstro();
        $this->localModel = new Local();
    }

    public function index() {
        $titulo = 'Monstros';
        $dados = $this->model->listar();
        require __DIR__ . '/../views/monstros/index.php';
    }

    public function adicionar() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = trim(filter_input(INPUT_POST, 'nome') ?? '');
            $perigo = filter_input(INPUT_POST, 'perigo', FILTER_VALIDATE_INT);
            $descricao = trim(filter_input(INPUT_POST, 'descricao') ?? '');
            $fraqueza = trim(filter_input(INPUT_POST, 'fraqueza') ?? '');
            $id_local = filter_input(INPUT_POST, 'id_local', FILTER_VALIDATE_INT);

            $imagem = $this->processarImagem($_FILES['imagem'] ?? null);

            if ($nome && $perigo) {

                $this->model->salvar(
                    $nome,
                    $perigo,
                    $descricao ?: null,
                    $fraqueza ?: null,
                    $imagem,
                    ($id_local !== false && $id_local > 0) ? $id_local : null
                );

                header('Location: /Trabalho_Lp3/monstros');
                exit;
            }
        }

        $locais = $this->localModel->listar();

        $titulo = 'Novo monstro';
        require __DIR__ . '/../views/monstros/criar.php';
    }

    public function editar() {

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /Trabalho_Lp3/monstros');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = trim(filter_input(INPUT_POST, 'nome') ?? '');
            $perigo = filter_input(INPUT_POST, 'perigo', FILTER_VALIDATE_INT);
            $descricao = trim(filter_input(INPUT_POST, 'descricao') ?? '');
            $fraqueza = trim(filter_input(INPUT_POST, 'fraqueza') ?? '');
            $id_local = filter_input(INPUT_POST, 'id_local', FILTER_VALIDATE_INT);

            $dadoAtual = $this->model->buscarPorId($id);

            if (!$dadoAtual) {
                header('Location: /Trabalho_Lp3/monstros');
                exit;
            }

            $imagem = $this->processarImagem($_FILES['imagem'] ?? null, $dadoAtual['imagem']);

            if ($nome && $perigo) {

                $this->model->atualizar(
                    $id,
                    $nome,
                    $perigo,
                    $descricao ?: null,
                    $fraqueza ?: null,
                    $imagem,
                    ($id_local !== false && $id_local > 0) ? $id_local : null
                );

                header('Location: /Trabalho_Lp3/monstros');
                exit;
            }
        }

        $dado = $this->model->buscarPorId($id);

        if (!$dado) {
            header('Location: /Trabalho_Lp3/monstros');
            exit;
        }

        $locais = $this->localModel->listar();

        $titulo = 'Editar monstro';
        require __DIR__ . '/../views/monstros/editar.php';
    }

    public function excluir() {

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id) {
            $dado = $this->model->buscarPorId($id);

            if ($dado && !empty($dado['imagem'])) {
                $caminho = __DIR__ . '/../uploads/monstros/' . $dado['imagem'];

                if (file_exists($caminho)) {
                    unlink($caminho);
                }
            }

            $this->model->excluir($id);
        }

        header('Location: /Trabalho_Lp3/monstros');
        exit;
    }

    private function processarImagem($arquivo, ?string $imagemAtual = null): ?string {

        if (!isset($arquivo) || empty($arquivo['name'])) {
            return $imagemAtual;
        }

        if ($arquivo['error'] !== UPLOAD_ERR_OK) {
            return $imagemAtual;
        }

        $permitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        if (!in_array($arquivo['type'], $permitidos, true)) {
            return $imagemAtual;
        }

        $diretorio = __DIR__ . '/../uploads/monstros';

        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0777, true);
        }

        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $nomeArquivo = time() . '_' . uniqid() . '.' . strtolower($extensao);
        $destino = $diretorio . '/' . $nomeArquivo;

        if (move_uploaded_file($arquivo['tmp_name'], $destino)) {

            if ($imagemAtual && file_exists($diretorio . '/' . $imagemAtual)) {
                unlink($diretorio . '/' . $imagemAtual);
            }

            return $nomeArquivo;
        }

        return $imagemAtual;
    }
}
