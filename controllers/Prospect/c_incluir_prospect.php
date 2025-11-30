<?php
session_start();

require_once('ControllerProspect.php');
require_once('../../models/Prospect.php');

use models\Prospect;
use controllers\ControllerProspect;

if(isset($_SESSION["usuario"])){
   $nome = $_POST['nome'];
   $email = $_POST['email'];
   $celular = $_POST['celular'];
   $facebook = $_POST['facebook'];
   $whatsapp = $_POST['whatsapp'];

   $prospect = new Prospect();

   $prospect->addProspect(null, $nome, $email, $celular, $facebook, $whatsapp);

   $ctrlProspect = new ControllerProspect();
   try{
      $ctrlProspect->salvarProspect($prospect);
   }catch(\Exception $e){
      $_SESSION['erroSistema'] = $e->getMessage();
      header("Location: ../../views/v_erro.php");
      die();
   }

   unset($prospect);
   unset($ctrlProspect);

   header("Location: ../../views/Prospects/v_listar_prospects.php");

}else{
    $_SESSION['erroLogin'] = "Faça o Login para completar a operação!";
    header("Location: ../index.php");
}
?>