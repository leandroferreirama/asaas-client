<?php

namespace Asaas\Contracts;

interface HttpClientInterface
{
    public function request(string $method, string $endpoint, array $data = []): array;
}
