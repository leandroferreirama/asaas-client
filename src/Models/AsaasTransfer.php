<?php

namespace Asaas\Models;

use Asaas\Contracts\TransactionInterface;

class AsaasTransfer implements TransactionInterface
{
    private float $value;
    private string $walletId;
    private ?string $description;

    public function __construct(float $value, string $walletId, ?string $description = null)
    {
        $this->value = $value;
        $this->walletId = $walletId;
        $this->description = $description;
    }

    public function toArray(): array
    {
        $data = [
            'type' => 'ASAAS_ACCOUNT',
            'value' => $this->value,
            'walletId' => $this->walletId,
        ];

        if ($this->description !== null) {
            $data['description'] = $this->description;
        }

        return $data;
    }
}
