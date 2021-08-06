<?php

namespace App\DataFixtures;

use App\Entity\Historical;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class HistoricalFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $historical1 = new Historical();
        $historical1->setBalance('1500');
        $historical1->setDate($faker->dateTime('2021-03-25 08:37:17'));
        $manager->persist($historical1);

        $historical2 = new Historical();
        $historical2->setBalance('2500');
        $historical2->setDate($faker->dateTime('2021-04-25 08:37:17'));
        $manager->persist($historical2);

        $historical3 = new Historical();
        $historical3->setBalance('500');
        $historical3->setDate($faker->dateTime('2021-05-25 08:37:17'));
        $manager->persist($historical3);

        $manager->flush();
    }
}
