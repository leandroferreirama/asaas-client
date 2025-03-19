<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\WebhookEndpoint;

try {
    // Token de acesso
    VariavelAmbiente::load(__DIR__.'/../');
    $token = getenv('ASAAS_TOKEN');
    
    // Configuração
    $config = new AsaasConfig(AsaasConfig::ENV_SANDBOX);
    $httpClient = new HttpClient(
        $token,
        $config
    );

    $webhookEndpoint = new WebhookEndpoint($httpClient);

    // Listar webhooks
    $response = $webhookEndpoint->list(0, 10);

    // Resposta final combinada
    echo '<pre>';
    var_dump($response);
    echo '</pre>';
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}