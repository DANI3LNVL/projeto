<?php
    include_once("session.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <link rel="stylesheet" href="css/nav-bar.css">
    <link rel="stylesheet" href="css/mensagens.css">
    <link href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="navegacao">
        <?php
            include_once("nav-bar.html");
        ?>
        </div>  
        
        <div class="principal">
            <div class="barraSuperior">
                <div class="alternar">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="container1">
                    <h1 style="color: rgba(0, 0, 0, 0);">Mensagens sobre Produtos Alimentícios</h1>
            
                    <div class="message">
                        <h2>Não há mensagem no momento</h2>
                    </div>

                    <!--div class="message">
                        <h2>Novo Sabor de Sorvete Lançado!</h2>
                        <p class="message-content">Experimente nosso novo sabor de sorvete de morango com pedaços de chocolate. Uma combinação perfeita para os dias quentes!</p>
                        <p class="message-date">Publicado em 25 de Junho de 2024</p>
                    </div>

                    <div class="message">
                        <h2>Receita Especial: Torta de Maçã</h2>
                        <p class="message-content">Aprenda a fazer uma deliciosa torta de maçã com nossa receita exclusiva. Surpreenda sua família e amigos!</p>
                        <p class="message-date">Publicado em 24 de Junho de 2024</p>
                    </div>
            
                    <div class="message">
                        <h2>Nova Linha de Produtos Orgânicos</h2>
                        <p class="message-content">Conheça nossa nova linha de produtos orgânicos, cultivados com cuidado para garantir qualidade e sabor.</p>
                        <p class="message-date">Publicado em 23 de Junho de 2024</p>
                    </div>
            
                    <div class="message">
                        <h2>Promoção Imperdível: Chocolate Amargo</h2>
                        <p class="message-content">Aproveite nossa promoção especial de chocolate amargo. Perfeito para os amantes de um sabor intenso!</p>
                        <p class="message-date">Publicado em 22 de Junho de 2024</p>
                    </div>
            
                    <div class="message">
                        <h2>Lançamento: Café Premium</h2>
                        <p class="message-content">Descubra nosso novo café premium, com grãos selecionados para um aroma e sabor incomparáveis.</p>
                        <p class="message-date">Publicado em 21 de Junho de 2024</p>
                    </div-->
                </div>

                <div>
                    <?php
                        echo $usuariol;
                    ?>
                </div>
            </div>
        </div>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="main.js"></script>
</body>
</html>