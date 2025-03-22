<?php

namespace Asaas\Endpoints;

use Asaas\Contracts\HttpClientInterface;
use Asaas\Contracts\TransactionInterface;

class TransferEndpoint
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function create(TransactionInterface $transfer): array
    {
        return $this->httpClient->request('POST', '/transfers', $transfer->toArray());
    }

    public function list(): array
    {
        return $this->httpClient->request('GET', '/transfers');
    }

    public function delete(string $transferId): array
    {
        return $this->httpClient->request('DELETE', "/transfers/$transferId");
    }
}
