<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\AnticipationEndpoint;

try {
    // Carregar variáveis de ambiente
    VariavelAmbiente::load(__DIR__ . '/../');
    $token = getenv('ASAAS_TOKEN');

    // Configuração
    $config = new AsaasConfig(AsaasConfig::ENV_SANDBOX);
    $httpClient = new HttpClient($token, $config);

    // Instanciar o endpoint de antecipações
    $anticipationEndpoint = new AnticipationEndpoint($httpClient);

    // Recuperar uma antecipação pelo ID
    $anticipationId = '1234567890'; // Substitua pelo ID real
    $response = $anticipationEndpoint->getAnticipationById($anticipationId);

    // Exibir a resposta
    echo '<pre>';
    var_dump($response);
    echo '</pre>';
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}