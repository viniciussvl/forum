<?php
include("inc/header.php");


$sqlCategoria = mysqli_query($conexao, "SELECT nomeCategoria FROM categoria WHERE idCategoria = 1");
while ($row = mysqli_fetch_array($sqlCategoria)) {
    $nomeCategoria = utf8_encode($row['nomeCategoria']);
}
$sqlAreas = mysqli_query($conexao, "SELECT idArea, nomeArea, descricao FROM area WHERE idCategoria = 1");
$sqlGrupos = mysqli_query($conexao, "SELECT nomeGrupo, corGrupo FROM grupo");


$msgRegistrado = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Sua conta foi criada com sucesso!
                </div>";

if (isset($_GET['erro']) && $_GET['erro'] == "login") {
    echo "<div class='erro col-md-12'><div class='alert alert-danger col-md-3'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Login ou senha incorretos!
                </div></div>";
}
//$date = date_create($row[0]);
//echo date('Y-m-d H:i:s') . "<br>";

?>

<div class="fundo-branco col-md-12">
    <section class="categorias col-md-9">

        <?php
        if (isset($_GET['cadastrado']) && $_GET['cadastrado'] == "true") {
            echo $msgRegistrado;
        }
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $nomeCategoria; ?></h3>
            </div>
            <div class="panel-body">
                <ul class="ul-categorias">
                    <?php
                    while ($row = mysqli_fetch_array($sqlAreas)):
                        $idArea = $row['idArea'];
                        $nomeArea = utf8_encode($row['nomeArea']);
                        $descricao = utf8_encode($row['descricao']);
                        $totalTopicos = mysqli_query($conexao, "SELECT * FROM topico WHERE idArea = '$idArea'");
                        $tt = mysqli_num_rows($totalTopicos);
                        $totalPosts = mysqli_query($conexao, "SELECT * FROM posts WHERE idArea = '$idArea'");
                        $tp = mysqli_num_rows($totalPosts);
                        
                        $ultimoTopico = mysqli_query($conexao,
                                "SELECT  posts.idTopico, qtdPosts, corGrupo, titulo, posts.idUsuario, usuario, posts.dataPost
                                FROM posts 
                                LEFT JOIN topico 
                                    ON posts.idTopico = topico.idTopico 
                                LEFT JOIN usuario 
                                    ON posts.idUsuario = usuario.idUsuario
                                LEFT JOIN grupo
                                    ON usuario.idGrupo = grupo.idGrupo
                                WHERE posts.idArea = '$idArea' OR topico.idArea = '$idArea'
                                ORDER BY posts.dataPost DESC LIMIT 1");
                        
                        $result = mysqli_num_rows($ultimoTopico);
                        while ($row = mysqli_fetch_array($ultimoTopico)) {
                            $idTopicoRecente = $row['idTopico'];
                            $topicoRecente = utf8_encode($row['titulo']);
                            $nickname = $row['usuario'];
                            $idUsuario = $row['idUsuario'];
                            $corGrupo = $row['corGrupo'];
                            $dataTopico = utf8_encode($row['dataPost']);
                            $dataFormatada = date('d/m/Y H:i', strtotime($dataTopico));
                        }
                        
                        ?>
                        <li class="<?php if($idArea % 2 == 0){ echo "zebra"; } ?>">
                            <a class="titulo-area" href="<?= $url; ?>topico/verTopicos.php?id=<?php echo $idArea; ?>&a=<?php echo $nomeArea; ?>"><?php echo $nomeArea; ?></a>
                            <div class="ultimo-topico right">                           
                                <?php
                                if ($result > 0) {
                                    ?>
                                    <a href="<?= $url; ?>topico/verTopico.php?t=<?php echo $idTopicoRecente;?>"><?php echo substr($topicoRecente, 0, 22) . " "; ?></a> <br>
                                    <?php echo $dataFormatada; ?><br>
                                    <a href="<?= $url; ?>perfil/verPerfil.php?id=<?= $idUsuario; ?>"><span class="nome-color" style="color: <?= $corGrupo;?>;"><?php echo $nickname; ?></span></a>

                                    <?php
                                } else {
                                    echo " ";
                                }
                                ?>
                            </div>
                            <div class="total-topicos-area right">
                                <strong><?php echo $tt; ?></strong> topicos<br>
                                <strong><?php echo $tp; ?></strong> respostas
                            </div>

                            <br><span><?php echo $descricao; ?></span>

                        </li>

                        <?php
                    endwhile;
                    ?>
                </ul>
            </div>
        </div>
                <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Grupos</h3>
            </div>
            <div class="grupos panel-body">
                <?php
                    while($row = mysqli_fetch_array($sqlGrupos)){
                        $nomeGrupo = $row['nomeGrupo'];
                        $corGrupo = $row['corGrupo'];
                        echo "<a href='#'><span class='nome-grupo' style='color: $corGrupo;'>" . $nomeGrupo . "</a>, ";
                    }
                ?>
            </div>
        </div>
    </section>
    <aside class="widgets col-md-3">
        <?php
        while ($row = mysqli_fetch_array($sqlWidgets)):
            $tituloWidget = utf8_encode($row['tituloWidget']);
            $conteudoWidget = utf8_encode($row['conteudoWidget']);
            ?>
            <div class="widget">
                <h2><?php echo $tituloWidget; ?></h2>
                <p><?php echo $conteudoWidget; ?></p>
            </div>
            <?php
        endwhile;
        ?>
    </aside>
    <?php 
        if(isset($_SESSION['verificaAdmin']) && $_SESSION['verificaAdmin'] == 1){
    ?>
    <div class="row">
        <div class="col-md-12">
            <h4 class="link-painel"><a href="<?= $url; ?>admin" target="_blank">Painel de Controle</a></h4>
        </div>
    </div>
    <?php
        }
    ?>
    
</div>

<?php
include("inc/footer.php");
?>