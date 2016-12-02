<?php
include("inc/header.php");


?>
<div class="menu-lateral col-md-3">
    <h3><i class='glyphicon glyphicon-wrench'></i> Fórum</h3>
    <ul>
        <a href="<?= $url;?>admin/geral.php?opcao=configForum"><li>Configuração</li></a>
        <a href="<?= $url;?>admin/geral.php?opcao=categorias"><li>Categorias e áreas</li></a>
        <a href="<?= $url;?>admin/geral.php?opcao=seguranca"><li>Segurança</li></a>
        <a href="<?= $url;?>admin/geral.php?opcao=cancelamento"><li>Cancelamento do fórum</li></a>
        <a href="<?= $url;?>admin/geral.php?opcao=outros"><li>Outros links</li></a>
    </ul>
    
    <h3><i class='glyphicon glyphicon-wrench'></i> Mensagens e e-mails</h3>
    <ul>
        <a href="<?= $url;?>admin/geral.php?opcao=configMsg"><li>Configuração</li></a>
        <a href="<?= $url;?>admin/geral.php?opcao=mp"><li>Mensagens privadas</li></a>
        <a href="<?= $url;?>admin/geral.php?opcao=emails"><li>E-mails e contato</li></a>
        <a href="<?= $url;?>admin/geral.php?opcao=anuncios"><li>Anúncios</li></a>
        <a href="<?= $url;?>admin/geral.php?opcao=anexos"><li>Anexos</li></a>
    </ul>
    
    <h3><i class='glyphicon glyphicon-wrench'></i> Promoção do fórum</h3>
    <ul>
        <a href="<?= $url;?>admin/geral.php?opcao=configMsg"><li>Convidar amigos</li></a>
        <a href="<?= $url;?>admin/geral.php?opcao=mp"><li>Motores de busca</li></a>
        <a href="<?= $url;?>admin/geral.php?opcao=emails"><li>Troca de tráfego</li></a>
    </ul>
    
    <h3><i class='glyphicon glyphicon-wrench'></i> Estatísticas e Censura</h3>
    <ul>
        <a href="<?= $url;?>admin/geral.php?opcao=configMsg"><li>Estatísticas do fórum</li></a>
        <a href="<?= $url;?>admin/geral.php?opcao=mp"><li>Censura das palavras</li></a>
        <a href="<?= $url;?>admin/geral.php?opcao=emails"><li>Censura dos nomes de usuário</li></a>
    </ul>
</div>

<div class="conteudo col-md-9">
    <?php
        if(isset($_GET['opcao']) && $_GET['opcao'] == "configForum"){
            include("geral/configForum.php");
        } elseif(isset($_GET['opcao']) && $_GET['opcao'] == "categorias"){
            include("geral/categorias.php");
        } elseif(isset($_GET['opcao']) && $_GET['opcao'] == "seguranca"){
            include("geral/seguranca.php");
        } elseif(isset($_GET['opcao']) && $_GET['opcao'] == "cancelamento"){
            include("geral/cancelamento.php");
        } elseif(isset($_GET['opcao']) && $_GET['opcao'] == "outros"){
            include("geral/outros.php");
        } elseif(isset($_GET['opcao']) && $_GET['opcao'] == "configMsg"){
            include("geral/configMsg.php");
        }elseif(isset($_GET['opcao']) && $_GET['opcao'] == "mp"){
            include("geral/mp.php");
        }elseif(isset($_GET['opcao']) && $_GET['opcao'] == "emails"){
            include("geral/emails.php");
        }elseif(isset($_GET['opcao']) && $_GET['opcao'] == "anuncios"){
            include("geral/anuncios.php");
        }elseif(isset($_GET['opcao']) && $_GET['opcao'] == "anexos"){
            include("geral/anexos.php");
        }else{
    ?>
    <h1><i class='glyphicon glyphicon-tint'></i> Geral</h1>
    <p>Nesta aba, você poderá administrar todas as <strong>opções gerais</strong> do seu fórum. Configure o seu fórum de acordo com seus próprios parâmetros e objetivos. Informe seus usuários enviando newsletters ou dialogando diretamente com os membros do seu fórum.  </p>
    <br><br>
     <div class="col-md-6">
        <fieldset>
            <legend>Categorias</legend>
            <table class="tabela table table-bordered table-striped">
                <tr>
                    <th>Nome da categoria</th>
                    <th>Número de áreas</th>
                </tr>
                <?php
                    $sqlCategorias = mysqli_query($conexao, "SELECT * FROM categoria");
                    while($k = mysqli_fetch_array($sqlCategorias)):
                        $nomeCategoria = $k['nomeCategoria'];
                        $query = mysqli_query($conexao, "SELECT count(*) AS 'qtd'
                                                        FROM categoria
                                                        INNER JOIN area
                                                            ON categoria.idCategoria = area.idCategoria
                                                        WHERE categoria.nomeCategoria = '$nomeCategoria'
                                                        ");
                        while($r = mysqli_fetch_array($query)){
                            $nAreas = $r['qtd'];
                        }
                ?>
                <tr>
                    <td><?= $nomeCategoria; ?></td>
                    <td><?= $nAreas;?></td>
                </tr> 
                <?php
                    endwhile;
                ?>
            </table>
        </fieldset>
    </div> 
    <div class="col-md-6">
        <fieldset>
            <legend>Áreas</legend>
            <table class="tabela table table-bordered table-striped">
                <tr>
                    <th>Nome da área</th>
                    <th>Mensagens</th>
                </tr>
                <?php
                    $sqlAreas = mysqli_query($conexao, "SELECT * FROM area");
                    while($r = mysqli_fetch_array($sqlAreas)):
                        $nomeArea = $r['nomeArea'];
                        $query = mysqli_query($conexao, "SELECT *
                                                         FROM topico
                                                         LEFT JOIN posts
                                                            ON topico.idTopico = posts.idTopico
                                                         LEFT JOIN area
                                                            ON topico.idArea = area.idArea
                                                         WHERE nomeArea = '$nomeArea'");
                        
                ?>
                <tr>
                    <td><?= $nomeArea; ?></td>
                    <td><?= mysqli_num_rows($query);?></td>
                </tr> 
                <?php
                    endwhile;
                ?>
            </table>
        </fieldset>
    </div> 
    
    <div class="col-md-12">
        <fieldset>
            <legend>Geral</legend>
            <table class="tabela table table-bordered table-striped">
                <tr>
                    <th>Estatísticas</th>
                    <th>Valor</th>
                    <th>Estatísticas</th>
                    <th>Valor</th>
                </tr>
                <tr>
                    <td>Número de ações administração</td>
                    <td>6000</td>
                    <td>Número de categorias</td>
                    <td>6000</td>
                </tr>
                <tr>
                    <td>Número de ações moderação</td>
                    <td>6000</td>
                    <td>Número de áreas</td>
                    <td>6000</td>
                </tr>
                <tr>
                    <td>Número de palavras censuradas</td>
                    <td>6000</td>
                    <td>Mensagens</td>
                    <td>6000</td>
                </tr>
            </table>
        </fieldset>
    </div>
        <?php 
        
        }?>
</div>
