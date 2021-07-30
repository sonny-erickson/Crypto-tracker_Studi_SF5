<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;


class AppExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('globalGainLoss', [$this, 'globalGainLoss']),
            new TwigFunction('unitGainLoss', [$this, 'unitGainLoss']),
        ];
    }

    public function globalGainLoss(array $transactions)
    {
        $globalGainLoss = 0;
        foreach($transactions as $transaction)
        {
            $globalGainLoss += $transaction->getCrypto()->getCurrentPrice() * $transaction->getQuantity() - $transaction->getPrice();
        }
        return $globalGainLoss;
    }
    public function unitGainLoss($transaction)
    {
        $unitGainLoss = 0;
        $unitGainLoss = $transaction->getCrypto()->getCurrentPrice() * $transaction->getQuantity() - $transaction->getPrice();

        return $unitGainLoss;
    }

}
