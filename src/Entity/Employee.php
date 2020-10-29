<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 */
class Employee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surName;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="string", length=11)
     */
    private $pesel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getfirstName(): ?string
    {
        return $this->firstName;
    }

    public function setfirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getsurName(): ?string
    {
        return $this->surName;
    }

    public function setsurName(string $surName): self
    {
        $this->surName = $surName;

        return $this;
    }

    public function getdateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setdateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getpesel(): ?string
    {
        return $this->pesel;
    }

    public function setpesel(string $pesel): self
    {
        $this->pesel = $pesel;

        return $this;
    }

    public function getaddress(): ?string
    {
        return $this->address;
    }

    public function setaddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }
}
