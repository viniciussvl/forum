<?php
include("../inc/header.php");
?>

<?php
if (!isset($_SESSION['usuarioLogado'])) {
    echo "Você precisa estar logado para criar um tópico!";
} else {
    if (isset($_GET['t']) && !empty($_GET['t'])) {
        $id = preg_replace("/[^0-9\s]/", "", $_GET['t']);
        $sql = mysqli_query($conexao, "SELECT titulo, topico.idArea FROM topico INNER JOIN area ON topico.idArea = area.idArea WHERE idTopico = '$id'");
        if (!mysqli_num_rows($sql) > 0) {
            echo "O tópico que você deseja postar não existe!";
        } else {
            while($row = mysqli_fetch_array($sql)){
                $titulo = $row['titulo'];
                $idArea = $row['idArea'];
            }
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Respondendo o tópico <strong><?php echo $titulo; ?></strong></h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="enviarPost.php?t=<?php echo $id; ?>&area=<?php echo$idArea; ?>">
                        
                        <div class="form-group">
                            <textarea class="form-control" name="conteudo" placeholder="Escreva o que deseja responder" rows="10"></textarea>
                        </div>

                        <button type="submit" class="btn btn-info right">Responder tópico</button>
                    </form>
                </div>
            </div>
        <?php }
        ?>



        <?php
    }
}
?>


<?php
include("../inc/footer.php");
?>