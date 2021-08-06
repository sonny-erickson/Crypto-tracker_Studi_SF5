<?php

namespace App\DataFixtures;

use App\Entity\Transaction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TransactionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $transaction = new Transaction();
        $transaction->setCrypto($this->getReference(CryptoFixtures::CRYPTO_REFERENCE));
        $transaction->setQuantity('2.0000');
        $transaction->setPrice('65000');
        $transaction->setDate($faker->dateTime('2021-02-25 08:37:17'));

        $manager->persist($transaction);

        $manager->flush();
    }
}
