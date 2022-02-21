<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    private $manager;

    public function __construct(UserPasswordHasherInterface $encoder, EntityManagerInterface $manager)
    {
        $this->encoder = $encoder;
        $this->manager = $manager;
    }
    public function load(ObjectManager $manager): void
    {
        $userAdmin = new User();
        $userAdmin->setUsername("ethadmin")
            ->setPassword($this->encoder->hashPassword($userAdmin, "pass"))
            ->setRoles(["ROLE_ADMIN"]);
        $this->manager->persist($userAdmin);

        $manager->flush();
    }
}
