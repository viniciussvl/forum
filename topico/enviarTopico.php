<?php
include("../config.php");
session_start();
if (!isset($_SESSION['usuarioLogado'])) {
    header("Location: index.php?erro=sessao");
} else {
    $usuario = $_SESSION['usuarioLogado'];
    $sqlUsuario = mysqli_query($conexao, "SELECT * FROM usuario WHERE usuario = '$usuario'");
        while($row = mysqli_fetch_array($sqlUsuario)){
            $idUsuario = $row['idUsuario'];
        }
    
    include("../inc/funcoes.php");
    include("../inc/slug.php");
    // Data e Hora atual
    $dataAtual = date('Y-m-d H:i:s');
    if (isset($_POST['titulo']) && isset($_POST['conteudo'])) {
        
        if (isset($_GET['area'])) {
            $idArea = preg_replace("/[^0-9\s]/", "", $_GET['area']);
            $titulo = utf8_decode($_POST['titulo']);
            $tituloOriginal = $_POST['titulo'];
            $slug = strtolower(slug($tituloOriginal, '-'));
            $conteudo = utf8_decode($_POST['conteudo']);
            $insere = mysqli_query($conexao, "INSERT INTO topico (titulo, slug, conteudo, dataPost, idArea, idUsuario) VALUES ('$titulo', '$slug', '$conteudo', '$dataAtual', '$idArea', '$idUsuario')");
            $sqlTopicoNovo = mysqli_query($conexao, "SELECT idTopico, slug FROM topico WHERE slug = '$slug'");
            while($row = mysqli_fetch_array($sqlTopicoNovo)){
                $idTopico = $row['idTopico'];
                $slug = $row['slug'];
            }
            header("Location: verTopico.php?t=$idTopico&pagina=1");
        }
    }
}
?>