<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class PdfRequestService
{

    public function __construct(private HttpClientInterface $client)
    {
    }

    public function generatePdfFromUrl(?string $url)
    {
        $response = $this->client->request(
            'POST',
            $_ENV['GOTENBERG_URL'] . '/forms/chromium/convert/url',
            [
                'headers' => [
                    'Accept' => 'application/pdf',
                ],
                'body' => [
                    'url' => $url,
                    'webPage' => [
                        'waitDelay' => 0.0
                    ]
                ]
            ]
        );

        return $response->getContent();
    }
}