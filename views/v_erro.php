<?php
session_start();

if(isset($_SESSION["erroSistema"])){

?>
<!DOCTYPE html>
<html>
<!-- Tratando erros com sessão -->
    <head>
        <title>Bem Vindo ao Sistema</title>
        <link rel="stylesheet" type="text/css" href="../libs/bootstrap/css/bootstrap.css">
        <meta charset="UTF-8">
    </head>
    <body>
      <div class="container jumbotron">
         <div class="row">
            <div class="col-md-12">
                  <div class="error-template">
                     <h1>
                        Oops!</h1>
                     <h2>
                        Desculpe, mas houve um erro!</h2>
                     <div class="error-details alert alert-danger">
                        <?php echo $_SESSION["erroSistema"];
                        unset($_SESSION['erroSistema'])?>
                     </div>
                     <div class="error-actions">
                        <a href="prospects/v_listar_prospects.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                              Voltar para o Cadastro </a>
                     </div>
                  </div>
            </div>
         </div>
      </div>
    </body>
</html>
<?php
}else{
    $_SESSION['erroLogin'] = "Faça o Login para completar a operação!";
    header("Location: ../index.php");
}
?>