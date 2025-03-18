<?php

namespace Asaas\Endpoints;

use Asaas\Contracts\HttpClientInterface;
use Asaas\Models\Customer;

class CustomerEndpoint
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function create(Customer $customer): array
    {
        return $this->httpClient->request('POST', '/customers', $customer->toArray());
    }

    public function list(): array
    {
        return $this->httpClient->request('GET', '/customers');
    }

    public function update(string $customerId, Customer $customer): array
    {
        return $this->httpClient->request('PUT', "/customers/$customerId", $customer->toArray());
    }

    public function delete(string $customerId): array
    {
        return $this->httpClient->request('DELETE', "/customers/$customerId");
    }

    public function findByDocument(string $cpfCnpj): array
    {
        return $this->httpClient->request('GET', "/customers?cpfCnpj={$cpfCnpj}");
    }
}
