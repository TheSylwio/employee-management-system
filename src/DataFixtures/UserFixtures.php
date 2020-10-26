<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
    }

    private function loadUsers(ObjectManager $manager)
    {
        foreach ($this->getUsersData() as [$email, $password]) {
            $user = new User();
            $user
                ->setEmail($email)
                ->setRoles([])
                ->setPassword($this->encoder->encodePassword($user, $password));

            $manager->persist($user);
        }

        $manager->flush();
    }

    private function getUsersData() {
        return [
            ['pracownik@emp.pl', 'admin123'],
            ['asystent@emp.pl', 'admin123'],
            ['ksiegowy@emp.pl', 'admin123'],
        ];
    }

}
