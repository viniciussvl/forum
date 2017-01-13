<?php
include("../config.php");
session_start();
error_reporting(0);
if (isset($_GET['t']) && !empty($_GET['t'])) {
    $idTopico = $_GET['t'];
    $sqlTopico = mysqli_query($conexao, "SELECT idTopico, usuario.idUsuario, usuario.slug, titulo, usuario, conteudo, topico.idArea, nomeArea, dataPost, topico.status, visualizacoes, corGrupo, nomeRanking
            FROM topico 
            INNER JOIN area 
                ON topico.idArea = area.idArea 
            INNER JOIN usuario 
                ON topico.idUsuario = usuario.idUsuario 
            INNER JOIN grupo
                ON usuario.idGrupo = grupo.idGrupo
            INNER JOIN ranking
                ON usuario.idRanking = ranking.idRanking
            WHERE idTopico = '$idTopico'");

    $contaLinhas = mysqli_num_rows($sqlTopico);
    if (!$contaLinhas > 0) {
        header("Location: ../index.php");
    }
    while ($row = mysqli_fetch_array($sqlTopico)) {
        $idTopico = $row['idTopico'];
        $idAutor = $row['idUsuario'];
        $titulo = utf8_encode($row['titulo']);
        $conteudo = utf8_encode($row['conteudo']);
        $views = intval($row['visualizacoes']);
        $dataPost = $row['dataPost'];
        $idArea = $row['idArea'];
        $donoTopico = $row['usuario'];
        $slugTopico = $row['slug'];
        $status = $row['status'];
        $nomeArea = utf8_encode($row['nomeArea']);
        $corAutor = $row['corGrupo'];
        $rankingAutor = $row['nomeRanking'];
    }
    $contador = $views + 1;
    $addViews = mysqli_query($conexao, "UPDATE topico SET visualizacoes = '$contador' WHERE idTopico = '$idTopico'");

    $posts = mysqli_query($conexao, "SELECT * FROM posts WHERE idTopico = '$idTopico'");

    if (mysqli_num_rows($posts) > 0) {
        $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
        $total = mysqli_num_rows($posts);
        //var_dump($total);
        $registros = 2;
        $numPaginas = ceil($total / $registros);
        $inicio = ($registros * $pagina) - $registros;
        $posts = mysqli_query($conexao, "SELECT usuario, slug, conteudoPost, corGrupo, nomeRanking, posts.idUsuario, dataPost 
                                         FROM posts 
                                         INNER JOIN usuario 
                                            ON posts.idUsuario = usuario.idUsuario  
                                         INNER JOIN grupo
                                            ON usuario.idGrupo = grupo.idGrupo
                                         INNER JOIN ranking
                                            ON usuario.idRanking = ranking.idRanking
                                         WHERE idTopico = '$idTopico' LIMIT $inicio, $registros");
        $total = mysqli_num_rows($posts);
        if (isset($_GET['pagina']) && $_GET['pagina'] > $numPaginas || $_GET['pagina'] <= 0) {
            header("Location: verTopico.php?t=$idTopico&pagina=1");
        }
    }

    $totalPosts = mysqli_query($conexao, "SELECT * FROM posts WHERE idUsuario = '$idAutor'");
    $totalTopicos = mysqli_query($conexao, "SELECT * FROM topico WHERE idUsuario = '$idAutor'");
    $totalMsg = mysqli_num_rows($totalPosts) + mysqli_num_rows($totalTopicos);
}

// Bloquear ou desbloquear tópicos
if ($_SESSION['verificaAdmin'] == 1) {
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'bloqueado') {
            $bloquear = mysqli_query($conexao, "UPDATE topico SET status = 0 WHERE idTopico = '$idTopico'");
            header("Location: verTopico.php?t=$idTopico&pagina=1");
        } else {
            $desbloquear = mysqli_query($conexao, "UPDATE topico SET status = 1 WHERE idTopico = '$idTopico'");
            header("Location: verTopico.php?t=$idTopico&pagina=1");
        }
    }
}

include("../inc/header.php");

if ($ativarDebugador == 1) {
    foreach ($totalMsg as $k):
        echo "<pre>";
        var_dump($k);
    endforeach;
}
?>
<div class="fundo-branco">
    <ol class="breadcrumb">
        <li><a href="<?= $url; ?>">Fórum</a></li>
        <li><a href="<?= $url; ?>/topico/verTopicos.php?id=<?php echo $idArea; ?>"><?php echo $nomeArea; ?></a></li>
        <li class="active"><?php echo $titulo; ?></li>
    </ol>

    <!-- PAGINAÇÃO -->
    <div class="left col-md-6">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php
                if (isset($_GET['pagina']) && $_GET['pagina'] > 1) {
                    $pagAnterior = $pagina - 1;
                    echo "<li><a href='$url/topico/verTopico.php?t=$idTopico&pagina=$pagAnterior' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
                }
                if (mysqli_num_rows($posts) > 0) {
                    for ($i = 1; $i < $numPaginas + 1; $i++) {
                        if ($_GET['pagina'] == $i) {
                            echo "<li class='active'><a href='$url/topico/verTopico.php?t=$idTopico&pagina=$i'>" . $i . "</a></li> ";
                        } else {
                            echo "<li><a href='$url/topico/verTopico.php?t=$idTopico&pagina=$i'>" . $i . "</a></li> ";
                        }
                    }
                    if (isset($_GET['pagina']) && $_GET['pagina'] < $numPaginas) {
                        $proxPagina = $pagina + 1;
                        echo "<li><a href='$url/topico/verTopico.php?t=$idTopico&pagina=$proxPagina' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
                    }
                }
                ?>
            </ul>
        </nav>
    </div>

    <!-- BOTÕES NOVO TOPICO / RESPONDER TOPICO / BLOQUEAR TOPICO -->
    <?php
    if (isset($_SESSION['usuarioLogado'])):
        ?>
        <div class="botoes-topico col-md-3">
            <?php
                if($status == 1){
                    echo "<a href='{$url}topico/novoPost.php?t=$idTopico&area=$idArea;'><img src='{$url}img/responder.png'></a>";
                } else{
                    echo "<a href='{$url}topico/novoPost.php?t=$idTopico&area=$idArea'><img src='{$url}img/bloqueado.png'></a>";
                }
            ?>
            
            <a href="<?= $url; ?>topico/novoTopico.php?id=<?php echo $idArea; ?>"><img src="<?= $url; ?>img/novo-topico.png" alt=""></a> 

        </div>
        <?php
    endif;
    ?>
    <div class="clearfix"></div>

    <!-- TOPICO -->
    <div class="topico">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $titulo; ?></h3>
            </div>

            <?php
            if (isset($_GET['pagina']) && $_GET['pagina'] == 1) {
                ?>
                <div class="barra-topico">
                    <a href="<?= $url; ?>perfil/verPerfil.php?id=<?= $idAutor; ?>"><span style="color:<?= $corAutor ?> ;"><?php echo $donoTopico; ?></span></a>
                </div>
                <div class="panel-body">
                    <div class="user-info col-md-3">

                        <img src="<?= $url; ?>img/uploads/perfil/<?= $slugTopico; ?>.jpg" alt="..." height="250" width="170"><br>
                        <span><?= $rankingAutor; ?></span>
                        <p>Mensagens: <?= $totalMsg; ?>
                            <br>Reputação: 0
                        </p>
                    </div>
                    <p class="data-topico col-md-4">Postado <?php echo $dataPost; ?></p>
                    <div class="conteudo-topico col-md-9">

                        <p><?php echo $conteudo; ?></p>
                    </div>

                    <?php
                    if (isset($_SESSION['usuarioLogado']))
                        if ($_SESSION['usuarioLogado'] == $usuario):
                            ?>
                            <div class="right botoes-editar-topico">
                                <a href="<?= $url; ?>topico/editarTopico.php?t=<?php echo $idTopico; ?>" class="btn btn-info">Editar</a>
                                <a href="#" class="btn btn-info">Quote</a>
                            </div>
                            <?php
                        









                    endif;
                    ?>
                </div>
<?php } ?>


            <!--            <div class="separador"></div>-->

            <?php
            while ($row = mysqli_fetch_array($posts)):
                $conteudoPost = utf8_encode($row['conteudoPost']);
                $usuarioPost = $row['usuario'];
                $postData = utf8_encode($row['dataPost']);
                $idPostador = $row['idUsuario'];
                $slugPost = $row['slug'];
                $corPostador = $row['corGrupo'];
                $rankingPostador = $row['nomeRanking'];

                $tPosts = mysqli_query($conexao, "SELECT * FROM posts WHERE idUsuario = '$idPostador'");
                $tTopicos = mysqli_query($conexao, "SELECT * FROM topico WHERE idUsuario = '$idPostador'");
                $totMsgPostador = mysqli_num_rows($tPosts) + mysqli_num_rows($tTopicos);
                ?>
                <div class="barra-topico">
                    <a href="<?= $url; ?>perfil/verPerfil.php?id=<?= $idPostador; ?>"><span style="color:<?= $corPostador ?> ;"><?php echo $usuarioPost; ?></span></a>
                </div>
                <div class="panel-body">
                    <div class="user-info col-md-3">
                        <img src="<?= $url; ?>img/uploads/perfil/<?= $slugPost; ?>.jpg" alt="..." height="250" width="170">
                        <span><?= $rankingPostador; ?></span>
                        <p>Mensagens: <?= $totMsgPostador; ?>
                            <br>Reputação: 0
                        </p>
                    </div>
                    <p class="data-topico col-md-4">Postado <?php echo $postData; ?></p>
                    <div class="conteudo-topico col-md-9">
                        <p><?php echo $conteudoPost; ?></p>
                    </div>
                    <?php
                    if (isset($_SESSION['usuarioLogado']))
                        if ($_SESSION['idUsuario'] == $idPostador):
                            ?>
                            <div class="right botoes-editar-topico">
                                <a href="editarTopico.php?t=<?php echo $idTopico; ?>" class="btn btn-info">Editar</a>
                                <a href="#" class="btn btn-info">Quote</a>
                            </div>
                            <?php
                        


                    endif;
                    ?>
                </div>
                <div class="separador"></div>
                <?php
            endwhile;
            ?>

            <div class="menu-moderacao">
                <?php
                if ($status == 1) {
                    echo "<a href='{$url}topico/verTopico.php?t=$idTopico&pagina=1&status=bloqueado'><img src='https://cdn1.iconfinder.com/data/icons/nuove/128x128/actions/lock.png' width=40></a>";
                } else {
                    echo "<a href='{$url}topico/verTopico.php?t=$idTopico&pagina=1&status=desbloqueado'><img src='https://cdn1.iconfinder.com/data/icons/nuove/128x128/actions/unlock.png' width=40></a>";
                }
                ?>
                <a href="#"><i class="glyphicon glyphicon-remove" style='color: red;'></i></a>
                <a href="#"><i class="glyphicon glyphicon-log-in" style='color: green;'></i></a>
            </div>
        </div>

    </div>
    <?php
    if (isset($_SESSION['usuarioLogado'])):
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Resposta rápida</h3>
            </div>
            <div class="panel-body">
                <form method="POST" action="enviarPost.php?t=<?php echo $idTopico; ?>&area=<?php echo$idArea; ?>">

                    <div class="form-group">
                        <textarea class="form-control" name="conteudo" placeholder="Escreva o que deseja responder" rows="10"></textarea>
                    </div>

                    <button type="submit" class="btn btn-info right">Responder tópico</button>
                </form>
            </div>
        </div>
        <?php
    endif;
    ?>

</div>
<?php
include("../inc/footer.php");
?>