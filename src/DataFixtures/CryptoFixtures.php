<?php

namespace App\DataFixtures;

use App\Entity\Crypto;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CryptoFixtures extends Fixture
{
    public const CRYPTO_REFERENCE = 'Crypto';

    public function load(ObjectManager $manager)
    {
        $crypto = new Crypto();
        $crypto->setName('Bitcoin');
        $crypto->setAcronym('BTC');
        $crypto->setImage('https://assets.coingecko.com/coins/images/1/small/bitcoin.png?1547033579');
        $manager->persist($crypto);
        $manager->flush();

        $this->addReference(self::CRYPTO_REFERENCE, $crypto);

    }
}
