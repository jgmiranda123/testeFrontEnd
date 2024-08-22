
//evento para verificação de senha incorreta
function login() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const errorMessage = document.getElementById('error-message');

    if (username === $valid_username && password === $valid_password ) {
        alert('Login realizado com sucesso!');
        errorMessage.textContent = '';
    } else {
        errorMessage.textContent = 'Usuário ou senha incorretos.';
    }
}

//evento para alertar ao usuario sobre o preenchimento de usuario e senha vazios
document.getElementById("loginForm").addEventListener("submit", function (event) {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    if (username === "" || password === "") {
        event.preventDefault(); // Impede o envio do formulário
        alert("Usuário e senha não podem estar vazios.");
    }
});

//validação de formulário para não deixar clique e evitar que dê erro no sistema ao mandar o form em branco
function validateForm() {
    // Obtém os valores dos campos
    const value = document.getElementById('value').value.trim();
    const description = document.getElementById('description').value.trim();

    // Obtém o container para mensagens de erro
    const errorContainer = document.getElementById('errorContainer');

    // Limpa mensagens de erro anteriores
    errorContainer.textContent = '';

    // Verifica se os campos estão vazios
    if (value === '' || description === '') {
        errorContainer.textContent = 'Por favor, preencha todos os campos.';
        return; // Interrompe a função se houver erro
    }
}

//efeito de tela após o login ter sido efetuado
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // Verifica se os campos estão preenchidos
    if (username === "" || password === "") {
        alert("Usuário e senha não podem estar vazios.");
    } else {
        // Exibe o spinner de carregamento
        document.getElementById('loadingContainer').style.display = 'flex';

        // Aguarda um pouco para mostrar o efeito de carregamento
        setTimeout(function () {
            // Submete o formulário manualmente após mostrar o spinner
            document.getElementById('loginForm').submit();
        }, 1000); // 1 segundo de atraso
    }
});