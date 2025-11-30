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
        <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>
        <script src="../../libs/bootstrap/js/bootstrap.min.js"></script>
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
        <!-- Modal de Delete-->
        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Confirma exclusao</h4>
                    </div>
                    <div class="modal-body">
                        <p>Deseja realmente excluir este prospect?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                        <a class="btn btn-danger btn-ok">Sim</a>
                    </div>
                </div>
            </div>
        </div> <!-- /.modal --><!-- /.modal -->
        <script>
           $('#modalDelete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).attr('data-href'));
            });
        </script>
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
                                            echo '<td width="160"><a href="v_alterar_prospect.php?email='.$dados->email.'">alterar</a> |
                                            <a data-toggle="modal" href="#" data-target="#modalDelete" data-href="../../controllers/Prospect/c_excluir_prospect.php?codigo='.$dados->codigo.'">excluir</a>';
                                        echo '</tr>';
                                    }
                                }
                            ?>
                    </tbody>
                </table>
            </div>
            <div>
                <a class="btn btn-primary" href="v_incluir_prospect.php">Novo</a>
    </body>
</html>
<?php
}else{
    $_SESSION['erroLogin'] = "Faça o Login para completar a operação!";
    header("Location: ../../index.php");
}
?>