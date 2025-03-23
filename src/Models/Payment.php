<?php

namespace Asaas\Models;

use Asaas\Contracts\TransactionInterface;

class Payment implements TransactionInterface
{
    private string $identificationField;
    private ?string $scheduleDate;
    private ?string $description;
    private ?float $discount;
    private ?float $interest;
    private ?float $fine;
    private ?string $dueDate;
    private ?float $value;
    private ?string $externalReference;

    public function __construct(
        string $identificationField,
        ?string $scheduleDate = null,
        ?string $description = null,
        ?float $discount = null,
        ?float $interest = null,
        ?float $fine = null,
        ?string $dueDate = null,
        ?float $value = null,
        ?string $externalReference = null
    ) {
        $this->identificationField = $identificationField;
        $this->scheduleDate = $scheduleDate;
        $this->description = $description;
        $this->discount = $discount;
        $this->interest = $interest;
        $this->fine = $fine;
        $this->dueDate = $dueDate;
        $this->value = $value;
        $this->externalReference = $externalReference;
    }

    public function toArray(): array
    {
        $data = [
            'identificationField' => $this->identificationField,
        ];

        if ($this->scheduleDate !== null) {
            $data['scheduleDate'] = $this->scheduleDate;
        }

        if ($this->description !== null) {
            $data['description'] = $this->description;
        }

        if ($this->discount !== null) {
            $data['discount'] = $this->discount;
        }

        if ($this->interest !== null) {
            $data['interest'] = $this->interest;
        }

        if ($this->fine !== null) {
            $data['fine'] = $this->fine;
        }

        if ($this->dueDate !== null) {
            $data['dueDate'] = $this->dueDate;
        }

        if ($this->value !== null) {
            $data['value'] = $this->value;
        }

        if ($this->externalReference !== null) {
            $data['externalReference'] = $this->externalReference;
        }

        return $data;
    }
}
