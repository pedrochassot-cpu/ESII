<?php
namespace models; 

class Usuario {
   // public $id;
    public $nome;
    public $login;
    //public $senha;
    public $email;
    public $celular;
    public $logado;
    
  /*public function __construct() {
  }*/

    // função para inicializar os atributos
    public function addUsuario($nome, $login, $email, $celular, $logado) {
        
        $this->nome = $nome;
        $this->login = $login;
        $this->email = $email;
        $this->celular = $celular;
        $this->logado = $logado;
    }
}
   ?>