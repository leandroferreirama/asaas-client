<?php

namespace Asaas\Models;

class CreditCard
{
    private string $holderName;
    private string $number;
    private string $expiryMonth;
    private string $expiryYear;
    private string $ccv;

    public function __construct(
        string $holderName,
        string $number,
        string $expiryMonth,
        string $expiryYear,
        string $ccv
    ) {
        $this->holderName = $holderName;
        $this->number = $number;
        $this->expiryMonth = $expiryMonth;
        $this->expiryYear = $expiryYear;
        $this->ccv = $ccv;
    }

    public function toArray(): array
    {
        return [
            'holderName' => $this->holderName,
            'number' => $this->number,
            'expiryMonth' => $this->expiryMonth,
            'expiryYear' => $this->expiryYear,
            'ccv' => $this->ccv,
        ];
    }
}