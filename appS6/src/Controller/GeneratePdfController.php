<?php

namespace App\Controller;

use App\Form\PdfType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/pdf', name: 'app_pdf')]
class GeneratePdfController extends AbstractController
{
    #[Route('/url', name: 'app_pdf_url')]
    public function index(): Response
    {

        $form = $this->createForm(PdfType::class);

        return $this->render('pdf/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
