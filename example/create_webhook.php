<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\WebhookEndpoint;
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

    $webhookEndpoint = new WebhookEndpoint($httpClient);

    // Criar webhook
    $webhook = new Webhook(
        'Nome Exemplo', // Nome do Webhook
        'https://www.exemplo.com/webhook', // URL de destino dos eventos
        'suporte@integracaosistema.com.br', // E-mail que receberá notificações sobre o Webhook
        true, // Webhook ativo
        false, // Fila de sincronização não interrompida
        3, // Versão da API
        'authToken', // Token de autenticação do Webhook
        'NON_SEQUENTIALLY', // Envio não sequencial
    );
    $webhook->addPaymentEvents();

    // Enviar webhook para criação
    $response = $webhookEndpoint->create($webhook);

    // Resposta final combinada
    echo '<pre>';
    var_dump($response);
    echo '</pre>';
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}