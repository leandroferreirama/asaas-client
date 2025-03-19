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

## Criar Subconta

O exemplo abaixo demonstra como criar uma subconta utilizando o cliente PHP:

```php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\HttpClient;
use Asaas\Endpoints\SubaccountEndpoint;
use Asaas\Models\Subaccount;
use Asaas\Config\VariavelAmbiente;

// Token de acesso
VariavelAmbiente::load(__DIR__.'/../');
$token = getenv('ASAAS_TOKEN');

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

### Exemplo de Resposta da API

```php
array(2) {
    ["status_code"] => int(200),
    ["response"] => array(25) {
        ["object"] => string(7) "account",
        ["id"] => string(36) "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
        ["name"] => string(16) "Minha Subconta",
        ["email"] => string(22) "email@exemplo.com",
        ["loginEmail"] => string(22) "email@exemplo.com",
        ["phone"] => NULL,
        ["mobilePhone"] => string(11) "41999999999",
        ["address"] => NULL,
        ["addressNumber"] => string(3) "947",
        ["complement"] => NULL,
        ["province"] => NULL,
        ["postalCode"] => string(8) "82000000",
        ["cpfCnpj"] => string(14) "00000000000000",
        ["birthDate"] => NULL,
        ["personType"] => string(8) "JURIDICA",
        ["companyType"] => string(7) "LIMITED",
        ["city"] => int(13405),
        ["state"] => string(2) "PR",
        ["country"] => string(6) "Brasil",
        ["site"] => NULL,
        ["walletId"] => string(36) "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
        ["apiKey"] => string(166) "chave_api_generica",
        ["accountNumber"] => array(3) {
            ["agency"] => string(4) "0001",
            ["account"] => string(6) "123456",
            ["accountDigit"] => string(1) "1"
        },
        ["incomeValue"] => int(5000),
        ["commercialInfoExpiration"] => NULL
    }
}
```

## Criar Customer

O exemplo abaixo demonstra como criar um customer utilizando o cliente PHP:

```php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\HttpClient;
use Asaas\Endpoints\CustomerEndpoint;
use Asaas\Models\Customer;
use Asaas\Config\VariavelAmbiente;

// Token de acesso
VariavelAmbiente::load(__DIR__.'/../');
$token = getenv('ASAAS_TOKEN');

// Configuração
$config = new AsaasConfig(AsaasConfig::ENV_SANDBOX);
$httpClient = new HttpClient($token, $config);
$customerEndpoint = new CustomerEndpoint($httpClient);

// Criar customer
$customer = new Customer(
    'Cliente Completo',
    'cliente@teste.com',
    '12345678909', // CPF ou CNPJ
    '5511999998888', // Telefone
    '88000000',    // CEP
    'Rua Completa', // Endereço
    '123',         // Número
    'Bairro Completo', // Bairro
    'Curitiba',    // Cidade
    'PR',          // Estado
    'Brasil',      // País
    'Ref123',      // Referência externa (opcional)
    'Apto 10'      // Complemento (opcional)
);

$response = $customerEndpoint->create($customer);
var_dump($response);
```

### Exemplo de Resposta da API

```php
array(2) {
    ["status_code"] => int(200),
    ["response"] => array(30) {
        ["object"] => string(8) "customer",
        ["id"] => string(16) "cus_000006579435",
        ["dateCreated"] => string(10) "2025-03-18",
        ["name"] => string(16) "Cliente Completo",
        ["email"] => string(17) "cliente@teste.com",
        ["company"] => NULL,
        ["phone"] => string(12) "551140028922",
        ["mobilePhone"] => string(13) "5511999998888",
        ["address"] => string(12) "Rua Completa",
        ["addressNumber"] => string(3) "123",
        ["complement"] => string(7) "Apto 10",
        ["province"] => string(15) "Bairro Completo",
        ["postalCode"] => string(8) "88000000",
        ["cpfCnpj"] => string(11) "12345678909",
        ["personType"] => string(6) "FISICA",
        ["deleted"] => bool(false),
        ["additionalEmails"] => NULL,
        ["externalReference"] => string(6) "Ref123",
        ["notificationDisabled"] => bool(true),
        ["observations"] => NULL,
        ["municipalInscription"] => NULL,
        ["stateInscription"] => NULL,
        ["canDelete"] => bool(true),
        ["cannotBeDeletedReason"] => NULL,
        ["canEdit"] => bool(true),
        ["cannotEditReason"] => NULL,
        ["city"] => NULL,
        ["cityName"] => NULL,
        ["state"] => NULL,
        ["country"] => string(6) "Brasil"
    }
}
```

## Licença

Este projeto está licenciado sob a licença MIT. Consulte o arquivo `LICENSE` para mais detalhes.
