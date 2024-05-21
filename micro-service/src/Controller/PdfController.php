<?php

namespace App\Controller;

use App\Service\PdfRequestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Routing\Attribute\Route;

class PdfController extends AbstractController
{

    public function __construct(private PdfRequestService $pdfRequestService)
    {
    }

    #[Route('/pdf', name: 'app_pdf')]
    public function index(?string $url)
    {
        // appeler le service PdfRequestService pour générer le PDF à partir de l'URL
        $pdfContent = $this->pdfRequestService->generatePdf($url);

        // enregistrer le contenu du PDF dans un fichier à la route définie dans le .env 'PDF_PATH'
        $filePath = $_ENV['PDF_STORAGE_PATH'];
        file_put_contents($filePath, $pdfContent);

        // renvoyer le fichier PDF en tant que BinaryFileResponse
        return new BinaryFileResponse($filePath);
    }
}
