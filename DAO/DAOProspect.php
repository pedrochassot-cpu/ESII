<?php
namespace DAO;

use Exception;
use mysqli;
use models\Prospect;
use mysqli_sql_exception;

mysqli_report(MYSQLI_REPORT_STRICT); 

require_once('../models/Prospect.php'); 

// comunicação com banco de dados, adicionar prospect @author Pedro Luiz Chassot Ferreira

class DAOProspect{


   /* incluir prospect no sistema 
   string nome para incluir nome ao prospecto
   string email para incluir email ao prospecto
   string celular para incluir celular ao prospecto
   string facebook para incluir facebook ao prospecto
   string whatsapp para incluir whatsapp ao prospecto
   */

 public function incluirProspect($nome, $email, $celular, $facebook, $whatsapp)  {
    try{  
      $conexao = $this-> conectarBanco();
    }catch(\Exception $e){ 
      die($e->getMessage());
    }

    $sqlInsert = $conexao->prepare("insert into prospect (nome, email, celular, facebook, whatsapp) values (?,?,?,?,?)"); 
    $sqlInsert->bind_param('sssss', $nome, $email, $celular, $facebook, $whatsapp); 
    $sqlInsert->execute();

    if(!$sqlInsert->error){ 
      $retorno = true;
    }else{
        throw new \Exception("Não foi possível incluir novo Prospecto");
        die;
    }

    $sqlInsert->close(); 
    $conexao->close(); 
    return $retorno;

   }


   /* Atualizar Prospect no sistema 
   * string nome para atualizar nome do prospecto
   * string email para atualizar email do prospecto
   * string celular para atualizar celular do prospecto
   * string facebook para atualizar facebook do prospecto
   * string whatsapp para atualizar whatsapp do prospecto
   * int codProspecto para atualizar prospecto conforme código
   */

   public function atualizarProspect($nome, $email, $celular, $facebook, $whatsapp, $codProspect)  {
    try{  
      $conexao = $this-> conectarBanco();
    }catch(\Exception $e){ 
      die($e->getMessage());
    }
    
    $sqlUpdate = $conexao->prepare("UPDATE prospect SET nome = ?, email = ?, celular = ?, facebook = ?, whatsapp = ? WHERE codProspect = ?");
    $sqlUpdate->bind_param("sssssi", $nome, $email, $celular, $facebook, $whatsapp, $codProspect);
    $sqlUpdate->execute();

    if(!$sqlUpdate->error){ 
      $retorno = true;
    }else{
        throw new \Exception("Não foi possível atualizar propecto");
        die;
    }

    $sqlUpdate->close(); 
    $conexao->close(); 
    return $retorno;

   } 


   /* excluir prospect no sistema 
   int codProspect para excluir prospecto
   */

  public function excluirProspect($codProspect)  {
    try{ 
      $conexao = $this-> conectarBanco();
    }catch(\Exception $e){ 
      die($e->getMessage());
    }
    
    $sqlDelete = $conexao->prepare("Delete prospect WHERE codProspect = ?");
    $sqlDelete->bind_param("i", $codProspect);
    $sqlDelete->execute();

    if(!$sqlDelete->error){ 
      $retorno = true;
    }else{
        throw new \Exception("Não foi possível excluir propecto");
        die;
    }

    $sqlDelete->close(); 
    $conexao->close(); 
    return $retorno;

   } 

   /*
   buscar prospectos
   *string email para buscar prospectos
   */

   public function buscarProspect($email = null)  {
    try{  
      $conexao = $this-> conectarBanco();
    }catch(\Exception $e){ 
      die($e->getMessage());
    }

    $prospect = new Prospect();
    $sql = $conexao->prepare("select nome, email, celular, facebook, whatsapp from prospect where email=?");
    $sql->bind_param('s', $email); 
    $sql->execute();

    if($sql->error){ 

      $resultado = $sql->get_result();

      
      if($resultado->num_rows===0){ 
      $prospect->addProspect(null, null, null, null, null);
      }else{
        while($linha = $resultado->fetch_assoc()){ 
        $prospect->addProspect($linha['nome'], $linha['email'], $linha['celular'],  $linha['facebook'],  $linha['whatsapp']);
        }
      }

    } 
    else{ 
        throw new \Exception("Erro ao executar busca");
    }


    $sql->close(); 
    $conexao->close(); 

  }

  private function conectarBanco(){
      if(!defined('DS')){
        define('DS', DIRECTORY_SEPARATOR);
      }

      if(!defined('BASE_DIR')){
        define('BASE_DIR', dirname(__FILE__).DS); 
      }

      require_once(DS.'bd_config.php'); //achar arquivo dentro da raíz sem erro
      
      try{ 
      $conn = new \MySQLi($dbhost, $user, $password, $db);
      return $conn;
      }catch(mysqli_sql_exception $e){ 
        throw new \Exception($e);
        die;
      }
      
  } 
}


?>