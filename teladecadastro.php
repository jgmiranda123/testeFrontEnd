<?php
    session_start();

    // Inicializa a lista de transações e o total se ainda não estiverem definidos
    if (!isset($_SESSION['transactions'])) {
        $_SESSION['transactions'] = [];
        $_SESSION['total'] = 0;
    }

    // Adiciona a transação na sessão se o formulário for enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $description = $_POST['description'];
        $value = floatval($_POST['value']);

    if (!empty($description) && $value != 0) {
        // Adiciona transação à sessão
        $_SESSION['transactions'][] = [
            'description' => $description,
            'value' => $value
        ];
        // Atualiza o total
        $_SESSION['total'] += $value;
    }
}
    $error_message = '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $value = isset($_POST['value']) ? trim($_POST['value']) : '';

    // Verifica se qualquer um dos campos está vazio
    if ($description === '' || $value === '') {
    $error_message = "Por favor, preencha todos os campos.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Transações com PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="sidebar">
    </br></br></br></br>
    <a href="https://www.exemplo.com"> <img src="imagens/layout-test-assets/ball.png" alt="Início" class="a"></a> </br>
    <a href="https://www.exemplo.com"> <img src="imagens/layout-assets/profile_round.png" alt="Perfil" class="a"></a> </br>
    <a href="https://www.exemplo.com"> <img src="imagens/layout-assets/script.png" alt="Script" class="a"></a> </br>
    <a href="https://www.exemplo.com"> <img src="imagens/layout-assets/notification_bell.png" alt="Notificações" class="a"></a> </br>
    <a href="https://www.exemplo.com"> <img src="imagens/layout-assets/message_three_points.png" alt="Chat" class="a"></a> </br>
    <a href="https://www.exemplo.com"> <img src="imagens/layout-assets/money.png" alt="Dinheiro" class="a"></a> </br>
    <a href="https://www.exemplo.com"> <img src="imagens/layout-assets/umbrella_round.png" alt="Sombrinha" class="a"></a>
</div>
<header class="header">
    <a href="#" class="titulo-link">Título</a>
</header>
<div class="container">
    <div class="box">
        <div class="header-container">
            <h1 class="titulo">Cadastrar transações</h1>
        </div>
        <form method="POST" action="">
            <div class="input-group">
                <input type="text" id="description" name="description" class="input-linha" placeholder="Descrição da transação">
            </div>
            <div class="input-group">
                <input type="number" id="value" name="value" class="input-linha" placeholder="Valor da transação" step="0.01" oninput="updateInputColor()">
            </div>
            <div style="text-align: left;">
                <button class="botao-redondo-right" onclick="validateForm()">Registrar transação</button>
            </div>
            <?php if($error_message) {
                echo '<div class="error-message">' . htmlspecialchars($error_message) . '</div>';
            }
            ?>
        </form>
    </div>
    <div class="box-right">
        <div class="header-container">
            <h1 class="titulo">Resumo</h1>
        </div>
        <div class="div-transaction">
            <?php
            $description = isset($_POST['description']) ? trim($_POST['description']) : '';
            $value = isset($_POST['value']) ? trim($_POST['value']) : '';

            // Verifica se qualquer um dos campos está vazio
            if ($description === '' || $value === '') {
                $error_message = "Por favor, preencha todos os campos.";
            }

            // Função para obter a classe CSS com base no valor
            function getClassForValue($value) {
                // Verifica se o valor é maior que 0, menor que 0 ou igual a 0
                if ($value >= 0) {
                    return 'positivo'; // Verde
                } else {
                    return 'negativo'; // Vermelho
                }
            }
            ?>

            <?php if (isset($_SESSION['transactions']) && !empty($_SESSION['transactions'])): ?>
                <?php foreach ($_SESSION['transactions'] as $transaction): ?>
                    <?php
                    // Obtém a classe CSS para a transação atual
                    $class = getClassForValue($transaction['value']);
                    ?>
                    <div class="timeline-item">
                        <p class="<?= $class ?>">R$ <?= number_format($transaction['value'], 2, ',', '.') ?></p></br>
                        <?= htmlspecialchars($transaction['description']) ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhuma transação cadastrada ainda.</p>
            <?php endif; ?>
        </div>
        <p class="p"><strong></br>Total:</strong> R$ <span id="total"><?= number_format($_SESSION['total'], 2, ',', '.') ?></span></p>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>
