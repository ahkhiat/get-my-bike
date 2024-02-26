<?php

namespace App\Tests;


use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testIsTrue()
    {
        $user = new User();

        $user->setEmail('true@test.com')
             ->setPassword('password')
             ->setNom('nom')
             ->setPrenom('prenom')
             ->setAdresse('adresse')
             ->setCodePostal('12345')
             ->setVille('ville')
             ->setTelephone('0612345678');

        $this->assertTrue($user->getEmail() === 'true@test.com');
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getNom() === 'nom');
        $this->assertTrue($user->getPrenom() === 'prenom');
        $this->assertTrue($user->getAdresse() === 'adresse');
        $this->assertTrue($user->getCodePostal() === '12345');
        $this->assertTrue($user->getVille() === 'ville');
        $this->assertTrue($user->getTelephone() === '0612345678');

    }

    public function testIsFalse()
    {
        $user = new User();

        $user->setEmail('true@test.com')
             ->setPassword('password')
             ->setNom('nom')
             ->setPrenom('prenom')
             ->setAdresse('adresse')
             ->setCodePostal('12345')
             ->setVille('ville')
             ->setTelephone('0612345678');

        $this->assertFalse($user->getEmail() === 'false@test.com');
        $this->assertFalse($user->getPassword() === 'false');
        $this->assertFalse($user->getNom() === 'false');
        $this->assertFalse($user->getPrenom() === 'false');
        $this->assertFalse($user->getAdresse() === 'false');
        $this->assertFalse($user->getCodePostal() === 'false');
        $this->assertFalse($user->getVille() === 'false');
        $this->assertFalse($user->getTelephone() === 'false');

    }

    public function testIsEmpty()
    {
        $user = new User();

        $user->setPassword('');

        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getNom());
        $this->assertEmpty($user->getPrenom());
        $this->assertEmpty($user->getAdresse());
        $this->assertEmpty($user->getCodePostal());
        $this->assertEmpty($user->getVille());
        $this->assertEmpty($user->getTelephone());

    }

}
