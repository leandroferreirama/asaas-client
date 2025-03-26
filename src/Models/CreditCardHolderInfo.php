<?php

namespace Asaas\Models;

class CreditCardHolderInfo
{
    private string $name;
    private string $email;
    private string $cpfCnpj;
    private string $postalCode;
    private string $addressNumber;
    private ?string $addressComplement;
    private string $phone;
    private string $mobilePhone;

    public function __construct(
        string $name,
        string $email,
        string $cpfCnpj,
        string $postalCode,
        string $addressNumber,
        ?string $addressComplement,
        string $phone,
        string $mobilePhone
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->cpfCnpj = $cpfCnpj;
        $this->postalCode = $postalCode;
        $this->addressNumber = $addressNumber;
        $this->addressComplement = $addressComplement;
        $this->phone = $phone;
        $this->mobilePhone = $mobilePhone;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'cpfCnpj' => $this->cpfCnpj,
            'postalCode' => $this->postalCode,
            'addressNumber' => $this->addressNumber,
            'addressComplement' => $this->addressComplement,
            'phone' => $this->phone,
            'mobilePhone' => $this->mobilePhone,
        ];
    }
}