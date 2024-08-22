<?php

class SouthTIApi {
    private $base_url = 'https://southti.com.br/desafio-front-end';
    private $token = '8A9B362F-E744-4BEE-8031-39A23FA67E63';
    private $auth_token = '';

    // Função para fazer requisições
    private function request($endpoint, $method, $body = [], $useAuth = false) {
        $url = $this->base_url . $endpoint;
        $headers = [
            'Authorization: ' . ($useAuth ? $this->auth_token : $this->token),
            'Content-Type: application/json',
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        if (!empty($body)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
        }

        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($http_code >= 200 && $http_code < 300) {
            return json_decode($response, true);
        } else {
            return ['error' => 'Erro na requisição', 'status' => $http_code];
        }
    }

    // Login
    public function login($email, $password) {
        $endpoint = '/user/auth';
        $method = 'POST';
        $body = ['email' => $email, 'password' => $password];

        $response = $this->request($endpoint, $method, $body);

        if (!isset($response['error'])) {
            $this->auth_token = $response['token'];
        }

        return $response;
    }

    // Perfil do usuário
    public function getProfile() {
        $endpoint = '/user/profile';
        $method = 'GET';

        return $this->request($endpoint, $method, [], true);
    }

    // Criar transação
    public function createTransaction($value, $description) {
        $endpoint = '/transaction/create';
        $method = 'POST';
        $body = [
            'value' => (float)$value,
            'description' => $description
        ];

        return $this->request($endpoint, $method, $body, true);
    }

    // Listar transações
    public function listTransactions() {
        $endpoint = '/transaction/list';
        $method = 'GET';

        return $this->request($endpoint, $method, [], true);
    }
}

    // Exemplo de uso
    $api = new SouthTIApi();

    // Login
    $loginResponse = $api->login('teste@testefrontend.com.br', 'testefrontend');
    print_r($loginResponse);

    // Obter perfil
    $profileResponse = $api->getProfile();
    print_r($profileResponse);

    // Criar transação
    $transactionResponse = $api->createTransaction(100.50, 'Descrição da transação');
    print_r($transactionResponse);

    // Listar transações
    $transactionListResponse = $api->listTransactions();
    print_r($transactionListResponse);
