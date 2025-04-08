<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\InvoiceEndpoint;
use Asaas\Models\Invoice;

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

    $invoiceEndpoint = new InvoiceEndpoint($httpClient);

    // Criar o objeto Invoice
    $invoice = new Invoice(
        null, // ID da cobrança
        null, // ID do parcelamento (opcional)
        'cus_000006622832', // ID do cliente
        'Mensalidade referente ao mês de abril', // Descrição dos serviços
        'Observações adicionais', // Observações
        300.0, // Valor total
        0, // Deduções
        '2025-04-07', // Data de emissão
        '2.08', // Código do serviço municipal
        null, // Nome do serviço municipal (opcional)
        false, // Atualizar o valor da cobrança com os impostos (opcional)
        null // Referência externa (opcional)
    );

    // Configurar os impostos
    $invoice->setTaxes(false, 0, 0, 0, 0, 0, 3);

    // Agendar a nota fiscal
    $response = $invoiceEndpoint->scheduleInvoice($invoice);

    // Resposta da API
    echo "Nota fiscal agendada com sucesso:\n";
    print_r($response);
} catch (Exception $e) {
    echo 'Erro ao agendar a nota fiscal: ' . $e->getMessage();
}