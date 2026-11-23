<?php
require_once __DIR__ . '/../config/Database.php';

class Desaparecido {
    private $db;
    private $tabela = "desaparecidos";

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function listar() {

        $sql = "select desaparecidos.*, locais.nome as local, monstros.nome as monstro
                from $this->tabela
                left join locais on desaparecidos.id_local = locais.id
                left join monstros on desaparecidos.id_monstro = monstros.id
                order by desaparecidos.data_desaparecimento desc";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll();

    }

    public function salvar(string $nome, ?int $idade, ?string $data_desaparecimento, string $situacao, ?string $descricao, ?string $imagem, ?int $id_local, ?int $id_monstro) {

        $sql = "insert into $this->tabela (nome, idade, data_desaparecimento, situacao, descricao, imagem, id_local, id_monstro) values (:nome, :idade, :data_desaparecimento, :situacao, :descricao, :imagem, :id_local, :id_monstro)";
        $stmt = $this->db->prepare($sql);

        $values = [
            ':nome' => $nome,
            ':idade' => $idade,
            ':data_desaparecimento' => $data_desaparecimento,
            ':situacao' => $situacao,
            ':descricao' => $descricao,
            ':imagem' => $imagem,
            ':id_local' => $id_local,
            ':id_monstro' => $id_monstro
        ];

        return $stmt->execute($values);

    }

    public function atualizar(int $id, string $nome, ?int $idade, ?string $data_desaparecimento, string $situacao, ?string $descricao, ?string $imagem, ?int $id_local, ?int $id_monstro) {

        $sql = "update $this->tabela set nome = :nome, idade = :idade, data_desaparecimento = :data_desaparecimento, situacao = :situacao, descricao = :descricao, imagem = :imagem, id_local = :id_local, id_monstro = :id_monstro where id = :id";
        $stmt = $this->db->prepare($sql);

        $values = [
            ':nome' => $nome,
            ':idade' => $idade,
            ':data_desaparecimento' => $data_desaparecimento,
            ':situacao' => $situacao,
            ':descricao' => $descricao,
            ':imagem' => $imagem,
            ':id_local' => $id_local,
            ':id_monstro' => $id_monstro,
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
