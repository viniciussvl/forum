<?php
session_start();
include("modals.php");
include("funcoes.php");
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/forum/config.php";
include_once($path);
$ativarDebugador = 0; // 0 para desativar | 1 para ativar
$sqlWidgets = mysqli_query($conexao, "SELECT tituloWidget, conteudoWidget FROM widget");

// Selecionar configuracoes
$sqlConfig = mysqli_query($conexao, "SELECT * FROM configuracoes");
while($r = mysqli_fetch_array($sqlConfig)){
    $nomeForum = $r['nome'];
    $favicon = $r['favicon'];
    $idioma = $r['idioma'];
    $descForum = $r['descricao'];
}


if (isset($_SESSION['usuarioLogado'])) {
    $usuario = $_SESSION['usuarioLogado'];
    $selecionaUser = mysqli_query($conexao, "SELECT slug FROM usuario WHERE usuario = '$usuario'");
    while ($row = mysqli_fetch_array($selecionaUser)) {
        $slug = $row['slug'];
    }
    $novasMsg = mysqli_query($conexao, "SELECT assunto, usuario FROM mensagem INNER JOIN usuario ON mensagem.idRecebeu = usuario.idUsuario WHERE visualizou = 0 AND usuario = '$usuario'");
}


if ($ativarDebugador == 1) {
    foreach ($mensagens as $k):
        echo "<pre>";
        var_dump($k);
    endforeach;
}

$htmlLang = ($idioma == 'portugues') ? 'pt-br' : 'en';
?>
<!DOCTYPE HTML>
<html lang="<?= $htmlLang;?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $nomeForum; ?></title>
        <link rel="icon" href="<?= $favicon; ?>" type="image/x-icon">
        <link rel="stylesheet" href="<?= $url; ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= $url; ?>css/estilo.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="<?= $url; ?>js/bootstrap.min.js"></script>

    </head>

    <body>

        <header id="topo">
            <div class="barra-topo">
                <div class="container">
                    <div class="logo left">
                        <a href="<?= $url; ?>"><img src="<?= $url; ?>img/amd-novo.png"></a>
                    </div>
                    <div class="form-busca right">
                        <form id="formBusca" name="formBusca" method="GET" action="<?= $url; ?>busca.php">
                            <div class="left form-group">
                                <input type="text" class="form-control" id="txtPesquisa" name="pesquisa" placeholder="<?php 
                                    if($idioma == 'portugues'){ 
                                        echo "O que você procura?";
                                    } else{ 
                                        echo 'What are you looking for?';} ?>">
                            </div>
                            <div class="right">
                                <button id="btnBuscar" type="submit" class="btnBuscar btn btn-danger">
                                    <?php
                                        if($idioma == 'portugues'){ 
                                            echo "Buscar";
                                        } else{ 
                                            echo 'Search';} ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="<?= $url; ?>"><i class="glyphicon glyphicon-home botao-home"></i></a></li>
                                <li><a href="<?= $url; ?>" class="botao-principal"><i class="glyphicon glyphicon-th-list"></i> Principal</a></li>

                            </ul>

                            <ul class="nav navbar-nav navbar-right">

                                <?php
                                if (!isset($_SESSION['usuarioLogado'])) {
                                    ?>
                                    <a href="<?= $url; ?>login.php" class="btn-entrar">Entrar</a>
                                    <a href="<?= $url; ?>registrar.php" class="btn-cadastro">Cadastre-se</a>

                                    <?php
                                } else {
                                    ?>
                                    <div class="right">

                                        <a href="<?= $url; ?>mp/caixaEntrada.php" title="Ver minhas mensagens privadas" class="icon-msg left">
                                            <?php
                                            if (mysqli_num_rows($novasMsg) > 0):
                                                ?>
                                                <span class="info-nova-mp"><em><?php echo mysqli_num_rows($novasMsg); ?></em></span>
                                                <?php
                                            endif;
                                            ?>
                                            <i class="glyphicon glyphicon-envelope"></i>
                                        </a>
                                        <a href="<?= $url; ?>perfil/meuPerfil.php" title="Alterar imagem de perfil">
                                            <img src="<?= $url; ?>img/uploads/perfil/<?php echo $slug . '.jpg'; ?>" class="left img-perfil-header">
                                        </a>

                                        <li class="dropdown right">

                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['usuarioLogado']; ?> <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?= $url; ?>perfil/meuPerfil.php">Perfil</a></li>
                                                <li><a href="<?= $url; ?>mp/caixaEntrada.php">Mensagens Privadas</a></li>
                                                <li><a href="#">Configurações da Conta</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a href="#">Separated link</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a href="<?= $url;?>sair.php">Sair</a></li>
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div>
                </div><!-- /.container-fluid -->

            </nav>
            <script>
                $(document).ready(function () {
                    $('[data-toggle="popover"]').popover();
                });
            </script>
        </header>
        <div class="container">

