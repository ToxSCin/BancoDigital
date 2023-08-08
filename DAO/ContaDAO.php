<?php

namespace BancoDigital\DAO;
use BancoDigital\Model\ContaModel;
use \PDO;

    class ContaDAO extends DAO
    {
     
        public function __construct()
        {
            parent::__construct();       
        }

    public function insert(ContaModel $model) : ?ContaModel
    {
        $sql = "INSERT INTO conta 
                            (id_correntista, saldo, limite, tipo) 
                VALUES 
                            (?, ?, ?, ?) ";
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->id_correntista);
        $stmt->bindValue(2, $model->saldo);
        $stmt->bindValue(3, $model->limite);
        $stmt->bindValue(4, $model->tipo);

        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;
    }

    public function select(int $id_cidadao)
    {
        $sql = "SELECT * FROM Reclamacao WHERE id_cidadao = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id_cidadao);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);        
    }
}