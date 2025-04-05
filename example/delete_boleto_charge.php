<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\BoletoEndpoint;

try {
    // Carregar o token de acesso
    VariavelAmbiente::load(__DIR__.'/../');
    $token = getenv('ASAAS_TOKEN');

    // Configuração
    $config = new AsaasConfig(AsaasConfig::ENV_SANDBOX);
    $httpClient = new HttpClient(
        $token,
        $config
    );

    $boletoEndpoint = new BoletoEndpoint($httpClient);

    // ID da cobrança a ser excluída
    $paymentId = 'pay_080225913252';

    // Excluindo a cobrança
    $response = $boletoEndpoint->delete($paymentId);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}