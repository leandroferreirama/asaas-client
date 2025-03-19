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

    public function createWithIdentificationField(BaseCharge $boletoCharge): array
    {
        // Etapa 1: Criação da cobrança BOLETO
        $chargeResponse = $this->httpClient->request('POST', '/lean/payments', $boletoCharge->toArray());

        // Verificando se o ID foi retornado na chave 'response'
        if (isset($chargeResponse['response']['id'])) {
            $paymentId = $chargeResponse['response']['id'];

            // Etapa 2: Recuperação do IdentificationField do BOLETO
            $identificationFieldResponse = $this->httpClient->request('GET', "/payments/{$paymentId}/identificationField");

            // Adicionando o campo de identificação à resposta original
            $chargeResponse['response']['identificationField'] = $identificationFieldResponse['response'];
        } else {
            throw new \Exception('Erro ao criar a cobrança BOLETO: ID não retornado na resposta.');
        }

        return $chargeResponse;
    }
}
