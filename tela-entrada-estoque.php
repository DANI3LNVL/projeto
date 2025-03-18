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
    <link rel="stylesheet" href="css/resultado.css">
    <link rel="stylesheet" href="css/entrada-estoque.css">
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
            <div class="opcoes">
                <form action="entrada_estoque.php" method="POST" class="form-cadastro">
                    <h2>Entrada de Estoque</h2>
                    <div class="form-group">
                        <label for="produto">Produto:</label>
                        <select name="produto" id="produto" required>
                            <?php
                            try {
                                $dsn = "mysql:host=Localhost;dbname=formulario;charset=utf8";
                                $pdo = new PDO($dsn, 'root', '');
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "SELECT produtos.nome FROM produtos INNER JOIN cadastro ON produtos.idcadastro = cadastro.id WHERE cadastro.email = :usuariol;";
                                $stmt = $pdo->prepare($sql);
                                $stmt->bindParam(':usuariol', $usuariol, PDO::PARAM_STR);
                                $stmt->execute();
                                $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                if (!empty($produtos)) {
                                    foreach ($produtos as $produto) {
                                        echo "<option>" . $produto["nome"] . "</option>";
                                    }
                                }
                            } catch (PDOException $e) {
                                die("<script>window.alert('Erro: " . $e->getMessage() . "')</script>");
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantidade">Quantidade:</label>
                        <input type="number" id="quantidade" name="quantidade" required min="1">
                    </div>
                    <div class="form-group">
                        <label for="fornecedor">Fornecedor:</label>
                        <select name="fornecedor" id="fornecedor" required>
                            <?php
                            try {
                                $dsn = "mysql:host=Localhost;dbname=formulario;charset=utf8";
                                $pdo = new PDO($dsn, 'root', '');
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "SELECT nome FROM fornecedor";
                                $stmt = $pdo->query($sql);
                                $fornecedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                if (!empty($fornecedores)) {
                                    foreach ($fornecedores as $fornecedor) {
                                        echo "<option>" . $fornecedor["nome"] . "</option>";
                                    }
                                }
                            } catch (PDOException $e) {
                                die("<script>window.alert('Erro: " . $e->getMessage() . "')</script>");
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="data_entrada">Data de Entrada:</label>
                        <input type="date" id="data_entrada" name="data_entrada" required>
                    </div>
                    <button type="submit">Registrar Entrada</button>
                </form>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="main.js"></script>
</body>
</html>