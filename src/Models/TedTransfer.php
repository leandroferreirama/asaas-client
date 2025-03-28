<?php

namespace Asaas\Models;

use Asaas\Contracts\TransactionInterface;

class TedTransfer implements TransactionInterface
{
    public function __construct(
        private float $value,
        private string $ownerName,
        private string $cpfCnpj,
        private string $agency,
        private string $account,
        private string $accountDigit,
        private ?string $bankCode = null,
        private ?string $accountName = null,
        private ?string $description = null,
        private ?string $ownerBirthDate = null,
        private ?string $bankAccountType = null,
        private ?string $ispb = null,
        private ?string $scheduleDate = null
    ) {
        if (empty($this->bankCode) && empty($this->ispb)) {
            throw new \InvalidArgumentException('É necessário informar o código do banco (bankCode) ou o ISPB.');
        }
    }

    public function toArray(): array
    {
        $data = [
            'type' => 'TED',
            'value' => $this->value,
            'bankAccount' => [
                'ownerName' => $this->ownerName,
                'cpfCnpj' => $this->cpfCnpj,
                'agency' => $this->agency,
                'account' => $this->account,
                'accountDigit' => $this->accountDigit,
            ],
        ];

        if ($this->accountName !== null) {
            $data['bankAccount']['accountName'] = $this->accountName;
        }

        if ($this->description !== null) {
            $data['description'] = $this->description;
        }

        if ($this->ownerBirthDate !== null) {
            $data['bankAccount']['ownerBirthDate'] = $this->ownerBirthDate;
        }

        if ($this->bankAccountType !== null) {
            $data['bankAccount']['bankAccountType'] = $this->bankAccountType;
        }

        if ($this->ispb !== null) {
            $data['bankAccount']['ispb'] = $this->ispb;
        }

        // Adicionando scheduleDate apenas se preenchido
        if ($this->scheduleDate !== null) {
            $data['scheduleDate'] = $this->scheduleDate;
        }

        if (!empty($this->bankCode)) {
            $data['bankAccount']['bank'] = ['code' => $this->bankCode];
        } elseif (!empty($this->ispb)) {
            $data['bankAccount']['ispb'] = $this->ispb;
        }

        return $data;
    }
}
