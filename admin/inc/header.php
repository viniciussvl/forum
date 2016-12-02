<?php
session_start();
include("../config.php");
if (!isset($_SESSION['usuarioLogado']) || $_SESSION['verificaAdmin'] != 1) {
    echo "<div style='color: red; text-align: center; font-size: 1.6em;' class='acesso-negado'>
            <p>Acesso Negado!</p>
            <a href='$url'>Voltar ao fórum</a>
          </div>";
    die;
}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AMD - Fórum</title>
        <link rel="icon" href="<?= $url; ?>img/favicon.png" type="image/x-icon">
        <link rel="stylesheet" href="<?= $url; ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= $url; ?>admin/css/estiloAdmin.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="<?= $url; ?>js/bootstrap.min.js"></script>
    </head>
    <body>
        <header id="topo">
            <div class="barra-topo">
                <img src="<?= $url; ?>img/favicon.png"><h1>Painel de Controle</h1>
                <a href="<?= $url; ?>" class="right" target="_blank">Ver fórum</a>
            </div>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <div class="container">
                            <ul class="nav navbar-nav">
                                <li><a href="<?= $url; ?>admin">Página Inicial</a></li>
                                <li><a href="<?= $url; ?>admin/geral.php">Geral</a></li>
                                <li><a href="#">Visualização</a></li>
                                <li><a href="#">Usuários & Grupos</a></li>
                                <li><a href="#">Módulos</a></li>
                                <li><a href="#">Diversos</a></li>
                            </ul>
                        </div>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>
    </body>
</html>