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

       

        for ($i=0; $i <= 10; $i++) {
            
                       
        }

        for ($i=0; $i <= 50; $i++) { 
            $user = new User;
            $proprio = new Proprietaire;
            $moto = new Moto;
            $modele = new Modele;


            $cylindrees = array('500', '600', '800', '900', '1000', '1200', '1300');
            $randomKey = array_rand($cylindrees, 1);

            $modele->setMarque($faker->lastName())
                   ->setLibelle($faker->word() . " " . $cylindrees[$randomKey])
                   ->setType($faker->word())
                   ->setPuissance(mt_rand(85, 200));

                $modeles[] = $modele;
                $manager->persist($modele);

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

                $users[] = $user;
                $manager->persist($user);

    
            $proprio->setUser($users[mt_rand(0, count($users) - 1)])
                    ->setEstSuperHote($faker->boolean());
                        
                $proprios[] = $proprio;
                $manager->persist($proprio);

            $imagesMoto = array('moto1.jpg', 'moto2.jpg', 'moto3.jpg', 'moto4.jpg', 'moto5.jpg', 'moto6.jpg', 'moto7.jpg',
                                'moto8.jpg', 'moto9.jpg', 'moto10.jpg', 'moto11.jpg', 'moto12.jpg');
            $randomKey = array_rand($imagesMoto, 1);

            $descriptionsMoto = array('Moto récente disponible 7/7j 24/24h. Prise en compte et restitution de la voiture sur les places en Autopartage réservées. Etape obligatoire : validez votre profil auprès de GetAround avec des originaux (les copies sont refusées et vous bloquez votre plafond de CB). Pour accéder à la voiture : suivez les instructions sur l\'appli afin de trouver la voiture et la déverrouiller.',
                                      'Bonjour, je mets a disposition mon véhicule qui est très bien entretenu. La selle est en cuir de couleur crème. Vous pouvez rapidement recuperer la moto à la sortie du métro Saint Barnabé. Je vous attends avec grand plaisir. Bonne journée',
                                      'Mon véhicule est bien entretenu et en très bon état. il dispose de tous les équipements tels que la régulation de vitesse, un radar de récul , toutes les connectivités pour le plus grand confort du pilote et du passager',
                                      'Mon véhicule est bien entretenu et en très bon état. Il dispose de toutes les options possible pour ce véhicule (kit Bluetooth, caméra de recule, etc …) pour le confort de tous. Le véhicule est livré avec une batterie pleine, il n\'est pas nécessaire de recharger le véhicule s\'il est rendu avec au moins 30 km d\'autonomie.',
                                      'Moto avec marche arrière pour une plus grande facilité de manœuvre en ville. Confortable et entretenue, elle consomme peu et vous emmènera avec facilité aussi bien en ville que sur autoroute.');
            $randomKeyDesc = array_rand($descriptionsMoto, 1);

            $moto->setModele($modeles[mt_rand(0, count($modeles) - 1)])
                 ->setProprietaire($proprios[mt_rand(0, count($proprios) - 1)])
                 ->setAnnee($faker->year())
                 ->setCouleur($faker->safeColorName())
                 ->setPrixJour($faker->numberBetween(80, 250))
                 ->setDispo($faker->boolean())
                 ->setDescription($descriptionsMoto[$randomKeyDesc])
                 ->setBagagerie($faker->boolean())
                 ->setImageName($imagesMoto[$randomKey])
                ;
                 $manager->persist($moto);
        }

        $manager->flush();
    }
}

