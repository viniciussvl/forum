<?php
// Selecionar configuracoes
$sqlConfig = mysqli_query($conexao, "SELECT * FROM configuracoes");
while($r = mysqli_fetch_array($sqlConfig)){
    $nome = $r['nome'];
    $descricao = $r['descricao'];
    $favicon = $r['favicon'];
    $idioma = $r['idioma'];
    $pub = $r['publicidades'];
    $manu = $r['manutencao'];
    $textoManu = $r['textoManutencao'];
}

// Atualizar configuracoes
if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
    $desricao = $_POST['descricao'];
    $favicon = $_POST['favicon'];
    $idioma = $_POST['idioma'];
    $pub = $_POST['publicidades'];
    $manu = $_POST['manu'];
    $textoManu = $_POST['motivo'];
    $update = mysqli_query($conexao, "UPDATE configuracoes SET nome = '$nome', descricao = '$descricao', favicon = '$favicon', idioma = '$idioma', publicidades = '$pub', manutencao = '$manu', textoManutencao = '$textoManu'");
    header("Location: geral.php?opcao=config&atualizado");    
}

// Alertas
if(isset($_GET['atualizado'])){
    echo "<br><div class='alert alert-info alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  As alterações foram efetuadas com sucesso!
</div>";
}

?>

<h1><i class='glyphicon glyphicon-cog'></i> Configuração</h1>
<p>Veja aqui as principais opções que permitem modificar a configuração geral do seu fórum.</p><br>
<div class="col-md-12">
    <fieldset>
        <legend>Geral</legend>
        <form method="POST" class="col-md-12 form-horizontal">
            <div class="form-group">
                <label for="nome" class="col-sm-3 control-label">Nome do Fórum:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nome" name="nome" value="<?= $nome;?>">
                </div>
            </div>
            <div class="form-group">
                <label for="descricao" class="col-sm-3 control-label">Descrição do Fórum:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="descricao" name="descricao" value="<?= $descricao; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="favicon" class="col-sm-3 control-label">
                    Favicon do Fórum:
                    <?php
                        if(!empty($favicon)){
                            echo "<img src='$favicon' width=20>";
                        }
                    ?>
                </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="favicon" name="favicon" value="<?= $favicon; ?>">
                   
                </div>
            </div>
            <div class="form-group">
                <label for="idioma" class="col-sm-3 control-label">Idioma padrão:</label>
                <div class="col-sm-2">
                    <select name="idioma" class="form-control">
                        <option value="portugues" <?php if($idioma == 'portugues') echo 'selected'; ?>>Português</option>  
                        <option value="ingles" <?php if($idioma == 'ingles') echo 'selected'; ?>>Inglês</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="publicidades" class="col-sm-3 control-label">Ativar as publicidades:</label>
                <div class="col-sm-9">
                    <label class="radio-inline">
                        <input type="radio" name="publicidades" id="inlineRadio1" value="1" <?php if($pub == 1) echo 'checked';?>> Sim
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="publicidades" id="inlineRadio2" value="0" <?php if($pub == 0) echo 'checked';?>> Não
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="manu" class="col-sm-3 control-label">Fórum em manutenção:</label>
                <div class="col-sm-9">
                    <label class="radio-inline">
                        <input type="radio" name="manu" id="inlineRadio1" value="1" <?php if($manu == 1) echo 'checked';?>> Sim
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="manu" id="inlineRadio2" value="0" <?php if($manu == 0) echo 'checked';?>> Não
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="motivo" class="col-sm-3 control-label"></label>
                <div class="col-sm-9">
                    <textarea class="form-control" rows="12" id="motivo" name="motivo" placeholder="Informe o motivo da manutenção"><?= $textoManu; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="right btn btn-success"><i class='glyphicon glyphicon-pencil'></i> SALVAR</button>
                </div>
            </div>
        </form>
    </fieldset>
</div>