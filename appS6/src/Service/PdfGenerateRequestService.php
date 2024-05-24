<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class PdfGenerateRequestService
{
    public function __construct(private HttpClientInterface $client)
    {
    }

    public function requestToGeneratePdfFromUrl(?string $url): mixed
    {
        $response = $this->client->request(
            'GET',
            $_ENV['MICROSERVICE_URL'] . '/pdf/download/url',
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'query' => [
                    'url' => $url
                ]
            ]
        );

        return $response;
    }
}