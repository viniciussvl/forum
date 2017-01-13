<?php
if (!isset($_GET['pesquisa']) || empty($_GET['pesquisa'])) {
    header("Location: index.php");
}
$pesquisa = $_GET['pesquisa'];

include("inc/header.php");

$sqlSearch = mysqli_query($conexao, "SELECT idTopico, titulo, usuario, dataPost FROM topico
                                     INNER JOIN usuario
                                        ON topico.idUsuario = usuario.idUsuario
                                     WHERE titulo LIKE '%$pesquisa%'");

//foreach($sqlSearch as $k){
//    echo "<pre>";
//        var_dump($k);   
//}
//die;

if (mysqli_num_rows($sqlSearch) > 0) {
    ?>
    <div class="panel panel-default topicos">
        <div class="panel-heading">
            <h3 class="panel-title"><strong><?= mysqli_num_rows($sqlSearch) ?></strong> Resultados para <strong><?= $pesquisa; ?></strong></h3>
        </div>
        <div class="panel-body">

            <table class="tabela-topicos table">
                <thead>
                <th>Tópicos</th>
                <th>Data</th>
                </thead>

                <?php
                while ($row = mysqli_fetch_array($sqlSearch)):
                    $idTopico = $row['idTopico'];
                    $autor = $row['usuario'];
                    $titulo = $row['titulo'];
                    $data = $row['dataPost'];
                    ?>

                    <tbody>
                    <td><a href="<?= $url; ?>topico/verTopico.php?t=<?= $idTopico; ?>"><?= $titulo; ?></a> por <?= $autor; ?></td>
                    <td><?= $data; ?></td>
                    </tbody>  

                <?php endwhile; ?>
            </table>


        </div>
    </div>
    <?php
} else {
    echo "Lamento, mas não encontramos nada para <strong>" . $pesquisa;
}
?>
<?php
include("inc/footer.php");
?>