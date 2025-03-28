<?php

namespace Asaas\Models;

use Asaas\Contracts\TransactionInterface;

class TedTransfer implements TransactionInterface
{
    public function __construct(
        private ?float $value,
        private ?string $ownerName,
        private ?string $cpfCnpj,
        private ?string $agency,
        private ?string $account,
        private ?string $accountDigit,
        private ?string $bankCode = null,
        private ?string $accountName = null,
        private ?string $description = null,
        private ?string $ownerBirthDate = null,
        private ?string $bankAccountType = null,
        private ?string $ispb = null,
        private ?string $scheduleDate = null
    ) {
        // Validação do valor da transferência
        if ($this->value <= 0) {
            throw new \InvalidArgumentException('O valor da transferência deve ser maior que zero.');
        }

        // Validação do nome do proprietário
        if (empty($this->ownerName)) {
            throw new \InvalidArgumentException('O nome do proprietário da conta é obrigatório.');
        }

        // Validação do CPF ou CNPJ
        if (empty($this->cpfCnpj)) {
            throw new \InvalidArgumentException('O CPF ou CNPJ do proprietário da conta é obrigatório.');
        }

        // Validação da agência
        if (empty($this->agency)) {
            throw new \InvalidArgumentException('O número da agência é obrigatório.');
        }

        // Validação da conta bancária
        if (empty($this->account)) {
            throw new \InvalidArgumentException('O número da conta bancária é obrigatório.');
        }

        // Validação do dígito da conta bancária
        if (empty($this->accountDigit)) {
            throw new \InvalidArgumentException('O dígito da conta bancária é obrigatório.');
        }

        // Validação do código do banco ou ISPB
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
