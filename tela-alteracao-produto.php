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
                        <form action="alteracao-produto.php" method="POST" class="form-cadastro">
                            <h2>Cadastro de produto</h2>
                            <div class="form-group">
                                <label for="nome">Nome do produto:</label>
                                <select name="nome" id="nome" required>
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
                                <label for="codigo">Código do produto:</label>
                                <input type="number" id="codigo" name="codigo" required maxlength="5">
                            </div>
                            <div class="form-group">
                                <label for="categoria">Categoria do produto:</label>
                                <select name="categoria" required>
                                    <?php
                                    try {
                                        $dsn = "mysql:host=Localhost;dbname=formulario;charset=utf8";
                                        $pdo = new PDO($dsn, 'root', '');
                                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        $sql = "SELECT * FROM categoria";
                                        $stmt = $pdo->query($sql);
                                        if ($stmt->rowCount() > 0) {
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                echo "<option>" . $row['categoria'] . "</option>";
                                            }
                                        }
                                    } catch (PDOException $e) {
                                        die("<script>window.alert('Erro ao buscar categorias: " . $e->getMessage() . "')</script>");
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="preco">Preço de custo:</label>
                                <input type="number" id="preco" name="custo" required  min="1">
                            </div>
                            <div class="form-group">
                                <label for="preco">Preço de venda:</label>
                                <input type="number" id="preco" name="venda" required  min="1">
                            </div>
                            <div class="form-group">
                                <label for="preco">Validade:</label>
                                <input type="date" id="validad" name="validade" required>
                            </div>
                            <button type="submit">Cadastrar</button>
                            <li><a href="tela-cadastro-categoria.php">Cadastre uma categoria</a></li>
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