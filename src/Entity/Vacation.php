<?php

namespace App\Entity;

use App\Repository\VacationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VacationRepository::class)
 */
class Vacation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $beginningOfVacation;

    /**
     * @ORM\Column(type="date")
     */
    private $endingOfVacation;

    /**
     * @ORM\ManyToOne(targetEntity=company::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity=employee::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $employee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vacationStatus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeginningOfVacation(): ?\DateTimeInterface
    {
        return $this->beginningOfVacation;
    }

    public function setBeginningOfVacation(\DateTimeInterface $beginningOfVacation): self
    {
        $this->beginningOfVacation = $beginningOfVacation;

        return $this;
    }

    public function getEndingOfVacation(): ?\DateTimeInterface
    {
        return $this->endingOfVacation;
    }

    public function setEndingOfVacation(\DateTimeInterface $endingOfVacation): self
    {
        $this->endingOfVacation = $endingOfVacation;

        return $this;
    }

    public function getCompany(): ?company
    {
        return $this->company;
    }

    public function setCompany(?company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getEmployee(): ?employee
    {
        return $this->employee;
    }

    public function setEmployee(?employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }

    public function getVacationStatus(): ?string
    {
        return $this->vacationStatus;
    }

    public function setVacationStatus(string $vacationStatus): self
    {
        $this->vacationStatus = $vacationStatus;

        return $this;
    }

}
