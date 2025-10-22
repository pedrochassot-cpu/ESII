<?php
namespace models; 

class Prospect {
 
    public $nome;
    public $email;
    public $celular;
    public $facebook;
    public $whatsapp;
    
    
  
    public function addProspect($nome, $email, $celular, $facebook, $whatsapp)  {
        
        $this->nome = $nome;
        $this->email = $email;
        $this->celular = $celular;
        $this->facebook = $facebook;
        $this->whatsapp = $whatsapp;
    }
  }