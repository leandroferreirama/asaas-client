<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\TransferEndpoint;
use Asaas\Models\TedTransfer;

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

    // Transferência via TED
    $tedTransfer = new TedTransfer(
        300.0, // Valor da transferência
        'John Doe', // Nome do proprietário da conta
        '52233424611', // CPF ou CNPJ
        '1263', // Agência
        '9999991', // Conta bancária
        '1', // Dígito da conta
        'Conta do Bradesco', // Nome da conta (opcional)
        'Transferência via TED', // Descrição (opcional)
        null, // Data de nascimento (opcional)
        'CONTA_CORRENTE', // Tipo da conta (opcional)
        '60746948' // ISPB (opcional)
    );

    $response = $transferEndpoint->create($tedTransfer);

    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
