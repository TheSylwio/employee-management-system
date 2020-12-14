<?php

namespace App\Entity;

use App\Repository\MilestoneRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MilestoneRepository::class)
 */
class Milestone
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(
     *  message=""
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(
     *     message="Podaj opis kamienia milowego"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $realizationTime;

    /**
     * @ORM\OneToMany(targetEntity=Task::class, mappedBy="milestone")
     */
    private $tasks;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="milestones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getRealizationTime(): ?DateTimeInterface
    {
        return $this->realizationTime;
    }

    public function setRealizationTime(DateTimeInterface $realizationTime): self
    {
        $this->realizationTime = $realizationTime;

        return $this;
    }

    /**
     * @return Collection|task[]
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setMilestone($this);
        }

        return $this;
    }

    public function removeTask(task $task): self
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getMilestone() === $this) {
                $task->setMilestone(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->name;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
