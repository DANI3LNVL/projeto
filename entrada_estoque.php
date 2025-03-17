<?php
    include_once('data.php');
    session_start();
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];
    $fornecedor = $_POST['fornecedor'];
    $data_entrada = $_POST['data_entrada'];
    try {
        $dsn = "mysql:host=Localhost;dbname=formulario;charset=utf8";
        $pdo = new PDO($dsn, 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $send = "INSERT INTO formulario.entrada_estoque VALUES (DEFAULT, :produto, :quantidade, :fornecedor, :data_entrada)";
        $stmtInsertEntrada = $pdo->prepare($send);
        $stmtInsertEntrada->bindParam(':produto', $produto, PDO::PARAM_STR);
        $stmtInsertEntrada->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmtInsertEntrada->bindParam(':fornecedor', $fornecedor, PDO::PARAM_STR);
        $stmtInsertEntrada->bindParam(':data_entrada', $data_entrada, PDO::PARAM_STR);
        $stmtInsertEntrada->execute();
        echo "<script>window.alert('Entrada cadastrada!')</script>";
        $sql = "SELECT quantidade FROM formulario.produtos WHERE nome = :produto;";
        $stmtSelectQuantidade = $pdo->prepare($sql);
        $stmtSelectQuantidade->bindParam(':produto', $produto, PDO::PARAM_STR);
        $stmtSelectQuantidade->execute();
        $row = $stmtSelectQuantidade->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $valor = $row['quantidade'] + $quantidade;
            $entrada = "UPDATE formulario.produtos SET quantidade = :valor WHERE nome = :produto;";
            $stmtUpdateQuantidade = $pdo->prepare($entrada);
            $stmtUpdateQuantidade->bindParam(':valor', $valor, PDO::PARAM_INT);
            $stmtUpdateQuantidade->bindParam(':produto', $produto, PDO::PARAM_STR);
            $stmtUpdateQuantidade->execute();
        } else {
            echo "<script>window.alert('Produto não encontrado no estoque!')</script>";
        }
    } catch (PDOException $e) {
        die("<script>window.alert('Erro: " . $e->getMessage() . "')</script>");
    }
    echo "<script>window.location.href = 'tela-entrada-estoque.php'</script>";
?>