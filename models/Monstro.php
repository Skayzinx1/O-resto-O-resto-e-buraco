<?php
require_once __DIR__ . '/../config/Database.php';

class Monstro {
    private $db;
    private $tabela = "monstros";

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function listar() {

        $sql = "select monstros.*, locais.nome as local from $this->tabela left join locais on monstros.id_local = locais.id order by monstros.perigo desc, monstros.nome asc";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll();

    }

    public function salvar(string $nome, int $perigo, ?string $descricao, ?string $fraqueza, ?string $imagem, ?int $id_local) {

        $sql = "insert into $this->tabela (nome, perigo, descricao, fraqueza, imagem, id_local) values (:nome, :perigo, :descricao, :fraqueza, :imagem, :id_local)";
        $stmt = $this->db->prepare($sql);

        $values = [
            ':nome' => $nome,
            ':perigo' => $perigo,
            ':descricao' => $descricao,
            ':fraqueza' => $fraqueza,
            ':imagem' => $imagem,
            ':id_local' => $id_local
        ];

        return $stmt->execute($values);

    }

    public function atualizar(int $id, string $nome, int $perigo, ?string $descricao, ?string $fraqueza, ?string $imagem, ?int $id_local) {

        $sql = "update $this->tabela set nome = :nome, perigo = :perigo, descricao = :descricao, fraqueza = :fraqueza, imagem = :imagem, id_local = :id_local where id = :id";
        $stmt = $this->db->prepare($sql);

        $values = [
            ':nome' => $nome,
            ':perigo' => $perigo,
            ':descricao' => $descricao,
            ':fraqueza' => $fraqueza,
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
