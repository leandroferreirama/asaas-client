# Changelog

Todos os principais eventos e mudanças neste projeto serão documentados aqui.

O formato é baseado em [Keep a Changelog](https://keepachangelog.com/pt-BR/1.0.0/), e este projeto segue [Semantic Versioning](https://semver.org/lang/pt-BR/).

## [Unreleased]
### Adicionado
- Planejamento para novos recursos e melhorias.

## [0.0.26] - 2025-04-16
### Adicionado
- Método `getAnticipationById` na classe `AnticipationEndpoint` para recuperar uma única antecipação pelo ID.

## [0.0.25] - 2025-04-15
### Corrigido
- Ajuste no endpoint de pagamento de QR Codes na classe `PixEndpoint`:
  - Corrigido o caminho do endpoint para `/v3/pix/qrCodes/pay`.
  - Simplificação do método `payWithQrCode` para receber os parâmetros diretamente.

## [0.0.24] - 2025-04-14
### Adicionado
- Suporte ao pagamento de QR Codes:
  - Método `payWithQrCode` na classe `PixEndpoint` para realizar pagamentos utilizando QR Codes.
  - Parâmetros suportados: `payload`, `value`, `description` (opcional), `scheduleDate` (opcional) e `changeValue` (opcional).

## [0.0.23] - 2025-04-07
### Adicionado
- Suporte à emissão de **invoices**:
  - Método `createInvoice` na classe `InvoiceEndpoint` para criar invoices.
  - Método `getInvoice` para consultar invoices por ID.
  - Método `cancelInvoice` para cancelar invoices existentes.
  - Validação para garantir que os campos obrigatórios, como `customer`, `value` e `dueDate`, sejam preenchidos.

## [0.0.22] - 2025-04-05
### Alterado
- Padronização das respostas dos métodos `update` e `delete` na classe `BoletoEndpoint`:
  - Ambos os métodos agora retornam a resposta completa da API, garantindo maior flexibilidade no tratamento das respostas.

## [0.0.21] - 2025-04-05
### Adicionado
- Método `update` na classe `BoletoEndpoint` para permitir a alteração de cobranças existentes:
  - Atualização dinâmica dos campos `billingType`, `value` e `dueDate`.
  - Validação para garantir que o campo `billingType` seja obrigatório.
- Método `delete` na classe `BoletoEndpoint` para permitir a exclusão de cobranças existentes.

## [0.0.20] - 2025-03-29
### Adicionado
- Exemplos de criação de cobranças via Pix:
  - Exemplo de criação de cobrança com chave Pix.
  - Exemplo de criação de cobrança com QR Code Pix.

## [0.0.19] - 2025-03-28
### Corrigido
- Ajuste na model `TedTransfer`:
  - Alteração para permitir que o campo `cpfCnpj` aceite valores nulos (`null`).
  - Adicionada validação para retornar mensagens de erro no padrão da API quando campos obrigatórios não forem preenchidos.

## [0.0.18] - 2025-03-28
### Adicionado
- Validação aprimorada na classe `TedTransfer`:
  - Mensagens claras para campos obrigatórios ausentes, como `value`, `ownerName`, `cpfCnpj`, `agency`, `account`, `accountDigit`, e `bankCode` ou `ispb`.
  - Garantia de que o valor da transferência seja maior que zero.

## [0.0.17] - 2025-03-28
### Adicionado
- Suporte ao envio do código do banco (`bankCode`) na transferência via TED:
  - Ajuste na classe `TedTransfer` para aceitar o código do banco ou o ISPB.
  - Validação para garantir que pelo menos um dos dois campos seja informado.

## [0.0.16] - 2025-03-27
### Alterado
- Alteração da rota para trazer dados completos nas respostas das cobranças.

## [0.0.15] - 2025-03-26
### Corrigido
- Envio da `ChargeFactory` que não havia sido incluída no repositório anteriormente.

## [0.0.14] - 2025-03-26
### Adicionado
- Suporte à captura de cobranças com pré-autorização no cartão de crédito:
  - Método `captureAuthorizedPayment` no `ChargeEndpoint` para capturar cobranças autorizadas.

## [0.0.13] - 2025-03-25
### Adicionado
- Suporte ao recebimento em cartão de crédito, incluindo:
  - Tokenização de cartão de crédito.
  - Criação de cobranças via cartão de crédito.
  - Suporte a informações completas do cartão e do titular.

## [0.0.12] - 2025-03-24
### Adicionado
- Inclusão do envio da chave Pix com suporte aos tipos: CPF, CNPJ, TELEFONE, EVP e EMAIL.

## [0.0.11] - 2025-03-23
### Alterado
- Padronização da resposta do `HttpClient` para retornar sempre um array com as chaves `status_code` e `response`, tanto para respostas de sucesso quanto para erros.

## [0.0.10] - 2025-03-22
### Corrigido
- Envio da model `Payment` que não havia sido incluída no repositório anteriormente.

## [0.0.9] - 2025-03-22
### Lançado
- Endpoint para **pagamento de contas**.
- Endpoint para **transferência TED**.
- Endpoint para **transferência Pix**.

## [0.0.8] - 2025-03-21
### Adicionado
- Suporte ao parâmetro `order` (asc ou desc) no endpoint de consulta ao extrato financeiro (`/financialTransactions`).

## [0.0.7] - 2025-03-21
### Adicionado
- Endpoint para consulta ao extrato financeiro (`/financialTransactions`) com suporte aos parâmetros `offset`, `limit`, `startDate` e `finishDate`.

## [0.0.6] - 2025-03-21
### Adicionado
- Obtenção da linha digitável do boleto (`identificationField`) no método `create` do endpoint de boletos.
- Obtenção do QR Code para pagamentos via Pix (`payload`) no método `create` do endpoint de boletos.

## [0.0.5] - 2025-03-21
### Alterado
- Nome da classe `BoletoEndPoint` para normalizar com o nome do arquivo.

## [0.0.4] - 2025-03-20
### Adicionado
- Suporte para incluir webhooks no cadastro de subaccounts.
- Endpoint para listagem de webhooks.
- Exemplo de criação de webhooks utilizando métodos `add`.

## [0.0.3] - 2025-03-19
### Adicionado
- Suporte à emissão de boletos bancários.
- Métodos para configurar descontos, juros e multas em cobranças.

## [0.0.2] - 2025-03-18
### Adicionado
- Endpoint para criação de customers.
- Endpoint para consulta de customers por ID.

## [0.0.1] - 2025-03-16
### Adicionado
- Primeira versão inicial do cliente PHP para integração com a API Asaas.
- Suporte à criação de subcontas.
- Configuração inicial do projeto com `composer.json`.