<?php
include("../inc/header.php");
if (!isset($_SESSION['usuarioLogado'])) {
    echo "Não existe uma sessão, portanto não pode modificar o topico!";
} else {
    if (isset($_GET['t']) && !empty($_GET['t'])) {
        $idTopico = $_GET['t'];
        $sqlTopico = mysqli_query($conexao, "SELECT usuario, cargo, titulo, conteudo FROM topico INNER JOIN usuario ON topico.idUsuario = usuario.idUsuario WHERE idTopico = '$idTopico'");
        while ($row = mysqli_fetch_array($sqlTopico)) {
            $usuario = $row['usuario'];
            $titulo = utf8_encode($row['titulo']);
            $conteudo = utf8_encode($row['conteudo']);
            $cargo = $row['cargo'];
        }
        if (!$_SESSION['usuarioLogado'] == $usuario) {
            echo "vc n pode editar um topico q n é seu!";
        } else { ?>
            
         <section class="novoTopico col-md-10">
                <form method="POST">
                    <div class="form-group">
                        
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $titulo; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="conteudo" rows="10"><?php echo $conteudo; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-info right">Editar topico</button>
                </form>
            </section>

        <?php }
    }
}
?>