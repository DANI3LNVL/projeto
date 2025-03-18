<?php
    include_once("session.php");
    include_once("data.php");

    try {
        $dsn = "mysql:host=localhost;dbname=formulario;charset=utf8";
        $pdo = new PDO($dsn, 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql1 = "SELECT produtos.nome FROM produtos 
                INNER JOIN cadastro ON produtos.idcadastro = cadastro.id 
                WHERE cadastro.email = :usuariol";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->bindParam(':usuariol', $usuariol, PDO::PARAM_STR);
        $stmt1->execute();
        $produtos = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($produtos)) {
            foreach ($produtos as $produto) {
                $nomeProduto = $produto['nome'];
                $_SESSION[$nomeProduto][0] = $nomeProduto;
                $_SESSION[$nomeProduto][1] = 0;
                $_SESSION[$nomeProduto][2] = 0;
                $_SESSION[$nomeProduto][3] = 0;

                $sql2 = "SELECT quantidade FROM produtos WHERE nome = :nome";
                $stmt2 = $pdo->prepare($sql2);
                $stmt2->bindParam(':nome', $nomeProduto, PDO::PARAM_STR);
                $stmt2->execute();
                $quantidade = $stmt2->fetch(PDO::FETCH_ASSOC);
                if ($quantidade) {
                    $_SESSION[$nomeProduto][1] = $quantidade['quantidade'];
                }

                $sql3 = "SELECT SUM(quantidade) AS quantidade FROM entrada_estoque WHERE produto = :nome";
                $stmt3 = $pdo->prepare($sql3);
                $stmt3->bindParam(':nome', $nomeProduto, PDO::PARAM_STR);
                $stmt3->execute();
                $entrada = $stmt3->fetch(PDO::FETCH_ASSOC);
                if ($entrada && $entrada['quantidade'] !== null) {
                    $_SESSION[$nomeProduto][2] = $entrada['quantidade'];
                }

                $sql4 = "SELECT SUM(quantidade) AS quantidade FROM saida_estoque WHERE produto = :nome";
                $stmt4 = $pdo->prepare($sql4);
                $stmt4->bindParam(':nome', $nomeProduto, PDO::PARAM_STR);
                $stmt4->execute();
                $saida = $stmt4->fetch(PDO::FETCH_ASSOC);
                if ($saida && $saida['quantidade'] !== null) {
                    $_SESSION[$nomeProduto][3] = $saida['quantidade'];
                }
            }
        }
    } catch (PDOException $e) {
        die("<script>window.alert('Erro: " . $e->getMessage() . "')</script>");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="./css/style.dashborde.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">
</head>
<body>
    <div class="container dashboard">
        <div class="navegacao">
        <?php
            include_once("lista.html");
        ?>
        </div>

        <div class="principal">
            <div class="barraSuperior">
                <div class="alternar" style="cursor: default;">
                    <ion-icon name="menu-outline" style="display: none;"></ion-icon>
                </div>

                <div>
                    <p>
                        Usuário cadastrado:
                        <?php
                            include_once("usuario.php");
                        ?>
                    </p>
                </div>
            </div>

            <div class="grafico-estoque">
                <h2>Resumo de Estoque</h2>
                <canvas id="estoqueGrafico"></canvas>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="main.js"></script>

    <script>
        const labels = [];
        const entradas = [];
        const saidas = [];
        const disponiveis = [];

        <?php
        try {
            $dsn = "mysql:host=localhost;dbname=formulario;charset=utf8";
            $pdo = new PDO($dsn, 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT produtos.nome 
                    FROM produtos 
                    INNER JOIN cadastro ON produtos.idcadastro = cadastro.id 
                    WHERE cadastro.email = :usuariol";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':usuariol', $usuariol, PDO::PARAM_STR);
            $stmt->execute();
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($produtos)) {
                foreach ($produtos as $produto) {
                    $nomeProduto = htmlspecialchars($produto['nome']);

                    echo 'labels.push("' . $_SESSION[$nomeProduto][0] . '");
                        disponiveis.push(' . (int) $_SESSION[$nomeProduto][1] . ');
                        entradas.push(' . (int) $_SESSION[$nomeProduto][2] . ');
                        saidas.push(' . (int) $_SESSION[$nomeProduto][3] . ');
                        ';
                }
            }
        } catch (PDOException $e) {
            die("<script>window.alert('Erro: " . $e->getMessage() . "')</script>");
        }
        ?>


        const ctx = document.getElementById('estoqueGrafico').getContext('2d');
        const estoqueGrafico = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Entradas no Estoque',
                        data: entradas,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Saídas do Estoque',
                        data: saidas,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Disponíveis no Estoque',
                        data: disponiveis,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Resumo de Estoque por Produto'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>