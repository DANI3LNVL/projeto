<?php
    include_once('data.php');
    session_start();
    $email = $_SESSION["usuariol"];
    $nome = $_POST['nome'];
    $codigo = $_POST['codigo'];
    $categoria = $_POST['categoria'];
    $custo = $_POST['custo'];
    $venda = $_POST['venda'];
    $quantidade = $_POST['quantidade'];
    $validade = $_POST['validade'];
    try {
        $dsn = "mysql:host=Localhost;dbname=formulario;charset=utf8";
        $pdo = new PDO($dsn, 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT id FROM formulario.cadastro WHERE email = :email";
        $stmtUser = $pdo->prepare($sql);
        $stmtUser->bindParam(':email', $email, PDO::PARAM_STR);
        $stmtUser->execute();
        $row = $stmtUser->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $id = intval($row['id']);
            $queryProduct = "INSERT INTO formulario.produtos VALUES (DEFAULT, :id, :nome, :codigo, :categoria, :custo, :venda, :quantidade, :validade, DEFAULT)";
            $stmtProduct = $pdo->prepare($queryProduct);
            $stmtProduct->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtProduct->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmtProduct->bindParam(':codigo', $codigo, PDO::PARAM_STR);
            $stmtProduct->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $stmtProduct->bindParam(':custo', $custo, PDO::PARAM_STR);
            $stmtProduct->bindParam(':venda', $venda, PDO::PARAM_STR);
            $stmtProduct->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
            $stmtProduct->bindParam(':validade', $validade, PDO::PARAM_STR);
            $stmtProduct->execute();
            echo "<script>window.alert('Seu produto foi cadastrado!')</script>";
            echo "<script>window.location.href = 'tela-cadastro-produtos.php'</script>";
        } else {
            echo "<script>window.alert('Usuário não encontrado!')</script>";
            echo "<script>window.location.href = 'tela-cadastro-produtos.php'</script>";
        }
    } catch (PDOException $e) {
        echo "<script>window.alert('Erro ao cadastrar o produto: " . $e->getMessage() . "')</script>";
        echo "<script>window.location.href = 'tela-cadastro-produtos.php'</script>";
    }
?>