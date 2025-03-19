<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\BoletoEndpoint;
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

    $boletoEndpoint = new BoletoEndpoint($httpClient);

    // Criando uma cobrança via boleto (sem parcelamento)
    $boletoCharge = ChargeFactory::createCharge(
        'cus_000006562001', // ID do cliente
        'BOLETO', // Tipo de cobrança
        175.35, // Valor da cobrança
        '2025-12-01', // Data de vencimento
        'Pedido 123', // Descrição (opcional)
        '123' // Referência externa (opcional)
    );

    // Criando a cobrança e obtendo o Identification Field
    $response = $boletoEndpoint->createWithIdentificationField($boletoCharge);

    // Resposta final combinada
    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
