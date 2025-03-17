<?php
include_once('data.php');
session_start();
$produto = $_POST['produto'];
$quantidade = $_POST['quantidade'];
$destinatario = $_POST['destinatario'];
$data_saida = $_POST['data_saida'];
try {
    $dsn = "mysql:host=Localhost;dbname=formulario;charset=utf8";
    $pdo = new PDO($dsn, 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT quantidade FROM formulario.produtos WHERE nome = :produto;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':produto', $produto, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $valor = $row["quantidade"] - $quantidade;
        if ($valor >= 0) {
            $entrada = "UPDATE formulario.produtos SET quantidade = :valor WHERE nome = :produto;";
            $stmtUpdate = $pdo->prepare($entrada);
            $stmtUpdate->bindParam(':valor', $valor, PDO::PARAM_INT);
            $stmtUpdate->bindParam(':produto', $produto, PDO::PARAM_STR);
            $stmtUpdate->execute();
            $send = "INSERT INTO formulario.saida_estoque VALUES (DEFAULT, :produto, :quantidade, :destinatario, :data_saida)";
            $stmtInsert = $pdo->prepare($send);
            $stmtInsert->bindParam(':produto', $produto, PDO::PARAM_STR);
            $stmtInsert->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
            $stmtInsert->bindParam(':destinatario', $destinatario, PDO::PARAM_STR);
            $stmtInsert->bindParam(':data_saida', $data_saida, PDO::PARAM_STR);
            $stmtInsert->execute();
            echo "<script>window.alert('Saída cadastrada!')</script>";
            echo "<script>window.location.href = 'tela-saida-estoque.php'</script>";
        } else {
            echo "<script>window.alert('Erro ao cadastrar saída...')</script>";
            echo "<script>window.location.href = 'tela-saida-estoque.php'</script>";
        }
    } else {
        echo "<script>window.alert('Erro: Produto não encontrado!')</script>";
        echo "<script>window.location.href = 'tela-saida-estoque.php'</script>";
    }
} catch (PDOException $e) {
    die("<script>window.alert('Erro no banco de dados: " . $e->getMessage() . "')</script>");
}
?>