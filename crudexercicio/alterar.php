<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<?php
$pdo = new PDO('mysql:host=localhost;dbname=crudphp', 'root', '');

if (isset($_GET['cod_aluno'])) {
    $cod_aluno = (int)$_GET['cod_aluno'];
    $sql = $pdo->prepare("SELECT * FROM tab_alunos WHERE cod_aluno = $cod_aluno");
    $sql->execute();
    $alunos = $sql->fetchAll();

    foreach ($alunos as $aluno) {
        echo "<div class=container>";
        echo "<form method='POST'>";
        echo "<br><legend>Altere os dados necessários:</legend>";
        echo "<fieldset>";
        echo "<div>";
        echo "Nome: <input type='text' class='form-control' name='nome' value='" . $aluno['nome'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "CPF: <input type='text' class='form-control' name='cpf' value='" . $aluno['cpf'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "E-mail: <input type='text' class='form-control' name='email' value='" . $aluno['email'] . "'>";
        echo "</div><br>";
        echo "<input type='submit' class='btn btn-primary' value='Enviar'>";
        echo "<input type='reset' class='btn btn-danger' value='Limpar Dados'>";
        echo "</div>";
        echo "<br>";
        echo "</fieldset>";
        echo "</form>";
        echo "</div>";
    }
}

if (isset($_POST['nome'])) {
    $sql = $pdo->prepare("UPDATE tab_alunos SET nome = ?, cpf = ?, email = ? WHERE cod_aluno = $cod_aluno");
    $sql->execute(array($_POST['nome'], $_POST['cpf'], $_POST['email']));
    echo "<div class=container>";
    echo "<h3>Usuário com id = $cod_aluno alterado com sucesso!</h3>";
    echo "<a href='index.php'>Voltar</a>";
    echo "</div>";
}
