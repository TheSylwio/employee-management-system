<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Employee::class, inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $employee;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $deadline;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Wpisz opis zadania")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="task")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Milestone::class, inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $milestone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }

    public function getCreationDate(): ?DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getDeadline(): ?DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(DateTimeInterface $deadline): self
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getMilestone(): ?Milestone
    {
        return $this->milestone;
    }

    public function setMilestone(?Milestone $milestone): self
    {
        $this->milestone = $milestone;

        return $this;
    }

    /**
     * @Assert\IsTrue(message="Wpisz poprawny termin realizacji")
     */
    public function isDeadlineValid(): bool
    {
        return $this->deadline > new DateTime('now');
    }
}
