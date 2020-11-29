<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $i=0;
        foreach ($this->getStatusData() as [$category,$name]) {
            $staus =new Status();
            $staus
                ->setCategory($category)
                ->setName($name)
                ->setCompany($this->getReference('company_1'));
            $manager->persist($staus);
            $this->addReference('status_'.$i++.'', $staus);
        }
        $manager->flush();
    }
    private function getStatusData()
    {
        return [
            ['done', 'zrobione' ],
            ['not_done', 'rozpoczęcie projeku' ],
            ['in_progress','w trakcie pracy'],
            ['in_progress','czekanie na sprawdzenie']
        ];
    }
    public function getDependencies()
    {
        return [
            CompanyFixtures::class,
        ];
    }
}
