<?php

namespace Asaas\Models;

use Asaas\Contracts\TransactionInterface;

class AccountDocument implements TransactionInterface
{
    public const TYPE_IDENTIFICATION = 'IDENTIFICATION';
    public const TYPE_SOCIAL_CONTRACT = 'SOCIAL_CONTRACT';
    public const TYPE_ENTREPRENEUR_REQUIREMENT = 'ENTREPRENEUR_REQUIREMENT';
    public const TYPE_MINUTES_OF_ELECTION = 'MINUTES_OF_ELECTION';
    public const TYPE_CUSTOM = 'CUSTOM';

    private string $id;
    private string $filePath;
    private string $type;

    public function __construct(string $id, string $filePath, string $type)
    {
        $this->id = $id;
        $this->filePath = $filePath;
        $this->type = $type;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'filePath' => $this->filePath,
            'type' => $this->type
        ];
    }
}