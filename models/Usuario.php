<?php
require_once __DIR__ . '/../config/Database.php';

class Usuario {
    private $db;
    private $tabela = "usuarios";

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function listar() {

        $stmt = $this->db->query("select id, nome, email, tipo, criado_em from $this->tabela order by id asc");
        return $stmt->fetchAll();

    }

    public function salvar(string $nome, string $email, string $senha, string $tipo = 'investigador') {

        $sql = "insert into $this->tabela (nome, email, senha, tipo) values (:nome, :email, :senha, :tipo)";
        $stmt = $this->db->prepare($sql);

        $values = [
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => password_hash($senha, PASSWORD_DEFAULT),
            ':tipo' => $tipo
        ];

        return $stmt->execute($values);

    }

    public function atualizar(int $id, string $nome, string $email, ?string $senha, string $tipo) {

        if ($senha) {
            $sql = "update $this->tabela set nome = :nome, email = :email, senha = :senha, tipo = :tipo where id = :id";
            $values = [':nome' => $nome, ':email' => $email, ':senha' => password_hash($senha, PASSWORD_DEFAULT), ':tipo' => $tipo, ':id' => $id];
        } else {
            $sql = "update $this->tabela set nome = :nome, email = :email, tipo = :tipo where id = :id";
            $values = [':nome' => $nome, ':email' => $email, ':tipo' => $tipo, ':id' => $id];
        }

        $stmt = $this->db->prepare($sql);

        return $stmt->execute($values);

    }

    public function buscarPorId(int $id) {

        $sql = "select * from $this->tabela where id = :id";
        $stmt = $this->db->prepare($sql);

        $values = [':id' => $id];

        $stmt->execute($values);

        return $stmt->fetch();

    }

    public function buscarPorEmail(string $email) {

        $sql = "select * from $this->tabela where email = :email";
        $stmt = $this->db->prepare($sql);

        $values = [':email' => $email];

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
