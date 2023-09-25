<?php

namespace BancoDigital\Controller;

use BancoDigital\Model\CorrentistaModel;
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

            $model = new CorrentistaModel();

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

            

            $model = new CorrentistaModel();
            // Copiando os valores de $data para $model
            $model->id = $data->id;
            $model->nome = $data->nome;
            $model->data_nascimento = $data->data_nascimento;
            $model->cpf = $data->cpf;
            $model->senha = $data->senha;
            

            

            parent::GetResponseAsJSON($model->save()); 

        } catch(Exception $e) {
            
            parent::LogError($e);
            parent::GetExceptionAsJSON($e);
        }   
    }
}
?>