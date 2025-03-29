<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\AccountDocumentEndpoint;

try {
    //token de acesso
    VariavelAmbiente::load(__DIR__.'/../');
    $token = getenv('ASAAS_TOKEN');
    
    // Configuração
    $config = new AsaasConfig(AsaasConfig::ENV_SANDBOX);
    $httpClient = new HttpClient(
        '$aact_hmlg_000MzkwODA2MWY2OGM3MWRlMDU2NWM3MzJlNzZmNGZhZGY6OjI3YzcxYjU3LTM1MjktNGNjNC1hYWY5LWIzZGY4YzViNjE2Mzo6JGFhY2hfMTI2YTZjZGYtM2M2ZC00ZmFiLWJiYzYtZGRkNzIwMTNkMzA1',
        $config
    );

    $documentEndpoint = new AccountDocumentEndpoint($httpClient);

    $response = $documentEndpoint->getPendingDocuments();

    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
