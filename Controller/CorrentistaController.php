<?php

namespace BancoDigital\Controller;

use ApiBancoDigital\Model\CorrenteModel;
use Exception;

class CorrentistaController extends Controller
{
    public static function login()
    {
        try
        {
            // Transformando os dados da entrada enviada do app em
            // JSON para um objeto em PHP.
            $data = json_decode(file_get_contents('php://input'));

            $model = new CorrenteModel();

            parent::GetResponseAsJSON($model->getByCpfAndSenha($data->cpf, $data->senha)); 

        } catch(Exception $e) {
            
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }  
    }

/**
 * Preenche um Model para que seja enviado ao banco de dados para salvar.
 */
    public static function salvar()
    {
        try
        {
            $data = json_decode(file_get_contents('php://input'));

            

            $model = new CorrenteModel();
            // Copiando os valores de $data para $model
            $model->id = $data->id;
            $model->email = $data->email;
            $model->nome = $data->nome;
            $model->cpf = $data->cpf;
            $model->senha = $data->senha;
            $model->data_nasc = $data->data_nasc;
            $model->data_cadastro = $data->data_cadastro;

            

            parent::GetResponseAsJSON($model->save()); 

        } catch(Exception $e) {
            
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }   
    }
}
?>