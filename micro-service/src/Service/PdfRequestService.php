<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class PdfRequestService
{

    public function __construct(private HttpClientInterface $client)
    {
    }

    public function generatePdf(?string $url)
    {
        $response = $this->client->request(
            'GET',
            $_ENV['GOTENBERG_URL'] . '/forms/chromium/convert/url',
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'multipart/form-data',
                ],
                'query' => [
                    'url' => $url
                ]
            ]
        );

        // Renvoyer le contenu de la réponse

        // vérifier si la réponse est un code d'erreur
        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Erreur lors de la génération du PDF');
        } else {
            return $response->getContent();
        }
    }
}