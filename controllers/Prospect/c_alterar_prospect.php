<?php
session_start();

require_once('ControllerProspect.php');
require_once('../../models/Prospect.php');

use models\Prospect;
use controllers\ControllerProspect;

if(isset($_SESSION["usuario"])){
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $facebook = $_POST['facebook'];
    $whatsapp = $_POST['whatsapp'];

    $prospect = new Prospect();

    $prospect->addProspect($codigo, $nome, $email, $celular, $facebook, $whatsapp);

    $ctrlProspect = new ControllerProspect();
    try{
        $ctrlProspect->salvarProspect($prospect);
        unset($prospect);
        unset($ctrlProspect);
        unset($_SESSION['emailOriginal']);
        header("Location: ../../views/Prospects/v_listar_prospects.php");
    }catch(\Exception $e){
        $_SESSION['erroSistema'] = $e->getMessage();
        echo $_SESSION['emailOriginal'];
        header("Location: ../../views/Prospects/v_alterar_prospect.php");
        die();
   }



}else{
    $_SESSION['erroLogin'] = "Faça o Login para completar a operação!";
    header("Location: ../../index.php");
}
?>