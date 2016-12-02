<?php
error_reporting(0);
session_start();
include("../config.php");


if (!isset($_SESSION['usuarioLogado'])) {
    header("Location: ../index.php");
} else {
    if(!isset($_GET['id']) || empty($_GET['id'])){
        header("Location: index.php");
    } else{
        include("../inc/header.php");
        $id = $_GET['id'];
        $idUser = $_SESSION['idUsuario'];
        $sqlEnviou = mysqli_query($conexao, "SELECT assunto, conteudoMsg, usuario, slug, dataMsg, visualizou 
                                             FROM mensagem 
                                             INNER JOIN usuario 
                                                ON mensagem.idEnviou = usuario.idUsuario 
                                             WHERE idMsg = '$id' AND idRecebeu = '$idUser'");
        
        while($row = mysqli_fetch_array($sqlEnviou)){
            $slug = $row['slug'];
            $assunto = utf8_encode($row['assunto']);
            $conteudo = utf8_encode($row['conteudoMsg']);
            $usuario = $row['usuario'];
            $visualizou = $row['visualizou'];
            $dataMsg = utf8_encode($row['dataMsg']);
        }
            if($visualizou == 0){
                $update = mysqli_query($conexao, "UPDATE mensagem SET visualizou = 1 WHERE idMsg = '$id'");            
            }
            ?>

            <section class="mensagem-privada categorias caixa-entrada col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $usuario . " - " . $assunto; ?></h3>
            </div>
            <div class="panel-body">
                <div class="usuario-mp left col-md-2">
                    <img src="<?= $url . 'img/uploads/perfil/' . $slug . '.jpg'?>">
                </div>
                <div class="conteudo-mp left col-md-10">
                    <span>Enviado <?php echo $dataMsg; ?></span>
                    <p><?php echo $conteudo; ?></p>
                </div>
            </div>
        </div>
    </section>
<?php        
            
        
        
        
    }
  
?>
    

<?php }
?>

