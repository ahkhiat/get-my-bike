<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Moto;


class MotoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $moto = new Moto();
        // $moto->setModele(mt_rand(2, 51))
        //     ->set

        // $manager->flush();
    }
}
