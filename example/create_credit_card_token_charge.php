<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\ChargeEndpoint;
use Asaas\Factories\ChargeFactory;

try {
    // Configuração
    //token de acesso
    VariavelAmbiente::load(__DIR__.'/../');
    $token = getenv('ASAAS_TOKEN');
    
    $config = new AsaasConfig(AsaasConfig::ENV_SANDBOX);
    $httpClient = new HttpClient(
        $token,
        $config
    );

    $chargeEndpoint = new ChargeEndpoint($httpClient);

    // Criando uma cobrança via token de cartão de crédito
    $creditCardTokenCharge = ChargeFactory::createCreditCardTokenCharge(
        'cus_000006367266', // ID do cliente
        129.9, // Valor
        date("Y-m-d"), // Data de vencimento
        '04b35d9c-23bd-4117-b5f2-74a6ff3c41b5', // Token do cartão
        '192.168.0.1', // IP do cliente
        'Pedido 056985', // Descrição
        '056985' // Referência externa (opcional)
    );

    $response = $chargeEndpoint->create($creditCardTokenCharge);

    // Resposta
    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
