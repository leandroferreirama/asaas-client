# Documentação de Uso - Asaas Client

Este documento descreve como utilizar o cliente PHP para integração com a API Asaas.

## Requisitos

- PHP 8.1 ou superior
- Composer para gerenciar dependências

## Instalação

1. Certifique-se de que o Composer está instalado no seu ambiente.
2. Adicione o cliente ao seu projeto:

   ```bash
   composer require leandroferreirama/asaas-client
   ```

3. Crie um arquivo .env na raiz do projeto e configure a variável de ambiente com seu token de acesso:

   ```bash
   ASAAS_TOKEN=seu_token_de_acesso_aqui
   ```

## Uso

```php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\HttpClient;
use Asaas\Endpoints\SubaccountEndpoint;
use Asaas\Models\Subaccount;

// Configuração
$config = new AsaasConfig(AsaasConfig::ENV_SANDBOX);
$httpClient = new HttpClient($token, $config);
$subaccountEndpoint = new SubaccountEndpoint($httpClient);

// Criar subconta
$subaccount = new Subaccount(
    'Minha Subconta',
    'email@email.com',
    '00000000000000',
    '41000000000',
    5000.00,
    '000',
    '00000000',
    companyType: 'LIMITED'
);

$response = $subaccountEndpoint->create($subaccount);
var_dump($response);
```
