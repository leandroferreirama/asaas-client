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
        array $creditCard,
        array $creditCardHolderInfo,
        string $ip,
        ?string $description = null,
        ?string $externalReference = null
    ): BaseCharge {
        $charge = new BaseCharge($customer, 'CREDIT_CARD', $value, $dueDate, $description, $externalReference);
        $charge->addCreditCardData($creditCard, $creditCardHolderInfo, $ip);

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
