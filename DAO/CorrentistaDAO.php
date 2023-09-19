<?php

namespace BancoDigital\DAO;

use BancoDigital\Model\CorrentistaModel;
use PDO;

class CorrentistaDAO extends DAO
{
    public function __construct()
    {

        parent::__construct();       
    }

    public function save(CorrentistaModel $m) : CorrentistaModel
    {
        return ($m->id == null) ? $this->insert($m) : $this->update($m);
    }



    private function insert(CorrentistaModel $model)
    {
        

        $sql = "INSERT INTO correntista (nome, email, cpf, data_nasc, senha, data_cadastro) 
                VALUES (?, ?, ?, ?, sha1(?) ,?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->email);
        $stmt->bindValue(3, $model->cpf);
       
        $stmt->bindValue(5, $model->senha);
    
        $stmt->execute();


        $model->id = $this->conexao->lastInsertId();

        return $model;
    }


    private function update(CorrentistaModel $m) 
    {

    }

    public function selectByCpfAndSenha($cpf, $senha) : CorrentistaModel
    {
        $sql = "SELECT * FROM Corrente WHERE cpf = ? AND senha = sha1(?) ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cpf);
        $stmt->bindValue(2, $senha);
        $stmt->execute();

        return $stmt->fetchObject("BancoDigital\Model\CorrentistaModel");
    }
}