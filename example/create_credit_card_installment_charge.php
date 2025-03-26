<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\ChargeEndpoint;
use Asaas\Factories\ChargeFactory;

try {
    // Token de acesso
    VariavelAmbiente::load(__DIR__.'/../');
    $token = getenv('ASAAS_TOKEN');
    
    $config = new AsaasConfig(AsaasConfig::ENV_SANDBOX);
    $httpClient = new HttpClient($token, $config);

    $chargeEndpoint = new ChargeEndpoint($httpClient);

    // Criando a cobrança no cartão de crédito
    $creditCardCharge = ChargeFactory::createCreditCardCharge(
        'cus_000006367266',
        450.0,
        date("Y-m-d"),
        'John Doe', // holderName
        '1234567890123456', // number
        date("m"), // expiryMonth
        date("Y"), // expiryYear
        '123', // ccv
        'John Doe', // cardHolderName
        'john.doe@asaas.cc', // cardHolderEmail
        '03597607918', // cardHolderCpfCnpj
        '82530090', // postalCode
        '123', // addressNumber
        '', // addressComplement
        '5511999999999', // phone
        '5511999999999', // mobilePhone
        '192.168.0.1', // ip
        'Cobrança via cartão de crédito', // description
        'REF123' // externalReference
    );

    $creditCardCharge->addInstallmentFields(
        3,
        450.0,
        null
    );

    // Enviando a cobrança
    $response = $chargeEndpoint->create($creditCardCharge);

    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}

