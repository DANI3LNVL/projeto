<?php
    include_once('data.php');
    session_start();
    $categoria = $_POST['categoria'];
    try {
        $dsn = "mysql:host=Localhost;dbname=formulario;charset=utf8";
        $pdo = new PDO($dsn, 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $send = "INSERT INTO formulario.categoria VALUES (DEFAULT, :categoria, DEFAULT)";
        $stmt = $pdo->prepare($send);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $stmt->execute();
        echo "<script>window.alert('Categoria cadastrada!')</script>";
        echo "<script>window.location.href = 'tela-cadastro-produtos.php'</script>";
    } catch (PDOException $e) {
        echo "<script>window.alert('Erro ao cadastrar categoria: " . $e->getMessage() . "')</script>";
        echo "<script>window.location.href = 'tela-cadastro-produtos.php'</script>";
    }
?>