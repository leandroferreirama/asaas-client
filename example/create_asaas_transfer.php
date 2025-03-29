<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\TransferEndpoint;
use Asaas\Models\AsaasTransfer;

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

    // Transferência para conta Asaas
    $asaasTransfer = new AsaasTransfer(
        100.0, // Valor da transferência
        'b388dd83-0082-4296-ba39-53beb40aaaaa', // ID da conta Asaas
        'Transferência para conta Asaas' // Descrição opcional
    );

    $response = $transferEndpoint->create($asaasTransfer);

    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
