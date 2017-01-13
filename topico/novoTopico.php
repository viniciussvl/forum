<?php

include("../inc/header.php");
?>

<?php

if (!isset($_SESSION['usuarioLogado'])) {
    echo "Você precisa estar logado para criar um tópico!";
} else {
    if (isset($_GET['id'])) {
        $id = preg_replace("/[^0-9\s]/", "", $_GET['id']);
        $sql = mysqli_query($conexao, "SELECT * FROM topico WHERE idTopico = '$id'");
        if (!mysqli_num_rows($sql) > 1) {
            echo "<div class='col-md-12'>Essa área não existe!</div>";
        } else {
            ?>

            <section class="novoTopico col-md-12">
                <form method="POST" class="col-md-10" action="<?= $url; ?>topico/enviarTopico.php?area=<?php echo $id; ?>">
                    <div class="form-group">
                        <label for="titulo">Título do tópico</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="conteudo" placeholder="conteudo" rows="10"></textarea>
                    </div>

                    <button type="submit" class="btn btn-info right">Criar topico</button>
                </form>

            </section>
            <?php

        }
    }
    ?>


    <?php

}
include("../inc/footer.php");
?>