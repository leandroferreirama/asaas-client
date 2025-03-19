<?php

namespace Asaas\Models;

use Asaas\Contracts\TransactionInterface;

class Webhook implements TransactionInterface
{
    public function __construct(
        public string $name,
        public string $url,
        public string $email,
        public bool $enabled = true,
        public bool $interrupted = false,
        public int $apiVersion = 3,
        public ?string $authToken = null,
        public string $sendType = 'NON_SEQUENTIALLY', // Valor padrão ajustado
        public ?array $events = null // Aceitar eventos nulos e mover para o final
    ) {}

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function addEvent(string $event): void
    {
        if ($this->events === null) {
            $this->events = [];
        }
        $this->events[] = $event;
    }

    public function addPaymentEvents(): void
    {
        if ($this->events === null) {
            $this->events = [];
        }
        $this->events = array_merge($this->events, [
            'PAYMENT_CREATED',
            'PAYMENT_AWAITING_RISK_ANALYSIS',
            'PAYMENT_APPROVED_BY_RISK_ANALYSIS',
            'PAYMENT_REPROVED_BY_RISK_ANALYSIS',
            'PAYMENT_AUTHORIZED',
            'PAYMENT_UPDATED',
            'PAYMENT_CONFIRMED',
            'PAYMENT_RECEIVED',
            'PAYMENT_CREDIT_CARD_CAPTURE_REFUSED',
            'PAYMENT_ANTICIPATED',
            'PAYMENT_OVERDUE',
            'PAYMENT_DELETED',
            'PAYMENT_RESTORED',
            'PAYMENT_REFUNDED',
            'PAYMENT_PARTIALLY_REFUNDED',
            'PAYMENT_REFUND_IN_PROGRESS',
            'PAYMENT_RECEIVED_IN_CASH_UNDONE',
            'PAYMENT_CHARGEBACK_REQUESTED',
            'PAYMENT_CHARGEBACK_DISPUTE',
            'PAYMENT_AWAITING_CHARGEBACK_REVERSAL',
            'PAYMENT_DUNNING_RECEIVED',
            'PAYMENT_DUNNING_REQUESTED',
            'PAYMENT_BANK_SLIP_VIEWED',
            'PAYMENT_CHECKOUT_VIEWED',
            'PAYMENT_SPLIT_CANCELLED',
            'PAYMENT_SPLIT_DIVERGENCE_BLOCK',
            'PAYMENT_SPLIT_DIVERGENCE_BLOCK_FINISHED'
        ]);
    }

    public function addInvoiceEvents(): void
    {
        if ($this->events === null) {
            $this->events = [];
        }
        $this->events = array_merge($this->events, [
            'INVOICE_CREATED',
            'INVOICE_UPDATED',
            'INVOICE_SYNCHRONIZED',
            'INVOICE_AUTHORIZED',
            'INVOICE_PROCESSING_CANCELLATION',
            'INVOICE_CANCELED',
            'INVOICE_CANCELLATION_DENIED',
            'INVOICE_ERROR'
        ]);
    }

    public function addTransferEvents(): void
    {
        if ($this->events === null) {
            $this->events = [];
        }
        $this->events = array_merge($this->events, [
            'TRANSFER_CREATED',
            'TRANSFER_PENDING',
            'TRANSFER_IN_BANK_PROCESSING',
            'TRANSFER_BLOCKED',
            'TRANSFER_DONE',
            'TRANSFER_FAILED',
            'TRANSFER_CANCELLED'
        ]);
    }

    public function addBillEvents(): void
    {
        if ($this->events === null) {
            $this->events = [];
        }
        $this->events = array_merge($this->events, [
            'BILL_CREATED',
            'BILL_PENDING',
            'BILL_BANK_PROCESSING',
            'BILL_PAID',
            'BILL_CANCELLED',
            'BILL_FAILED',
            'BILL_REFUNDED'
        ]);
    }

    public function addAccountStatusEvents(): void
    {
        if ($this->events === null) {
            $this->events = [];
        }
        $this->events = array_merge($this->events, [
            'ACCOUNT_STATUS_BANK_ACCOUNT_INFO_APPROVED',
            'ACCOUNT_STATUS_BANK_ACCOUNT_INFO_AWAITING_APPROVAL',
            'ACCOUNT_STATUS_BANK_ACCOUNT_INFO_PENDING',
            'ACCOUNT_STATUS_BANK_ACCOUNT_INFO_REJECTED',
            'ACCOUNT_STATUS_COMMERCIAL_INFO_APPROVED',
            'ACCOUNT_STATUS_COMMERCIAL_INFO_AWAITING_APPROVAL',
            'ACCOUNT_STATUS_COMMERCIAL_INFO_PENDING',
            'ACCOUNT_STATUS_COMMERCIAL_INFO_REJECTED',
            'ACCOUNT_STATUS_DOCUMENT_APPROVED',
            'ACCOUNT_STATUS_DOCUMENT_AWAITING_APPROVAL',
            'ACCOUNT_STATUS_DOCUMENT_PENDING',
            'ACCOUNT_STATUS_DOCUMENT_REJECTED',
            'ACCOUNT_STATUS_GENERAL_APPROVAL_APPROVED',
            'ACCOUNT_STATUS_GENERAL_APPROVAL_AWAITING_APPROVAL',
            'ACCOUNT_STATUS_GENERAL_APPROVAL_PENDING',
            'ACCOUNT_STATUS_GENERAL_APPROVAL_REJECTED'
        ]);
    }
}