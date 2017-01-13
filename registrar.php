<?php
include("inc/header.php");

$erro = "";

if(isset($_POST['usuario'])){
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $nome = strtoupper($_POST['nome']);
    $sql = mysqli_query($conexao, "SELECT usuario, email FROM usuario WHERE usuario = '$usuario' OR email = '$email'");
    if(mysqli_num_rows($sql) > 0){
        $erro = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Oops!</strong> Esse usuário ou e-mail já existe!
                </div>";
    } else{
        echo "cadastrado!";
        $registrar = mysqli_query($conexao, "INSERT INTO usuario (usuario, senha, email, nome) VALUES ('$usuario', '$senha', '$email', '$nome')");
        header("Location: index.php?cadastrado=true");
    }
}

?>

<div class="col-md-6">
    <div id="erro"><?php echo $erro; ?></div>
    <form id="formRegistro" method="POST" class="form-horizontal">
        <div class="form-group">
            <label for="usuario" class="col-sm-2 control-label">Usuário</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário">
            </div>
        </div>
        <div class="form-group">
            <label for="senha" class="col-sm-2 control-label">Senha</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
            </div>
        </div>
        <div class="form-group">
            <label for="confirmSenha" class="col-sm-2 control-label">Confirme a senha</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="confirmSenha" name="confirmSenha" placeholder="Confirme a senha">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">E-mail</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
            </div>
        </div>
        <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Nome completo</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" id="botaoRegistrar" onclick="return validacao()" class="btn btn-default">Registrar</button>
            </div>
        </div>
    </form>
</div>
<?php
include("inc/footer.php");
?>