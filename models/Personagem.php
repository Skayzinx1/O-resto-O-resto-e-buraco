<?php
require_once __DIR__ . '/../config/Database.php';

class Personagem {
    private $db;
    private $tabela = "personagens";

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function listar() {

        $sql = "select personagens.*, locais.nome as local from $this->tabela left join locais on personagens.id_local = locais.id order by personagens.nome asc";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll();

    }

    public function salvar(string $nome, ?int $idade, ?string $descricao, ?string $imagem, ?int $id_local) {

        $sql = "insert into $this->tabela (nome, idade, descricao, imagem, id_local) values (:nome, :idade, :descricao, :imagem, :id_local)";
        $stmt = $this->db->prepare($sql);

        $values = [
            ':nome' => $nome,
            ':idade' => $idade,
            ':descricao' => $descricao,
            ':imagem' => $imagem,
            ':id_local' => $id_local
        ];

        return $stmt->execute($values);

    }

    public function atualizar(int $id, string $nome, ?int $idade, ?string $descricao, ?string $imagem, ?int $id_local) {

        $sql = "update $this->tabela set nome = :nome, idade = :idade, descricao = :descricao, imagem = :imagem, id_local = :id_local where id = :id";
        $stmt = $this->db->prepare($sql);

        $values = [
            ':nome' => $nome,
            ':idade' => $idade,
            ':descricao' => $descricao,
            ':imagem' => $imagem,
            ':id_local' => $id_local,
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
