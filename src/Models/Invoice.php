<?php

namespace Asaas\Models;

use Asaas\Contracts\TransactionInterface;
use InvalidArgumentException;

class Invoice implements TransactionInterface
{
    private ?string $payment;
    private ?string $installment;
    private ?string $customer;
    private string $serviceDescription;
    private string $observations;
    private float $value;
    private float $deductions;
    private string $effectiveDate;
    private string $municipalServiceCode;
    private ?string $municipalServiceName;
    private ?bool $updatePayment;
    private array $taxes = [];
    private ?string $externalReference;

    public function __construct(
        ?string $payment,
        ?string $installment,
        ?string $customer,
        string $serviceDescription,
        string $observations,
        float $value,
        float $deductions,
        string $effectiveDate,
        string $municipalServiceCode,
        ?string $municipalServiceName = null,
        ?bool $updatePayment = false,
        ?string $externalReference = null
    ) {
        // Garantir que pelo menos um dos campos seja preenchido
        if (empty($payment) && empty($installment) && empty($customer)) {
            throw new InvalidArgumentException(
                'Pelo menos um dos campos payment, installment ou customer deve ser preenchido.'
            );
        }

        if (empty($serviceDescription)) {
            throw new InvalidArgumentException('O campo serviceDescription é obrigatório.');
        }

        if (empty($observations)) {
            throw new InvalidArgumentException('O campo observations é obrigatório.');
        }

        if ($value <= 0) {
            throw new InvalidArgumentException('O valor total deve ser maior que zero.');
        }

        if ($deductions < 0) {
            throw new InvalidArgumentException('As deduções não podem ser negativas.');
        }

        if (empty($effectiveDate)) {
            throw new InvalidArgumentException('O campo effectiveDate é obrigatório.');
        }

        if (empty($municipalServiceCode)) {
            throw new InvalidArgumentException('O campo municipalServiceCode é obrigatório.');
        }

        $this->payment = $payment;
        $this->installment = $installment;
        $this->customer = $customer;
        $this->serviceDescription = $serviceDescription;
        $this->observations = $observations;
        $this->value = $value;
        $this->deductions = $deductions;
        $this->effectiveDate = $effectiveDate;
        $this->municipalServiceCode = $municipalServiceCode;
        $this->municipalServiceName = $municipalServiceName;
        $this->updatePayment = $updatePayment;
        $this->externalReference = $externalReference;
    }

    /**
     * Configura os impostos da nota fiscal.
     *
     * @param bool $retainIss
     * @param float $cofins
     * @param float $csll
     * @param float $inss
     * @param float $ir
     * @param float $pis
     * @param float $iss
     */
    public function setTaxes(
        bool $retainIss,
        float $cofins,
        float $csll,
        float $inss,
        float $ir,
        float $pis,
        float $iss
    ): void {
        $this->taxes = [
            'retainIss' => $retainIss,
            'cofins' => $cofins,
            'csll' => $csll,
            'inss' => $inss,
            'ir' => $ir,
            'pis' => $pis,
            'iss' => $iss,
        ];
    }

    /**
     * Converte os dados da nota fiscal para um array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'payment' => $this->payment,
            'installment' => $this->installment,
            'customer' => $this->customer,
            'serviceDescription' => $this->serviceDescription,
            'observations' => $this->observations,
            'value' => $this->value,
            'deductions' => $this->deductions,
            'effectiveDate' => $this->effectiveDate,
            'municipalServiceCode' => $this->municipalServiceCode,
            'taxes' => $this->taxes,
        ];

        if ($this->municipalServiceName !== null) {
            $data['municipalServiceName'] = $this->municipalServiceName;
        }

        if ($this->updatePayment !== null) {
            $data['updatePayment'] = $this->updatePayment;
        }

        if ($this->externalReference !== null) {
            $data['externalReference'] = $this->externalReference;
        }

        return $data;
    }
}