<?php

namespace Asaas\Models;

use Asaas\Contracts\TransactionInterface;

class Customer implements TransactionInterface
{
    private string $name;
    private string $cpfCnpj;
    private ?string $email;
    private ?string $phone;
    private ?string $mobilePhone;
    private ?string $postalCode;
    private ?string $address;
    private ?string $addressNumber;
    private ?string $complement;
    private ?string $province;
    private ?string $externalReference;
    private ?bool $notificationDisabled;

    public function __construct(
        string $name,
        string $cpfCnpj,
        ?string $email = null,
        ?string $phone = null,
        ?string $mobilePhone = null,
        ?string $postalCode = null,
        ?string $address = null,
        ?string $addressNumber = null,
        ?string $complement = null,
        ?string $province = null,
        ?string $externalReference = null,
        bool $notificationDisabled = true
    ) {
        $this->name = $name;
        $this->cpfCnpj = $cpfCnpj;
        $this->email = $email;
        $this->phone = $phone;
        $this->mobilePhone = $mobilePhone;
        $this->postalCode = $postalCode;
        $this->address = $address;
        $this->addressNumber = $addressNumber;
        $this->complement = $complement;
        $this->province = $province;
        $this->externalReference = $externalReference;
        $this->notificationDisabled = $notificationDisabled;
    }

    public function toArray(): array
    {
        $data = [
            'name' => $this->name,
            'cpfCnpj' => $this->cpfCnpj,
        ];

        if ($this->email !== null) {
            $data['email'] = $this->email;
        }
        if ($this->phone !== null) {
            $data['phone'] = $this->phone;
        }
        if ($this->mobilePhone !== null) {
            $data['mobilePhone'] = $this->mobilePhone;
        }
        if ($this->postalCode !== null) {
            $data['postalCode'] = $this->postalCode;
        }
        if ($this->address !== null) {
            $data['address'] = $this->address;
        }
        if ($this->addressNumber !== null) {
            $data['addressNumber'] = $this->addressNumber;
        }
        if ($this->complement !== null) {
            $data['complement'] = $this->complement;
        }
        if ($this->province !== null) {
            $data['province'] = $this->province;
        }
        if ($this->externalReference !== null) {
            $data['externalReference'] = $this->externalReference;
        }
        if ($this->notificationDisabled !== null) {
            $data['notificationDisabled'] = $this->notificationDisabled;
        }

        return $data;
    }
}
