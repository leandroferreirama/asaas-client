<?php

namespace Asaas\Endpoints;

use Asaas\Contracts\HttpClientInterface;

class FinancialTransactionEndpoint
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Recupera o extrato financeiro.
     *
     * @param int $offset Elemento inicial da lista (padrão: 0)
     * @param int $limit Número de elementos da lista (padrão: 100, máximo: 100)
     * @param string|null $startDate Data inicial no formato YYYY-MM-DD (opcional)
     * @param string|null $finishDate Data final no formato YYYY-MM-DD (opcional)
     * @return array
     */
    public function getStatement(string $startDate, string $finishDate, int $offset = 0, int $limit = 100, string $order = 'asc'): array
    {
        $queryParams = [
            'startDate' => $startDate,
            'finishDate' => $finishDate,
            'offset' => $offset,
            'limit' => $limit,
            'order' => $order
        ];
        $queryString = http_build_query($queryParams);

        return $this->httpClient->request('GET', "/financialTransactions?$queryString");
    }
}