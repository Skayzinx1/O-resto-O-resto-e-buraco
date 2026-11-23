<?php
class DesaparecidoController {

    private $model;
    private $localModel;
    private $monstroModel;
    private $situacoes = ['Desaparecido', 'Em investigação', 'Encontrado', 'Não sobreviveu'];

    public function __construct()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /Trabalho_Lp3/login');
            exit;
        }
        $this->model = new Desaparecido();
        $this->localModel = new Local();
        $this->monstroModel = new Monstro();
    }

    public function index() {
        $titulo = 'Desaparecidos';
        $dados = $this->model->listar();
        require __DIR__ . '/../views/desaparecidos/index.php';
    }

    public function adicionar() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = trim(filter_input(INPUT_POST, 'nome') ?? '');
            $idade = filter_input(INPUT_POST, 'idade', FILTER_VALIDATE_INT);
            $data_desaparecimento = filter_input(INPUT_POST, 'data_desaparecimento');
            $situacao = filter_input(INPUT_POST, 'situacao');
            $descricao = trim(filter_input(INPUT_POST, 'descricao') ?? '');
            $id_local = filter_input(INPUT_POST, 'id_local', FILTER_VALIDATE_INT);
            $id_monstro = filter_input(INPUT_POST, 'id_monstro', FILTER_VALIDATE_INT);

            $imagem = $this->processarImagem($_FILES['imagem'] ?? null);

            if ($nome && in_array($situacao, $this->situacoes)) {

                $this->model->salvar(
                    $nome,
                    ($idade !== false && $idade !== null) ? $idade : null,
                    $data_desaparecimento ?: null,
                    $situacao,
                    $descricao ?: null,
                    $imagem,
                    ($id_local !== false && $id_local > 0) ? $id_local : null,
                    ($id_monstro !== false && $id_monstro > 0) ? $id_monstro : null
                );

                header('Location: /Trabalho_Lp3/desaparecidos');
                exit;
            }
        }

        $locais = $this->localModel->listar();
        $monstros = $this->monstroModel->listar();
        $situacoes = $this->situacoes;

        $titulo = 'Novo desaparecido';
        require __DIR__ . '/../views/desaparecidos/criar.php';
    }

    public function editar() {

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /Trabalho_Lp3/desaparecidos');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = trim(filter_input(INPUT_POST, 'nome') ?? '');
            $idade = filter_input(INPUT_POST, 'idade', FILTER_VALIDATE_INT);
            $data_desaparecimento = filter_input(INPUT_POST, 'data_desaparecimento');
            $situacao = filter_input(INPUT_POST, 'situacao');
            $descricao = trim(filter_input(INPUT_POST, 'descricao') ?? '');
            $id_local = filter_input(INPUT_POST, 'id_local', FILTER_VALIDATE_INT);
            $id_monstro = filter_input(INPUT_POST, 'id_monstro', FILTER_VALIDATE_INT);

            $dadoAtual = $this->model->buscarPorId($id);

            if (!$dadoAtual) {
                header('Location: /Trabalho_Lp3/desaparecidos');
                exit;
            }

            $imagem = $this->processarImagem($_FILES['imagem'] ?? null, $dadoAtual['imagem']);

            if ($nome && in_array($situacao, $this->situacoes)) {

                $this->model->atualizar(
                    $id,
                    $nome,
                    ($idade !== false && $idade !== null) ? $idade : null,
                    $data_desaparecimento ?: null,
                    $situacao,
                    $descricao ?: null,
                    $imagem,
                    ($id_local !== false && $id_local > 0) ? $id_local : null,
                    ($id_monstro !== false && $id_monstro > 0) ? $id_monstro : null
                );

                header('Location: /Trabalho_Lp3/desaparecidos');
                exit;
            }
        }

        $dado = $this->model->buscarPorId($id);

        if (!$dado) {
            header('Location: /Trabalho_Lp3/desaparecidos');
            exit;
        }

        $locais = $this->localModel->listar();
        $monstros = $this->monstroModel->listar();
        $situacoes = $this->situacoes;

        $titulo = 'Editar desaparecido';
        require __DIR__ . '/../views/desaparecidos/editar.php';
    }

    public function excluir() {

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id) {
            $dado = $this->model->buscarPorId($id);

            if ($dado && !empty($dado['imagem'])) {
                $caminho = __DIR__ . '/../uploads/desaparecidos/' . $dado['imagem'];

                if (file_exists($caminho)) {
                    unlink($caminho);
                }
            }

            $this->model->excluir($id);
        }

        header('Location: /Trabalho_Lp3/desaparecidos');
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

        $diretorio = __DIR__ . '/../uploads/desaparecidos';

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
