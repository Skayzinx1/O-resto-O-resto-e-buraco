<?php
class ProdutoController {

    private $model;
    private $categoriaModel;

    public function __construct()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /Trabalho_Lp3/login');
            exit;
        }
        $this->model = new Produto();
        $this->categoriaModel = new Categoria();
    }

    public function index() {
        $titulo = 'Produtos';
        $dados = $this->model->listar();
        require __DIR__ . '/../views/produtos/index.php';
    }

    public function adicionar() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $produto = trim(filter_input(INPUT_POST, 'produto') ?? '');
            $valor = filter_input(INPUT_POST, 'valor', FILTER_VALIDATE_FLOAT);
            $descricao = trim(filter_input(INPUT_POST, 'descricao') ?? '');
            $id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_VALIDATE_INT);

            $imagem = $this->processarImagem($_FILES['imagem'] ?? null);

            if ($produto && $valor !== false && $valor !== null && $valor >= 0) {

                $this->model->salvar(
                    $produto,
                    $valor,
                    $descricao ?: null,
                    $imagem,
                    ($id_categoria !== false && $id_categoria > 0) ? $id_categoria : null
                );

                header('Location: /Trabalho_Lp3/produtos');
                exit;
            }
        }

        $categorias = $this->categoriaModel->listar();

        $titulo = 'Novo produto';
        require __DIR__ . '/../views/produtos/criar.php';
    }

    public function editar() {

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /Trabalho_Lp3/produtos');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $produto = trim(filter_input(INPUT_POST, 'produto') ?? '');
            $valor = filter_input(INPUT_POST, 'valor', FILTER_VALIDATE_FLOAT);
            $descricao = trim(filter_input(INPUT_POST, 'descricao') ?? '');
            $id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_VALIDATE_INT);

            $dadoAtual = $this->model->buscarPorId($id);

            if (!$dadoAtual) {
                header('Location: /Trabalho_Lp3/produtos');
                exit;
            }

            $imagem = $this->processarImagem($_FILES['imagem'] ?? null, $dadoAtual['imagem']);

            if ($produto && $valor !== false && $valor !== null && $valor >= 0) {

                $this->model->atualizar(
                    $id,
                    $produto,
                    $valor,
                    $descricao ?: null,
                    $imagem,
                    ($id_categoria !== false && $id_categoria > 0) ? $id_categoria : null
                );

                header('Location: /Trabalho_Lp3/produtos');
                exit;
            }
        }

        $dado = $this->model->buscarPorId($id);

        if (!$dado) {
            header('Location: /Trabalho_Lp3/produtos');
            exit;
        }

        $categorias = $this->categoriaModel->listar();

        $titulo = 'Editar produto';
        require __DIR__ . '/../views/produtos/editar.php';
    }

    public function excluir() {

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id) {
            $dado = $this->model->buscarPorId($id);

            if ($dado && !empty($dado['imagem'])) {
                $caminho = __DIR__ . '/../uploads/produtos/' . $dado['imagem'];

                if (file_exists($caminho)) {
                    unlink($caminho);
                }
            }

            $this->model->excluir($id);
        }

        header('Location: /Trabalho_Lp3/produtos');
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

        $diretorio = __DIR__ . '/../uploads/produtos';

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
