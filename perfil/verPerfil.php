<?php
if(!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])){
    header("Location: ../index.php");
}

include("../inc/header.php");

$idPerfil = preg_replace("/[^a-zA-Z0-9]/", "", $_GET['id']);

$query = mysqli_query($conexao, "SELECT usuario, nome, sexo, frase, slug, localizacao, nomeRanking, humor, time, comida, corGrupo, desenho, emprego, skype, dataInscricao, dataNascimento 
                                 FROM usuario 
                                 INNER JOIN grupo
                                    ON usuario.idGrupo = grupo.idGrupo
                                 INNER JOIN ranking
                                    ON usuario.idRanking = ranking.idRanking
                                 WHERE idUsuario = '$idPerfil'");

if(!mysqli_num_rows($query) > 0){
    echo "Não existe usuario com esse ID";
} else{



while($row = mysqli_fetch_array($query)){
    $usuario = $row['usuario'];
    $sexo = $row['sexo'];
    $nome = $row['nome'];
    $frase = $row['frase'];
    $localizacao = $row['localizacao'];
    $humor = $row['humor'];
    $comida = $row['comida'];
    $desenho = $row['desenho'];
    $emprego = $row['emprego'];
    $ranking = $row['nomeRanking'];
    $time = $row['time'];
    $di = $row['dataInscricao'];
    $dn = $row['dataNascimento'];
    $slugUsuario = $row['slug'];
    $dataInscricao = date('d/m/Y', strtotime($di));
    $dataNascimento = date('d/m/Y', strtotime($dn));
    $corGrupo = $row['corGrupo'];
}

$data = getDate();
$anoAtual = $data['year'];
$anoNascimento = date('Y', strtotime($dn));


// Total de Posts
$msg = mysqli_query($conexao, "SELECT count(*) AS 'totMsg' FROM posts WHERE idUsuario = '$idPerfil'");
while($row = mysqli_fetch_array($msg)){
    $totMsg = $row['totMsg'];
}

// Total de Tópicos
$tpc = mysqli_query($conexao, "SELECT count(*) AS 'totTpc' FROM topico WHERE idUsuario = '$idPerfil'");
while($row = mysqli_fetch_array($tpc)){
    $totTpc = $row['totTpc'];
}

// Posts + Topicos 
$totalMsg = $totMsg + $totTpc;
?>

<div class="fundo-branco col-md-12">
    <section class="categorias col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Tudo sobre <span style="color: <?= $corGrupo; ?>"><strong><?= $usuario; ?></strong></span></h3>
            </div>
            <div class="panel-body ver-perfil">
                <table class="table">
                    <tr>
                        <th>Sexo:</th>
                        <td><?= $sexo; ?></td>
                    </tr>
                    <tr>
                        <th>Mensagens:</th>
                        <td><?= $totalMsg; ?></td>
                    </tr>
                    <tr>
                        <th>Reputação:</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>Nome completo:</th>
                        <td><?= $nome; ?></td>
                    </tr>
                    <tr>
                        <th>Data de inscrição:</th>
                        <td><?= $dataInscricao; ?></td>
                    </tr>
                    <tr>
                        <th>Data de nascimento:</th>
                        <td><?= $dataNascimento; ?></td>
                    </tr>
                    <tr>
                        <th>Idade:</th>
                        <td><?= $anoAtual - $anoNascimento; ?></td>
                    </tr>
                    <tr>
                        <th>Localização:</th>
                        <td><?= $localizacao; ?></td>
                    </tr>
                    <tr>
                        <th>Time do coração:</th>
                        <td><?= $time; ?></td>
                    </tr>
                    <tr>
                        <th>Desenho preferido:</th>
                        <td><?= $desenho; ?></td>
                    </tr>
                    <tr>
                        <th>Comida preferida:</th>
                        <td><?= $comida; ?></td>
                    </tr>
                    <tr>
                        <th>Emprego/Lazer:</th>
                        <td><?= $emprego; ?></td>
                    </tr>
                    <tr>
                        <th>Frase:</th>
                        <td><?= $frase; ?></td>
                    </tr>
                    <tr>
                        <th>Humor:</th>
                        <td><?= $humor; ?></td>
                    </tr>
                    <tr>
                        <th>Gerenciar o usuário:</th>
                        <td><a href="#">Perfil</a> - <a href="#">Banir esse membro</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
    <aside class="col-md-4">
        <div class="widget widget-perfil">
            <h2><span style="color: <?= $corGrupo; ?>"><strong><?= $usuario; ?></strong></span></h2>
            <img src="<?= $url; ?>img/uploads/perfil/<?= $slugUsuario; ?>.jpg" width="200">
            <p>Rank: <?= $ranking; ?></p>
        </div>
    </aside>
</div>

<?php
}

include("../inc/footer.php");
?>