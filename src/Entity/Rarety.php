<?php

namespace App\Entity;

use App\Repository\RaretyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RaretyRepository::class)
 */
class Rarety
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Etherystal::class, mappedBy="rarety")
     */
    private $etherystals;

    public function __construct()
    {
        $this->etherystals = new ArrayCollection();
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

    /**
     * @return Collection|Etherystal[]
     */
    public function getEtherystals(): Collection
    {
        return $this->etherystals;
    }

    public function addEtherystal(Etherystal $etherystal): self
    {
        if (!$this->etherystals->contains($etherystal)) {
            $this->etherystals[] = $etherystal;
            $etherystal->setRarety($this);
        }

        return $this;
    }

    public function removeEtherystal(Etherystal $etherystal): self
    {
        if ($this->etherystals->removeElement($etherystal)) {
            // set the owning side to null (unless already changed)
            if ($etherystal->getRarety() === $this) {
                $etherystal->setRarety(null);
            }
        }

        return $this;
    }
    

    public function __toString()
    {
        return $this->name;
    }
}