<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Modele;
use App\Entity\Moto;
use App\Entity\User;
use App\Entity\Proprietaire;
use App\Entity\Commentaire;
use App\Entity\Reservation;
use App\Entity\Marque;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

       
        // array pour choix aléatoire de cylindrée parmis des valeurs que j'ai défini
        $cylindrees = array('500', '600', '800', '900', '1000', '1200', '1300');

        // $marquesMoto = array('Yamaha', 'Triumph');
        // $marquesUtilisees = [];

        // foreach ($marquesMoto as $marqueNom) {
        //     do {
        //         $marqueAleatoire = $marquesMoto[mt_rand(0, count($marquesMoto) - 1)];
        //     } while (in_array($marqueAleatoire, $marquesUtilisees));
        
        //     $marquesUtilisees[] = $marqueAleatoire; 
        
        //     $marque = new Marque;
        //     $marque->setLibelle($marqueAleatoire);
        //     $marques[] = $marque;
        //     $manager->persist($marque);
        // }
        $marque1 = new Marque;
        $marque1->setLibelle('Yamaha');

        $marque2 = new Marque;
        $marque2->setLibelle('Triump');

        $manager->persist($marque1);
        $manager->persist($marque2);

        $modele1 = new Modele;
        $modele1->setMarque($marque1)
                ->setLibelle('Fazer 600');
        $manager->persist($modele1);


        $modele2 = new Modele;
        $modele2->setMarque($marque1)
                ->setLibelle('Fazer 1000');
        $manager->persist($modele2);

        $modele3 = new Modele;
        $modele3->setMarque($marque2)
                ->setLibelle('Tiger 800');
        $manager->persist($modele3);

        $modele4 = new Modele;
        $modele4->setMarque($marque2)
                ->setLibelle('Tiger 1200');
        $manager->persist($modele4);

        $manager->persist($modele1, $modele2, $modele3, $modele4);


        for ($i=0; $i <= 3; $i++) { 
            $user = new User;

            $proprio = new Proprietaire;
            $moto = new Moto;
            
            $randomKeyCyl = array_rand($cylindrees, 1); // renvoi un index

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
                 ->setBio($faker->sentence())
                 ->setAdresse($faker->streetAddress())
                 ->setCodePostal($faker->postCode())
                 ->setVille($faker->city())
                 ->setTelephone($faker->phoneNumber())
                 ->setIsVerified($faker->boolean())
                 ->setImageName('user_1144760.png')
                ;
                //  ->setCreatedAtValue($faker->dateTimeBetween('-6 month', 'now')); // ne fonctionne pas

            $users[] = $user;    
            $manager->persist($user);


                                // méthode pour choix aléatoire d'idUser dans Proprio
            $proprio->setUser($user) 
                    ->setEstSuperHote($faker->boolean())
                    ->setIsVerified($faker->boolean());

                        
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

            $moto->setCylindree($cylindrees[$randomKeyCyl])
                 ->setProprietaire($proprios[mt_rand(0, count($proprios) - 1)])
                 ->setPoids($faker->numberBetween(150, 300))
                 ->setPuissance($faker->numberBetween(80, 200))
                 ->setAnnee($faker->year())
                 ->setCouleur($faker->safeColorName())
                 ->setPrixJour($faker->numberBetween(80, 250))
                 ->setDispo($faker->boolean())
                 ->setDescription($descriptionsMoto[$randomKeyDesc])
                 ->setBagagerie($faker->boolean())
                 ->setImageName($imagesMoto[$randomKey])
                 
                
                ;
                 $motos[] = $moto;
                 $manager->persist($moto);

            $reservation = new Reservation;

            $reservation->setUser($users[mt_rand(0, count($users) - 1)])
                        ->setMoto($motos[mt_rand(0, count($motos) - 1)])
                        ->setDateDebut($faker->dateTimeBetween('-1 week'))
                        ->setDateFin($faker->dateTimeBetween('now','+1 week'));

                        $reservations[] = $reservation;
                        $manager->persist($reservation);

            $commentaire = new Commentaire;

            $textesMoto = array("Très bonne moto, je recommande", "Je me suis regalé, à refaire !", 
                                "Malgré le fait de ne pas avoir conduit pendant des années, la plaisir était toujours là !",
                                "Excellente Moto !", "Vraiment une moto très bien entretenue et très agréable à conduire !");
            $textesProprio = array("C'est une personne très sérieuse, je recommande !", "Il a su être rassurant, très bonne expérience !",
                                    "Un propriétaire très sympathique, je recommande !", "Serieux et ponctuel, parfait !",
                                    "Un peu d'appréhension des 2 cotés mais tout c'est très bien passé !", "Une expérience hors-norme grâce à elle, à recommander !");
            
            $randomKeyMoto = array_rand($textesMoto, 1);
            $randomKeyProprio = array_rand($textesProprio, 1);

            $commentaire->setUser($users[mt_rand(0, count($users) - 1)])
                        ->setMoto($motos[mt_rand(0, count($motos) - 1)])
                        ->setReservation($reservations[mt_rand(0, count($reservations) - 1)])
                        // ->setCreatedAtValue()
                        ->setNoteMoto(mt_rand(1,5))
                        ->setNoteProprio(mt_rand(1,5))
                        ->setTexteMoto($textesMoto[$randomKeyMoto])
                        ->setTexteProprio($textesProprio[$randomKeyProprio])                    
                        ;
                        foreach ($reservations as $resa_choisie) { 
                            $commentaire->setReservation($resa_choisie);
                        }

                        $manager->persist($commentaire);

            // foreach ($motos as $moto) {
            //     $commentaire = new Commentaire;
            //     $commentaire->setNoteMoto(mt_rand(1, 5))
            //                 ->setUser($users[mt_rand(0, count($users) - 1)])
            //                 ->setMoto($moto)
            //                 ->setReservation($reservation)
            //                 ;
            //     $manager->persist($commentaire);  
            // }

        }

        $manager->flush();
    }
}

