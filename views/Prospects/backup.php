<?php
session_start();
require_once('../../controllers/Prospect/ControllerProspect.php');
require_once('../../models/Usuario.php');
use models\Usuario;
use controllers\ControllerProspect;

if(isset($_SESSION["usuario"])){

?>
<!DOCTYPE html>
<html>
<!-- Tratando erros com sessão -->
    <head>
        <title>Bem Vindo ao Sistema</title>
        <link rel="stylesheet" type="text/css" href="../../libs/bootstrap/css/bootstrap.css">
        <style type="text/css">
            .table-overflow {
                max-height:600px;
                overflow-y:auto;
            }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="collapse navbar-collapse" id="textoNavbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link " href="../principal.php">Home <span class="sr-only">(Página atual)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cadastrar Prospects</a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        Bem vindo: <?php $usuario = unserialize($_SESSION['usuario']);
                        echo $usuario->nome;?>
                    </span>
                </div>
            </nav>
        </header><br>
        <div class="container">
            <div class="table-overflow" style= "height: 750; overflow: auto;">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Facebook</th>
                            <th scope="col">Whatsapp</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php


                                $cUsuario = new ControllerProspect();
                                $listaUsuarios = $cUsuario->buscarProspects();
                                if($listaUsuarios !== "Vazio"){
                                    foreach($listaUsuarios as $dados){
                                        echo '<tr>';
                                            echo '<td>'.$dados->nome.'</td>';
                                            echo '<td>'.$dados->email.'</td>';
                                            echo '<td>'.$dados->celular.'</td>';
                                            echo '<td>'.$dados->facebook.'</td>';
                                            echo '<td>'.$dados->whatsapp.'</td>';
                                            echo '<td width="150"><a href="v_alterar_prospect.php?email='.$dados->email.'">alterar</a> |
                                            <a href="../../controllers/prospect/c_excluir_prospect.php?codigo='.$dados->codigo.'">excluir</a></td>';
                                        echo '</tr>';
                                    }
                                }
                            ?>
                    </tbody>
                </table>
            </div>
            <div>
                <a class="btn btn-primary" href="v_incluir_prospect.php">Novo</a>
            </div>
        </div>

    </body>
</html>
<?php
}else{
    $_SESSION['erroLogin'] = "Faça o Login para completar a operação!";
    header("Location: ../../index.php");
}
?>