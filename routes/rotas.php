<?php
require_once 'SouthTIApi'; // Inclui a classe SouthTIApi

$api = new SouthTIApi();

// Obter a rota a partir da URL
$path = $_SERVER['REQUEST_URI'];

// Método HTTP (GET, POST, etc.)
$method = $_SERVER['REQUEST_METHOD'];

// Definir as rotas
switch ($path) {
    case '/login':
        if ($method === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $response = $api->login($email, $password);
            echo json_encode($response);
        } else {
            http_response_code(405); // Método não permitido
            echo json_encode(['error' => 'Método não permitido']);
        }
        break;

    case '/profile':
        if ($method === 'GET') {
            $response = $api->getProfile();
            echo json_encode($response);
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
        }
        break;

    case '/transaction/create':
        if ($method === 'POST') {
            $value = $_POST['value'];
            $description = $_POST['description'];
            $response = $api->createTransaction($value, $description);
            echo json_encode($response);
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
        }
        break;

    case '/transaction/list':
        if ($method === 'GET') {
            $response = $api->listTransactions();
            echo json_encode($response);
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
        }
        break;

    default:
        http_response_code(404); // Não encontrado
        echo json_encode(['error' => 'Rota não encontrada']);
        break;
}

