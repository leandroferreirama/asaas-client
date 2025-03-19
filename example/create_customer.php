<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\CustomerEndpoint;
use Asaas\Models\Customer;

try {
    //token de acesso
    VariavelAmbiente::load(__DIR__.'/../');
    $token = getenv('ASAAS_TOKEN');
    
    // Configuração
    $config = new AsaasConfig(AsaasConfig::ENV_SANDBOX);
    $httpClient = new HttpClient('$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwOTU0Nzk6OiRhYWNoXzg2YWQxYTI1LWYzN2UtNDc2My05NmI1LTg0NGZhYTFlZjQ3ZA==', $config);

    // Criar cliente completo
    $customerEndpoint = new CustomerEndpoint($httpClient);
    $customer = new Customer(
        'Cliente Completo',
        '12345678909',
        'cliente@teste.com',
        '+551140028922',
        '+5511999998888',
        '88000000',
        'Rua Completa',
        '123',
        'Apto 10',
        'Bairro Completo',
        'Ref123',
        true
    );

    $response = $customerEndpoint->create($customer);

    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
