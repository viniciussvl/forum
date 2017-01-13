<?php
session_start();
include("../config.php");
include("../inc/funcoes.php");
if(isset($_GET['area']) && !empty($_GET['area'])){
    $idArea = $_GET['area'];
}
if(isset($_GET['t']) && !empty($_GET['t'])){
    $idTopico = $_GET['t'];
} else{
    header("Location: index.php");
}
if(!isset($_SESSION['usuarioLogado'])){
    header("Location: index.php");
} else{
    if(isset($_POST['conteudo'])){
        $ip = $_SERVER["REMOTE_ADDR"];
        $conteudo = $_POST['conteudo'];
        $dataAtual = date('Y-m-d H:i:s');
        $usuario = $_SESSION['usuarioLogado'];
        $sqlUsuario = mysqli_query($conexao, "SELECT idUsuario FROM usuario WHERE usuario = '$usuario'");
        while($row = mysqli_fetch_array($sqlUsuario)){
            $idUsuario = $row['idUsuario'];
        }
        $insere = mysqli_query($conexao, "INSERT INTO posts (idUsuario, conteudoPost, dataPost, ip, idArea, idTopico) VALUES ('$idUsuario', '$conteudo', '$dataAtual', '$ip', '$idArea', '$idTopico')");
        $sql = mysqli_query($conexao, "SELECT qtdPosts FROM topico WHERE idTopico = '$idTopico'");
        while($row = mysqli_fetch_array($sql)){
            $qtdPosts = intval($row['qtdPosts']);
        }
        $cont = $qtdPosts + 1;
        $contadorPosts = mysqli_query($conexao, "UPDATE topico SET qtdPosts = '$cont' WHERE idTopico = '$idTopico'");
        header("Location: verTopico.php?t=$idTopico");
    }
}
?>