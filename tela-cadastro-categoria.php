<?php
    include_once("session.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <link rel="stylesheet" href="css/style.dashborde.css">
    <link rel="stylesheet" href="css/fornecedores.css">
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
                        <form action="cadastro-categoria.php" method="POST" class="form-cadastro">
                            <h2>Cadastro de categoria</h2>
                            <div class="form-group">
                                <label for="nome">Nome da categoria:</label>
                                <input type="text" id="nome" name="categoria" required>
                            </div>
                            <button type="submit">Cadastrar</button>
                            <li><a href="tela-alteracao-produto.php">Altere um produto</a></li>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="main.js"></script>
</body>
</html>