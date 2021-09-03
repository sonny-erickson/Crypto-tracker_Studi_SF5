<?php

namespace App\Controller;

use App\Repository\TransactionRepository;
use App\Service\SaveBalanceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TransactionRepository $transactionRepository, SaveBalanceService $saveBalance): Response
    {
        $transactions = $transactionRepository->findAll();
        $cryptos=[];
        foreach($transactions as $transaction){
            $cryptos[] = strtolower($transaction->getCrypto()->getName());
        }
        $cryptos = array_unique($cryptos);
        //$cryptoValues=$apiService->getCryptoPriceMoment(implode(",",$cryptos)); // ["bitcoin"=>["eur",value],"ethereum"=>["eur"=>value2],...]


        return $this->render('main/home.html.twig', [
            'transactions' => $transactions
        ]);
    }
    /**
     * @Route("/cron", name="cron")
     */
    public function SaveDaily(SaveBalanceService $saveBalance, TransactionRepository $transactionRepository): Response
    {
        $transactions = $transactionRepository->findAll();
        //dump($transactions);die;
        $saveB=$saveBalance->globalBalance($transactions);
        return $this->render('main/home.html.twig', [
            'transactions' => $transactions
        ]);
    }
}
