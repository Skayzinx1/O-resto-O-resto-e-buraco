<?php
class LocalController {

    private $model;
    private $tipos = ['seguro', 'alerta', 'perigo'];

    public function __construct()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /Trabalho_Lp3/login');
            exit;
        }
        $this->model = new Local();
    }

    public function index() {
        $titulo = 'Locais';
        $dados = $this->model->listar();
        require __DIR__ . '/../views/locais/index.php';
    }

    public function adicionar() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = trim(filter_input(INPUT_POST, 'nome') ?? '');
            $tipo = filter_input(INPUT_POST, 'tipo');
            $descricao = trim(filter_input(INPUT_POST, 'descricao') ?? '');
            $pos_x = filter_input(INPUT_POST, 'pos_x', FILTER_VALIDATE_INT);
            $pos_y = filter_input(INPUT_POST, 'pos_y', FILTER_VALIDATE_INT);

            $imagem = $this->processarImagem($_FILES['imagem'] ?? null);

            if ($nome && in_array($tipo, $this->tipos) && $pos_x !== false && $pos_y !== false) {

                $this->model->salvar($nome, $tipo, $descricao ?: null, $pos_x, $pos_y, $imagem);

                header('Location: /Trabalho_Lp3/locais');
                exit;
            }
        }

        $titulo = 'Novo local';
        $tipos = $this->tipos;
        require __DIR__ . '/../views/locais/criar.php';
    }

    public function editar() {

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /Trabalho_Lp3/locais');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = trim(filter_input(INPUT_POST, 'nome') ?? '');
            $tipo = filter_input(INPUT_POST, 'tipo');
            $descricao = trim(filter_input(INPUT_POST, 'descricao') ?? '');
            $pos_x = filter_input(INPUT_POST, 'pos_x', FILTER_VALIDATE_INT);
            $pos_y = filter_input(INPUT_POST, 'pos_y', FILTER_VALIDATE_INT);

            $dadoAtual = $this->model->buscarPorId($id);

            if (!$dadoAtual) {
                header('Location: /Trabalho_Lp3/locais');
                exit;
            }

            $imagem = $this->processarImagem($_FILES['imagem'] ?? null, $dadoAtual['imagem']);

            if ($nome && in_array($tipo, $this->tipos) && $pos_x !== false && $pos_y !== false) {

                $this->model->atualizar($id, $nome, $tipo, $descricao ?: null, $pos_x, $pos_y, $imagem);

                header('Location: /Trabalho_Lp3/locais');
                exit;
            }
        }

        $dado = $this->model->buscarPorId($id);

        if (!$dado) {
            header('Location: /Trabalho_Lp3/locais');
            exit;
        }

        $titulo = 'Editar local';
        $tipos = $this->tipos;
        require __DIR__ . '/../views/locais/editar.php';
    }

    public function excluir() {

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id) {
            $dado = $this->model->buscarPorId($id);

            if ($dado && !empty($dado['imagem'])) {
                $caminho = __DIR__ . '/../uploads/locais/' . $dado['imagem'];

                if (file_exists($caminho)) {
                    unlink($caminho);
                }
            }

            $this->model->excluir($id);
        }

        header('Location: /Trabalho_Lp3/locais');
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

        $diretorio = __DIR__ . '/../uploads/locais';

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
