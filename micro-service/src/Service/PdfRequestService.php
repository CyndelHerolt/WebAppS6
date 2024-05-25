<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class PdfRequestService
{

    public function __construct(private HttpClientInterface $client)
    {
    }

    public function generatePdfFromUrl(string $url): string
    {
        $response = $this->client->request(
            'POST',
            $_ENV['GOTENBERG_URL'] . '/forms/chromium/convert/url',
            [
                'headers' => [
                    'Content-Type' => 'multipart/form-data',
                ],
                'body' => [
                    'url' => $url
                ]
            ]
        );

        return $response->getContent();
    }
}