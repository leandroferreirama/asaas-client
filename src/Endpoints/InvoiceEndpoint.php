<?php

namespace Asaas\Endpoints;

use Asaas\Models\Invoice;
use Asaas\Contracts\HttpClientInterface;

class InvoiceEndpoint
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Agenda uma nota fiscal.
     *
     * @param Invoice $invoice Objeto da nota fiscal
     * @return array Resposta da API
     * @throws \Exception
     */
    public function scheduleInvoice(Invoice $invoice): array
    {
        // Enviar a requisição POST para o endpoint de agendamento de nota fiscal
        $response = $this->httpClient->request('POST', '/invoices', $invoice->toArray());

        // Retornar a resposta completa da API
        return $response;
    }
}