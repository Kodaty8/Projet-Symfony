<?php

namespace App\Entity;

use App\Repository\OfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfferRepository::class)]
class Offer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $company = null;

    #[ORM\ManyToMany(targetEntity: Skill::class)]
    private Collection $requirements;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'applications')]
    private Collection $appliants;

    public function __construct()
    {
        $this->requirements = new ArrayCollection();
        $this->appliants = new ArrayCollection();
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

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection<int, Skill>
     */
    public function getRequirements(): Collection
    {
        return $this->requirements;
    }

    public function addRequirement(Skill $requirement): self
    {
        if (!$this->requirements->contains($requirement)) {
            $this->requirements->add($requirement);
        }

        return $this;
    }

    public function removeRequirement(Skill $requirement): self
    {
        $this->requirements->removeElement($requirement);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getAppliants(): Collection
    {
        return $this->appliants;
    }

    public function addAppliant(User $appliant): self
    {
        if (!$this->appliants->contains($appliant)) {
            $this->appliants->add($appliant);
        }

        return $this;
    }

    public function removeAppliant(User $appliant): self
    {
        $this->appliants->removeElement($appliant);

        return $this;
    }
}
