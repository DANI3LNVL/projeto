<?php
    include_once('data.php');
    session_start();
    $nome = $_POST['nome'];
    $codigo = $_POST['codigo'];
    $categoria = $_POST['categoria'];
    $custo = $_POST['custo'];
    $venda = $_POST['venda'];
    $validade = $_POST['validade'];
    try {
        $dsn = "mysql:host=Localhost;dbname=formulario;charset=utf8";
        $pdo = new PDO($dsn, 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $queryProduct = "UPDATE formulario.produtos SET codigo = :codigo, tipo = :categoria, preco_custo = :custo, preco_venda = :venda, validade = :validade WHERE nome = :nome";
        $stmtProduct = $pdo->prepare($queryProduct);
        $stmtProduct->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmtProduct->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        $stmtProduct->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $stmtProduct->bindParam(':custo', $custo, PDO::PARAM_STR);
        $stmtProduct->bindParam(':venda', $venda, PDO::PARAM_STR);
        $stmtProduct->bindParam(':validade', $validade, PDO::PARAM_STR);
        $stmtProduct->execute();
        echo "<script>window.alert('Seu produto foi alterado!')</script>";
        echo "<script>window.location.href = 'tela-cadastro-produtos.php'</script>";
    } catch (PDOException $e) {
        echo "<script>window.alert('Erro ao cadastrar o produto: " . $e->getMessage() . "')</script>";
        echo "<script>window.location.href = 'tela-cadastro-produtos.php'</script>";
    }
?>