<?php

namespace Asaas\Models;

use Asaas\Contracts\TransactionInterface;

class PixTransfer implements TransactionInterface
{
    private float $value;
    private string $pixAddressKey;
    private string $pixAddressKeyType;
    private string $operationType;
    private ?string $description;
    private ?string $scheduleDate; // Nova propriedade

    public function __construct(
        float $value,
        string $pixAddressKey,
        string $operationType = 'PIX',
        ?string $description = null,
        ?string $scheduleDate = null // Adicionado ao construtor
    ) {
        $this->value = $value;
        $this->pixAddressKey = $pixAddressKey;
        $this->pixAddressKeyType = $this->detectPixKeyType($pixAddressKey);
        $this->operationType = $operationType;
        $this->description = $description;
        $this->scheduleDate = $scheduleDate;
    }

    private function detectPixKeyType(string $pixAddressKey): string
    {
        // Detect CPF
        if (preg_match('/^\d{11}$/', $pixAddressKey)) {
            return 'CPF';
        }

        // Detect CNPJ
        if (preg_match('/^\d{14}$/', $pixAddressKey)) {
            return 'CNPJ';
        }

        // Detect EMAIL
        if (filter_var($pixAddressKey, FILTER_VALIDATE_EMAIL)) {
            return 'EMAIL';
        }

        // Detect PHONE
        if (preg_match('/^\+\d{11,15}$/', $pixAddressKey)) {
            return 'PHONE';
        }

        // Default to EVP
        return 'EVP';
    }

    public function toArray(): array
    {
        $data = [
            'operationType' => $this->operationType,
            'value' => $this->value,
            'pixAddressKey' => $this->pixAddressKey,
            'pixAddressKeyType' => $this->pixAddressKeyType,
        ];

        if ($this->description !== null) {
            $data['description'] = $this->description;
        }

        // Adicionando scheduleDate apenas se preenchido
        if ($this->scheduleDate !== null) {
            $data['scheduleDate'] = $this->scheduleDate;
        }

        return $data;
    }
}
