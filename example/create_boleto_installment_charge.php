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

    // Criando uma cobrança parcelada via boleto
    $boletoCharge = ChargeFactory::createCharge(
        'cus_000006562001', // ID do cliente
        'BOLETO', // Tipo de cobrança
        0, // Valor não necessário para parcelamento
        '2025-04-01', // Data de vencimento
        'Pedido Parcelado 056985', // Descrição (opcional)
        '056985' // Referência externa (opcional)
    );

    // Adicionando detalhes do parcelamento
    $boletoCharge->addInstallmentFields(
        3,       // Número de parcelas
        450.0,   // Valor total (opcionalmente pode usar installmentValue)
        null     // Valor individual de cada parcela (calculado automaticamente)
    );

    // Criando a cobrança e obtendo o Identification Field
    $response = $boletoEndpoint->create($boletoCharge);

    // Resposta final combinada
    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
