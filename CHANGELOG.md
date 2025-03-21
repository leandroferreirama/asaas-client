# Changelog

Todos os principais eventos e mudanças neste projeto serão documentados aqui.

O formato é baseado em [Keep a Changelog](https://keepachangelog.com/pt-BR/1.0.0/), e este projeto segue [Semantic Versioning](https://semver.org/lang/pt-BR/).

## [Unreleased]
### Adicionado
- Planejamento para novos recursos e melhorias.

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