<?php

namespace App\Controller;

use App\Service\PdfRequestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route('/pdf/download', name: 'app_pdf_download')]
class PdfController extends AbstractController
{
    public function __construct(
        private PdfRequestService $pdfRequestService,
    )
    {
    }

    #[Route('/url', name: 'app_pdf_url')]
    public function index(Request $request)
    {
        $url = $request->get('url');

        // Appel du service PdfRequestService qui va envoyer l'url du PDF à Gotenberg
        $pdfContent = $this->pdfRequestService->generatePdfFromUrl($url);

        return new Response($pdfContent, Response::HTTP_OK, ['Content-Type' => 'application/pdf']);
    }
}
