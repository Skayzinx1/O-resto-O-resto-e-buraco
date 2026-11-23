<?php
require_once __DIR__ . '/../config/Database.php';

class Local {
    private $db;
    private $tabela = "locais";

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function listar() {

        $stmt = $this->db->query("select * from $this->tabela order by nome asc");
        return $stmt->fetchAll();

    }

    public function salvar(string $nome, string $tipo, ?string $descricao, int $pos_x, int $pos_y, ?string $imagem) {

        $sql = "insert into $this->tabela (nome, tipo, descricao, pos_x, pos_y, imagem) values (:nome, :tipo, :descricao, :pos_x, :pos_y, :imagem)";
        $stmt = $this->db->prepare($sql);

        $values = [
            ':nome' => $nome,
            ':tipo' => $tipo,
            ':descricao' => $descricao,
            ':pos_x' => $pos_x,
            ':pos_y' => $pos_y,
            ':imagem' => $imagem
        ];

        return $stmt->execute($values);

    }

    public function atualizar(int $id, string $nome, string $tipo, ?string $descricao, int $pos_x, int $pos_y, ?string $imagem) {

        $sql = "update $this->tabela set nome = :nome, tipo = :tipo, descricao = :descricao, pos_x = :pos_x, pos_y = :pos_y, imagem = :imagem where id = :id";
        $stmt = $this->db->prepare($sql);

        $values = [
            ':nome' => $nome,
            ':tipo' => $tipo,
            ':descricao' => $descricao,
            ':pos_x' => $pos_x,
            ':pos_y' => $pos_y,
            ':imagem' => $imagem,
            ':id' => $id
        ];

        return $stmt->execute($values);

    }

    public function buscarPorId(int $id) {

        $sql = "select * from $this->tabela where id = :id";
        $stmt = $this->db->prepare($sql);

        $values = [':id' => $id];

        $stmt->execute($values);

        return $stmt->fetch();

    }

    public function excluir(int $id) {

        $sql = "delete from $this->tabela where id = :id";
        $stmt = $this->db->prepare($sql);

        $values = [':id' => $id];

        return $stmt->execute($values);

    }
}
