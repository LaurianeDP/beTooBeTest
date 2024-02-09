<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\Column]
    private ?int $ageRequirement = null;

    #[ORM\Column]
    private ?int $maximumParticipants = null;

    #[ORM\ManyToMany(targetEntity: user::class, inversedBy: 'activities')]
    private Collection $participants;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getAgeRequirement(): ?int
    {
        return $this->ageRequirement;
    }

    public function setAgeRequirement(int $ageRequirement): static
    {
        $this->ageRequirement = $ageRequirement;

        return $this;
    }

    public function getMaximumParticipants(): ?int
    {
        return $this->maximumParticipants;
    }

    public function setMaximumParticipants(int $maximumParticipants): static
    {
        $this->maximumParticipants = $maximumParticipants;

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(user $participant): static
    {
        if (!$this->participants->contains($participant)) {
            $this->participants->add($participant);
        }

        return $this;
    }

    public function removeParticipant(user $participant): static
    {
        $this->participants->removeElement($participant);

        return $this;
    }
}
