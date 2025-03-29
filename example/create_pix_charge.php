<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\PixEndpoint;
use Asaas\Factories\ChargeFactory;

try {
    //token de acesso
    VariavelAmbiente::load(__DIR__.'/../');
    $token = getenv('ASAAS_TOKEN');
    
    // Configuração
    $config = new AsaasConfig(AsaasConfig::ENV_SANDBOX);
    $httpClient = new HttpClient(
        $token,
        $config
    );

    $pixEndpoint = new PixEndpoint($httpClient);

    // Criando uma cobrança via PIX sem parcelamento
    $pixCharge = ChargeFactory::createCharge(
        'cus_000006367266', // ID do cliente
        'PIX', // Tipo de cobrança
        129.9, // Valor
        date("Y-m-d"), // Data de vencimento
        'Pedido 056984', // Descrição
        '056984' // Referência externa (opcional)
    );

    $response = $pixEndpoint->createWithQrCode($pixCharge);

    // Resposta final combinada
    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
