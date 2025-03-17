<?php
session_start();
if (isset($_SESSION["usuariol"]) && isset($_SESSION["senhal"]) && isset($_SESSION["verificado"])) {
    include_once("data.php");
    $usuariol = $_SESSION["usuariol"];
    $senhal = $_SESSION["senhal"];
    function simple_encrypt($str, $key) {
        $crypted = '';
        for ($i = 0; $i < strlen($str); $i++) {
            $char = $str[$i];
            $keychar = $key[$i % strlen($key)];
            $crypted .= chr(ord($char) + ord($keychar));
        }
        return base64_encode($crypted);
    }
    $key = 'elvis-banana';
    $data = $senhal;
    $crypted = simple_encrypt($data, $key);
    try {
        $dsn = "mysql:host=Localhost;dbname=formulario;charset=utf8";
        $pdo = new PDO($dsn, 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $check = "SELECT * FROM formulario.cadastro WHERE email = :usuariol AND senha = :crypted;";
        $stmt = $pdo->prepare($check);
        $stmt->bindParam(':usuariol', $usuariol, PDO::PARAM_STR);
        $stmt->bindParam(':crypted', $crypted, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {} else {
            echo "<script>window.alert('O email ou senha está incorreto')</script>";
            echo "<script>window.location.href = 'tela-login.php'</script>";
        }
    } catch (PDOException $e) {
        die("<script>window.alert('Erro no banco de dados: " . $e->getMessage() . "')</script>");
    }
} else {
    echo "<script>window.location.href = 'tela-login.php'</script>";
}
?>