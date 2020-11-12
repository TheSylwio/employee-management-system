<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
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
    private $teamName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $teamLeader;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $teamDescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeamName(): ?string
    {
        return $this->teamName;
    }

    public function setTeamName(string $teamName): self
    {
        $this->teamName = $teamName;

        return $this;
    }

    public function getTeamLeader(): ?string
    {
        return $this->teamLeader;
    }

    public function setTeamLeader(string $teamLeader): self
    {
        $this->teamLeader = $teamLeader;

        return $this;
    }

    public function getTeamDescription(): ?string
    {
        return $this->teamDescription;
    }

    public function setTeamDescription(?string $teamDescription): self
    {
        $this->teamDescription = $teamDescription;

        return $this;
    }
}
