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
    <link rel="stylesheet" href="css/listagem-produtos.css">
    <link rel="stylesheet" href="css/resultado.css">
    <link href="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="navegacao">
            <nav>
            <?php
                include_once("lista.html");
            ?>
            </div>
        </nav>
    </div>
    <div class="principal">
    <div class="barraSuperior">
        <div class="alternar" style="cursor: default;">
            <ion-icon name="menu-outline" style="display: none;"></ion-icon>
        </div>
    </div>
    <div class="pesquisa">
        <form action="tela-listagem-produtos.php" method="post">
            <input type="text" name="resultado" placeholder="Pesquise o nome do produto" required>
            <input type="submit" value="pesquisar">
        </form>
    </div>
    <h1>Listagem de Produtos</h1>
    <?php
    $resultado = '%%';
    if (isset($_POST["resultado"])) {
        $resultado = '%' . $_POST["resultado"] . '%';
    }
    try {
        $dsn = "mysql:host=Localhost;dbname=formulario;charset=utf8";
        $pdo = new PDO($dsn, 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT produtos.* FROM produtos INNER JOIN cadastro ON produtos.idcadastro = cadastro.id WHERE cadastro.email = :usuariol AND (nome LIKE :resultado OR codigo LIKE :resultado);";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuariol', $usuariol, PDO::PARAM_STR);
        $stmt->bindParam(':resultado', $resultado, PDO::PARAM_STR);
        $stmt->execute();
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($produtos)) {
            echo "<table border='1'>
                    <tr>
                        <th>Nome</th>
                        <th>Código</th>
                        <th>Categoria</th>
                        <th>Preço de Custo</th>
                        <th>Preço de Venda</th>
                        <th>Quantidade</th>
                        <th>Validade</th>
                    </tr>";
            foreach ($produtos as $produto) {
                echo "<tr>
                        <td>" . $produto["nome"] . "</td>
                        <td>" . $produto["codigo"] . "</td>
                        <td>" . $produto["tipo"] . "</td>
                        <td>" . $produto["preco_custo"] . "</td>
                        <td>" . $produto["preco_venda"] . "</td>
                        <td>" . $produto["quantidade"] . "</td>
                        <td>" . $produto["validade"] . "</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "Nenhum produto encontrado.";
        }
    } catch (PDOException $e) {
        die("<script>window.alert('Erro ao consultar dados: " . $e->getMessage() . "')</script>");
    }
    ?>
    </div>
</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="main.js"></script>
</html>