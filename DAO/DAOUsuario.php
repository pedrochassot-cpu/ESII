<?php
namespace DAO; //definir pacote

use Exception;
use mysqli;
use models\Usuario;
use mysqli_sql_exception;

mysqli_report(MYSQLI_REPORT_STRICT); //recuperar mensagens de erro do mysqli

require_once('../models/Usuario.php'); //importar classe usuário

// comunicação com banco de dados, logar e incluir novo usuário @author Ana Paula Ferreira

class DAOUsuario{

  /* logar no sistema com dados do usuário
  *  @param string $login login do usuário
  *  @param string @senha senha do usuário
  *  return Usuario|Exception
  */
  public function logar($login, $senha){
    try{  //quando chamar função que trata excessão chamar tratando
      $conexao = $this-> conectarBanco();
    }catch(\Exception $e){ //capturar excessão lançada no conectarBanco
      die($e->getMessage());
    }

    $usuario = new Usuario();//carregar dados usuario dentro do objeto usuario
    $sql = $conexao->prepare("select nome, login, email, celular from usuario where login=? and senha=?");//prepare prepara sentença sql
    $sql->bind_param('ss', $login, $senha); //pegar variaveis e substituir na ordem (ss) -> duas string
    $sql->execute();

    if($sql->error){ //se sql não apresentar erro

      $resultado = $sql->get_result();//guardar resultado da consulta

      //carregar objeto usuario com dados do banco se tiver resultado
      if($resultado->num_rows===0){ //num_rows -> numero linhas se não carregar nenhuma linha, nenhum resultado
      $usuario->addUsuario(null, null, null, null, false);
      }else{
        while($linha = $resultado->fetch_assoc()){ //percorrer dados pegos do banco para colocar nas variáveis, fetch_assoc extrair resultado
        $usuario->addUsuario($linha['nome'], $linha['login'],$linha['email'], $linha['celular'], true);
        }
      }

    } //fechar if se não apresentar erro sql
    else{ //excessão se acontecer erro sql
        throw new \Exception("Erro ao executar busca");
    }


    $sql->close(); //fechar sql
    $conexao->close(); //fechar conexao
  
   
  } //fechar função logar

   /* incluir usuario no sistema 
  *  @param string $nome  incluir nome do usuário
  *  @param string $email incluir email do usuário
  *  @param string $login incluir login do usuário
  *  @param string $senha incluir senha do usuário
  *  return True|Exception true para inclusão bem sucedida ou exception erro de não inclusão
  */
   public function incluirUsuario($nome, $email, $login, $senha){
    try{  //quando chamar função que trata excessão chamar tratando
      $conexao = $this-> conectarBanco();
    }catch(\Exception $e){ //capturar excessão lançada no conectarBanco
      die($e->getMessage());
    }

    $sqlInsert = $conexao->prepare("insert into usuario (nome, email, login, senha) values (?,?,?,?)");//prepare prepara sentença sql
    $sqlInsert->bind_param('ssss', $nome, $email, $login, $senha); //pegar variaveis e substituir na ordem (ss) -> duas string
    $sqlInsert->execute();

    if(!$sqlInsert->error){ //se não der erro
      $retorno = true;
    }else{
        throw new \Exception("Não foi possível incluir novo Usuário");
        die;
    }

    $sqlInsert->close(); //fechar sql
    $conexao->close(); //fechar conexao
    return $retorno;

   } //fechar função incluir

  private function conectarBanco(){
      if(!defined('DS')){//definir constante para separar sistema operacional se não tiver definida
        define('DS', DIRECTORY_SEPARATOR);
      }

      if(!defined('BASE_DIR')){//definir constante para base diretório se não tiver definida
        define('BASE_DIR', dirname(__FILE__).DS); //recebe nome diretório (dirname) raiz (__FILE__) com separador do sistema operacional
      }

      require_once(DS.'bd_config.php'); //achar arquivo dentro da raíz sem erro
      
      try{ //tratar erro de conexão
      $conn = new \MySQLi($dbhost, $user, $password, $db);
      return $conn;
      }catch(mysqli_sql_exception $e){ //capturar erro de msql
        throw new \Exception($e); //lançar exceção
        die; //interromper processamento
      }
      
  } //fechar função conectar
}


?>