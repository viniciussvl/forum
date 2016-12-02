<?php

include("../inc/header.php");
if (!isset($_SESSION['usuarioLogado'])) {
    echo "Não existe uma sessão, portanto não poderá acessar aqui!";
} else {
    
        
   
?>
    <section class="nova-mp categorias caixa-entrada col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Nova mensagem privada</h3>
            </div>
            <div class="panel-body">
               <form method="POST" action="<?= $url; ?>mp/enviarMsg.php">
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="titulo" name="recebeu" placeholder="Usuário">
                    </div>
                    <div class="form-group col-md-9">
                        <input type="text" class="form-control" id="titulo" name="assunto" placeholder="Assunto">
                    </div>
                    <div class="form-group col-md-12">
                        <textarea class="form-control" name="conteudo" placeholder="conteudo" rows="10"></textarea>
                    </div>
                   <div class="col-md-12">
                    <button type="submit" class="btn btn-info right">Enviar mensagem</button>
                   </div>
               </form>
            </div>
        </div>
    </section>

<?php }
?>

