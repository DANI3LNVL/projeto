<?php
    include_once("session.php");
    $email = $_SESSION["usuariol"];
    try {
        $dsn = "mysql:host=Localhost;dbname=formulario;charset=utf8";
        $pdo = new PDO($dsn, 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT usuario FROM formulario.cadastro WHERE email = :email";
        $stmtUser = $pdo->prepare($sql);
        $stmtUser->bindParam(':email', $email, PDO::PARAM_STR);
        $stmtUser->execute();
        $row = $stmtUser->fetch(PDO::FETCH_ASSOC);
        echo $row['usuario'];
    } catch (PDOException $e) {
        echo "<script>window.alert('Erro ao acessar a conta: " . $e->getMessage() . "')</script>";
        echo "<script>window.location.href = 'tela-cadastro-produtos.php'</script>";
    }
?>