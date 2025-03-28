# Changelog

Todos os principais eventos e mudanças neste projeto serão documentados aqui.

O formato é baseado em [Keep a Changelog](https://keepachangelog.com/pt-BR/1.0.0/), e este projeto segue [Semantic Versioning](https://semver.org/lang/pt-BR/).

## [Unreleased]
### Adicionado
- Planejamento para novos recursos e melhorias.

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