<?php

namespace Asaas\Endpoints;

use Asaas\Contracts\HttpClientInterface;
use Asaas\Models\BaseCharge;

class BoletoEndPoint
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
}
