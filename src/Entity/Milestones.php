<?php

namespace App\Entity;

use App\Repository\MilestonesRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MilestonesRepository::class)
 */
class Milestones
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $realizationTime;

    /**
     * @ORM\OneToMany(targetEntity=Task::class, mappedBy="milestone")
     */
    private $taskid;

    public function __construct()
    {
        $this->taskid = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

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
    public function getTaskid(): Collection
    {
        return $this->taskid;
    }

    public function addTaskid(task $taskid): self
    {
        if (!$this->taskid->contains($taskid)) {
            $this->taskid[] = $taskid;
            $taskid->setMilestone($this);
        }

        return $this;
    }

    public function removeTaskid(task $taskid): self
    {
        if ($this->taskid->removeElement($taskid)) {
            // set the owning side to null (unless already changed)
            if ($taskid->getMilestone() === $this) {
                $taskid->setMilestone(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->Name .'';
    }

}
