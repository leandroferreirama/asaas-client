<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\TransferEndpoint;
use Asaas\Models\PixTransfer;

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

    $transferEndpoint = new TransferEndpoint($httpClient);

    // Transferência via PIX (detecção automática do tipo da chave)
    $pixTransfer = new PixTransfer(
        200.0, // Valor da transferência
        'john.doe@example.com', // Chave PIX (EMAIL neste caso)
        'PIX', // Tipo de operação
        'Transferência via PIX' // Descrição opcional
    );

    $response = $transferEndpoint->create($pixTransfer);

    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
