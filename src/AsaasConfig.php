<?php

namespace Asaas;

class AsaasConfig
{
    public const ENV_PRODUCTION = 'production';
    public const ENV_SANDBOX = 'sandbox';

    private const BASE_URLS = [
        self::ENV_PRODUCTION => 'https://api.asaas.com/v3',
        self::ENV_SANDBOX => 'https://sandbox.asaas.com/api/v3',
    ];

    private string $environment;

    public function __construct(string $environment = self::ENV_PRODUCTION)
    {
        if (!isset(self::BASE_URLS[$environment])) {
            throw new \InvalidArgumentException("Ambiente inválido: $environment");
        }
        $this->environment = $environment;
    }

    public function getBaseUrl(): string
    {
        return self::BASE_URLS[$this->environment];
    }
}
