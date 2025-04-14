<?php

namespace Asaas\Endpoints;

use Asaas\Contracts\HttpClientInterface;
use Asaas\Models\BaseCharge;

class PixEndpoint
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function createWithQrCode(BaseCharge $pixCharge): array
    {
        // Etapa 1: Criação da cobrança PIX
        $chargeResponse = $this->httpClient->request('POST', '/lean/payments', $pixCharge->toArray());

        // Verificando se o ID foi retornado na chave 'response'
        if (isset($chargeResponse['response']['id'])) {
            $paymentId = $chargeResponse['response']['id'];

            // Etapa 2: Recuperação do QR Code do PIX
            $qrCodeResponse = $this->httpClient->request('GET', "/payments/{$paymentId}/pixQrCode");

            // Adicionando o QR Code à resposta original
            $chargeResponse['response']['pixQrCode'] = $qrCodeResponse['response'];
        } else {
            throw new \Exception('Erro ao criar a cobrança PIX: ID não retornado na resposta.');
        }

        return $chargeResponse;
    }

    public function payWithQrCode(string $payload, float $value, ?string $description = null, ?string $scheduleDate = null, ?float $changeValue = null): array
    {
        // Montar o corpo da requisição
        $data = [
            'qrCode' => [
                'payload' => $payload,
            ],
            'value' => $value,
        ];

        // Adicionar parâmetros opcionais, se fornecidos
        if ($description !== null) {
            $data['description'] = $description;
        }
        if ($scheduleDate !== null) {
            $data['scheduleDate'] = $scheduleDate;
        }
        if ($changeValue !== null) {
            $data['qrCode']['changeValue'] = $changeValue;
        }

        // Enviar a requisição para o endpoint de pagamento de QR Code
        return $this->httpClient->request('POST', '/pix/qrCodes/pay', $data);
    }
}
