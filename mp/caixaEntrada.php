<?php
error_reporting(0);
session_start();
include("../config.php");

if (!isset($_SESSION['usuarioLogado'])) {
    header("Location: index.php");
} else {
    $idUsuario = $_SESSION['idUsuario'];
    $sqlMps = mysqli_query($conexao, "SELECT * FROM mensagem 
                                      WHERE idRecebeu = '$idUsuario' AND statusRecebeu = 1");
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
                                        ON mensagem.idEnviou = usuario.idUsuario  
                                       WHERE idRecebeu = '$idUsuario' AND statusRecebeu = 1 ORDER BY idMsg DESC LIMIT $inicio, $registros ");

        $total = mysqli_num_rows($sqlMps);
        if (isset($_GET['pagina']) && $_GET['pagina'] > $numPaginas || $_GET['pagina'] <= 0) {
            header("Location: caixaEntrada.php?pagina=1");
        }
    }

    $visualizado = mysqli_query($conexao, "UPDATE mensagem SET visualizou = 1 WHERE idRecebeu = '$idUsuario'");
    include("../inc/header.php");
    ?>

    <div class="fundo-branco col-md-12">
        <?php
        if (isset($_GET['enviado']) && $_GET['enviado'] == "true") {
            //echo $_SESSION['recebeu'];
            if (isset($_SESSION['recebeu'])) {
                ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Mensagem enviada com sucesso para <strong><?php echo $_SESSION['recebeu']; ?></strong>
                </div>

                <?php
                unset($_SESSION["recebeu"]);
            }
        }
        if (isset($_GET['erro']) && $_GET['erro'] == "igual") {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Você não pode mandar mensagem privada para você mesmo!
            </div>
            <?php
        }
        if (isset($_GET['erro']) && $_GET['erro'] == "inexistente") {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Esse usuário não existe em nosso banco de dados!
            </div> 
    <?php }
    if (isset($_GET['deletado']) && $_GET['deletado'] == "tudo") {
        ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Todas as mensagens foram deletadas!
            </div> 
    <?php }
    if (isset($_GET['deletado']) && $_GET['deletado'] == "selecionado") {
        ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                As mensagens selecionadas foram apagadas!
            </div> 
    <?php }
    if (isset($_GET['erro']) && $_GET['erro'] == "full") {
        ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Esse usuário está com a caixa de entrada lotada, portanto a mensagem não foi enviada!
            </div> 
        <?php }
        if (isset($_GET['erro']) && $_GET['erro'] == "selecionado") {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Nenhuma mensagem foi selecionada!
            </div> 
    <?php }
    ?>
    <?php
    include("menuMp.php");
    ?>
        <section class="categorias caixa-entrada col-md-9">  
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Caixa de entrada</h3>
                </div>
                <div class="panel-body">
                    <ul>
                        <form method="POST" id="formDeletarMsg" action="desativarMp.php">
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
                                } ?> href="<?= $url; ?>mp/visualizarMp.php?id=<?php echo $idMsg; ?>"><?php echo substr($assunto, 0, 30); ?></a>   por <strong><?php echo $usuario; ?></strong> - <?php echo $dataMsg; ?></span>
                                    <div class="right">

                                        <input type="checkbox" class="marcar" name="desativar[]" value="<?php echo $idMsg; ?>">


                                    </div>
                                </li>

        <?php
    endwhile;
    ?>
                        </form>
                    </ul>
                </div>
                <div class="panel-footer">
                    
                    <div id="pages">
                        <ul>
                            <?php
                            if (isset($_GET['pagina']) && $_GET['pagina'] > 1) {
                                $pagAnterior = $pagina - 1;
                                echo "<li><a href='$url/mp/caixaEntrada.php?pagina=$pagAnterior'>« Página anterior</a></li>";
                            } else {
                                echo "<li class='nolink'>«</li>";
                            }
                            if (mysqli_num_rows($sqlMps) > 0) {
                                for ($i = 1; $i < $numPaginas + 1; $i++) {
                                    if ($_GET['pagina'] == $i) {
                                        echo "<li class='current'>" . $i . "</li> ";
                                    } else {
                                        echo "<li><a href='$url/mp/caixaEntrada.php?pagina=$i'>" . $i . "</a></li> ";
                                    }
                                }
                                if (isset($_GET['pagina']) && $_GET['pagina'] < $numPaginas) {
                                    $proxPagina = $pagina + 1;
                                    echo "<li><a href='$url/mp/caixaEntrada.php?pagina=$proxPagina'>Próxima página »</a></li>";
                                } else {
                                    echo "<li class='nolink'>»</li>";
                                }
                            }
                            ?>


                        </ul>
                    </div>
                    <div class="col-md-6 right">
                        <a href="javascript: botaoSubmit()" class="btn btn-primary" onclick="return confirm('Deseja realmente excluir os itens selecionados?')">Excluir selecionado</a>
                        <a href="<?= $url; ?>mp/desativarMp.php?acao=deletarTudo" onclick="return confirm('Deseja realmente excluir todos os itens?')" class="btn btn-primary">Excluir tudo</a>
                        <a id='todos' onclick='marcardesmarcar();' >Selecionar tudo</a>
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