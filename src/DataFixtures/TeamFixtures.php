<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->loadTeams($manager);
    }

    private function loadTeams(ObjectManager $manager) {
        $team = new Team();
        $team
            ->setCompany($this->getReference('company_1'))
            ->setName("Pracownicy 1. kontaktu")
            ->setDescription("Opis pracowników 1. kontaktu");

        $manager->persist($team);
        $manager->flush();

        $this->addReference('team_1', $team);
    }

    public function getDependencies(): array
    {
        return [
            CompanyFixtures::class,
        ];
    }
}
