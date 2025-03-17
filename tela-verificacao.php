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
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Dois Fatores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #5f639b;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        input {
            padding: 10px;
            width: 100%;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            text-align: center;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #1307bd52;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #5f639b;
        }
        .resend-link {
            margin-top: 10px;
            display: block;
            color: #1307bd52;
            text-decoration: none;
        }
        .resend-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Verificação de Dois Fatores</h2>
        <p>Insira o código de verificação enviado para o seu e-mail.</p>
        <form action="verificacao.php" method="post">
            <input type="text" name="codigo" placeholder="Digite o código de verificação" required>
            <input type="submit" value="Confirmar Código">
        </form>
    </div>
</body>
</html>