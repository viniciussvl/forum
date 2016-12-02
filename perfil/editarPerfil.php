<?php
session_start();
$usuario = $_SESSION['usuarioLogado'];
include("../config.php");
include("../inc/slug.php");
$idUsuario = $_SESSION['idUsuario'];
    if(!isset($_SESSION['usuarioLogado'])){
        header("Location: index.php");
    } else{
        if(!isset($_POST['nome'])        || 
           !isset($_POST['localizacao']) ||
           !isset($_POST['frase'])       ||
           !isset($_POST['humor'])       ||
           !isset($_POST['comida'])      ||
           !isset($_POST['desenho'])     ||
           !isset($_POST['emprego'])     ||
           !isset($_POST['skype'])      ){
            header("Location: index.php");
        }
        $nome = $_POST['nome'];
        $localizacao = utf8_decode($_POST['localizacao']);
        $frase = $_POST['frase'];
        $humor = $_POST['humor'];
        $comida = $_POST['comida'];
        $desenho = $_POST['desenho'];
        $emprego = $_POST['emprego'];
        $skype = $_POST['skype'];
        $slug = slug($usuario);
        
        rename("img/uploads/perfil/{$slug}.jpg", "img/uploads/perfil/{$slug}.jpg"); 
                if(!empty($_FILES['arquivo']['name'])){
                    if(file_exists("{$url}img/uploads/perfil/{$slug}.jpg")){
                        unlink("{$url}img/uploads/perfil/{$slug}.jpg");
                    }
                    include("../inc/upload-imagem.php");
                    move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final);
                }
                
        $update = mysqli_query($conexao, "UPDATE usuario SET slug = '$slug', nome = '$nome', localizacao = '$localizacao', frase = '$frase', humor = '$humor', comida = '$comida', desenho = '$desenho', emprego = '$emprego', skype = '$skype' WHERE idUsuario = '$idUsuario'");
        header("Location: meuPerfil.php?alterado=true");
        
    }