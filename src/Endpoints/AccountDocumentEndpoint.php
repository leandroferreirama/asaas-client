<?php

namespace Asaas\Endpoints;

use Asaas\Contracts\HttpClientInterface;
use Asaas\Models\AccountDocument;

class AccountDocumentEndpoint
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function upload(AccountDocument $document): array
    {
        $endpoint = "/myAccount/documents/{$document->getId()}";

        $file = new \CURLFile($document->getFilePath());

        $data = [
            'documentFile' => $file,
            'type' => $document->getType()
        ];

        return $this->httpClient->request('POST', $endpoint, $data, ['Content-Type: multipart/form-data']);
    }

    public function getPendingDocuments(): array
    {
        return $this->httpClient->request('GET', '/myAccount/documents');
    }
}
