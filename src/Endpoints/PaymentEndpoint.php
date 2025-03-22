<?php

namespace Asaas\Endpoints;

use Asaas\Contracts\HttpClientInterface;
use Asaas\Models\Payment;

class PaymentEndpoint
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function create(Payment $payment): array
    {
        return $this->httpClient->request('POST', '/bill', $payment->toArray());
    }

    public function list(): array
    {
        return $this->httpClient->request('GET', '/bill');
    }

    public function update(string $paymentId, Payment $payment): array
    {
        return $this->httpClient->request('PUT', "/bill/$paymentId", $payment->toArray());
    }

    public function delete(string $paymentId): array
    {
        return $this->httpClient->request('DELETE', "/bill/$paymentId");
    }
}
