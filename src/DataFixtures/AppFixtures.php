<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $profil = new Profil();
        $profil->setLibelle('admin');
        $user = new User();
        $user->setUsername('admin');
        $password = $this->encoder->encodePassword($user, "admin");
        $user->setPassword($password);
        $user->setProfile($profil);
        $manager->persist($profil);
        $manager->persist($user);
        $manager->flush();
    }
}
