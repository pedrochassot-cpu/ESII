<?php
use dao\DAOUsuario;
use models\Usuario;

require_once('DAOUsuario.php');
require_once('../models/Usuario.php');

$dao = new DAOUsuario();
$usuario = new Usuario();

$usuario = $dao->logar('paulo', '123');

echo " ".$usuario->nome;
?>