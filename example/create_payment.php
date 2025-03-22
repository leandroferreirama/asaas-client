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
        '00190.00009 02831.814005 21320.604172 7 10370000012830',
    );

    $response = $paymentEndpoint->create($payment);

    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
