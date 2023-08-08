<?php

namespace BancoDigital\DAO;

use BancoDigital\Model\ChavePixModel;

class ChavePixDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();       
    }

    /**
     * 
     */
    public function select()
    {
        $sql = "SELECT * FROM chave_pix";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS);
    }

    public function insert(ChavePixModel $m) : bool
    {
        $sql = "INSERT INTO chave_pix (tipo, chave) VALUES (?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->tipo);
        $stmt->bindValue(2, $m->chave);

        return $stmt->execute();
    }

    public function update(ChavePixModel $m)
    {
        $sql = "UPDATE chave_pix SET tipo=?, chave=? WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->tipo);
        $stmt->bindValue(2, $m->chave);
        $stmt->bindValue(3, $m->id);

        return $stmt->execute();
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM chave_pix WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}