<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\PaymentEndpoint;
use Asaas\Models\Payment;

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

    $paymentEndpoint = new PaymentEndpoint($httpClient);

    // Criar pagamento de conta479201012298800000030400
    $payment = new Payment(
        '03399.03718 94400.000009 15479.201012 2 98800000030400',
        '2024-11-25'
    );

    $response = $paymentEndpoint->create($payment);

    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
