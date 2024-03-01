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
        $user = new User;
        $faker = Faker\Factory::create('fr_FR');

        for ($i=0; $i <= 50; $i++) { 

            $user = new User;

            // Intervalle choisi pour les dates de naissances
            $dateDebut = '-60 years'; 
            $dateFin = '-18 years';  
            $dateAleatoire = $faker->dateTimeBetween($dateDebut, $dateFin);
            $dateString = $dateAleatoire->format('Y-m-d');
            $dateNaissance = \DateTime::createFromFormat('Y-m-d', $dateString);

            $user->setEmail($faker->email())
                 ->setPassword($faker->password())
                 ->setNom($faker->lastName())
                 ->setPrenom($faker->firstName())
                 ->setDateNaissance($dateNaissance)
                 ->setAdresse($faker->streetAddress())
                 ->setCodePostal($faker->postCode())
                 ->setVille($faker->city())
                 ->setTelephone($faker->phoneNumber())
                 ->setIsVerified($faker->boolean())
                 ->setImageName('user_1144760.png');
                //  ->setCreatedAtValue($faker->dateTimeBetween('-6 month', 'now')); // ne fonctionne pas

                
                $manager->persist($user);
        }

        for ($i=0; $i <= 10; $i++) {

            $modele = new Modele;

            $cylindrees = array('500', '600', '800', '900', '1000', '1200', '1300');
            $randomKey = array_rand($cylindrees, 1);

            $modele->setMarque($faker->lastName())
                   ->setLibelle($faker->word() . " " . $cylindrees[$randomKey])
                   ->setType($faker->word())
                   ->setPuissance(mt_rand(85, 200));

                $manager->persist($modele);
                       
        }

        // for ($i=0; $i < 20; $i++) { 
        //    $proprio = new Proprietaire;
        //    $proprio->setUser($user->getId())
        //            ->setEstSuperHote($faker->boolean());
        //         //    ->setIBAN($faker->iban('FR'));

        //     $manager->persist($proprio);

        // }

        $manager->flush();
    }
}

