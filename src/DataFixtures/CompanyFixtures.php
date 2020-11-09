<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadCompanies($manager);
    }

    private function loadCompanies(ObjectManager $manager) {
        $company = new Company();
        $company
            ->setName("Testowa firma")
            ->setAddress("41-100 Katowice Katowicka 2B");
        $manager->persist($company);
        $manager->flush();

        $this->addReference('company_1', $company);
    }
}
