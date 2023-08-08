<?php

namespace BancoDigital\Model;
use BancoDigital\DAO\ContaDAO;

class ContaModel extends Model
{
    public $id, $id_correntista, $tipo, $saldo, $limite;
    
    public function save()
    {
      
      $dao = new ContaDAO(); 

      
      if(empty($this->id))
      {
          
          $dao->insert($this);

      } else {

          //$dao->update($this); 
      }        
    }

    public function getAllRows(int $id_cidadao)
    {
        $dao = new ContaDAO();
        $this->rows = $dao->select($id_cidadao);
    }
    public function delete()
    {
        (new ContaModel())->delete($this->id);
    }
}