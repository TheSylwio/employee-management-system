<?php

namespace App\DataFixtures;

use App\Entity\Milestone;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MilestoneFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $i = 1;
        foreach ($this->getMilestoneData() as [$name, $description, $realizationTime]) {
            $milestone = new Milestone();
            $milestone
                ->setName($name)
                ->setDescription($description)
                ->setCompany($this->getReference('company_1'))
                ->setRealizationTime($realizationTime);
            $manager->persist($milestone);
            $this->addReference('milestone_' . $i++, $milestone);
        }
        $manager->flush();
    }

    private function getMilestoneData()
    {
        return [
            ['kamień milowy nr1', 'opis nr.1', DateTime::createFromFormat('d.m.Y', '11.12.2020')],
            ['kamień milowy nr2', 'opis nr.2', DateTime::createFromFormat('d.m.Y', '12.12.2020')],
            ['kamień milowy nr3', 'opis nr.3', DateTime::createFromFormat('d.m.Y', '13.12.2020')],
        ];
    }
}
