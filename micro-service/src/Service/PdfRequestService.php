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
                    'Content-Type' => 'multipart/form-data',
                ],
                'body' => ['url'=>$url]
            ]
        );

        // Renvoyer le contenu de la réponse

        // vérifier si la réponse est un code d'erreur
//        if ($response->getStatusCode() !== 200) {
//            throw new \Exception($response->getContent());
//        } else {
        return $response->getContent();
//        }
    }
}