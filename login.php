<?php
session_start();

$valid_username = 'teste@testefrontend.com.br';
$valid_password = 'testefrontend';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica as credenciais
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['loggedin'] = true;
        header("Location: teladecadastro.php");
        exit;
    } else {
        $error_message = "Usuário ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login com PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-container">
    <form id="loginForm" method="POST" action="login.php">
        <img src="imagens/layout-test-assets/ball.png" alt="Início">
        <div class="input-group">
            <label for="username"><strong>Olá!</br>Entre com seu login e senha para começar.</strong></label>
            <input type="text" id="username" class="input-linha" name="username" placeholder="Digite seu usuário">
        </div>
        <div class="input-group">
            <input type="password" id="password" class="input-linha" name="password" placeholder="Digite sua senha">
        </div>
        </br>
        <button type="submit" id="entrar" class="botao-redondo"><strong>Entrar</strong></button>
    </form>
    <?php if (isset($error_message)): ?>
        <p class="error"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>
    <!-- Bolinha de carregamento -->
    <div class="loading-container" id="loadingContainer">
        <div class="spinner"></div>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>