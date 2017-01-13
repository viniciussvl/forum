<?php
//OR die(mysqli_error($conexao));

include("../config.php");
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idArea = $_GET['id'];
    $sqlArea = mysqli_query($conexao, "SELECT nomeArea FROM area WHERE idArea = '$idArea'");
    while ($row = mysqli_fetch_array($sqlArea)) {
        $nomeArea = utf8_encode($row['nomeArea']);
    }

    $ordenar = "posts.dataPost DESC";

// FILTRO
    if (isset($_GET['filtro'])) {
        $filtro = $_GET['filtro'];
        switch ($filtro) {
            case ('views'):
                $ordenar = "visualizacoes DESC";
                break;
            case ('autor'):
                $ordenar = "Autor DESC";
                break;
            case ('titulo'):
                $ordenar = "topico.titulo ASC";
                break;
        }
    }

    $sqlTopicos = mysqli_query($conexao, "SELECT topico.titulo, topico.idTopico, topico.idUsuario, topico.idUsuario AS 'Autor', usuario.usuario, posts.idUsuario AS 'Postador', corGrupo AS 'corPostador', grupo.corGrupo AS 'corAutor', posts.dataPost, status, visualizacoes, qtdPosts
                            FROM topico 
                            LEFT JOIN (SELECT * FROM posts ORDER BY dataPost DESC) posts
                                ON topico.idTopico = posts.idTopico
                            LEFT JOIN usuario
                                ON posts.idUsuario = usuario.idUsuario
                            LEFT JOIN grupo
                                ON usuario.idGrupo = grupo.idGrupo
                            WHERE posts.idArea = '$idArea' OR topico.idArea = '$idArea'
                            GROUP BY titulo
                            ORDER BY $ordenar");
    
    /* Paginação */
    if (mysqli_num_rows($sqlTopicos) > 0) {
        $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
        $total = mysqli_num_rows($sqlTopicos);
        $registros = 10;
        $numPaginas = ceil($total / $registros);
        $inicio = ($registros * $pagina) - $registros;
        $sqlTopicos = mysqli_query($conexao, "SELECT topico.titulo, topico.idTopico, topico.idUsuario, topico.idUsuario AS 'Autor', usuario.usuario, posts.idUsuario AS 'Postador', corGrupo AS 'corPostador', grupo.corGrupo AS 'corAutor', posts.dataPost, status, visualizacoes, qtdPosts
                            FROM topico 
                            LEFT JOIN (SELECT * FROM posts ORDER BY dataPost DESC) posts
                                ON topico.idTopico = posts.idTopico
                            LEFT JOIN usuario
                                ON posts.idUsuario = usuario.idUsuario
                            LEFT JOIN grupo
                                ON usuario.idGrupo = grupo.idGrupo
                            WHERE posts.idArea = '$idArea' OR topico.idArea = '$idArea'
                            GROUP BY titulo 
                            ORDER BY $ordenar
                            LIMIT $inicio, $registros");
        
        $total = mysqli_num_rows($sqlTopicos);
        if (isset($_GET['pagina']) && $_GET['pagina'] > $numPaginas || $_GET['pagina'] <= 0) {
            header("Location: verTopicos.php?id=$idArea&pagina=1");
        }
    }
// Total de Tópicos
    $totalTopicos = mysqli_query($conexao, "SELECT count(*) AS qtd FROM topico WHERE idArea = '$idArea'");
    while ($row = mysqli_fetch_array($totalTopicos)) {
        $totTopicos = $row['qtd'];
    }
    
    include("../inc/header.php");
    ?>

    <div class="fundo-branco">
        <ol class="breadcrumb">
            <li><a href="<?= $url; ?>">Fórum</a></li>
            <li class="active"><?php echo $nomeArea; ?></li>
        </ol>

        <!-- Sistema de Filtrar resultados -->
        <div class="col-md-6">
            <form method="GET" class="form-inline">
                <input type="hidden" name="id" value="<?php echo $idArea; ?>">
                <div class="form-group">
                    <label for="listarPor">Listar por:</label>
                    <select name="filtro" class="form-control" onchange="this.form.submit()">
                        <option>Selecione</option>
                        <option value="views">Visualizações</option>
                        <option value="autor">Usuário</option>
                        <option value="respostas">Respostas</option>
                        <option value="titulo">Título</option>
                    </select>
                </div>
            </form>
        </div>
        <?php
        if (isset($_SESSION['usuarioLogado'])):
            ?>
            <div class="botoes-topico col-md-3">
                <a href="<?= $url; ?>topico/novoTopico.php?id=<?php echo $idArea; ?>&acao=novoTopico"><img src="<?= $url; ?>img/novo-topico.png"></a>
            </div>
            <?php
        endif;
        ?>
        <div class="clearfix"></div>
        <div class="panel panel-default topicos">
            <div class="panel-heading">
                <h3 class="panel-title">Tópicos [ <?php echo $totTopicos; ?> ]</h3>
            </div>
            <div class="panel-body">
                <table class="tabela-topicos table">
                    <thead>
                    <th>Tópicos</th>
                    <th>Respostas</th>
                    <th>Visualizações</th>
                    <th>Última mensagem</th>
                    </thead>




                    <?php
                    while ($row = mysqli_fetch_array($sqlTopicos)):

                        $consulta = mysqli_query($conexao, "SELECT usuario FROM usuario WHERE idUsuario = '{$row['Autor']}'");
                        while ($k = mysqli_fetch_array($consulta)) {
                            $ultimoPost = $k['usuario'];
                        }
                        $idTopico = $row['idTopico'];
                        $titulo = utf8_encode($row['titulo']);
                        $idAutor = $row['idUsuario'];
                        $autor = utf8_encode($row['usuario']);
                        $idPostador = $row['Postador'];
                        $dataPost = $row['dataPost'];
                        $dataFormatada = date('d/m/Y H:i', strtotime($dataPost));
                        $views = $row['visualizacoes'];
                        $qtdPosts = $row['qtdPosts'];
                        $status = $row['status'];
                        $corPostador = $row['corPostador'];
                        ?>

                        <tbody>
                        <td> 
                            <?php
                                if($status == 1){
                                    echo "<img src='{$url}img/unlock.png'>";
                                } else{
                                    echo "<img src='{$url}img/lock.png' title='Topico bloqueado'>";
                                }
                            ?>
                            <a class="titulo-topico" href="<?= $url; ?>topico/verTopico.php?t=<?php echo $idTopico; ?>&pagina=1"><?php echo $titulo; ?></a> por <a href="<?= $url; ?>perfil/verPerfil.php?id=<?= $idAutor; ?>" style="color: <?= $corPostador; ?>"><?php echo $ultimoPost; ?></a>  
                        </td>
                        <td> <?php echo $qtdPosts; ?> </td>
                        <td> <?php echo $views; ?> </td>
                        <?php if ($autor): ?>

                            <td> em <?= $dataPost; ?> - <a href="<?= $url; ?>perfil/verPerfil.php?id=<?= $idPostador; ?>"><span style='color:<?= $corPostador; ?>'><?= $autor; ?></span></a></td>
                                <?php else: ?>
                            <td></td>
                        <?php endif; ?>
                        </tbody> 

                        <?php
                    endwhile;
                    ?>

                </table>

            </div>
                    <div id="pages">
                        <ul>
                            <?php
                                if (isset($_GET['pagina']) && $_GET['pagina'] > 1) {
                                    $pagAnterior = $pagina - 1;
                                    echo "<li><a href='{$url}topico/verTopicos.php?id=$idArea&pagina=$pagAnterior'>« Página anterior</a></li>";
                                } else{
                                    echo "<li class='nolink'>« Página anterior</li>";
                                } 
                                if (mysqli_num_rows($sqlTopicos) > 0) {
                                for ($i = 1; $i < $numPaginas + 1; $i++) {
                                    if($_GET['pagina'] == $i){
                                       echo "<li class='current'>" . $i . "</li> ";   
                                    } else{
                                        echo "<li><a href='{$url}topico/verTopicos.php?id=$idArea&pagina=$i'>" . $i . "</a></li> ";
                                    }
                                }
                                if (isset($_GET['pagina']) && $_GET['pagina'] < $numPaginas) {
                                    $proxPagina = $pagina + 1;
                                    echo "<li><a href='{$url}topico/verTopicos.php?id=$idArea&pagina=$proxPagina'>Próxima página »</a></li>";
                                } else{
                                   echo "<li class='nolink'>Próxima página »</li>"; 
                                }
                            }
                            ?>
                            
                            
                        </ul>
                    </div>
        </div>

    </div>


    <?php
} else {
    echo "Nenhum parametro foi passado no ID!";
}
include("../inc/footer.php");
?>