<?php
include_once('data.php');
session_start();
$nome = $_POST['nome'];
$cnpj = $_POST['cnpj'];
$numero = $_POST['numero'];
$email = $_POST['email'];
$tipo = $_POST['tipo'];
$cep = $_POST['cep'];
$logradouro = $_POST['rua'];
$bairro = $_POST['bairro'];
$numero_endereco = $_POST['numero_endereco'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
try {
    $dsn = "mysql:host=Localhost;dbname=formulario;charset=utf8";
    $pdo = new PDO($dsn, 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO formulario.fornecedor VALUES (DEFAULT, :nome, :cnpj, :numero, :email, :tipo, :cep, :logradouro, :bairro, :numero_endereco, :cidade, :estado, DEFAULT);";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':cnpj', $cnpj, PDO::PARAM_STR);
    $stmt->bindParam(':numero', $numero, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
    $stmt->bindParam(':cep', $cep, PDO::PARAM_STR);
    $stmt->bindParam(':logradouro', $logradouro, PDO::PARAM_STR);
    $stmt->bindParam(':bairro', $bairro, PDO::PARAM_STR);
    $stmt->bindParam(':numero_endereco', $numero_endereco, PDO::PARAM_STR);
    $stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);
    $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
    $stmt->execute();
    echo "<script>window.alert('O fornecedor foi cadastrado!')</script>";
} catch (PDOException $e) {
    die("<script>window.alert('Erro ao cadastrar o fornecedor: " . $e->getMessage() . "')</script>");
}
echo "<script>window.location.href = 'tela-fornecedores.php'</script>";
?>