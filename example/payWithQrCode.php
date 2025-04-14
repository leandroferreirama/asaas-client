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
        '00020101021226840014br.gov.bcb.pix2562qr.iugu.com/public/payload/v2/7CBA60A6B12F42D4B403DF59EAD478D55204000053039865406179.005802BR5925FRANCIELI BARBOZA DE SOUZ6007OLIMPIA62070503***6304660F', // Payload do QR Code
        179.00,                  // Valor
    );

    // Exibir a resposta
    echo '<pre>';
    var_dump($response);
    echo '</pre>';
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}