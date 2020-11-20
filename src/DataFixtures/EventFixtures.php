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
        foreach ($this->getEventData() as [$startDate, $endDate, $description]) {
            $event = new Event();
            $event
                ->setStartDate($startDate)
                ->setEndDate($endDate)
                ->setDescription($description)
                ->setCompany($this->getReference('company_1'));
            $manager->persist($event);
        }
        $manager->flush();
    }

    private function getEventData()
    {
        return [
            [DateTime::createFromFormat('d.m.Y', '11.11.2020'), DateTime::createFromFormat('d.m.Y', '11.11.2020'),'opis1' ],
            [DateTime::createFromFormat('d.m.Y', '22.01.2020'), DateTime::createFromFormat('d.m.Y', '10.12.2020'),'opis2'],
            [DateTime::createFromFormat('d.m.Y', '29.07.2020'), DateTime::createFromFormat('d.m.Y', '24.11.2020'),'opis3'],
            [DateTime::createFromFormat('d.m.Y', '11.02.2020'), DateTime::createFromFormat('d.m.Y', '26.11.2020'),'opis4'],
        ];
    }

    public function getDependencies()
    {
        return [
            CompanyFixtures::class,
        ];
    }
}
