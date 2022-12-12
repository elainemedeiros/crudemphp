<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD em PHP - Exercício</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php
    $pdo = new PDO("mysql:host=localhost;dbname=crudphp", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //SÓ EM DESENVOLVIMENTO. MOSTRA OS ERROS

    if (isset($_GET['excluir'])) {
        $cod_aluno = (int)$_GET['excluir'];
        $pdo->exec("DELETE FROM tab_alunos WHERE cod_aluno = $cod_aluno");
        echo "<h2>O aluno $cod_aluno foi excluído com sucesso!</h2>";
        //voltar para o index
        header("Location: index.php");
    }

    if (isset($_POST['nome'])) {
        $sql = $pdo->prepare("INSERT INTO `tab_alunos` VALUES (null, ?, ?, ?)");
        $nome = $_POST['nome'];
        $sql->execute(array($nome, $_POST['cpf'], $_POST['email']));
        echo "<h2>Aluno $nome cadastrado com sucesso!</h2>";
    }
    ?>

    <div class="container">
        <br>
        <form method="POST">
            <legend>
                <h2 class="row justify-content-center">Cadastro de alunos</h2>
            </legend>
            <fieldset>
                <div style="padding: 10px 0px 10px 0px;">
                    Nome: <input type="text" name="nome" class="form-control">
                </div>
                <div style="padding: 10px 0px 10px 0px;">
                    CPF: <input type="text" name="cpf" class="form-control">
                </div>
                <div style="padding: 10px 0px 10px 0px;">
                    E-mail: <input type="text" name="email" class="form-control">
                </div>
                <br>
                <div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <button type="reset" class="btn btn-danger">Limpar Dados</button>
                </div>
                <br>
        </form>
        </fieldset>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <?php
    $sql = $pdo->prepare("SELECT * FROM `tab_alunos`");
    $sql->execute();
    $alunos = $sql->fetchAll();

    echo "<table class='table table-stripped table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col' colspan='2' class='text-center'>Ações</th>";
    echo "<th scope='col'>Nome</th>";
    echo "<th scope='col'>CPF</th>";
    echo "<th scope='col'>E-mail</th>";
    echo "</tr></thead><tbody>";

    foreach ($alunos as $aluno) {
        echo "<tr>";
        echo '<td align=center>
        <a href="?excluir=' . $aluno['cod_aluno'] . '">( X )</a>
        </td>';
        echo '<td align=center>
        <a href="alterar.php?cod_aluno=' . $aluno['cod_aluno'] . '">( Alterar )</a>
        </td>';
        echo "<td>" . $aluno['nome'] . "</td>";
        echo "<td>" . $aluno['cpf'] . "</td>";
        echo "<td>" . $aluno['email'] . "</td>";
        echo "</tr>";
    }


    ?>



</body>

</html>