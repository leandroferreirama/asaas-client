<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\SubaccountEndpoint;

try {
    //token de acesso
    VariavelAmbiente::load(__DIR__.'/../');
    $token = getenv('ASAAS_TOKEN');
    
    // Configuração
    $config = new AsaasConfig(AsaasConfig::ENV_SANDBOX);
    $httpClient = new HttpClient(
        '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwOTU0Nzk6OiRhYWNoXzg2YWQxYTI1LWYzN2UtNDc2My05NmI1LTg0NGZhYTFlZjQ3ZA==',
        $config
    );

    $subaccountEndpoint = new SubaccountEndpoint($httpClient);

    // ID da subconta para consulta
    $subaccountId = '304c54b3-7e59-4d6b-98c1-6e4b070fafbd';

    $response = $subaccountEndpoint->getById($subaccountId);

    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}