<?php

namespace BancoDigital\Model;
use BancoDigital\DAO\CorrentistaDAO;
use BancoDigital\DAO\ContaDAO;

use PDO;

class CorrentistaModel extends Model
{
   
    public $id, $nome, $email, $cpf, $data_nascimento, $senha;
    public $rows_contas; 

    
    public function save() : ?CorrentistaModel
    {
        $dao_correntista = new CorrentistaDAO();
        
        $model_preenchido = $dao_correntista->save($this);

       
        if($model_preenchido->id != null)
        {
            $dao_conta = new ContaDAO();

            
            $conta_corrente = new ContaModel();
            $conta_corrente->id_correntista = $model_preenchido->id;
            $conta_corrente->saldo = 0;
            $conta_corrente->limite = 100;
            $conta_corrente->tipo = 'C';
            $conta_corrente = $dao_conta->insert($conta_corrente);

            $model_preenchido->rows_contas[] = $conta_corrente;

            $conta_poupanca = new ContaModel();
            $conta_poupanca->id_correntista = $model_preenchido->id;
            $conta_poupanca->saldo = 0;
            $conta_poupanca->limite = 0;
            $conta_poupanca->tipo = 'P';
            $conta_poupanca = $dao_conta->insert($conta_poupanca);

            $model_preenchido->rows_contas[] = $conta_poupanca;
        }

        return $model_preenchido;    
    }


    
    public function getByCpfAndSenha($cpf, $senha) : CorrentistaModel
    {      
        return (new CorrentistaDAO())->selectByCpfAndSenha($cpf, $senha);
    }
}