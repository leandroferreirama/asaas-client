<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\SubaccountEndpoint;
use Asaas\Models\Subaccount;
use Asaas\Models\Webhook;

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

    $subaccountEndpoint = new SubaccountEndpoint($httpClient);

    // Criar webhooks
    $webhook1 = new Webhook(
        'teste',
        'https://dsfsd.com.br',
        'suporte@integracaosistema.com.br',
        true,
        false,
        3,
        'authToken',
        'NON_SEQUENTIALLY'
    );
    $webhook1->addPaymentEvents();

    // Criar subconta com webhooks
    $subaccount = new Subaccount(
        'teste',
        'teste@teste.com.br',
        '01234567890',
        '41997780000',
        250000,
        '947',
        '82530090',
        webhooks: [$webhook1]
    );

    $response = $subaccountEndpoint->create($subaccount);

    // Resposta final combinada
    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
