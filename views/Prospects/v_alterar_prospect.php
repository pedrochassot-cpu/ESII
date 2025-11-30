<?php
session_start();

require_once('../../controllers/Prospect/ControllerProspect.php');
require_once('../../models/Usuario.php');

use models\Usuario;
use controllers\ControllerProspect;


if(isset($_SESSION["usuario"])){

    if(isset($_GET['email']) || isset($_SESSION['emailOriginal'])){
        $email = (isset($_GET['email'])) ? $_GET['email'] : $_SESSION['emailOriginal'];

        $ctrlProspect = new ControllerProspect();
        $arrProspect = $ctrlProspect->buscarProspects($email);
        $prospect = $arrProspect[0];

        $_SESSION['emailOriginal'] = $email;
   }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bem Vindo ao Sistema</title>
        <link rel="stylesheet" type="text/css" href="../../libs/bootstrap/css/bootstrap.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="collapse navbar-collapse" id="textoNavbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../main.php">Home <span class="sr-only">(Página atual)</span></a>
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
        </header>
        <div class="container">
            <form class="form-signin" action="../../controllers/Prospect/c_alterar_prospect.php" method="POST">
                <div>
                    <h5 class="form-signin-heading">Cadastro de Usuários:</h5>
                </div class="">
                <div class="form-group">
                    <label for="nome">Código:</label>
                    <input <?php echo 'value="'.$prospect->codigo.'"';?> name="codigo" id="codigio" type="text" placeholder="Digite seu nome" class="form-control" required readonly/>
                    <label for="nome">Nome:</label>
                    <input <?php echo 'value="'.$prospect->nome.'"';?> name="nome" id="nome" type="text" placeholder="Digite seu nome" class="form-control" required/>
                    <label for="email">E-mail:</label>
                    <input <?php echo 'value="'.$prospect->email.'"';?> name="email" id="email" placeholder="Digite seu E-mail" class="form-control" required autofocus autocomplete="off"/>
                    <label for="celular">Celular:</label>
                    <input <?php echo 'value="'.$prospect->celular.'"';?> name="celular" id="celular" type="text" placeholder="Digite seu celular" class="form-control" required/>
                    <label for="whatsapp">Whatsapp:</label>
                    <input <?php echo 'value="'.$prospect->whatsapp.'"';?> name="whatsapp" id="whatsapp" type="text" placeholder="Digite seu whatsapp" class="form-control" required/>
                    <label for="facebook">Facebook:</label>
                    <input <?php echo 'value="'.$prospect->facebook.'"';?> name="facebook" id="facebook" type="text" placeholder="Digite sua facebook" class="form-control" required/>
                </div>
                <button type="submit" class="btn btn-success">Cadastrar</button>
                <a href="v_listar_prospect.php" class="btn btn-danger">Cancelar</a>
            </form>
            <p class="text-center text-danger">
                <?php
                    if(isset($_SESSION["erroSistema"])){
                        echo $_SESSION["erroSistema"];
                        unset($_SESSION["erroSistema"]);
                    }
                ?>
            </p>
        </div>
    </body>
</html>
<?php
}else{
    $_SESSION['erroLogin'] = "Faça o Login para completar a operação!";
    header("Location: index.php");
}
?>