<?php
    include_once("session.php");
    $email = $_SESSION["usuariol"];
    try {
        $dsn = "mysql:host=Localhost;dbname=formulario;charset=utf8";
        $pdo = new PDO($dsn, 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT nivel FROM formulario.cadastro WHERE email = :email";
        $stmtUser = $pdo->prepare($sql);
        $stmtUser->bindParam(':email', $email, PDO::PARAM_STR);
        $stmtUser->execute();
        $row = $stmtUser->fetch(PDO::FETCH_ASSOC);
        if ($row['nivel'] == 'Administrador') {} else {
            echo "<script>window.alert('Você não tem permissão de acessar essa tela')</script>";
            echo "<script>window.location.href = 'tela-dashborde.php'</script>";
        }
    } catch (PDOException $e) {
        echo "<script>window.alert('Erro ao acessar a conta: " . $e->getMessage() . "')</script>";
        echo "<script>window.location.href = 'tela-cadastro-produtos.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <link rel="stylesheet" href="css/style.dashborde.css">
    <link rel="stylesheet" href="css/cadastro-usuarios.css">
    <link rel="stylesheet" href="css/nivel.css">
    <link href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
    <div class="navegacao">
    <?php
        include_once("lista.html");
    ?>
        </div>
        <div class="principal">
            <div class="barraSuperior">
                    <div class="opcoes">
                        <form action="cadastro-usuario.php" method="POST" class="form-cadastro">
                            <h2>Cadastro de Usuário</h2>
                            <div class="form-group">
                                <label for="username">Nome Usuário</label>
                                <input
                                  type="text"
                                  name="username"
                                  placeholder="Digite o nome do usuario..."
                                  required
                                />
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                  type="email"
                                  name="email"
                                  placeholder="Digite o seu email..."
                                  required
                                />
                            </div>
                            <div class="form-group">
                                <label for="tel">Telefone</label>
                                <input
                                  type="tel"
                                  minlength="18"
                                  maxlength="19"
                                  oninput="Tel()"
                                  name="tel"
                                  id="tel"
                                  placeholder="Digite o seu telefone..."
                                  required
                                  
                                />
                            </div>
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input
                                  type="password"
                                  name="password"
                                  placeholder="Digite sua senha..."
                                  minlength="8"
                                  required
                                />
                            </div>
                            <div class="form-group">
                                <label for="password-confirmation">Confirmação de senha</label>
                                <input
                                  type="password"
                                  name="password-confirmation"
                                  placeholder="Digite sua senha novamente..."
                                  minlength="8"
                                  required
                                />
                            </div>
                            <div class="form-group">
                                <label for="nivel">Nível de acesso</label>
                                <select name="nivel" required>
                                    <option>Administrador</option>
                                    <option>Usuário</option>
                                </select>
                            </div>
                            <button type="submit">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="main.js"></script>
    <script src="js/validacao.js"></script>
</body>
</html>