<?php

namespace Asaas\Endpoints;

use Asaas\Contracts\HttpClientInterface;
use Asaas\Models\Webhook;

class WebhookEndpoint
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Lista todos os webhooks cadastrados na conta.
     *
     * @param int $offset Elemento inicial da lista
     * @param int $limit Número de elementos da lista (max: 100)
     * @return array
     */
    public function list(int $offset = 0, int $limit = 10): array
    {
        $queryParams = http_build_query([
            'offset' => $offset,
            'limit' => $limit
        ]);

        return $this->httpClient->request('GET', "/webhooks?$queryParams");
    }

    /**
     * Cria um novo webhook.
     *
     * @param Webhook $webhook Objeto Webhook
     * @return array
     */
    public function create(Webhook $webhook): array
    {
        return $this->httpClient->request('POST', '/webhooks', $webhook->toArray());
    }
}