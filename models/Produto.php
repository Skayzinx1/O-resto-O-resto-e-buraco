<?php
require_once __DIR__ . '/../config/Database.php';

class Produto {
    private $db;
    private $tabela = "produtos";

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function listar() {

        $sql = "select produtos.*, categorias.categoria from $this->tabela left join categorias on produtos.id_categoria = categorias.id order by categorias.categoria asc, produtos.produto asc";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll();

    }

    public function salvar(string $produto, float $valor, ?string $descricao, ?string $imagem, ?int $id_categoria) {

        $sql = "insert into $this->tabela (produto, valor, descricao, imagem, id_categoria) values (:produto, :valor, :descricao, :imagem, :id_categoria)";
        $stmt = $this->db->prepare($sql);

        $values = [
            ':produto' => $produto,
            ':valor' => $valor,
            ':descricao' => $descricao,
            ':imagem' => $imagem,
            ':id_categoria' => $id_categoria
        ];

        return $stmt->execute($values);

    }

    public function atualizar(int $id, string $produto, float $valor, ?string $descricao, ?string $imagem, ?int $id_categoria) {

        $sql = "update $this->tabela set produto = :produto, valor = :valor, descricao = :descricao, imagem = :imagem, id_categoria = :id_categoria where id = :id";
        $stmt = $this->db->prepare($sql);

        $values = [
            ':produto' => $produto,
            ':valor' => $valor,
            ':descricao' => $descricao,
            ':imagem' => $imagem,
            ':id_categoria' => $id_categoria,
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
