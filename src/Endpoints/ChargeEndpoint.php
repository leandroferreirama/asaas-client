<?php

namespace Asaas\Endpoints;

use Asaas\Contracts\HttpClientInterface;
use Asaas\Contracts\TransactionInterface;
use Asaas\Models\CreditCard;
use Asaas\Models\CreditCardHolderInfo;
use Asaas\Models\CreditCardTokenization;

class ChargeEndpoint
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function create(TransactionInterface $charge): array
    {
        return $this->httpClient->request('POST', '/payments', $charge->toArray());
    }

    public function tokenizeCreditCard(TransactionInterface $tokenization): array
    {
        return $this->httpClient->request('POST', '/creditCard/tokenizeCreditCard', $tokenization->toArray());
    }

    public function captureAuthorizedPayment(string $paymentId): array
    {
        $endpoint = "/payments/{$paymentId}/captureAuthorizedPayment";
        return $this->httpClient->request('POST', $endpoint);
    }
}
