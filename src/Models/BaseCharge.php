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
