<?php
include_once("data.php");
session_start();
try {
    $dsn = "mysql:host=Localhost;dbname=formulario;charset=utf8";
    $pdo = new PDO($dsn, 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM formulario.email WHERE email = :email;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $_SESSION["usuariol"], PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $_SESSION["verificado"] = 1;
        echo "<script>window.location.href = 'tela-dashborde.php'</script>";
    } else {
        echo "<script>window.location.href = 'email.php'</script>";
    }
} catch (PDOException $e) {
    die("<script>window.alert('Erro no banco de dados: " . $e->getMessage() . "')</script>");
}
?>