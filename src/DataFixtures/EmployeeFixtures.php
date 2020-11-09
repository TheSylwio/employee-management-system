<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EmployeeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->loadEmployees($manager);
    }

    private function loadEmployees(ObjectManager $manager)
    {
        $i = 0;
        
        foreach ($this->getEmployeesData() as [$firstName, $surname, $dateOfBirth, $pesel, $address]) {
            $employee = new Employee();
            $employee
                ->setFirstName($firstName)
                ->setSurname($surname)
                ->setDateOfBirth($dateOfBirth)
                ->setPesel($pesel)
                ->setAddress($address)
                ->setCompany($this->getReference('company_1'))
            ;

            $manager->persist($employee);
            $this->addReference('employee_' . $i++, $employee);
        }

        $manager->flush();
    }

    private function getEmployeesData()
    {
        return [
            ['Jan', 'Koniczyna', \DateTime::createFromFormat('d.m.Y', '11.06.1962'), 12312312346, 'Bytom ul. Konopnickiej 15'],
            ['Adam', 'Kowalski', \DateTime::createFromFormat('d.m.Y', '22.01.1978'), 12312312347, 'Katowice ul. Katowicka 1'],
            ['Michał', 'Nowak', \DateTime::createFromFormat('d.m.Y', '29.07.1972'), 12312312348, 'Katowice ul. Chorzowska 3'],
            ['Tadeusz', 'Ziobro', \DateTime::createFromFormat('d.m.Y', '11.02.1960'), 12312312345, 'Chorzów ul. Zielona 2'],
        ];
    }

    public function getDependencies()
    {
        return [
            CompanyFixtures::class,
        ];
    }
}
