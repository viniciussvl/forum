<?php

session_start();
include("../config.php");
$usuario = $_SESSION['usuarioLogado'];
$sqlUsuario = mysqli_query($conexao, "SELECT idUsuario FROM usuario WHERE usuario = '$usuario'");
while($row = mysqli_fetch_array($sqlUsuario)){
    $idUsuario = $row['idUsuario'];
}
if(!isset($_SESSION['usuarioLogado'])) {
    header("Location: index.php");
} else{
    if(isset($_GET['acao']) && $_GET['acao'] == "deletarTudo"){
        $desativarTudo = mysqli_query($conexao, "UPDATE mensagem SET statusRecebeu = 0, visualizou = 1 WHERE idRecebeu = '$idUsuario'");
        header("Location: caixaEntrada.php?deletado=tudo");
    }
    if (!empty($_POST['desativar'])) {
        $excluir = implode(',', $_POST['desativar']);
        $desativar = mysqli_query($conexao, "UPDATE mensagem SET statusRecebeu = 0, visualizou = 1 WHERE idMsg IN ($excluir) AND idRecebeu = '$idUsuario'");
        header("Location: caixaEntrada.php?deletado=selecionado");
    } else{
        header("Location: caixaEntrada.php?deletado=selecionado");
    }
   
}
