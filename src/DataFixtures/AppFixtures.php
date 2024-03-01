<?php

namespace App\DataFixtures;

use App\Entity\Proprietaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Modele;
use App\Entity\Moto;
use App\Entity\User;


use Faker;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        // for ($i=0; $i <= 50; $i++) { 
        //     $modele = new Modele;

        //     $cylindrees = array('500', '600', '800', '900', '1000', '1200', '1300');
        //     $randomKey = array_rand($cylindrees, 1);

        //     $modele->setMarque($faker->lastName())
        //            ->setLibelle($faker->word() . " " . $cylindrees[$randomKey])
        //            ->setType($faker->word())
        //            ->setPuissance(mt_rand(85, 200));

        //         $manager->persist($modele);
                       
        // }

        for ($i=0; $i < 20; $i++) { 
           $proprio = new Proprietaire;
           $proprio->setUser($faker->randomElement(User::class('id')->toArray()))
                   ->setEstSuperHote($faker->boolean())
                   ->setIBAN($faker->iban('FR'));

            $manager->persist($proprio);

        }

        $manager->flush();
    }
}

