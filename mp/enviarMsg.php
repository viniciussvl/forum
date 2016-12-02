<?php
session_start();
include("../config.php");
include("inc/funcoes.php");
$limiteMsg = 10;
if (!isset($_POST['assunto']) && !isset($_POST['usuario']) && !isset($_POST['conteudo'])) {
    header("Location: index.php");
} else {
    $enviou = $_SESSION['usuarioLogado'];
    $recebeu = $_POST['recebeu'];
    $_SESSION['recebeu'] = $recebeu;
    $sqlUser = mysqli_query($conexao, "SELECT idUsuario, usuario FROM mensagem INNER JOIN usuario ON mensagem.idRecebeu = usuario.idUsuario WHERE usuario = '$recebeu'");
    while ($row = mysqli_fetch_array($sqlUser)) {
        $idUser = $row['idUsuario'];
    }
    $sqlMensagens = mysqli_query($conexao, "SELECT * FROM mensagem WHERE idRecebeu = '$idUser' AND statusRecebeu = 1");
    if (mysqli_num_rows($sqlMensagens) >= $limiteMsg) {
        header("Location: caixaEntrada.php?erro=full");
    } else {
        if ($enviou == $recebeu) {
            header("Location: caixaEntrada.php?erro=igual");
        } else {
            $sqlEnviou = mysqli_query($conexao, "SELECT idUsuario FROM usuario WHERE usuario = '$enviou'");
            while ($row = mysqli_fetch_array($sqlEnviou)) {
                $idEnviou = $row['idUsuario'];
            }

            $sqlRecebeu = mysqli_query($conexao, "SELECT idUsuario FROM usuario WHERE usuario = '$recebeu'");
            if (mysqli_num_rows($sqlRecebeu) < 1) {
                header("Location: caixaEntrada.php?erro=inexistente");
            } else {
                while ($row = mysqli_fetch_array($sqlRecebeu)) {
                    $idRecebeu = $row['idUsuario'];
                }
                $assunto = utf8_decode($_POST['assunto']);
                $conteudo = utf8_decode($_POST['conteudo']);
                $dataAtual = date('Y-m-d H:i:s');
                for($i = 1; $i <= 10; $i++){
                    
                    $insere = mysqli_query($conexao, "INSERT INTO mensagem (assunto, conteudoMsg, dataMsg, idEnviou, idRecebeu)
                                          VALUES ('$assunto', '$conteudo', '$dataAtual', '$idEnviou', '$idRecebeu')");
                }
                header("Location: caixaEntrada.php?enviado=true");
            }
        }
    }
}

