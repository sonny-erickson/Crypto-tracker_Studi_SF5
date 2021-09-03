<?php

namespace App\Service;

/**
 * Class CryptoService
 * @package App\Service
 */
class CryptoService
{
    /** @var ApiService $apiService */
    private $apiService;

    /**
     * CryptoService constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * @param array $transactions
     * @return float|int
     */
    public function globalBalance(array $transactions)
    {
        $globalBalance = 0;

        foreach($transactions as $transaction)
        {
            $globalBalance += $this->unitBalance($transaction);
        }

        return $globalBalance;
    }

    /**
     * @param $transaction
     * @return float|int
     */
    public function unitBalance($transaction)
    {
        return  $transaction->getPrice() - $this->apiService->getCurrentPrice($transaction->getCrypto()->getName()) * $transaction->getQuantity();
    }
}
