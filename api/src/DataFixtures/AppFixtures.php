<?php

namespace App\DataFixtures;

use App\Entity\Fruit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fruit = new Fruit;
        $fruit->setGenus('foo');
        $fruit->setName('nmae');
        $fruit->setFamily('ss');
        $fruit->setArrange('ss');
        $fruit->setNutritions([]);
    
        $manager->persist($fruit);

        $manager->flush();
    }
}
