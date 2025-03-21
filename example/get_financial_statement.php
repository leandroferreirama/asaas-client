<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\FinancialTransactionEndpoint;

try {
    // Token de acesso
    VariavelAmbiente::load(__DIR__.'/../');
    $token = getenv('ASAAS_TOKEN');
    
    // Configuração
    $config = new AsaasConfig(AsaasConfig::ENV_SANDBOX);
    $httpClient = new HttpClient($token, $config);

    $financialTransactionEndpoint = new FinancialTransactionEndpoint($httpClient);

    // Recuperar extrato financeiro
    $response = $financialTransactionEndpoint->getStatement(
        startDate: '2025-03-01',
        finishDate: '2025-03-31',
        offset: 0,
        limit: 10
    );

    echo '<pre>';
    var_dump($response);
    echo '</pre>';
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}