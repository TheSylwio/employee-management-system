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
        foreach ($this->getTaskData() as [$description, $creationDate, $deadline]) {
            $task = new Task();
            $task
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

    private function getTaskData()
    {
        return [
            ['opis1', DateTime::createFromFormat('d.m.Y', '11.11.2020'), DateTime::createFromFormat('d.m.Y', '11.12.2020')],
            ['opis2', DateTime::createFromFormat('d.m.Y', '11.11.2020'), DateTime::createFromFormat('d.m.Y', '12.12.2020')],
            ['opis3', DateTime::createFromFormat('d.m.Y', '11.11.2020'), DateTime::createFromFormat('d.m.Y', '13.12.2020')]
        ];
    }

    public function getDependencies()
    {
        return [
            StatusFixtures::class,
            MilestoneFixtures::class,
            EmployeeFixtures::class,
        ];
    }
}
