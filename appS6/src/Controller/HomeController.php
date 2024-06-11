<?php

namespace App\Controller;

use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(SubscriptionRepository $subscriptionRepository): Response
    {
        // récupérer toutes les subscriptions rangée par price
        $subscriptions = $subscriptionRepository->findBy([], ['price' => 'ASC']);

        return $this->render('home/index.html.twig', [
            'subscriptions' => $subscriptions,
        ]);
    }
}
