<?php 
    session_start();
    $check = $_POST["codigo"];
    if ($check == $_SESSION["codigo"]) {
        include_once("data.php");
        try {
            $dsn = "mysql:host=Localhost;dbname=formulario;charset=utf8";
            $pdo = new PDO($dsn, 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("<script>alert('Erro ao conectar ao banco de dados: " . $e->getMessage() . "');</script>");
        }
        $_SESSION["verificado"] = 1;
        $usuariol = $_SESSION["usuariol"];
        $send1 = "INSERT INTO formulario.login VALUES (DEFAULT, :usuariol, DEFAULT)";
        $send2 = "INSERT INTO formulario.email VALUES (DEFAULT, :usuariol, DEFAULT)";
        try {
            $stmt1 = $pdo->prepare($send1);
            $stmt1->bindParam(':usuariol', $usuariol, PDO::PARAM_STR);
            $stmt1->execute();
            $stmt2 = $pdo->prepare($send2);
            $stmt2->bindParam(':usuariol', $usuariol, PDO::PARAM_STR);
            $stmt2->execute();
            echo "<script>window.location.href = 'tela-dashborde.php';</script>";
        } catch (PDOException $e) {
            die("<script>alert('Erro ao executar consulta no banco de dados: " . $e->getMessage() . "');</script>");
        }
    } else {
        echo '<script>alert("Código incorreto");</script>';
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
                echo "<script>window.location.href = 'tela-verificacao.php'</script>";
            }
        }
        echo "<script>window.location.href = 'tela-verificacao.php'</script>";
    }
?>