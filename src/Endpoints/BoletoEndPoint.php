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

        return $chargeResponse;
    }
}
