<?php

namespace App\Entity;

use App\Repository\OvertimeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OvertimeRepository::class)
 */
class Overtime
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Employee::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $employee;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="overtimeDisposition")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="time")
     */
    private $beginHour;

    /**
     * @ORM\Column(type="time")
     */
    private $endHour;

    /**
     * @ORM\Column(type="text")
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCompany(): ?company
    {
        return $this->company;
    }

    public function setCompany(?company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBeginHour(): ?\DateTimeInterface
    {
        return $this->beginHour;
    }

    public function setBeginHour(\DateTimeInterface $beginHour): self
    {
        $this->beginHour = $beginHour;

        return $this;
    }

    public function getEndHour(): ?\DateTimeInterface
    {
        return $this->endHour;
    }

    public function setEndHour(\DateTimeInterface $endHour): self
    {
        $this->endHour = $endHour;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
