<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\Psychologue;
use Doctrine\Migrations\Version\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('Fr-fr');
        // $product = new Product();
        // $manager->persist($product);
        /*$adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);
        $adminUser = new Psychologue();
        $hash = $this->encoder->encodePassword($adminUser, 'password');
        $adminUser->setNom('Wyart')
                  ->setPrenom('Guillaume')
                  ->setEmail('wyartguillaume@gmail.com')
                  ->setMotDePasse($hash)
                  ->setToken('123456789')
                  ->setIsActive(true)
                  ->addUserRole($adminRole);
        $manager->persist($adminUser);
                  

        $manager->flush();*/

    }

}
