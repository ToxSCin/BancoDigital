<?php

namespace BancoDigital\DAO;

use BancoDigital\Model\CorrenteModel;
use PDO;

class CorrenteDAO extends DAO
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
        

        $sql = "INSERT INTO corrente (nome, email, cpf, data_nasc, senha, data_cadastro) 
                VALUES (?, ?, ?, ?, sha1(?) ,?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->email);
        $stmt->bindValue(3, $model->cpf);
        $stmt->bindValue(4, $model->data_nasc);
        $stmt->bindValue(5, $model->senha);
        $stmt->bindValue(6, $model->data_cadastro);

        $stmt->execute();


        $model->id = $this->conexao->lastInsertId();

        return $model;
    }


    private function update(CorrenteModel $m) 
    {

    }

    public function selectByCpfAndSenha($cpf, $senha) : CorrenteModel
    {
        $sql = "SELECT * FROM Corrente WHERE cpf = ? AND senha = sha1(?) ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cpf);
        $stmt->bindValue(2, $senha);
        $stmt->execute();

        return $stmt->fetchObject("ApiBancoDigital\Model\CorrenteModel");
    }
}