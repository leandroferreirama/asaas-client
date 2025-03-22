<?php

namespace Asaas\Models;

use Asaas\Contracts\TransactionInterface;

class TedTransfer implements TransactionInterface
{
    private float $value;
    private string $ownerName;
    private string $cpfCnpj;
    private string $agency;
    private string $account;
    private string $accountDigit;
    private ?string $accountName;
    private ?string $description;
    private ?string $ownerBirthDate;
    private ?string $bankAccountType;
    private ?string $ispb;
    private ?string $scheduleDate;

    public function __construct(
        float $value,
        string $ownerName,
        string $cpfCnpj,
        string $agency,
        string $account,
        string $accountDigit,
        ?string $accountName = null,
        ?string $description = null,
        ?string $ownerBirthDate = null,
        ?string $bankAccountType = null,
        ?string $ispb = null,
        ?string $scheduleDate = null
    ) {
        $this->value = $value;
        $this->ownerName = $ownerName;
        $this->cpfCnpj = $cpfCnpj;
        $this->agency = $agency;
        $this->account = $account;
        $this->accountDigit = $accountDigit;
        $this->accountName = $accountName;
        $this->description = $description;
        $this->ownerBirthDate = $ownerBirthDate;
        $this->bankAccountType = $bankAccountType;
        $this->ispb = $ispb;
        $this->scheduleDate = $scheduleDate;
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

        return $data;
    }
}
