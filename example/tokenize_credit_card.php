<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\ChargeEndpoint;
use Asaas\Models\CreditCard;
use Asaas\Models\CreditCardHolderInfo;
use Asaas\Models\CreditCardTokenization;

try {
    // Token de acesso
    VariavelAmbiente::load(__DIR__.'/../');
    $token = getenv('ASAAS_TOKEN');
    
    $config = new AsaasConfig(AsaasConfig::ENV_SANDBOX);
    $httpClient = new HttpClient($token, $config);

    $chargeEndpoint = new ChargeEndpoint($httpClient);

    // Dados do cartão de crédito
    $creditCard = new CreditCard(
        'John Doe', // holderName
        '1234567890123459', // number
        '12', // expiryMonth
        '2025', // expiryYear
        '123' // ccv
    );

    // Dados do titular do cartão
    $creditCardHolderInfo = new CreditCardHolderInfo(
        'John Doe', // name
        'john.doe@example.com', // email
        '12345678909', // cpfCnpj
        '82530090', // postalCode
        '123', // addressNumber
        'Apto 101', // addressComplement
        '5511999999999', // phone
        '5511999999999' // mobilePhone
    );

    // Criando o objeto de tokenização
    $tokenization = new CreditCardTokenization(
        'cus_000006367266', // ID do cliente
        $creditCard,
        $creditCardHolderInfo,
        '116.213.42.532' // IP remoto
    );

    // Tokenizar o cartão de crédito
    $response = $chargeEndpoint->tokenizeCreditCard($tokenization);

    echo '<pre>';
    var_dump($response);
    echo '</pre>';
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}