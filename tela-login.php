<?php
    session_start();
    if (isset($_SESSION["usuariol"]) || isset($_SESSION["senhal"]) || isset($_SESSION["verificado"])) {
        unset($_SESSION["usuariol"]);
        unset($_SESSION["senhal"]);
        unset($_SESSION["verificado"]);
    };
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-login.css">
    <title>Login</title>
</head>
<body>

    <div class="main-login">
        <div class="left-login">
            <h1>Faça login <br> E entre para o nosso time</h1>
            <img src="midia/SEO analytics team-rafiki.svg" class="left-login-image" alt="Seo-animation">
        </div>

        <form action="post.php" method="post">
            <div class="right-login">
                <div class="card-login">
                    <h1>LOGIN</h1>
                    <div class="textfield">
                        <label for="usuario">Email</label>
                        <input type="text" name="usuariol" placeholder="Email" required>
                    </div>
                    <div class="textfield">
                        <label for="senha">Senha</label>
                        <input type="password" name="senhal" placeholder="Senha" required>
                    </div>
                    <input class="btn-login" type="submit" value="Login">
                </div>
            </div>
        </form>
    </div>
</body>
</html>