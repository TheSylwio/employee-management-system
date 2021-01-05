<?php

namespace App\DataFixtures;


use App\Entity\Event;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EventFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getEventData() as [$name, $startDate, $endDate, $description]) {
            $event = new Event();
            $event
                ->setName($name)
                ->setStartDate($startDate)
                ->setEndDate($endDate)
                ->setDescription($description)
                ->setCompany($this->getReference('company_1'));
            $manager->persist($event);
        }
        $manager->flush();
    }

    private function getEventData(): array
    {
        return [
            ['Event 1', DateTime::createFromFormat('d.m.Y', '11.11.2020'), DateTime::createFromFormat('d.m.Y', '11.11.2020'), 'opis1'],
            ['Event 2', DateTime::createFromFormat('d.m.Y', '22.01.2020'), DateTime::createFromFormat('d.m.Y', '10.12.2020'), 'opis2'],
            ['Event 3', DateTime::createFromFormat('d.m.Y', '29.07.2020'), DateTime::createFromFormat('d.m.Y', '24.11.2020'), 'opis3'],
            ['Event 4', DateTime::createFromFormat('d.m.Y', '11.02.2020'), DateTime::createFromFormat('d.m.Y', '26.11.2020'), 'opis4'],
        ];
    }

    public function getDependencies(): array
    {
        return [
            CompanyFixtures::class,
        ];
    }
}
