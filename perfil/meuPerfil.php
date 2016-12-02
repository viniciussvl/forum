<?php
include("../inc/header.php");

if(!isset($_SESSION['usuarioLogado'])){
    //header("Location: index.php");
    echo "Não existe sessão, portanto nada será exibido!";
}  else{
    $idUsuario = $_SESSION['idUsuario'];
    $sql = mysqli_query($conexao, "SELECT usuario, slug, email, nome, frase, localizacao, humor, comida, desenho, emprego, skype FROM usuario WHERE idUsuario = '$idUsuario'");
    while($row = mysqli_fetch_array($sql)){
        $usuario = $row['usuario'];
        $slug = $row['slug'];
        $email = $row['email'];
        $nome = $row['nome'];
        $frase = $row['frase'];
        $localizacao = utf8_encode($row['localizacao']);
        $humor = $row['humor'];
        $comida = $row['comida'];
        $desenho = $row['desenho'];
        $emprego = $row['emprego'];
        $skype = $row['skype'];
    }
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
               <form method="POST" action="editarPerfil.php" class="form-horizontal" enctype="multipart/form-data">
                   <div class="form-group">
                       <label for="usuario" class="col-sm-4 control-label">Foto de Perfil</label>
                       
                        <img src="<?= $url; ?>img/uploads/perfil/<?php echo $slug . '.jpg';?>" class="img-perfil"><br><br>
                        <div class="col-sm-5 right">
                            <input name="arquivo" id="arquivo" type="file">
                        </div>
                    </div>
                    <!-- SE O ADMIN PERMITIR QUE O USUARIO ALTERE O USUARIO FAÇA UM IF COM ESSE INPUT
                    
                    <div class="form-group">
                        <label for="usuario" class="col-sm-4 control-label">Usuário</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="usuario" id="usuario" value="echo usuario aqui" disabled>
                        </div>
                    </div> 
                    
                     SE O ADMIN PERMITIR QUE O USUARIO ALTERE O EMAIL FAÇA UM IF COM ESSE INPUT
                    
                    <div class="form-group">
                        <label for="usuario" class="col-sm-4 control-label">E-mail</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="email" id="usuario" value="echo email aqui" disabled>
                        </div>
                    </div>-->
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Usuário</label>
                        <div class="col-sm-8">
                            <p class="form-control-static"><?php echo $usuario; ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">E-mail</label>
                        <div class="col-sm-8">
                            <p class="form-control-static"><?php echo $email; ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Senha</label>
                        <div class="col-sm-8">
                            <p class="form-control-static"><a href="alterarSenha.php">Alterar</a></p>
                        </div>
                    </div>
                    
                   <div class="form-group">
                        <label for="usuario" class="col-sm-4 control-label">Nome</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nome" id="usuario" value="<?php echo $nome; ?>" required>
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="usuario" class="col-sm-4 control-label">Localizacao</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="localizacao" value="<?php echo $localizacao; ?>">
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="usuario" class="col-sm-4 control-label">Frase</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="frase" value="<?php echo $frase; ?>">
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="usuario" class="col-sm-4 control-label">Humor</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="humor" value="<?php echo $humor; ?>">
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="usuario" class="col-sm-4 control-label">Comida preferida</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="comida" value="<?php echo $comida; ?>">
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="usuario" class="col-sm-4 control-label">Desenho preferido</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="desenho" value="<?php echo $desenho; ?>">
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="usuario" class="col-sm-4 control-label">Emprego/Lazer</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="emprego" value="<?php echo $emprego; ?>">
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="usuario" class="col-sm-4 control-label">Skype</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="skype" value="<?php echo $skype; ?>">
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Salvar</button>
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

}
include("../inc/footer.php");
?>