<?php

namespace App\Service;

use App\Entity\Company;
use App\Entity\Employee;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Helper
{
    private SessionInterface $session;
    private ManagerRegistry $em;

    public function __construct(SessionInterface $session, ManagerRegistry $em)
    {
        $this->session = $session;
        $this->em = $em;
    }

    /**
     * @return object|null
     */
    public function getCompany(): ?object
    {
        if (!$this->session->has('company')) return null;

        $repo = $this->em->getRepository(Company::class);
        return $repo->find($this->session->get('company'));
    }

    /**
     * @return object|null
     */
    public function getEmployee(): ?object
    {
        if (!$this->session->has('employee')) return null;

        $repo = $this->em->getRepository(Employee::class);
        return $repo->find($this->session->get('employee'));
    }
}