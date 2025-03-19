<?php

namespace Asaas\Models;

use Asaas\Contracts\TransactionInterface;

class Subaccount implements TransactionInterface
{
    public function __construct(
        public string $name,
        public string $email,
        public string $cpfCnpj,
        public string $mobilePhone,
        public float $incomeValue,
        public string $addressNumber,
        public string $postalCode,
        public ?string $address = null,
        public ?string $province = null,
        public ?string $loginEmail = null,
        public ?string $birthDate = null,
        public ?string $companyType = null,
        public ?string $phone = null,
        public ?string $site = null,
        public ?string $complement = null,
        public array $webhooks = [] // Adicionado para aceitar webhooks
    ) {}

    public function toArray(): array
    {
        $data = get_object_vars($this);
        $data['webhooks'] = array_map(fn($webhook) => $webhook->toArray(), $this->webhooks);
        return $data;
    }
}