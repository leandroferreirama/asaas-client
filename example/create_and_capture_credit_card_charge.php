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

    // Criando a cobrança no cartão de crédito com pré-autorização
    $creditCardCharge = ChargeFactory::createCreditCardCharge(
        'cus_000006367266',
        450.0,
        date("Y-m-d"),
        'John Doe', // holderName
        '1234567890123459', // number
        date("m"), // expiryMonth
        date("Y"), // expiryYear
        '234', // ccv
        'John Doe', // cardHolderName
        'john.doe@asaas.cc', // cardHolderEmail
        '03597607918', // cardHolderCpfCnpj
        '82530090', // postalCode
        '123', // addressNumber
        '', // addressComplement
        '5511999999999', // phone
        '5511999999999', // mobilePhone
        '192.168.0.1', // ip
        'Cobrança via cartão de crédito com pré-autorização', // description
        'REF123', // externalReference
        true // authorizeOnly
    );

    // Enviando a cobrança com pré-autorização
    $response = $chargeEndpoint->create($creditCardCharge);

    echo "Cobrança criada com sucesso:\n";
    var_dump($response);
    echo '<hr>';

    // Capturando a cobrança autorizada
    if (isset($response['response']['id'])) {
        $paymentId = $response['response']['id']; // ID da cobrança retornada
        $captureResponse = $chargeEndpoint->captureAuthorizedPayment($paymentId);

        echo "Cobrança capturada com sucesso:\n";
        var_dump($captureResponse);
    } else {
        echo "Erro: ID da cobrança não retornado.\n";
    }
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}