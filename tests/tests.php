<?php

require_once('../controllers/ControllerUsuario.php');

use CONTROLLERS\ControllerUsuario;

$ctrlUsuario = new ControllerUsuario();

$ctrlUsuario->salvarUsuario('Marcos Dias', 'dias@noites.com.br', 'dias', '45632');