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

    // ID da cobrança a ser alterada
    $paymentId = 'pay_080225913252';

    // Dados para atualização
    $billingType = 'BOLETO'; // Tipo de cobrança (obrigatório)
    $dueDate = '2025-12-15'; // Nova data de vencimento

    // Alterando a data de vencimento
    $response = $boletoEndpoint->update($paymentId, $billingType, null, $dueDate);

    // Resposta final
    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}