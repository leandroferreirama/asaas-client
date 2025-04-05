<?php

namespace Asaas\Endpoints;

use Asaas\Contracts\HttpClientInterface;
use Asaas\Models\BaseCharge;

class BoletoEndpoint
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function create(BaseCharge $boletoCharge): array
    {
        // Etapa 1: Criação da cobrança BOLETO
        $chargeResponse = $this->httpClient->request('POST', '/payments', $boletoCharge->toArray());

        // Verificando se o ID foi retornado na chave 'response'
        if (!isset($chargeResponse['response']['id'])) {
            throw new \Exception('Erro ao criar a cobrança BOLETO: ID não retornado na resposta.');
        }

        $paymentId = $chargeResponse['response']['id'];

        // Etapa 2: Obter a linha digitável do boleto
        $identificationFieldResponse = $this->httpClient->request('GET', "/payments/{$paymentId}/identificationField");

        // Adicionando a linha digitável ao array de resposta
        if (isset($identificationFieldResponse['response']['identificationField'])) {
            $chargeResponse['response']['identificationField'] = $identificationFieldResponse['response']['identificationField'];
        } else {
            throw new \Exception('Erro ao obter a linha digitável do boleto: identificationField não retornado.');
        }

        // Etapa 3: Obter o QR Code para pagamentos via Pix
        $pixQrCodeResponse = $this->httpClient->request('GET', "/payments/{$paymentId}/pixQrCode");

        // Adicionando o payload do QR Code ao array de resposta
        if (isset($pixQrCodeResponse['response']['payload'])) {
            $chargeResponse['response']['pixQrCodePayload'] = $pixQrCodeResponse['response']['payload'];
        } else {
            throw new \Exception('Erro ao obter o QR Code do Pix: payload não retornado.');
        }

        return $chargeResponse;
    }

    public function update(string $paymentId, string $billingType, ?float $value = null, ?string $dueDate = null): array
    {
        // Garantir que billingType não seja nulo ou vazio
        if (empty($billingType)) {
            throw new \InvalidArgumentException('O campo billingType é obrigatório e não pode ser nulo ou vazio.');
        }

        // Construir dinamicamente o array de dados para a atualização
        $updateData = [
            'billingType' => $billingType, // billingType é obrigatório
        ];

        if ($value !== null) {
            $updateData['value'] = $value;
        }

        if ($dueDate !== null) {
            $updateData['dueDate'] = $dueDate;
        }

        // Enviar a requisição PUT para o endpoint de atualização
        $response = $this->httpClient->request('PUT', "/payments/{$paymentId}", $updateData);

        // Verificar se a resposta contém a chave 'response'
        if (!isset($response['response'])) {
            throw new \Exception('Erro ao atualizar a cobrança: resposta inválida da API.');
        }

        return $response['response'];
    }
}
