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
        '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwOTU0Nzk6OiRhYWNoXzg2YWQxYTI1LWYzN2UtNDc2My05NmI1LTg0NGZhYTFlZjQ3ZA==',
        $config
    );

    $pixEndpoint = new PixEndpoint($httpClient);

    // Criando uma cobrança parcelada via PIX com QR Code
    $pixCharge = ChargeFactory::createCharge(
        'cus_000006367266', // ID do cliente
        'PIX', // Tipo de cobrança
        0, // Valor (não necessário para parcelamento)
        '2024-12-01', // Data de vencimento
        'Pedido Parcelado PIX', // Descrição
        '056984', // Referência externa (opcional)
        3, // Número de parcelas
        450.0, // Valor total
        null // Valor de cada parcela
    );

    $response = $pixEndpoint->createWithQrCode($pixCharge);

    // Resposta final combinada
    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
