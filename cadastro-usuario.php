<?php
session_start();
if (
    isset($_POST["username"]) &&
    isset($_POST["email"]) &&
    isset($_POST["tel"]) &&
    isset($_POST["password"]) &&
    isset($_POST["password-confirmation"]) &&
    isset($_POST["nivel"])
) {
    try {
        $dsn = "mysql:host=Localhost;dbname=formulario;charset=utf8";
        $pdo = new PDO($dsn, 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erro ao conectar ao banco de dados: " . $e->getMessage());
    }
    $username = $_POST["username"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $password = $_POST["password"];
    $passcon = $_POST["password-confirmation"];
    $nivel = $_POST["nivel"];
    if ($password != $passcon) {
        echo "<script>alert('Os campos senha e confirmar senha precisam ser iguais');</script>";
        echo "<script>window.location.href = 'tela-cadastro-usuarios.php';</script>";
        exit;
    }
    if (!preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[@#$%*&!]/', $password)) {
        echo "<script>alert('A senha deve conter pelo menos uma letra maiúscula, um número e um caractere especial (@#$%*&!)');</script>";
        echo "<script>window.location.href = 'tela-cadastro-usuarios.php';</script>";
        exit;
    }
    $check = "SELECT COUNT(*) FROM formulario.cadastro WHERE email = :email";
    $stmt = $pdo->prepare($check);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $emailExists = $stmt->fetchColumn();
    if ($emailExists > 0) {
        echo "<script>alert('Esse usuário já está cadastrado');</script>";
        echo "<script>window.location.href = 'tela-cadastro-usuarios.php';</script>";
        exit;
    }
    function simple_encrypt($str, $key) {
        $encrypted = '';
        for ($i = 0; $i < strlen($str); $i++) {
            $char = $str[$i];
            $keychar = $key[$i % strlen($key)];
            $encrypted .= chr(ord($char) + ord($keychar));
        }
        return base64_encode($encrypted);
    }
    $key = 'elvis-banana';
    $data = $password;
    $encrypted = simple_encrypt($data, $key);
    $send = "INSERT INTO formulario.cadastro VALUES (DEFAULT, :username, :email, :tel, :pass, :nivel, DEFAULT)";
    $stmt = $pdo->prepare($send);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $encrypted, PDO::PARAM_STR);
    $stmt->bindParam(':nivel', $nivel, PDO::PARAM_STR);
    if ($stmt->execute()) {
        echo "<script>alert('Seus dados foram cadastrados, agora você pode fazer o login');</script>";
        echo "<script>window.location.href = 'tela-cadastro-usuarios.php';</script>";
    } else {
        echo "<script>alert('Ocorreu um erro ao cadastrar seus dados');</script>";
        echo "<script>window.location.href = 'tela-cadastro-usuarios.php';</script>";
    }
}
?>