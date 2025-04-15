<?php

namespace Asaas\Endpoints;

use Asaas\Contracts\HttpClientInterface;

class AnticipationEndpoint
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Recupera uma única antecipação pelo ID.
     *
     * @param string $id O identificador único da antecipação.
     * @return array A resposta da API.
     * @throws \InvalidArgumentException Se o ID não for fornecido.
     */
    public function getAnticipationById(string $id): array
    {
        if (empty($id)) {
            throw new \InvalidArgumentException('O parâmetro "id" é obrigatório.');
        }

        return $this->httpClient->request('GET', "/anticipations/{$id}");
    }
}