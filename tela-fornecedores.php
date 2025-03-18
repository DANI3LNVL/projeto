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
                <form action="cadastro-fornecedor.php" method="POST" class="form-cadastro">
                    <h2>Cadastro de Fornecedores</h2>

                    <div class="form-group">
                        <label for="nome">Empresa fornecedora:</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>

                    <div class="form-group">
                        <label for="cnpj">CNPJ do fornecedor:</label>
                        <input type="text" id="cnpj" name="cnpj" required minlength="18" maxlength="18" oninput="Cnpj()">
                    </div>

                    <div class="form-group">
                        <label for="numero">Número do fornecedor:</label>
                        <input type="text" id="tel" name="numero" required minlength="18" maxlength="19" oninput="Tel()">
                    </div>

                    <div class="form-group">
                        <label for="email">Email do fornecedor:</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="tipo">Tipo de fornecedor:</label>
                        <select id="tipo" name="tipo">
                            <option value="materia-prima">Matéria-prima</option>
                            <option value="produtos-acabados">Produtos acabados</option>
                            <option value="servicos">Serviços</option>
                        </select>
                    </div>

                    <div class="form-group-full">
                        <label for="cep">CEP:</label>
                        <input type="text" id="cep" name="cep" required minlength="9" maxlength="9" oninput="Cep()">
                    </div>

                    <div class="form-group-full">
                        <label for="rua">Endereço - Lograduro:</label>
                        <input type="text" id="rua" name="rua" required>
                    </div>

                    <div class="form-group">
                        <label for="bairro">Endereço - Bairro:</label>
                        <input type="text" id="bairro" name="bairro" required>
                    </div>

                    <div class="form-group">
                        <label for="numero_endereco">Endereço - Número:</label>
                        <input type="number" id="numero_endereco" name="numero_endereco" required min="1">
                    </div>

                    <div class="form-group">
                        <label for="cidade">Endereço - Cidade:</label>
                        <input type="text" id="cidade" name="cidade" required>
                    </div>

                    <div class="form-group">
                        <label for="estado">Endereço - Estado:</label>
                        <input type="text" id="estado" name="estado" required maxlength="2">
                    </div>

                    <button type="submit">Cadastrar</button>
                    <li><a href="tela-alteracao-fornecedor.php">Altere um fornecedor</a></li>
                </form>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="main.js"></script>
    <script src="js/validacao.js"></script>
    <script src="js/cep.js"></script>
</body>
</html>
