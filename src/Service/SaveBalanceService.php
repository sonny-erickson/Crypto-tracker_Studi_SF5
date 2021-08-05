<?php
namespace App\Service;

use App\Entity\Historical;
use Doctrine\ORM\EntityManagerInterface;

class SaveBalanceService
{
    /** @var CryptoService $cryptoService */
    private $cryptoService;

    private $em;

    /**
     * SaveBalance constructor.
     * @param CryptoService $cryptoService
     */
    public function __construct(CryptoService $cryptoService, EntityManagerInterface $entityManager)
    {
        $this->cryptoService = $cryptoService;
        $this->em = $entityManager;
    }

    /**
     * @param array $transactions
     */
    public function globalBalance(array $transactions)
    {
        $globalGainLoss = $this->cryptoService->globalBalance($transactions);
        $history = new Historical();
        $history->setBalance($globalGainLoss);
        $history->setDate(new \DateTime());
        $this->em->persist($history);
        $this->em->flush();
    }


}