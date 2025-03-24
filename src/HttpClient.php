<?php

namespace Asaas;

use Asaas\Contracts\HttpClientInterface;
use Exception;

class HttpClient implements HttpClientInterface
{
    private string $apiKey;
    private string $baseUrl;

    public function __construct(string $apiKey, AsaasConfig $config)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = $config->getBaseUrl();
    }

    /**
     * @param string $apiKey
     * @param AsaasConfig $config
     */
    public function request(string $method, string $endpoint, array $data = []): array
    {
        $url = $this->baseUrl . $endpoint;
        $ch = curl_init();

        $headers = [
            'Content-Type: application/json',
            'access_token: ' . $this->apiKey,
            'User-Agent: Asaas PHP Client',
        ];

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } elseif ($method === 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } elseif ($method === 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            curl_close($ch);
            return [
                'status_code' => 500,
                'response' => [
                    'error' => 'Erro na requisição: ' . curl_error($ch),
                ],
            ];
        }

        curl_close($ch);

        $decodedResponse = json_decode($response, true);

        if ($httpCode < 200 || $httpCode >= 300) {
            return [
                'status_code' => $httpCode,
                'response' => $decodedResponse ?? [
                    'error' => 'Erro HTTP: Código ' . $httpCode,
                    'raw_response' => $response,
                ],
            ];
        }

        return [
            'status_code' => $httpCode,
            'response' => $decodedResponse,
        ];
    }
}
