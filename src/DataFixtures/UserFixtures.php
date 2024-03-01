<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $faker = Faker\Factory::create('fr_FR');

        // for ($i=0; $i <= 50; $i++) { 

        //     $user = new User;

        //     $user->setEmail($faker->email())
        //          ->setPassword($faker->password())
        //          ->setNom($faker->lastName())
        //          ->setPrenom($faker->firstName())
        //          ->setAdresse($faker->streetAddress())
        //          ->setCodePostal($faker->postCode())
        //          ->setVille($faker->city())
        //          ->setTelephone($faker->phoneNumber())
        //          ->setIsVerified($faker->boolean());

        //         $manager->persist($user);
        // }

        // $manager->flush();
    }
}
