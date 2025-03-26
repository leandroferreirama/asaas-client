<?php

namespace Asaas\Factories;

use Asaas\Models\BaseCharge;

class ChargeFactory
{
    /**
     * Cria uma cobrança genérica.
     */
    public static function createCharge(
        string $customer,
        string $billingType,
        float $value,
        string $dueDate,
        ?string $description = null,
        ?string $externalReference = null
    ): BaseCharge {
        return new BaseCharge($customer, $billingType, $value, $dueDate, $description, $externalReference);
    }

    /**
     * Cria uma cobrança via cartão de crédito com os dados completos do cartão.
     */
    public static function createCreditCardCharge(
        string $customer,
        float $value,
        string $dueDate,
        string $holderName,
        string $number,
        string $expiryMonth,
        string $expiryYear,
        string $ccv,
        string $cardHolderName,
        string $cardHolderEmail,
        string $cardHolderCpfCnpj,
        string $postalCode,
        string $addressNumber,
        ?string $addressComplement,
        string $phone,
        string $mobilePhone,
        string $ip,
        ?string $description = null,
        ?string $externalReference = null,
        bool $authorizeOnly = false // Novo parâmetro com valor padrão
    ): BaseCharge {
        $charge = new BaseCharge($customer, 'CREDIT_CARD', $value, $dueDate, $description, $externalReference);

        $creditCard = [
            'holderName' => $holderName,
            'number' => $number,
            'expiryMonth' => $expiryMonth,
            'expiryYear' => $expiryYear,
            'ccv' => $ccv,
        ];

        $creditCardHolderInfo = [
            'name' => $cardHolderName,
            'email' => $cardHolderEmail,
            'cpfCnpj' => $cardHolderCpfCnpj,
            'postalCode' => $postalCode,
            'addressNumber' => $addressNumber,
            'addressComplement' => $addressComplement,
            'phone' => $phone,
            'mobilePhone' => $mobilePhone,
        ];

        $charge->addCreditCardData($creditCard, $creditCardHolderInfo, $ip);

        // Adicionando o campo authorizeOnly
        $charge->setAuthorizeOnly($authorizeOnly);

        return $charge;
    }

    /**
     * Cria uma cobrança via token do cartão de crédito.
     */
    public static function createCreditCardTokenCharge(
        string $customer,
        float $value,
        string $dueDate,
        string $creditCardToken,
        string $ip,
        ?string $description = null,
        ?string $externalReference = null
    ): BaseCharge {
        $charge = new BaseCharge($customer, 'CREDIT_CARD', $value, $dueDate, $description, $externalReference);
        $charge->addCreditCardToken($creditCardToken, $ip);

        return $charge;
    }

    /**
     * Cria uma cobrança parcelada (genérica).
     */
    public static function createInstallmentCharge(
        string $customer,
        string $billingType,
        float $value,
        string $dueDate,
        ?int $installmentCount,
        ?float $totalValue,
        ?float $installmentValue,
        ?string $description = null,
        ?string $externalReference = null
    ): BaseCharge {
        $charge = new BaseCharge($customer, $billingType, $value, $dueDate, $description, $externalReference);
        $charge->addInstallmentFields($installmentCount, $totalValue, $installmentValue);

        return $charge;
    }
}
