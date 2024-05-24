<?php

namespace App\Controller;

use App\Form\PdfType;
use App\Service\PdfGenerateRequestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/pdf', name: 'app_pdf')]
class GeneratePdfController extends AbstractController
{
    public function __construct(private PdfGenerateRequestService $pdfGenerateRequestService)
    {
    }

    #[Route('/url', name: 'app_pdf_url')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(PdfType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $url = $form->get('url')->getData();

            // Call the service to generate the PDF
            $pdf = $this->pdfGenerateRequestService->requestToGeneratePdfFromUrl($url);

            dump($pdf->getContent());

            return $this->render('pdf/_pdf_result.html.twig', [
                'url' => $pdf,
            ]);
        }

        return $this->render('pdf/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}