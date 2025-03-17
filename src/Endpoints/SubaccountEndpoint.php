<?php

namespace Asaas\Endpoints;

use Asaas\Contracts\HttpClientInterface;
use Asaas\Models\Subaccount;

class SubaccountEndpoint
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function create(Subaccount $subaccount): array
    {
        return $this->httpClient->request('POST', '/accounts', $subaccount->toArray());
    }

    public function getById(string $id): array
    {
        return $this->httpClient->request('GET', "/accounts/{$id}");
    }
}
