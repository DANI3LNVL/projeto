<?php
session_start();
if (isset($_SESSION['end_time'])) {
    $ctm = new DateTime();
    $etm = $_SESSION['end_time'];

    if ($ctm >= $_SESSION['end_time']) {
        echo '<script>window.alert("Acesso liberado!")</script>';
        unset($_SESSION['end_time']);
    } else {
        echo '<script>window.alert("Você está bloqueado da acessar essa tela devido a muitas tentativas, tente novamente mais tarde")</script>';
        echo "<script>window.location.href = 'tela-login.php'</script>";
    }
} else if (isset($_POST["usuariol"]) && isset($_POST["senhal"])) {
    include_once("data.php");
    $usuariol = $_POST["usuariol"];
    $senhal = $_POST["senhal"];
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
        if ($stmt->rowCount() > 0) {
            $_SESSION["usuariol"] = $usuariol;
            $_SESSION["senhal"] = $senhal;
            echo "<script>window.location.href = 'checkemail.php'</script>";
        } else {
            echo "<script>window.alert('O email ou senha está incorreto')</script>";
            if (!isset($_SESSION['attempts'])) {
                $_SESSION['attempts'] = 0;
            }
            if (isset($_SESSION['attempts'])) {
                $_SESSION['attempts'] += 1;
                if ($_SESSION['attempts'] >= 5) {
                    unset($_SESSION['attempts']);
                    $time = new DateTime();
                    $time->modify('+5 minutes');
                    $_SESSION['end_time'] = $time;
                    echo "<script>window.location.href = 'tela-login.php'</script>";
                }
            }
            echo "<script>window.location.href = 'tela-login.php'</script>";
        }
    } catch (PDOException $e) {
        die("<script>window.alert('Erro no banco de dados: " . $e->getMessage() . "')</script>");
    }
} else {
    echo "<script>window.location.href = 'tela-login.php'</script>";
}
?>