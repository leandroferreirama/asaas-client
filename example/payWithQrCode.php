<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\PixEndpoint;

try {
    // Carregar variáveis de ambiente
    VariavelAmbiente::load(__DIR__ . '/../');
    $token = getenv('ASAAS_TOKEN');

    // Configuração
    $config = new AsaasConfig(AsaasConfig::ENV_SANDBOX);
    $httpClient = new HttpClient($token, $config);

    // Instanciar o endpoint Pix
    $pixEndpoint = new PixEndpoint($httpClient);

    // Realizar o pagamento via QR Code
    $response = $pixEndpoint->payWithQrCode(
        'EXEMPLO_PAYLOAD_QRCODE', // Payload do QR Code
        100.00,                  // Valor
        'Pagamento de churrasco', // Descrição (opcional)
        '2025-04-15',            // Data de agendamento (opcional)
        10.00                    // Valor do troco (opcional)
    );

    // Exibir a resposta
    echo '<pre>';
    var_dump($response);
    echo '</pre>';
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}