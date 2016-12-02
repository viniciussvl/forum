<?php
session_start();
error_reporting(0);
include("../config.php");
if (!isset($_SESSION['usuarioLogado'])) {
    header("Location: index.php");
    echo "Não existe sessão, portanto nada será exibido!";
} else {
    $idUsuario = $_SESSION['idUsuario'];
    $sqlMps = mysqli_query($conexao, "SELECT * FROM mensagem
                                      WHERE idEnviou = '$idUsuario'");
    
    /* Paginação */
    if (mysqli_num_rows($sqlMps) > 0) {
        $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
        $total = mysqli_num_rows($sqlMps);
        $registros = 10;
        $numPaginas = ceil($total / $registros);
        $inicio = ($registros * $pagina) - $registros;
        $sqlMps = mysqli_query($conexao, "SELECT idMsg, assunto, usuario, dataMsg, visualizou 
                                       FROM mensagem 
                                       INNER JOIN usuario 
                                        ON mensagem.idRecebeu = usuario.idUsuario 
                                       WHERE idEnviou = '$idUsuario' ORDER BY idMsg DESC LIMIT $inicio, $registros");
        $total = mysqli_num_rows($sqlMps);
        if (isset($_GET['pagina']) && $_GET['pagina'] > $numPaginas || $_GET['pagina'] <= 0) {
            header("Location: msgEnviadas.php?pagina=1");
        }
    }
    include("../inc/header.php");
    
    
    ?>

    <div class="fundo-branco col-md-12">

        <?php
        include("menuMp.php");
        ?>
        <section class="categorias caixa-entrada col-md-9">  
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Mensagens enviadas</h3>
                </div>
                <div class="panel-body">
                    <ul>    

                        <?php
                        while ($row = mysqli_fetch_array($sqlMps)):
                            $idMsg = $row['idMsg'];
                            $assunto = utf8_encode($row['assunto']);
                            $usuario = $row['usuario'];
                            $visualizou = $row['visualizou'];
                            $dataMsg = utf8_encode($row['dataMsg']);
                            ?>
                            <li>
                                <span><a <?php if ($visualizou == 0) {
                        echo "class='negrito'";
                    } ?> href="visualizarMp.php?id=<?php echo $idMsg; ?>"><?php echo substr($assunto, 0, 30); ?></a>   para <strong><?php echo $usuario; ?></strong> - <?php echo $dataMsg; ?></span>

                            </li>

                            <?php
                        endwhile;
                        ?>

                    </ul>
                </div>
                
                <div class="panel-footer">
                    <div id="pages">
                        <ul>
                            <?php
                                if (isset($_GET['pagina']) && $_GET['pagina'] > 1) {
                                    $pagAnterior = $pagina - 1;
                                    echo "<li><a href='$url/mp/msgEnviadas.php?pagina=$pagAnterior'>« Página anterior</a></li>";
                                } else{
                                    echo "<li class='nolink'>« Página anterior</li>";
                                } 
                                if (mysqli_num_rows($sqlMps) > 0) {
                                for ($i = 1; $i < $numPaginas + 1; $i++) {
                                    if($_GET['pagina'] == $i){
                                       echo "<li class='current'>" . $i . "</li> ";   
                                    } else{
                                        echo "<li><a href='$url/mp/msgEnviadas.php?pagina=$i'>" . $i . "</a></li> ";
                                    }
                                }
                                if (isset($_GET['pagina']) && $_GET['pagina'] < $numPaginas) {
                                    $proxPagina = $pagina + 1;
                                    echo "<li><a href='$url/mp/msgEnviadas.php?pagina=$proxPagina'>Próxima página »</a></li>";
                                } else{
                                   echo "<li class='nolink'>Próxima página »</li>"; 
                                }
                            }
                            ?>
                            
                            
                        </ul>
                    </div>
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
    </div>

    <?php
}
include("../inc/footer.php");
?>