<?php

namespace App\Controller;

use App\Form\PdfType;
use App\Service\PdfGenerateRequestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route('/app/pdf', name: 'app_pdf')]
class GeneratePdfController extends AbstractController
{
    public function __construct(
        private PdfGenerateRequestService $pdfGenerateRequestService,
    )
    {
    }

    #[Route('/url', name: '_url')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(PdfType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pdf = $form->getData();
            $url = $pdf->getUrl();

            // Appel du service PdfGenerateRequestService qui va envoyer l'url du PDF au micro-service
            $pdfContent = $this->pdfGenerateRequestService->requestToGeneratePdfFromUrl($url);

            // enregistrer le contenu du PDF dans un fichier dans le dossier pdf_repository de votre projet
            $fileName = 'pdf_' . uniqid() . '.pdf';
            $filePath = $_ENV['PDF_STORAGE_PATH'] . '/' . $fileName;
            file_put_contents($filePath, $pdfContent);

            return $this->render('pdf/_pdf_result.html.twig', [
                'url' => $url,
                'path' => $_ENV['PDF_STORAGE_SRC'] . '/' . $fileName
            ]);
        }

        return $this->render('pdf/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}