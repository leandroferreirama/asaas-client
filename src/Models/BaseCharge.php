<?php

namespace Asaas\Models;

use Asaas\Contracts\TransactionInterface;
use InvalidArgumentException;

class BaseCharge implements TransactionInterface
{
    protected string $customer;
    protected string $billingType;
    protected float $value;
    protected string $dueDate;
    protected ?string $description;
    protected ?string $externalReference;
    protected array $extraFields = [];

    public function __construct(
        string $customer,
        string $billingType,
        float $value,
        string $dueDate,
        ?string $description = null,
        ?string $externalReference = null
    ) {
        $this->customer = $customer;
        $this->billingType = $billingType;
        $this->value = $value;
        $this->dueDate = $dueDate;
        $this->description = $description;
        $this->externalReference = $externalReference;
    }

    /**
     * Adiciona dados para cobranças parceladas.
     *
     * @param int|null $installmentCount Número de parcelas
     * @param float|null $totalValue Valor total da cobrança
     * @param float|null $installmentValue Valor individual de cada parcela
     *
     * @throws InvalidArgumentException
     */
    public function addInstallmentFields(?int $installmentCount, ?float $totalValue, ?float $installmentValue): void
    {
        if ($installmentCount !== null) {
            if ($totalValue === null && $installmentValue === null) {
                throw new InvalidArgumentException(
                    'Ao enviar o número de parcelas, é obrigatório informar o valor total ou o valor individual de cada parcela.'
                );
            }

            if ($totalValue !== null && $installmentValue !== null) {
                throw new InvalidArgumentException(
                    'Você deve informar apenas o valor total ou o valor individual de cada parcela, não ambos.'
                );
            }

            $this->extraFields['installmentCount'] = $installmentCount;

            if ($totalValue !== null) {
                $this->extraFields['totalValue'] = $totalValue;
            }

            if ($installmentValue !== null) {
                $this->extraFields['installmentValue'] = $installmentValue;
            }
        }
    }

    /**
     * Adiciona dados do cartão de crédito para cobranças.
     *
     * @param array $creditCard Dados do cartão de crédito
     * @param array $creditCardHolderInfo Dados do titular do cartão
     * @param string $ip IP do cliente
     *
     * @throws InvalidArgumentException
     */
    public function addCreditCardData(array $creditCard, array $creditCardHolderInfo, string $ip): void
    {
        if (empty($creditCard) || empty($creditCardHolderInfo) || empty($ip)) {
            throw new InvalidArgumentException('Os campos creditCard, creditCardHolderInfo e ip são obrigatórios para compras com cartão de crédito.');
        }

        $this->extraFields['creditCard'] = $creditCard;
        $this->extraFields['creditCardHolderInfo'] = $creditCardHolderInfo;
        $this->extraFields['ip'] = $ip;
    }

    /**
     * Adiciona dados do token do cartão de crédito para cobranças.
     *
     * @param string $creditCardToken Token do cartão de crédito
     * @param string $ip IP do cliente
     *
     * @throws InvalidArgumentException
     */
    public function addCreditCardToken(string $creditCardToken, string $ip): void
    {
        if (empty($creditCardToken) || empty($ip)) {
            throw new InvalidArgumentException('Os campos creditCardToken e ip são obrigatórios para compras com token de cartão.');
        }

        $this->extraFields['creditCardToken'] = $creditCardToken;
        $this->extraFields['ip'] = $ip;
    }

    /**
     * Adiciona campos extras à cobrança.
     *
     * @param string $key Nome do campo extra
     * @param mixed $value Valor do campo extra
     */
    public function addExtraField(string $key, $value): void
    {
        $this->extraFields[$key] = $value;
    }

    /**
     * Adiciona dados de desconto à cobrança.
     *
     * @param float $value Valor do desconto
     * @param int $dueDateLimitDays Dias limite para aplicar o desconto
     * @param string $type Tipo do desconto (ex: FIXED ou PERCENTAGE)
     *
     * @throws InvalidArgumentException
     */
    public function addDiscount(float $value, int $dueDateLimitDays, ?string $type = 'FIXED'): void
    {
        if ($value <= 0) {
            throw new InvalidArgumentException('O valor do desconto deve ser maior que zero.');
        }

        if ($dueDateLimitDays < 0) {
            throw new InvalidArgumentException('Os dias limite para o desconto não podem ser negativos.');
        }

        if (!in_array($type, ['FIXED', 'PERCENTAGE'], true)) {
            throw new InvalidArgumentException('O tipo de desconto deve ser "FIXED" ou "PERCENTAGE".');
        }

        $this->extraFields['discount'] = [
            'value' => $value,
            'dueDateLimitDays' => $dueDateLimitDays,
            'type' => $type,
        ];
    }

    /**
     * Adiciona dados de juros à cobrança.
     *
     * @param float $value Valor do juros (percentual)
     *
     * @throws InvalidArgumentException
     */
    public function addInterest(float $value): void
    {
        if ($value <= 0) {
            throw new InvalidArgumentException('O valor do juros deve ser maior que zero.');
        }

        $this->extraFields['interest'] = [
            'value' => $value,
        ];
    }

    /**
     * Adiciona dados de multa à cobrança.
     *
     * @param float $value Valor da multa
     * @param string $type Tipo da multa (ex: FIXED ou PERCENTAGE)
     *
     * @throws InvalidArgumentException
     */
    public function addFine(float $value, ?string $type = 'FIXED'): void
    {
        if ($value <= 0) {
            throw new InvalidArgumentException('O valor da multa deve ser maior que zero.');
        }

        if (!in_array($type, ['FIXED', 'PERCENTAGE'], true)) {
            throw new InvalidArgumentException('O tipo da multa deve ser "FIXED" ou "PERCENTAGE".');
        }

        $this->extraFields['fine'] = [
            'value' => $value,
            'type' => $type,
        ];
    }

    /**
     * Converte os dados da cobrança para um array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'customer' => $this->customer,
            'billingType' => $this->billingType,
            'value' => $this->value,
            'dueDate' => $this->dueDate,
        ];

        if ($this->description !== null) {
            $data['description'] = $this->description;
        }

        if ($this->externalReference !== null) {
            $data['externalReference'] = $this->externalReference;
        }

        return array_merge($data, $this->extraFields);
    }
}
