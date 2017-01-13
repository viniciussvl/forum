<?php
include("config.php");
if (isset($_POST['usuario']) && isset($_POST['senha'])) {
    $usuario = $_POST['usuario'];
    //preg_replace("/[^a-zA-Z0-9]/", "", $_GET['id']);
    $senha = $_POST['senha'];
    $sqlUsuario = mysqli_query($conexao, "SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$senha'");
    while ($row = mysqli_fetch_array($sqlUsuario)) {
        $nome = $row['nome'];
        $admin = $row['admin'];
        $idUsuario = $row['idUsuario'];
    }
    if (mysqli_num_rows($sqlUsuario) > 0) {
        session_start();
        $_SESSION['idUsuario'] = $idUsuario;
        $_SESSION['usuarioLogado'] = $usuario;
        $_SESSION['nomeUsuario'] = $nome;
        $_SESSION['verificaAdmin'] = $admin;
        header("Location: index.php");
    } else {
        header("Location: login.php?erro=login");
    }
}

include("inc/header.php");
?>

<div class="col-md-12 fundo-branco">
    <form method="POST" class="col-md-5 form-horizontal">
        <div class="form-group">
            <label for="usuario" class="col-sm-2 control-label">Usuário</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuário">
            </div>
        </div>
        <div class="form-group">
            <label for="senha" class="col-sm-2 control-label">Senha</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Lembrar-me
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Logar</button>
            </div>
        </div>
    </form>
</div>
<?php
include("inc/footer.php");
?>