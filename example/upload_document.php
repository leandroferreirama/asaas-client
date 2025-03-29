<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\AccountDocumentEndpoint;
use Asaas\Models\AccountDocument;

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

    $documentEndpoint = new AccountDocumentEndpoint($httpClient);

    // Criar documento
    $document = new AccountDocument(
        '8d257732-2220-11', // ID da conta
        __DIR__ . '/document.pdf', // Caminho do arquivo
        'IDENTIFICATION' // Tipo do documento
    );

    $response = $documentEndpoint->upload($document);

    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}

