<?php

namespace Asaas\Models;

use Asaas\Contracts\TransactionInterface;

class CreditCardTokenization implements TransactionInterface
{
    private string $customer;
    private CreditCard $creditCard;
    private CreditCardHolderInfo $creditCardHolderInfo;
    private string $remoteIp;

    public function __construct(
        string $customer,
        CreditCard $creditCard,
        CreditCardHolderInfo $creditCardHolderInfo,
        string $remoteIp
    ) {
        $this->customer = $customer;
        $this->creditCard = $creditCard;
        $this->creditCardHolderInfo = $creditCardHolderInfo;
        $this->remoteIp = $remoteIp;
    }

    public function toArray(): array
    {
        return [
            'customer' => $this->customer,
            'creditCard' => $this->creditCard->toArray(),
            'creditCardHolderInfo' => $this->creditCardHolderInfo->toArray(),
            'remoteIp' => $this->remoteIp,
        ];
    }
}