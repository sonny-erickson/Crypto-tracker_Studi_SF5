<?php

namespace App\Controller;

use App\Repository\TransactionRepository;
use App\Service\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TransactionRepository $transactionRepository, ApiService $apiService): Response
    {
        $cryptoBought = $transactionRepository->findAll();
        return $this->render('main/home.html.twig', [
            'controller_name' => 'HomeController',
            'transactions' => $cryptoBought,
            'data' => $apiService->getImage()

        ]);
    }
}
