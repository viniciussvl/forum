<?php
// Insere categoria
if(isset($_POST['nomeCategoria'])){
    $categoria = $_POST['nomeCategoria'];
    $descricao = $_POST['descricao'];
    $insere = mysqli_query($conexao, "INSERT INTO categoria (nomeCategoria) VALUES ('$categoria')");
    header("Location: geral.php?opcao=categorias");
}

// Insere área
if(isset($_POST['nomeArea'])){
    $area = $_POST['nomeArea'];
    $idCategoria = $_POST['categoria'];
    $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : "";
    $descricao = $_POST['descricao'];
    $status = $_POST['status'];
    $insere = mysqli_query($conexao, "INSERT INTO area (nomeArea, descricao, endereco, status, idCategoria) VALUES ('$area', '$descricao', '$endereco', '$status', '$idCategoria')");
    header("Location: geral.php?opcao=categorias");
}

?>

<h1><i class='glyphicon glyphicon-tint'></i> Categorias e áreas</h1>
<p>Este espaço permite criar e ordenar as categorias e fóruns do seu fórum. Caso deseje adicionar ou remover uma categoria ou uma área, clique no botão adequado. Você pode igualmente controlar as autorizações dos mesmos.</p>

<div class="col-md-12">
    <fieldset>
        <legend>Categorias</legend>
        <a data-toggle="modal" data-target="#modalCategoria" class="btn-new right"><i class='glyphicon glyphicon-plus'></i></a> 
        <table class="tabela-categorias table table-bordered table-striped">
            <tr>
                <th class="col-md-8">Categoria</th>
                <th>Tópicos</th>
                <th>Posts</th>
                <th>Ações</th>
            </tr>
            <?php
            $sqlCategorias = mysqli_query($conexao, "SELECT nomeCategoria FROM categoria");
            while ($r = mysqli_fetch_array($sqlCategorias)):
                $nomeCategoria = $r['nomeCategoria'];
                ?>
                <tr>
                    <td><a href="#"><?= $nomeCategoria; ?></a></td>
                    <td>5</td>
                    <td>51</td>
                    <td>x EDITAR</td>
                </tr> 
                <?php
            endwhile;
            ?>
        </table>
    </fieldset>
</div>     

<!-- Modal nova categoria/area -->
<div class="modal fade bs-example-modal-lg" id="modalCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#nova-categoria" aria-controls="nova-categoria" role="tab" data-toggle="tab">Nova categoria</a></li>
                        <li role="presentation"><a href="#nova-area" aria-controls="nova-area" role="tab" data-toggle="tab">Nova área</a></li>
                    </ul>

                    <!-- Nova categoria -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="nova-categoria">
                            <br><br>
                            <form method="POST" class="form-horizontal">
                                <div class="form-group">
                                    <label for="nomeCategoria" class="col-sm-2 control-label">Nome da categoria :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nomeCategoria" name="nomeCategoria" placeholder="Nome da categoria">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descricao" class="col-sm-2 control-label">Descrição :</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="5" id="descricao" name="descricao" placeholder="Informe a descrição"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary"><i class='glyphicon glyphicon-plus'></i> Adicionar categoria</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Nova área -->
                        <div role="tabpanel" class="tab-pane" id="nova-area">
                            <br><br>
                            <form method="POST" class="form-horizontal">
                                <div class="form-group">
                                    <label for="nomeArea" class="col-sm-2 control-label">Nome da área :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nomeArea" name="nomeArea" placeholder="Nome da categoria">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descricao" class="col-sm-2 control-label">Ligado a:</label>
                                    <div class="col-sm-10">
                                        <select name="categoria" class="form-control">
                                            <?php
                                            $sql = mysqli_query($conexao, "SELECT * FROM categoria");
                                            while ($r = mysqli_fetch_array($sql)):
                                                $idCategoria = $r['idCategoria'];
                                                $nomeCategoria = $r['nomeCategoria'];
                                                ?>
                                                <option value="<?= $idCategoria; ?>"><?= $nomeCategoria; ?></option>
                                                <?php
                                            endwhile;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-2 control-label">Status do fórum :</label>
                                    <div class="col-sm-10">
                                        <label class="radio-inline">
                                            <input type="radio" name="status" id="inlineRadio1" value="0"> Bloqueado
                                        </label>
                                        <label class="radio-inline">
                                          <input type="radio" name="status" id="inlineRadio2" value="1"> Desbloqueado
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="endereco" class="col-sm-2 control-label">Endereço da imagem :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Link da imagem">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descricao" class="col-sm-2 control-label">Descrição :</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="5" id="descricao" name="descricao" placeholder="Informe a descrição"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success"><i class='glyphicon glyphicon-plus'></i> Adicionar área</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
