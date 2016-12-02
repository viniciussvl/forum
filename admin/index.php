<?php
include("inc/header.php");
$usuario = $_SESSION['usuarioLogado'];

// Estatísticas do Fórum
$sqlPosts = mysqli_query($conexao, "SELECT count(*) AS 'quantidade' FROM posts");
$sqlTopicos = mysqli_query($conexao, "SELECT count(*) AS 'quantidade' FROM topico");
$sqlUsuarios = mysqli_query($conexao, "SELECT count(*) AS 'quantidade' FROM usuario");
while ($row = mysqli_fetch_array($sqlPosts)) {
    while ($r = mysqli_fetch_array($sqlTopicos)) {
        while ($u = mysqli_fetch_array($sqlUsuarios)) {
            $totUsers = $u['quantidade'];
        }
        $totTopicos = $r['quantidade'];
    }
    $totPosts = $row['quantidade'];
}
$totMsg = $totTopicos + $totPosts;
?>

<div class="container">
    <h2>Bem-vindo a administração do seu fórum, <span><?= $usuario; ?></span></h2>
</div>
<br><br>
<div class="col-md-3">
    <fieldset>
        <legend>Membros recentes</legend>
        eteste
    </fieldset>

    <fieldset>
        <legend>Procurar um usuário</legend>
        <form method="GET">
            <input type="text" name="usuario">
            <button type="submit" class="btn btn-danger"><i class='glyphicon glyphicon-search'></i></button>
        </form>
    </fieldset> 
    
    <fieldset>
        <legend>Resumo do fórum</legend>
        <p>Lorem ipsumn</p>
    </fieldset>  
</div>

<div class="conteudo col-md-9">
    <div class="col-md-12">
        <fieldset>
            <legend>Estatísticas</legend>
            <table class="tabela table table-bordered table-striped">
                <tr>
                    <th>Estatísticas do fórum</th>
                    <th>Valor</th>
                    <th>Estatísticas do fórum</th>
                    <th>Valor</th>
                </tr>

                <tr>
                    <td>Total de mensagens</td>
                    <td><?= $totMsg; ?></td>
                    <td>Mensagens por dia</td>
                    <td>NULL</td>
                </tr> 
                <tr>
                    <td>Número de tópicos</td>
                    <td><?= $totTopicos; ?></td>
                    <td>Tópicos por dia</td>
                    <td>NULL</td>
                </tr>
                <tr>
                    <td>Número de posts</td>
                    <td><?= $totPosts; ?></td>
                    <td>Tópicos por dia</td>
                    <td>NULL</td>
                </tr>
                <tr>
                    <td>Usuários registrados</td>
                    <td><?= $totUsers; ?></td>
                    <td>Tópicos por dia</td>
                    <td>NULL</td>
                </tr>
                <tr>
                    <td>Criação do fórum</td>
                    <td>17/11/2016 às 22:00</td>
                    <td>Tópicos por dia</td>
                    <td>NULL</td>
                </tr>
            </table>
        </fieldset>
    </div> 
</div>