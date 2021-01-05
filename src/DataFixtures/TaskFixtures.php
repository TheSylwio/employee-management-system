<?php

namespace App\DataFixtures;

use App\Entity\Task;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TaskFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach ($this->getTaskData() as [$name, $description, $creationDate, $deadline]) {
            $task = new Task();
            $task
                ->setName($name)
                ->setDescription($description)
                ->setCreationDate($creationDate)
                ->setDeadline($deadline)
                ->setStatus($this->getReference('status_' . $i++))
                ->setMilestone($this->getReference('milestone_1'))
                ->setEmployee($this->getReference('employee_0'));
            $manager->persist($task);

        }
        $manager->flush();
    }

    private function getTaskData(): array
    {
        return [
            ['Zadanie 1', 'Opis 1', DateTime::createFromFormat('d.m.Y', '11.11.2020'), DateTime::createFromFormat('d.m.Y', '11.12.2020')],
            ['Zadanie 2', 'Opis 2', DateTime::createFromFormat('d.m.Y', '11.11.2020'), DateTime::createFromFormat('d.m.Y', '12.12.2020')],
            ['Zadanie 3', 'Opis 3', DateTime::createFromFormat('d.m.Y', '11.11.2020'), DateTime::createFromFormat('d.m.Y', '13.12.2020')]
        ];
    }

    public function getDependencies(): array
    {
        return [
            StatusFixtures::class,
            MilestoneFixtures::class,
            EmployeeFixtures::class,
        ];
    }
}
