<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $userPasswordHasher
    )
    {
    }

    public function load(ObjectManager $manager): void
    {

        $user = new User();
        $user->setEmail("user@example.com");
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "123"));
        $user->setRoles(["ROLE_USER"]);

        $manager->persist($user);

        $admin = new User();
        $admin->setEmail("admin@example.com");
        $admin->setPassword($this->userPasswordHasher->hashPassword($user, "123"));
        $admin->setRoles(["ROLE_ADMIN"]);
        $manager->persist($admin);

        $manager->flush();

    }
}