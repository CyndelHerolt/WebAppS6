<?php

namespace App\Tests;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetterAndSetter()
    {
        // Création d'une instance de l'entité User
        $user = new User();

        // Définition de données de test
        $email = 'test@test.com';
        $firstname = 'John';
        $lastname = 'Doe';
        // cryptage du mot de passe
        $password = password_hash('test', PASSWORD_DEFAULT);
        $role = ['ROLE_USER'];

        // construire un tableau qui contient les données de test
        $dataTest = [
            'email' => $email,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'password' => $password,
            'roles' => $role
        ];

        // Définition des setters via le tableau de données de test
        foreach ($dataTest as $key => $value) {
            $setter = 'set' . ucfirst($key);
            $user->$setter($value);
        }

        // Vérification des getters via le tableau de données de test
        foreach ($dataTest as $key => $value) {
            $getter = 'get' . ucfirst($key);
            $this->assertEquals($value, $user->$getter());
        }
    }
}