<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['usuarioLogado'])){
    header("Location: index.php");
}
$usuario = $_SESSION['usuarioLogado'];
$sql = mysqli_query($conexao, "SELECT senha FROM usuario WHERE usuario = '$usuario'");
while($row = mysqli_fetch_array($sql)){
    echo $row['senha'];
}

include("inc/header.php");
?>


<div class="fundo-branco col-md-12">
    <?php
if(isset($_GET['alterado']) && $_GET['alterado'] == "true"){ ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Alterações efetuadas com sucesso!
            </div> 
<?php } ?>
    <section class="categorias col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Perfil</h3>
            </div>
            
            <div class="panel-body perfil col-md-10">
               <form method="POST" class="form-horizontal" enctype="multipart/form-data">
                   
                   <div class="form-group">
                        <label for="senhaAtual" class="col-sm-4 control-label">Senha Atual</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="senhaAtual" id="senhaAtual" required>
                        </div>
                    </div>
                   <br><br>
                   <div class="form-group">
                        <label for="novaSenha" class="col-sm-4 control-label">Nova senha</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="novaSenha" id="novaSenha" required>
                        </div>
                    </div>
                   
                   <div class="form-group">
                        <label for="confirmarSenha" class="col-sm-4 control-label">Confirmar senha</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="confirmarSenha" id="confirmarSenha" required>
                        </div>
                    </div>

                   
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default right">Alterar senha</button>
                        </div>
                    </div>
                </form> 
            </div>
            
        </div>
        
        
    </section>
    <aside class="widgets col-md-3">
 
            <div class="widget">
                <h2>aaa</h2>
                <p>bbb</p>
            </div>
    </aside>
</div>

<?php


include("inc/footer.php");
?>

